<?php
/*
Plugin Name: AppThemes Confirm Email
Plugin URI: http://marketplace.appthemes.com/plugins/confirm-email/
Description: Require from users to confirm email upon registration in AppThemes themes.

AppThemes ID: confirm-email

Version: 1.0
Author: AppThemes
Author URI: http://www.appthemes.com
Text Domain: appthemes-confirm-email
*/

define( 'APP_CE_TD', 'appthemes-confirm-email' );

/**
 * Avoid calling file directly.
 */
if ( ! function_exists( 'add_action' ) ) {
	die( 'Whoops! You shouldn\'t be doing that.' );
}


/**
 * Load Text-Domain
 */
load_plugin_textdomain( APP_CE_TD, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


/**
 * Process actions on plugin activation.
 *
 * @return void
 */
function appthemes_confirm_email_plugin_activate() {
	global $wp_roles;

	if ( class_exists( 'WP_Roles' ) ) {
		if ( ! isset( $wp_roles ) ) {
			$wp_roles = new WP_Roles();
		}
	}

	$wp_roles->add_role( 'pending', __( 'Pending User', APP_CE_TD ), array(
		'read' => false,
		'edit_posts' => false,
		'delete_posts' => false,
	) );

}
register_activation_hook( plugin_basename( __FILE__ ), 'appthemes_confirm_email_plugin_activate' );


/**
 * Setups email confirmation.
 *
 * @return void
 */
function appthemes_confirm_email_setup() {

	// Check for AppThemes theme presence
	if ( ! current_theme_supports( 'app-login' ) ) {
		if ( ! appthemes_confirm_email_is_network_activated() ) {
			add_action( 'admin_notices', 'appthemes_confirm_email_display_warning' );
		}
		return;
	}

	add_action( 'register_post', 'appthemes_confirm_email_register_post' );
	add_filter( 'appthemes_after_registration', 'appthemes_confirm_email_registration_redirect', 9999, 2 );

	add_action( 'authenticate', 'appthemes_confirm_email_authenticate', 100, 3 );
	add_filter( 'allow_password_reset', 'appthemes_confirm_email_allow_password_reset', 10, 2 );

	add_action( 'template_redirect', 'appthemes_confirm_email_template_redirect' );

	add_action( 'appthemes_notices', 'appthemes_confirm_email_action_messages' );
	add_action( 'appthemes_confirm_email_new_user_activated', 'appthemes_confirm_email_new_user_activated', 10, 2 );

	add_action( 'appthemes_confirm_email_request_activate', 'appthemes_confirm_email_user_activation' );
	add_action( 'appthemes_confirm_email_request_sendactivation', 'appthemes_confirm_email_send_activation' );

}
add_action( 'after_setup_theme', 'appthemes_confirm_email_setup', 9999 );


/**
 * Display warning and disable plugin if AppThemes compatible product not installed.
 *
 * @return void
 */
function appthemes_confirm_email_display_warning() {

	if ( ! function_exists( 'appthemes_init' ) ) {
		$message = __( 'AppThemes Confirm Email does not support the current theme. Please use one of AppThemes theme.', APP_CE_TD );
	} else if ( ! current_theme_supports( 'app-login' ) ) {
		$message = __( 'AppThemes Confirm Email does not support the current theme. Your theme not using the AppThemes themed login pages.', APP_CE_TD );
	} else {
		$message = __( 'AppThemes Confirm Email does not support the current theme.', APP_CE_TD );
	}

	echo '<div class="error fade"><p>' . $message . '</p></div>';
	deactivate_plugins( plugin_basename( __FILE__ ) );
}


/**
 * Checks if plugin is network activated.
 *
 * @return bool
 */
function appthemes_confirm_email_is_network_activated() {
	if ( ! is_multisite() ) {
		return false;
	}

	$plugins = get_site_option( 'active_sitewide_plugins' );

	return isset( $plugins[ plugin_basename( __FILE__ ) ] );
}


/**
 * Applies user moderation upon registration.
 *
 * @return void
 */
function appthemes_confirm_email_register_post() {
	// Remove default new user notification
	if ( has_action( 'appthemes_after_registration', 'wp_new_user_notification' ) ) {
		remove_action( 'appthemes_after_registration', 'wp_new_user_notification', 10, 2 );
	}

	// Clipper, ClassiPress, JobRoller
	if ( has_action( 'appthemes_after_registration', 'app_new_user_notification' ) ) {
		remove_action( 'appthemes_after_registration', 'app_new_user_notification', 10, 2 );
	}

	// Moderate user upon registration
	add_action( 'appthemes_after_registration', 'appthemes_confirm_email_moderate_user', 100, 2 );
}


/**
 * Applies moderation to a newly registered user.
 *
 * @param int $user_id The user's ID
 * @param string $user_pass The user's password
 *
 * @return void
 */
function appthemes_confirm_email_moderate_user( $user_id, $user_pass ) {
	global $wpdb;

	// Set user role to "pending"
	$user = new WP_User( $user_id );

	// Make sure user isn't already "Pending"
	if ( in_array( 'pending', (array) $user->roles ) ) {
		return;
	}

	// Set user to "pending" role
	update_user_meta( $user_id, 'user_original_roles', (array) $user->roles );
	$user->set_role( 'pending' );

	// Temporarily save plaintext pass
	$show_password_fields = apply_filters( 'show_password_fields_on_registration', true );
	if ( $show_password_fields ) {
		$user_pass = isset( $_POST['pass1'] ) ? stripslashes( trim( $_POST['pass1'] ) ) : '';
		update_user_meta( $user_id, 'user_pass', $user_pass );
	}

	// Generate an activation key
	$key = wp_generate_password( 20, false );

	// Set the activation key for the user
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'user_login' => $user->user_login ) );

	// Send activation e-mail
	appthemes_confirm_email_new_user_activation_notification( $user_id, $key );
}


/**
 * Notifies a pending user to activate their account.
 *
 * @param int $user_id The user's ID
 * @param string $key (optional) The unique activation key
 *
 * @return void
 */
function appthemes_confirm_email_new_user_activation_notification( $user_id, $key = '' ) {
	global $wpdb, $current_site;

	$user = new WP_User( $user_id );

	$user_login = stripslashes( $user->user_login );
	$user_email = stripslashes( $user->user_email );

	if ( empty( $key ) ) {
		$key = $wpdb->get_var( $wpdb->prepare( "SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login ) );
		if ( empty( $key ) ) {
			$key = wp_generate_password( 20, false );
			$wpdb->update( $wpdb->users, array( 'user_activation_key' => $key ), array( 'user_login' => $user_login ) );
		}
	}

	$activation_url = add_query_arg( array( 'action' => 'activate', 'key' => $key, 'login' => rawurlencode( $user_login ) ), wp_login_url() );

	$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	$subject = sprintf( __( '[%s] Activate Your Account', APP_CE_TD ), $blogname );

	$message  = html( 'p', sprintf( __( 'Thanks for registering at %s!', APP_CE_TD ), $blogname ) ) . PHP_EOL;
	$message .= html( 'p', sprintf( __( 'To complete the activation of your account please click the following link: %s', APP_CE_TD ), $activation_url ) ) . PHP_EOL;
        $message .= '<a href="'.$activation_url.'">'.$activation_url.'</a>';
	$email = array( 'to' => $user_email, 'subject' => $subject, 'message' => $message );
	$email = apply_filters( 'appthemes_confirm_email_new_user_activation_notification', $email, $user_id, $key );

	appthemes_send_email( $email['to'], $email['subject'], $email['message'] );
}


/**
 * Changes the registration redirection.
 *
 * @param int $user_id The user's ID
 * @param string $user_pass The user's password
 *
 * @return void
 */
function appthemes_confirm_email_registration_redirect( $user_id, $user_pass ) {

	$redirect_to = APP_Login::get_url( 'raw' );
	$redirect_to = add_query_arg( array( 'pending' => 'activation' ), $redirect_to );

	wp_redirect( $redirect_to );
	exit;
}


/**
 * Blocks "pending" users from loggin in.
 *
 * @param object $user WP_User object
 * @param string $username Username posted
 * @param string $password Password posted
 *
 * @return object WP_User if the user can login, WP_Error otherwise
 */
function appthemes_confirm_email_authenticate( $user, $username, $password ) {
	global $wpdb;

	if ( $userdata = get_user_by( 'login', $username ) ) {
		if ( in_array( 'pending', (array) $userdata->roles ) ) {
			$sendactivation_url = APP_Login::get_url( 'raw' );
			$sendactivation_url = add_query_arg( array( 'action' => 'sendactivation', 'login' => $username ), $sendactivation_url );

			return new WP_Error( 'pending', sprintf( __( '<strong>ERROR</strong>: You have not yet confirmed your e-mail address. <a href="%s">Resend activation</a>?', APP_CE_TD ), $sendactivation_url ) );
		}
	}

	return $user;
}


/**
 * Blocks "pending" users from resetting their password.
 *
 * @param bool $allow Default setting
 * @param int $user_id User ID
 *
 * @return bool Whether to allow password reset or not
 */
function appthemes_confirm_email_allow_password_reset( $allow, $user_id ) {
	$user = get_user_by( 'id', $user_id );
	if ( in_array( 'pending', (array) $user->roles ) ) {
		return false;
	}

	return $allow;
}


/**
 * Handles display of various action/status messages.
 *
 * @return void
 */
function appthemes_confirm_email_action_messages() {
	if ( isset( $_GET['pending'] ) ) {
		switch ( $_GET['pending'] ) {
			case 'activation' :
				appthemes_display_notice( 'success', __( 'Your registration was successful but you must now confirm your email address before you can log in. Please check your email and click on the link provided.', APP_CE_TD ) );
				break;
		}
	}

	if ( isset( $_GET['activation'] ) ) {
		switch ( $_GET['activation'] ) {
			case 'complete' :
				$show_password_fields = apply_filters( 'show_password_fields_on_registration', true );
				if ( $show_password_fields ) {
					appthemes_display_notice( 'success', __( 'Your account has been activated. You may now log in.', APP_CE_TD ) );
				} else {
					appthemes_display_notice( 'success', __( 'Your account has been activated. Please check your e-mail for your password.', APP_CE_TD ) );
				}
				break;
			case 'invalidkey' :
				appthemes_display_notice( 'error', __( '<strong>ERROR</strong>: Sorry, that key does not appear to be valid.', APP_CE_TD ) );
				break;
		}
	}

	if ( isset( $_GET['sendactivation'] ) ) {
		switch ( $_GET['sendactivation'] ) {
			case 'failed' :
				appthemes_display_notice( 'error', __( '<strong>ERROR</strong>: Sorry, the activation e-mail could not be sent.', APP_CE_TD ) );
				break;
			case 'sent' :
				appthemes_display_notice( 'success', __( 'The activation e-mail has been sent to the e-mail address with which you registered. Please check your email and click on the link provided.', APP_CE_TD ) );
				break;
			case 'activated' :
				appthemes_display_notice( 'success', __( 'Your account is already activated. You can log in.', APP_CE_TD ) );
				break;
		}
	}
}


/**
 * Sends the new user notification email.
 *
 * @param int $user_id The user's ID
 * @param string $user_pass The user's password
 *
 * @return void
 */
function appthemes_confirm_email_new_user_activated( $user_id, $user_pass ) {
	// Clipper, ClassiPress, JobRoller
	if ( function_exists( 'app_new_user_notification' ) ) {
		app_new_user_notification( $user_id, $user_pass );
	} else {
		wp_new_user_notification( $user_id, $user_pass );
	}
}


/**
 * Handles "activate" action for login page.
 *
 * @return void
 */
function appthemes_confirm_email_user_activation() {
	// Attempt to activate the user
	$errors = appthemes_confirm_email_activate_new_user( $_GET['key'], $_GET['login'] );

	$redirect_to = APP_Login::get_url( 'raw' );

	// Make sure there are no errors
	if ( ! is_wp_error( $errors ) ) {
		$redirect_to = add_query_arg( array( 'activation' => 'complete' ), $redirect_to );
	} else {
		$redirect_to = add_query_arg( array( 'activation' => 'invalidkey' ), $redirect_to );
	}

	wp_redirect( $redirect_to );
	exit;
}


/**
 * Handles "send_activation" action for login page.
 *
 * @return void
 */
function appthemes_confirm_email_send_activation() {
	global $wpdb;

	$login = isset( $_GET['login'] ) ? trim( $_GET['login'] ) : '';
	$redirect_to = APP_Login::get_url( 'raw' );

	if ( ! $user_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->users WHERE user_login = %s", $login ) ) ) {
		$redirect_to = add_query_arg( array( 'sendactivation' => 'failed' ), $redirect_to );
		wp_redirect( $redirect_to );
		exit;
	}

	do_action( 'appthemes_confirm_email_user_activation_resend', $user_id );

	$user = new WP_User( $user_id );

	if ( in_array( 'pending', (array) $user->roles ) ) {
		// Send activation e-mail
		appthemes_confirm_email_new_user_activation_notification( $user->ID );
		// Now redirect them
		$redirect_to = add_query_arg( array( 'sendactivation' => 'sent' ), $redirect_to );
		wp_redirect( $redirect_to );
		exit;
	} else {
		// Account already activated
		$redirect_to = add_query_arg( array( 'sendactivation' => 'activated' ), $redirect_to );
		wp_redirect( $redirect_to );
		exit;
	}
}


/**
 * Handles activating a new user by user email confirmation.
 *
 * @param string $key Hash to validate sending confirmation email
 * @param string $login User's username for logging in
 *
 * @return bool|WP_Error True if successful, WP_Error otherwise
 */
function appthemes_confirm_email_activate_new_user( $key, $login ) {
	global $wpdb;

	$key = preg_replace( '/[^a-z0-9]/i', '', $key );

	if ( empty( $key ) || ! is_string( $key ) ) {
		return new WP_Error( 'invalid_key', __( 'Invalid key', APP_CE_TD ) );
	}

	if ( empty( $login ) || ! is_string( $login ) ) {
		return new WP_Error( 'invalid_key', __( 'Invalid key', APP_CE_TD ) );
	}

	// Validate activation key
	$user = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $key, $login ) );
	if ( empty( $user ) ) {
		return new WP_Error( 'invalid_key', __( 'Invalid key', APP_CE_TD ) );
	}

	do_action( 'appthemes_confirm_email_user_activation_post', $user->user_login, $user->user_email );

	// Allow plugins to short-circuit process and send errors
	$errors = new WP_Error();
	$errors = apply_filters( 'appthemes_confirm_email_user_activation_errors', $errors, $user->user_login, $user->user_email );

	// Return errors if there are any
	if ( $errors->get_error_code() ) {
		return $errors;
	}

	// Clear the activation key
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => '' ), array( 'user_login' => $login ) );

	// Set user role
	$user_object = new WP_User( $user->ID );
	$user_object->remove_role( 'pending' );

	$user_roles = get_user_meta( $user->ID, 'user_original_roles', true );
	if ( empty( $user_roles ) || ! is_array( $user_roles ) ) {
		$user_roles = array( get_option( 'default_role' ) );
	}

	foreach ( $user_roles as $role_name ) {
		$user_object->add_role( $role_name );
	}

	// Check for plaintext pass
	$show_password_fields = apply_filters( 'show_password_fields_on_registration', true );
	$user_pass = get_user_meta( $user->ID, 'user_pass', true );
	if ( ! $show_password_fields && ! $user_pass ) {
		$user_pass = wp_generate_password();
		wp_set_password( $user_pass, $user->ID );
	}

	// Delete plaintext pass and roles
	delete_user_meta( $user->ID, 'user_pass' );
	delete_user_meta( $user->ID, 'user_original_roles' );

	do_action( 'appthemes_confirm_email_new_user_activated', $user->ID, $user_pass );

	return true;
}


/**
 * Proccesses the request.
 *
 * @return void
 */
function appthemes_confirm_email_template_redirect() {
	$request_action = isset( $_REQUEST['action'] ) ? sanitize_key( $_REQUEST['action'] ) : '';

	if ( has_action( 'appthemes_confirm_email_request_' . $request_action ) ) {
		do_action( 'appthemes_confirm_email_request_' . $request_action );
	}
}

