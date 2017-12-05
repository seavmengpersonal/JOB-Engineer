<?php
/*
Template Name: User Profile
*/

nocache_headers();

appthemes_auth_redirect_login();

$userdata = wp_get_current_user(); // grabs the user info and puts into vars

// check to see if the form has been posted. If so, validate the fields
if(!empty($_POST['submit'])) {

	require_once(ABSPATH . 'wp-admin/includes/user.php');

	check_admin_referer('update-profile_' . get_current_user_id());

	$errors = edit_user($user_ID);

	$errmsg = '';
	if ( is_wp_error( $errors ) ) { 
		foreach( $errors->get_error_messages() as $message )
			$errmsg = $message;
	}

	// if there are no errors, then process the ad updates
	if ( ! $errmsg ) {
		// update the user fields
		do_action('personal_options_update', $user_ID);

		// update the custom user fields
		foreach ( array( 'twitter_id', 'facebook_id', 'linkedin_profile', 'nationality','r_sex','d_month','d_year','d_day','r_marital','r_location','r_address','r_email','website','r_profile') as $field )
			update_user_meta($user_ID, $field, strip_tags(stripslashes($_POST[$field])));

		$d_url = $_POST['dashboard_url'];
		$n_url = wp_redirect( './?updated=true&d='. $d_url );
                $var_url = ""; 
                
                if(!isset($_GET['action']))
                {
                   if(user_can($user_ID, 'can_submit_resume')) 
                   { 
                     $var_url = site_url('edit-resume');
                   }
                   if(user_can($user_ID, 'can_submit_job')) 
                   { 
                     $var_url = site_url('submit-job');
                   }
                   $str_button = "Next";
                }
                else
                { 
                   $var_url=site_url('my-dashboard'); 
                }

                if($n_url){
                   wp_redirect($var_url);
                }

	}

}	        $var_string = "";
                if(user_can($user_ID, 'can_submit_resume')) 
                { 
                     $var_string = "Create CV";
                }
                if(user_can($user_ID, 'can_submit_job')) 
                { 
                     $var_string = "Create Job";
                }
?>
	<div class="section">
		
	<div class="break-word panel">
       <div class="col-lg-9">
			<ol class="steps ">
			<li class="current"><span class="first">Create Profile</span></li>
			<li class=""><span class=""><?php echo $var_string ?></span></li>
			<li class=""><span class="">Preview</span></li>
			<li class=""><span class="last">Confirm</span></li>
			</ol>

			<?php 
			if ( empty($errmsg) && isset($_GET['updated']) ) :
				$d_url = $_GET['d'];
				appthemes_display_notice( 'success', __( 'Your profile has been updated.', APP_TD ) );
			endif;
			?>

				<form name="profile" id="your-profile" action="" method="post" class="main_form" autocomplete="off">
					
					<div>
						<?php wp_nonce_field('update-profile_' . $user_ID) ?>
						<input type="hidden" name="from" value="profile" />
						<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
						<input type="hidden" id="user_login" name="user_login" value="<?php echo $userdata->user_login ?>" />
					</div>
					
					<div class="col-lg-12">
					
						<legend><?php _e('Your Details', APP_TD); ?></legend>
			
						<p><label for="first_name"><?php echo stripslashes(get_option('tr_first_name'))  ?></label> <input type="text" name="first_name" class="text form-control" id="first_name" value="<?php echo $userdata->first_name ?>" maxlength="100" /></p>
						
						<p><label for="last_name"><?php echo stripslashes(get_option('tr_last_name'))  ?></label> <input type="text" name="last_name" class="text form-control" id="last_name" value="<?php echo $userdata->last_name ?>" maxlength="100" /></p>
						
						<p><label for="nickname"><?php _e('Nickname/Company Name',APP_TD) ?></label> <input type="text" name="nickname" class="text form-control" id="nickname" value="<?php echo $userdata->nickname ?>" maxlength="100" /></p>
						
						<p><label for="display_name"><?php _e('Display Name',APP_TD) ?></label> <select name="display_name" class="select form-control" id="display_name">
						<?php
								$public_display = array();
								$public_display['display_displayname'] = $userdata->display_name;
								$public_display['display_nickname'] = $userdata->nickname;
								$public_display['display_username'] = $userdata->user_login;
								$public_display['display_firstname'] = $userdata->first_name;
								$public_display['display_firstlast'] = $userdata->first_name.' '.$userdata->last_name;
								$public_display['display_lastfirst'] = $userdata->last_name.' '.$userdata->first_name;
								$public_display = array_unique(array_filter(array_map('trim', $public_display)));
								foreach($public_display as $id => $item) {
						?>
								<option id="<?php echo $id; ?>" value="<?php echo $item; ?>"><?php echo $item; ?></option>
						<?php
								}
						?>
						</select></p>
						
						<p><label for="email"><?php _e('Email',APP_TD) ?></label> <input type="text" name="email" class="text form-control" id="email" value="<?php echo $userdata->user_email ?>" maxlength="100" /></p>
					
					 
					
					<!---<fieldset>
						<legend><?php _e('Websites &amp; Social media', APP_TD); ?></legend>
					
						<p><label for="url"><?php _e('Website',APP_TD) ?></label> <input type="text" name="url" class="text regular-text" id="url" value="<?php echo $userdata->user_url ?>" maxlength="100" /></p>
						
						<p><label for="twitter_id"><?php _e('Twitter ID',APP_TD) ?></label> <input type="text" name="twitter_id" class="text regular-text" id="twitter_id" value="<?php echo get_user_meta($user_ID, 'twitter_id', true); ?>" maxlength="100" /></p>
						
						<p><label for="facebook_id"><?php _e('Facebook ID',APP_TD) ?></label> <input type="text" name="facebook_id" class="text regular-text" id="facebook_id" value="<?php echo get_user_meta($user_ID, 'facebook_id', true); ?>" maxlength="100" /></p>
						
						<p><label for="linkedin_profile"><?php _e('LinkedIn profile URL',APP_TD) ?></label> <input type="text" name="linkedin_profile" class="text regular-text" id="linkedin_profile" value="<?php echo get_user_meta($user_ID, 'linkedin_profile', true); ?>" maxlength="100" /></p>

					</fieldset>
					
					<fieldset>
						<legend><?php _e('Profile', APP_TD); ?></legend>
						
						<p><?php _e('Enter a description below; this information will appear on your profile.', APP_TD); ?></p>
					
						<p><label for="description"><?php _e('Profile content',APP_TD); ?></label> <textarea name="description" class="text form-control" id="description" rows="10" cols="50"><?php echo $userdata->description ?></textarea></p>
						
					</fieldset>--->
                                        
					<?php
						do_action('profile_personal_options', $userdata);
						do_action('show_user_profile', $userdata);
					?>
					
					<?php
					$show_password_fields = apply_filters('show_password_fields', true);
					if ( $show_password_fields ) :
					?>
					 
						<legend><?php _e('Change password', APP_TD); ?></legend>
						<p><?php _e('Leave this field blank unless you would like to change your password.',APP_TD); ?> <?php _e('Your password should be at least seven characters long.',APP_TD); ?></p>
						<p><label for="pass1"><?php _e('New Password',APP_TD); ?></label> <input type="password" name="pass1" class="text form-control" id="pass1" maxlength="50" value="" /></p>
						<p><label for="pass1"><?php _e('Password Again',APP_TD); ?></label> <input type="password" name="pass2" class="text form-control" id="pass21" maxlength="50" value="" /></p>						
					 
					<?php endif; ?>
					
					 
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_ID; ?>" />
						<?php if(!isset($_GET['action'])) 
						{ ?>
						   <input type="submit" class="submit btn" name="submit" value="<?php _e(' Next >>', APP_TD)?>" />
						<?php 
						} else { ?>
						   <input type="submit" class="submit btn btn-primary" name="submit" value="<?php _e(' Save ', APP_TD)?>" />
						<?php } ?>
					</div>
				</form>

		</div><!-- shadowblockout -->
		<!--show side bar accound option-->
		<div class='col-md-3 col-lg-3'>
			<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('user'); ?>
		</div>
	</div><!-- shadowblock -->

	</div><!-- end section -->
	
	<script type='text/javascript' src='<?php echo get_bloginfo('wpurl'); ?>/wp-admin/js/password-strength-meter.js?ver=20081210'></script>
	<script type="text/javascript">
	// <![CDATA[
		(function($){
		
			 $(document).ready( function() {
	
				function check_pass_strength () {
		
					var pass = $('#pass1').val();
					var pass2 = $('#pass2').val();
					var user = $('#user_login').val();
		
					$('#pass-strength-result').removeClass('short bad good strong');
					if ( ! pass ) {
						$('#pass-strength-result').html( pwsL10n.empty );
						return;
					}

					var strength = passwordStrength(pass, user, pass2);
		
					if ( 2 == strength )
						$('#pass-strength-result').addClass('bad').html( pwsL10n.bad );
					else if ( 3 == strength )
						$('#pass-strength-result').addClass('good').html( pwsL10n.good );
					else if ( 4 == strength )
						$('#pass-strength-result').addClass('strong').html( pwsL10n.strong );
					else if ( 5 == strength )
						 $('#pass-strength-result').addClass('short').html( pwsL10n.mismatch );
					else
						$('#pass-strength-result').addClass('short').html( pwsL10n.short );
		
				}
	
				$('#pass1, #pass2').val('').keyup( check_pass_strength );
			});
		})(jQuery);

		pwsL10n = {
			empty: "<?php _e('Strength indicator',APP_TD) ?>",
			short: "<?php _e('Very weak',APP_TD) ?>",
			bad: "<?php _e('Weak',APP_TD) ?>",
			good: "<?php _e('Medium',APP_TD) ?>",
			strong: "<?php _e('Strong',APP_TD) ?>",
			mismatch: "<?php _e('Mismatch',APP_TD) ?>"
		}
		try{convertEntities(pwsL10n);}catch(e){};
	// ]]>
	</script>

	<div class="clear"></div>

</div><!-- end main content -->

