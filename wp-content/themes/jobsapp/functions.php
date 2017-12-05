<?php

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles )) {
		//check for admins
		if ( in_array( 'administrator', $user->roles )) {
			return $redirect_to;
		} else {

                      return home_url('after-login'); 
		}

	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

if(!is_admin()){
	remove_action('wp_head', 'wp_print_scripts');
	//remove_action('wp_head', 'wp_print_head_scripts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	
	add_action('wp_footer', 'wp_print_scripts', 5);
	//add_action('wp_footer', 'wp_print_head_scripts', 5);
        add_action('wp_footer', 'wp_enqueue_scripts', 5);		
}


register_nav_menus(array(
	'job_seeker'=> __('Job Seeker Menu'),
	'employer' => __('Employer Menu'),
));

//*//
add_filter( 'jr_load_style', '__return_true' );


// display the login message in the header/sidebar
if (!function_exists('jr_login_head')) {
    function jr_login_head() {
        if (is_user_logged_in()) :
			global $current_user;
			get_currentuserinfo();
			?>
			
<ul>
<li> <a><?php _e('Welcome, ',APP_TD); ?><strong><?php echo $current_user->user_login; ?></strong></a></li>
<li><?php echo '<a href="'.get_permalink( JR_Dashboard_Page::get_id() ).'">'.__('My Dashboard', APP_TD).'</a> ';?></li>
<li><a href="<?php echo wp_logout_url(); ?>"><?php _e('Log out',APP_TD); ?></a></li>

</ul>
		<?php else : ?>
			<?php



	global $posted;
	
	if (!$action) $action = site_url('wp-login.php');
	if (!$redirect) $redirect = get_permalink(get_option('jr_dashboard_page_id'));
	?>

	<form action="<?php echo APP_Login::get_url(); ?>" method="post" class="account_form" id="login-form">
		
           
               <div id="lefty" > <label id="lefty" for="login_username"><?php _e('Username', APP_TD); ?>:</label></div>
                <input type="text" class="text2" name="log" id="login_username" value="<?php if (isset($posted['login_username'])) echo $posted['login_username']; ?>" />
          

   <div id="spacer"></div>
              <div id="lefty" > <label id="lefty" for="login_password"><?php _e('Password', APP_TD); ?>:</label></div>
                <input type="password" class="text2" name="pwd" id="login_password" value="" />
          
           
                <input type="hidden" name="redirect_to" value="<?php echo $redirect; ?>" />
                <input type="hidden" name="rememberme" value="forever" />
 <div id="spacer"></div>
<div id="lefty"></div>

              <div id="lefty1" >
				<label></label><input type="checkbox" name="rememberme" class="checkbox" tabindex="3" id="rememberme" value="forever" checked="checked"/></label>
				</div>
			<label for="rememberme"><?php _e('Remember me', APP_TD ); ?></label>
			
               
                   

	        <p>
	        <div id="lefty" ></div>
	            <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect); ?>" />

                <input type="submit" class="submit2" name="login" value="<?php _e('Login &rarr;', APP_TD); ?>" />

   <div id="spacer"></div>
           <div id="lefty" ></div>     <a class="lostpassy" href="<?php echo site_url('wp-login.php?action=lostpassword', 'login') ?>" title="<?php _e('Password Lost and Found', APP_TD); ?>"><?php _e('Lost your password?', APP_TD); ?></a>
            

	</form>


        <?php endif;

    }
}


// validate fields
function at_validate_custom_fields( $login, $email, $errors ) {
 
  // fields to be validated
  $fields = array(
	'user_login' => __( 'Name', APP_TD ),  

  );
 
  // check for empty required fields an display notice
  foreach ( $fields as $field => $value ) {
	if ( empty( $_POST[$field] ) ) {
		$errors->add('empty_fields', __('<strong>ERROR</strong>: &ldquo;', APP_TD).$value.__('&rdquo; is a required field.', APP_TD));
	}
  }
 
  // check for invalid names (letters and spaces)
  if ( ! empty( $_POST['last_name'] ) && preg_match("/[^a-zA-Z ]/", $_POST['last_name']) ) {
	$errors->add('invalid_name', __('<strong>ERROR</strong>: &ldquo;', APP_TD).$fields['last_name'].__('&rdquo; does not contain a valid name.', APP_TD));
  }
 
  // additional custom fields validations here
 
}


// validate custom fields
add_action( 'register_post', 'at_validate_custom_fields', 10, 3 );


// register the extra fields as user metadata
function at_register_custom_fields( $user_id, $password = "", $meta = array() )  {
 
	// custom fields
	$fields = array(
		'company',
		'phone',
		'last_name',
		'first_name',
                'r_industry',
	);
        // cleans and updates the custom fields
	foreach ( $fields as $field ) {
	    $value = stripslashes( trim( $_POST[$field] ) ) ;
	    if ( ! empty( $value ) ) {
	  	 update_user_meta( $user_id, $field, $value );
	    }
	}
 
}


// save the custom fields to the database as soon as the user is registered on the database
add_action( 'user_register', 'at_register_custom_fields' );


// display custom fields/values on the backend or frontend
function at_custom_fields_display( $user ) {
   $user_id = $user->ID;

?>
   <?php if ( is_admin() ) { ?>
        <!-- // show the backend HTML -->
	<h3><?php _e('Additional Information', APP_TD); ?></h3>
 
 	<table class="form-table">
	<tr>
	  <th><label for="company"><?php _e('Company', APP_TD); ?></label></th>
	  <td>
	   <input class="text" type="text" name="company" id="company" value="<?php echo get_user_meta( $user_id, 'company', true ) ; ?>">		
	   </td>
	   
	   
	    <th><label for="phone"><?php _e('Phone', APP_TD); ?></label></th>
	  <td>
	   <input class="text" type="text" name="phone" id="phone" value="<?php echo get_user_meta( $user_id, 'phone', true ) ; ?>">		
	   </td>

	      </tr>
      </table>
 
	<?php }
       if($user->roles[0] == 'job_lister' || $user->roles[0] == 'administrator' ||  $user->roles[0] == 'recruiter'){?>

           <p>
	    <label for="company"><?php _e('Company', APP_TD); ?></label>
	    <input class="text form-control" type="text" name="company" id="company" value="<?php echo get_user_meta( $user_id, 'company', true ) ; ?>">		
	   </p>

           <p>
	    <label for="phone"><?php _e('Website', APP_TD); ?></label>
	    <input class="text form-control" type="text" name="website" id="website" placeholder="http://" value="<?php echo get_user_meta( $user_id, 'website', true ) ; ?>">		
	   </p>        
	   
	   <p>
	    <label for="phone"><?php _e('Phone', APP_TD); ?></label>
	    <input class="text form-control" type="text" name="phone" id="phone" value="<?php echo get_user_meta( $user_id, 'phone', true ) ; ?>">		
	   </p>

          <p><label for="hire"><?php _e('Location', APP_TD); ?> <span title="required">*</span></label> 
				<select name="r_location" id="r_location" required class="form-control">
                                  <option value="">  Select... </option>
				<?php
$r_location= get_user_meta( $user_id, 'r_location', true ); 
				$job_types = get_terms( 'job_loc', array( 'hide_empty' => false,'orderby' => 'description','order'=> 'ASC' ) );
				if ($job_types && sizeof($job_types) > 0) {
                                                
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $r_location==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select></p>

<p ><label for="address"><?php _e('Address', APP_TD); ?></label> <textarea class="form-control" rows="5" cols="30" name="r_address" id="r_address" placeholder="<?php _e('Phnom Penh, Cambodia.', APP_TD); ?>" class="short" style="height:100px;"><?php echo get_user_meta( $user_id, 'r_address', true ); ?></textarea></p>

<?php //wp_editor( get_user_meta( $user_id, 'r_profile', true ), 'r_profile', jr_get_editor_settings( array( 'editor_class' => 'how' ) ) ); ?>

       <?php }
       if($user->roles[0] == 'job_seeker') { ?>
 
        <!-- // show the frontend HTML -->
	<fieldset>
	   <legend><?php _e('Personal Information', APP_TD); ?></legend>
	   <p style="display:none;">
	    <label for="company"><?php _e('Company', APP_TD); ?></label>
	    <input class="text" type="text" name="company" id="company" value="<?php echo get_user_meta( $user_id, 'company', true ) ; ?>">		
	   </p>

          <p style="display:none;">
	    <label for="company"><?php _e('Email', APP_TD); ?></label>
	    <input class="text" type="text" name="r_email" id="r_email" value="<?php echo get_user_meta( $user_id, 'r_email', true ) ; ?>">		
	   </p>
	   <div class='col-md-12'>
		   <div class='col-md-2'>
			<p>  <label for="phone"><?php _e('Phone', APP_TD); ?></label></p> 
			</div>
			<div class='col-md-5'>
			<input class="text  phone form-control" type="tel" pattern=".{9,10}"  name="phone" id="phone" value="<?php echo get_user_meta( $user_id, 'phone', true ) ; ?>">		
			</div>
		</div>
		<div class='col-md-12'>
			<div class='col-md-2'>
			<p>
				<label for="company"><?php _e('Nationality', APP_TD); ?></label></p>
			</div>
			<div class='col-md-5'>
				<input class="text form-control" type="text" name="nationality" id="nationality" value="<?php echo get_user_meta( $user_id, 'nationality', true ) ; ?>">		
			</div>
		</div>
		<div class='col-md-12'>
				<div class='col-md-2'>
			   <p><label for="hire"><?php _e('Sex', APP_TD); ?> <span title="required">*</span></label> 	</p>
			   </div>
			   <div class='col-md-2'>
				<select name="r_sex" id="r_sex" class='form-control'>
				<?php
							$r_sex = get_user_meta( $user_id, 'r_sex', true );          
				$job_types = get_terms( 'r_sex', array( 'hide_empty' => false,'orderby' => 'description','order'=> 'ASC' ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $r_sex==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
					</select>
				</div>
		</div> 
		
		<div class='col-md-12'>
			<div class='col-md-2'>
          <p><label for="dob"><?php _e('Date of Birth', APP_TD); ?></label></p>
		  </div>
		  <div class='col-md-2'>
                <select style="width:118px" class="day form-control" name="d_day">
                     <option value="0">Day</option>
                     <?php
 $d_day= get_user_meta( $user_id, 'd_day', true ); 
 for($i=1; $i<=31; $i++){ ?>
                     <option <?php if($d_day==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                     <?php } ?>
                </select>
			</div>
		<div class='col-md-2'>
                <select style="width:118px" class="month form-control" name="d_month">
                     <option value="0">Month</option>
                     <?php 
 $d_month= get_user_meta( $user_id, 'd_month', true ); 
$months = array("January","February","March","April", "May","June","July","August","September","October","November","December");
                     foreach($months as $key => $month){ ?>
		<option <?php if($d_month==$month){ echo 'selected'; } ?> value="<?= $month ?>"><?= $month ?></option>
	    <?php } ?>
                </select>
				</div>
				<div class='col-md-2'>
                <select style="width:118px" class="year form-control" name="d_year">
                     <option value="0">Year</option>
                     <?php 
$d_year= get_user_meta( $user_id, 'd_year', true ); 
for($i=1980; $i<=2016; $i++){ ?>
                     <option <?php if($d_year==$i){ echo 'selected'; } ?> value="<?= $i ?>"><?= $i ?></option>
                     <?php } ?>
                </select>
				
				</div>
		</div>
		<div class='col-md-12'>
			<div class='col-md-2'>
			<p><label for="hire"><?php _e('Marital', APP_TD); ?> <span title="required">*</span></label> </p>
				</div>
				<div class='col-md-2'>
				<select name="r_marital" id="r_marital" class='form-control'>
				<?php
$r_marital= get_user_meta( $user_id, 'r_marital', true ); 
				$job_types = get_terms( 'r_marital', array( 'hide_empty' => false,'orderby' => 'description','order'=> 'ASC' ) );
				if ($job_types && sizeof($job_types) > 0) {
				foreach ($job_types as $type) { ?>
				<option <?php if ( $r_marital==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
				<?php } } ?>
			</select>
			</div>
		</div>
		<div class='col-md-12'>
			<div class='col-md-2'>
				<p><label for="hire"><?php _e('Location', APP_TD); ?> <span title="required">*</span></label> </p>
			</div>
			<div class='col-md-3'>
				<select name="r_location" id="r_location" class='form-control' required>
                                <option value="">  Select... </option>
				<?php
$r_location= get_user_meta( $user_id, 'r_location', true ); 
				$job_types = get_terms( 'job_loc', array( 'hide_empty' => false ) );
				if ($job_types && sizeof($job_types) > 0) {
					foreach ($job_types as $type) {
						?>
						<option <?php if ( $r_location==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
						<?php
					}
				}
				?>
			</select>
			</div>
		</div>
		
<p style="display:none;"><label for="address"><?php _e('Address', APP_TD); ?></label> <textarea rows="5" cols="30" name="r_address" id="r_address" placeholder="<?php _e('Phnom Penh, Cambodia.', APP_TD); ?>" class="short" style="height:100px;"><?php echo get_user_meta( $user_id, 'r_address', true ); ?></textarea></p>    
  
	</fieldset>
	<br/>
 
	<?php } ?>
<?php
}




// display the custom fields on the user profile page (frontend and admin)
add_action( 'show_user_profile', 'at_custom_fields_display' ); // frontend
add_action( 'edit_user_profile', 'at_custom_fields_display' ); // backend








   
   
   
   
   
   
   // updates custom fields
function at_custom_fields_update( $user_id ) {
 
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
 
	// updatable fields
	$fields = array(
		'company',
		'phone',
	'last_name',
		'first_name', 
	);
 
	foreach ( $fields as $field ) {
		$value = stripslashes( trim( $_POST[$field] ) ) ;
		if ( ! empty( $value ) ) {
			update_user_meta( $user_id, $field, $value );
		}
	}
 
}






// additional fields update
add_action( 'edit_user_profile_update', 'at_custom_fields_update' );
add_action( 'personal_options_update', 'at_custom_fields_update' );




















$args = array(
	'name'          => sprintf(__('Sidebar %d'), $i ),
	'id'            => 'sidebar-$i',
	'description'   => '',
	'before_widget' => '<li id="%1$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2>',
	'after_title'   => '</h2>' 
);



/*custom sidebars*/
function at_register_sidebars2() {


 register_sidebar(array(
        'name'          => __('Home featured logos',APP_TD),
        'id'            => 'sidebar_home',
        'description'   => 'Do not insert here anything except the featured logos',
     	'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="home-title">',
        'after_title'   => '</h2>',
    ));
	
	
	 register_sidebar(array(
        'name'          => __('Login Sidebar',APP_TD),
        'id'            => 'sidebar_login',
        'description'   => '',
        'before_widget' => '<li id="%1$s" class="widget %2$s"><div>',
        'after_widget'  => '</div></li>',
        'before_title'  => '</div><h2 class="widget_title">',
        'after_title'   => '</h2><div class="widget_content">',
    ));
	
	}
	// tell WordPress to add these to the theme
add_action( 'wp_loaded', 'at_register_sidebars2' );




function at_register_sidebars() {
 
	$max_columns = get_option('footer_layout'); // change to number of columns you want to add to your footer
	$text_domain = APP_TD; // the text domain to use for translating the strings
 
	foreach ( range(1, $max_columns) as $number ) {
		$sidebar_name = sprintf(__('Footer Column %d', $text_domain), $number );		
		register_sidebar( array(
			'name' 		=> $sidebar_name,
			'description' 	=> '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</li>',
			'before_title' 	=> '<h2 class="widgettitle">',
			'after_title'	=> '</h2>',
		) );
	}		
}




//if no footer area is selected then shows nothing in widgets

	if (get_option('footer_layout') != '0') { 
		add_action( 'wp_loaded', 'at_register_sidebars' );
	} else {}

	
// This child theme uses wp_nav_menu() in three locations.
register_nav_menus( array(
	'top' => __( 'Top Bar Navigation' , APP_TD ),
	'primary' => __( 'Primary Navigation', APP_TD ),
	'footer' => __( 'Footer Menu', APP_TD ),
) );



// login using email or usernam
function login_with_email_address($username) {
	$user = get_user_by_email($username);
	if(!empty($user->user_login))
		$username = $user->user_login;
	return $username;
}
add_action('wp_authenticate','login_with_email_address');




/// create tasonomy for location 
function loc_init() {
	// create a new taxonomy

if(get_option('job_loc_tax_permalink')) $loc_tax_base_url = get_option('job_loc_tax_permalink'); else $loc_tax_base_url = 'job-location';


    register_taxonomy( APP_TAX_LOCATION,
            array( APP_POST_TYPE ),
            array('hierarchical' => true,
                    'labels' => array(
                            'name' => __( 'Job location', APP_TD),
                            'singular_name' => __( 'Job location', APP_TD),
                            'search_items' =>  __( 'Search Location', APP_TD),
                            'all_items' => __( 'All Locations', APP_TD),
                            'parent_item' => __( 'Parent Location', APP_TD),
                            'parent_item_colon' => __( 'Parent Location:', APP_TD),
                            'edit_item' => __( 'Edit Location', APP_TD),
                            'update_item' => __( 'Update Location', APP_TD),
                            'add_new_item' => __( 'Add New Location', APP_TD),
                            'new_item_name' => __( 'New Location', APP_TD)
                    ),
                    'show_ui' => true,
                    'query_var' => true,
					'update_count_callback' => '_update_post_term_count',
                    'rewrite' => array( 'slug' => $loc_tax_base_url ),
            )
    );
}
add_action( 'init', 'loc_init' );
define('APP_TAX_LOCATION', 'job_loc');




// register new taxonomy permalink
if(get_option($app_abbr.'_job_loc_tax_permalink') == false) update_option($app_abbr.'_job_loc_tax_permalink', 'job-location');



// Feed url in taxonomies pages //

// Get Page URL
if ( !function_exists('jt_get_current_url') ) {
function jt_get_current_url($url = '') {

	if (is_front_page() || is_search() || is_front_page()) :
		return trailingslashit(get_bloginfo('wpurl'));
	elseif (is_category()) :
		return trailingslashit(get_category_link(get_cat_id(single_cat_title("", false))));
	elseif (is_tax()) :

		$job_cat = get_query_var('job_cat');
		$job_type = get_query_var('job_type');
		$job_loc = get_query_var('job_loc');
		
		if (isset($job_cat) && $job_cat) :
			$slug = $job_cat;
			return trailingslashit(get_term_link( $slug, 'job_cat' ));
			
			
		elseif (isset($job_type) && $job_type) :
			$slug = $job_type;
			return trailingslashit(get_term_link( $job_type, 'job_type' ));
			
			elseif (isset($job_loc) && $job_loc) :
			$slug = $job_loc;
			return trailingslashit(get_term_link( $job_loc, 'job_loc' ));
			
		endif;

	endif;
	return trailingslashit($url);
}
}



//change default wordpress email sender
function res_fromemail($email) {
    $wpfrom = get_option('admin_email');
    return $wpfrom;
}
 
function res_fromname($email){
    $wpfrom = get_option('blogname');
    return $wpfrom;
}

add_filter('wp_mail_from', 'res_fromemail');
add_filter('wp_mail_from_name', 'res_fromname');


// output sponsored listings 
if ( !function_exists('jr_display_sponsored_results') ):
function jr_display_sponsored_results( $search_results, $params, $is_ajax = false, $page = 1 ) {

	$defaults = array (
		'link_class'  => array('more_sponsored_results', 'front_page'),
		'tax'		  => '',
		'term'		  => ''
	);	
	$params = wp_parse_args( $params, $defaults );
	
	$alt = 1;
	$first = true;
	
	if (!$is_ajax) :
		echo sprintf('<div class="section">', esc_html($params['title']));
   		echo sprintf('<ol class="jobs sponsored_results" source="%s">', esc_attr($params['source']));
	endif;

foreach ($search_results as $job) :

		$job_defaults = array (
			'onmousedown' => '',
		);
		$job = wp_parse_args( $job, $job_defaults );

		$post_class = array('job');
		if ($alt==1) $post_class[] = 'job-alt';

		// check for the special sponsored job types (i.e: paid, sponsored or organic) and add them as classes
		if ( isset($job['type']) && $job['type'] ) $post_class[] = 'ty_' . strtolower( $params['source'] ) . '_' . $job['type'];

		// check for the additional classes to add
		if ( isset($job['class']) && $job['class'] ) $post_class[] = $job['class'];

		?>
		
	<li class="<?php esc_attr_e( implode(' ', $post_class) ); ?>" <?php if ($is_ajax && $first) echo 'id="more-'.$page.'"'; ?>><dl>
            <dt><?php _e('Job', APP_TD); ?></dt>
            <div id="titlo">
			<strong><a href="<?php echo esc_url($job['url']); ?>" onmous edown="<?php echo esc_attr($job['onmousedown']); ?>" target="_blank" rel="nofollow"><?php echo esc_html($job['jobtitle']); ?></a></strong></div>
         
         
         
         
         <div id="type-tag"><span class="ftype <?php esc_attr_e($job['jobtype']); ?>"><?php echo ucwords(esc_html($job['jobtype_name'])); ?></span></div>
<div id="type-tag-prev"><span class="ftype <?php esc_attr_e($job['jobtype']); ?>"><?php echo ucwords(esc_html($job['jobtype_name'])); ?></span></div>

<div class="spacer"></div>
         
  <div id="exc"><?php echo wptexturize($job['snippet']); ?></div>

 <div  id="location-indeed"><strong><?php _e('Location:', APP_TD); ?> </strong><?php echo esc_html($job['location']); ?> <?php echo esc_html($job['country']); ?></div>
            <div id="date"><span class="year"> <?php echo date_i18n('j/m/Y', strtotime($job['date'])); ?></span></div>
            <div id="details-2"><strong><a href="<?php echo esc_url($job['url']); ?>" onmousedown="<?php echo $x['onmousedown']; ?>" target="_blank" rel="nofollow"><?php _e('Details', APP_TD); ?></a> </strong></div>
            <div id="faceb"><a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($job['url']); ?>" target="_blank" >Facebook</a></div>

        </dl></li>
	    
		<?php		
	endforeach;
	
if (!$is_ajax) :

		echo '</ol>
		<div class="paging sponsored_results_paging">
	        <div style="float:left;"><a href="#more" source="'. esc_attr($params['source']) .'" callback="' . esc_attr($params['callback']) . '" class="'.esc_attr(implode(' ', $params['link_class'])).'" tax="'.esc_attr($params['tax']).'" term="'.esc_attr($params['term']).'" rel="2" >Load More &raquo;</a></div>
			<p class="attribution"><a href="'.esc_url($params['url']).'">jobs</a> by <a href="'.esc_url($params['url']).'" title="Job Search" target="_new"><img src="' . esc_attr($params['jobs_by_img']) . '" alt="' . esc_attr($params['source']) . ' job search" /></a></p>
	    </div></div>';

    endif;    
        	
}
endif;



 


// Function to output pagination
if (!function_exists('jr_paging_static')) {
function jr_paging_static() {

	?>
	<div class="clear"></div>
    <div class="paging">
      
<div class="pagination-s">
            <div style="float:left; margin-right:10px"><a href="<?php echo get_permalink(get_option('jr_jobs_page_id')); ?>page/2/"><?php _e('Next page &raquo;', APP_TD); ?></a></div>

     </div>
    </div>
    <?php
}
}


// Function to output pagination
if (!function_exists('jr_paging')) {
function jr_paging( $new_wp_query = null, $query_var = 'paged', $args = array() ) {
	global $wp_query;
?>
		<div class="clear"></div>
		<div class="paging">
<?php
		if ( ! $new_wp_query ) $new_wp_query = $wp_query;

		if ( $new_wp_query->max_num_pages > 1 ) {

			if ( function_exists('wp_pagenavi') ) {
				$args['query'] = $new_wp_query;
				jr_wp_pagenavi_tab_pagination( $args );
				wp_pagenavi( $args );
			} else {
				appthemes_pagenavi( $new_wp_query, $query_var, $args ); 
			}
		}
?>
	</div>
<?php
}
}




// create a new iamge size for the lisging logo
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'logoso', 220, 180, true ); //(cropped)
}













// call to define time ago in loop jobs
// add_filter('the_time', 'timeago');

// function timeago()
// {
    // global $post;

    // $date = $post->post_date;

    // $time = get_post_time('G', true, $post);

    // $time_diff = time() - $time;

    // if( $time_diff > 0 && $time_diff < 24*60*60 )
        // $display = sprintf( __('<span class="new">new</span>'), human_time_diff( $time ) );
    // else
        // $display = date(get_option(''), strtotime($date) );

    // return $display;
// }




//call the admin options
include_once 'admin/options-init.php';








if ( !is_admin() ) {
} else {
	require_once( get_stylesheet_directory() . '/includes/install-script.php' );
};



//load scripts
 wp_enqueue_script('smoothscroll', get_bloginfo('stylesheet_directory').'/includes/js/smoothscroll.js', array('jquery'), '');
 wp_enqueue_script('carrosel', get_bloginfo('stylesheet_directory').'/js/infinite-carousel.js', array('jquery'), '');
//wp_enqueue_script('marker', get_bloginfo('stylesheet_directory').'/includes/map/js/marker.js', array('jquery'), '');
  
  
  
  
  
  
  
  
  
  /*widgets*/
  
  
  

    class JR_login_Widget extends WP_Widget {
    function JR_login_Widget() {
    $widget_ops = array('classname' => 'widget_login_links', 'description' => 'Website login form' );
    $this->WP_Widget('login_links', 'jobsapp login form widget', $widget_ops);
    }
    function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

 ?>


<?php jr_login_head();  ?>


 <?php


    echo $after_widget;
    }
    function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
    }
    function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
    $title = strip_tags($instance['title']);
    ?>

    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  

 <?php
    }
    }




class JR_search_Widget extends WP_Widget {
    function JR_search_Widget() {
    $widget_ops = array('classname' => 'widget_search_links', 'description' => 'Search bar widget' );
    $this->WP_Widget('search_links', 'jobsapp search widget', $widget_ops);
    }
function widget($args, $instance) {
extract($args, EXTR_SKIP);
echo $before_widget;
$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
$entry_title = empty($instance['entry_title']) ? ' ' : apply_filters('widget_entry_title', $instance['entry_title']);
if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
echo '<ul>';
			 get_template_part( 'search', 'widget' ); 
			

echo '</ul>';
echo $after_widget;
}
function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
$instance['entry_title'] = strip_tags($new_instance['entry_title']);

return $instance;
}
function form($instance) {
$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
$title = strip_tags($instance['title']);
$entry_title = strip_tags($instance['entry_title']);
$comments_title = strip_tags($instance['comments_title']);
$comments_title2 = strip_tags($instance['comments_title2']);
?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

 <?php
    }
    }














   class JR_contact_Widget extends WP_Widget {
    function JR_contact_Widget() {
    $widget_ops = array('classname' => 'widget_contact_links', 'description' => 'Website contact details' );
    $this->WP_Widget('contact_links', 'jobsapp Contact details widget', $widget_ops);
    }
function widget($args, $instance) {
extract($args, EXTR_SKIP);
echo $before_widget;
$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
$entry_title = empty($instance['entry_title']) ? ' ' : apply_filters('widget_entry_title', $instance['entry_title']);
$comments_title = empty($instance['comments_title']) ? ' ' : apply_filters('widget_comments_title', $instance['comments_title']);
$comments_title2 = empty($instance['comments_title2']) ? ' ' : apply_filters('widget_comments_title2', $instance['comments_title2']);
if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
echo '<ul>';
echo '<li><a>' . $entry_title . '</a></li>';
echo '<li><a>' . $comments_title . '</a></li>';
echo '<li><a>' . $comments_title2 . '</a></li>';
echo '</ul>';
echo $after_widget;
}
function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
$instance['entry_title'] = strip_tags($new_instance['entry_title']);
$instance['comments_title'] = strip_tags($new_instance['comments_title']);
$instance['comments_title2'] = strip_tags($new_instance['comments_title2']);
return $instance;
}
function form($instance) {
$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'entry_title' => '', 'comments_title' => '' ) );
$title = strip_tags($instance['title']);
$entry_title = strip_tags($instance['entry_title']);
$comments_title = strip_tags($instance['comments_title']);
$comments_title2 = strip_tags($instance['comments_title2']);
?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('entry_title'); ?>">Entry 1 (ex:Phone:..)<input class="widefat" id="<?php echo $this->get_field_id('entry_title'); ?>" name="<?php echo $this->get_field_name('entry_title'); ?>" type="text" value="<?php echo attribute_escape($entry_title); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('comments_title'); ?>">Entry 2 (ex:Fax:..)<input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('comments_title2'); ?>">Entry 3 (ex:Email:..)<input class="widefat" id="<?php echo $this->get_field_id('comments_title2'); ?>" name="<?php echo $this->get_field_name('comments_title2'); ?>" type="text" value="<?php echo attribute_escape($comments_title2); ?>" /></label></p>

 <?php
    }
    }




    





// 80 ad
class JR_Widget_80ad extends WP_Widget {

    function JR_Widget_80ad() {
        $widget_ops = array( 'description' => __( 'Places an ad space in the sidebar for 80x75 ads', APP_TD) );
		$control_ops = array('width' => 77, 'height' => 75);
        $this->WP_Widget(false, __('80X75 Ad Space', APP_TD), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {

        extract($args);

		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : false;
		$newin = isset( $instance['newin'] ) ? $instance['newin'] : false;


        if (isset($instance['ads'])) :

			// separate the ad line items into an array
        	$ads = explode("\n", $instance['ads']);

        	if (sizeof($ads)>0) :

				echo $before_widget;

				if ($title) echo $before_title . $title . $after_title;
				echo '<div class="pad5"></div>';
				if ($newin) $newin = 'target="_blank"';
			?>

				<ul class="ads">
				<?php
				$alt = 1;
				foreach ($ads as $ad) :
					if ($ad && strstr($ad, '|')) {
						$alt = $alt*-1;
						$this_ad = explode('|', $ad);
						echo '<li class="logos';
						if ($alt==1) echo '';
						echo '"><a href="'.$this_ad[0].'" rel="'.$this_ad[3].'" '.$newin.'><img src="'.$this_ad[1].'" width="77" height="75" alt="'.$this_ad[2].'" /></a></li>';
					}
				endforeach;
				?>
				</ul>

				<?php
				echo $after_widget;

	        endif;

        endif;
    }

   function update($new_instance, $old_instance) {
        $instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ads'] = strip_tags( $new_instance['ads'] );
		$instance['newin'] = $new_instance['newin'];

		return $instance;
    }

	function form( $instance ) {

		// load up the default values
		$default_ads = "http://jobthemes.com|".get_stylesheet_directory_uri()."/images/your-logo.jpg|Ad 1|nofollow\n"."http://jobthemes.com|".get_stylesheet_directory_uri()."/images/your-logo.jpg|Ad 1|nofollow\n"."http://jobthemes.com|".get_stylesheet_directory_uri()."/images/your-logo.jpg|Ad 1|nofollow\n"."http://jobthemes.com|".get_stylesheet_directory_uri()."/images/your-logo.jpg|Ad 2|follow\n"."http://jobthemes.com|".get_stylesheet_directory_uri()."/images/your-logo.jpg|Ad 3|nofollow\n"."http://jobthemes.com|".get_stylesheet_directory_uri()."/images/your-logo.jpg|Ad 4|follow";
		$defaults = array( 'title' => __('', APP_TD), 'ads' => $default_ads, 'rel' => true );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label><?php _e('Title:', APP_TD) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label><?php _e('Ads:', APP_TD); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('ads'); ?>" cols="5" rows="5"><?php echo $instance['ads']; ?></textarea>
			<?php _e('Enter one ad entry per line in the following format:<br /> <code>URL|Image URL|Image Alt Text|rel</code><br /><strong>Note:</strong> You must hit your &quot;enter/return&quot; key after each ad entry otherwise the ads will not display properly.',APP_TD); ?>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['newin'], 'on'); ?> id="<?php echo $this->get_field_id('newin'); ?>" name="<?php echo $this->get_field_name('newin'); ?>" />
			<label><?php _e('Open ads in a new window?', APP_TD); ?></label>
		</p>
<?php
	}
}




// the latest job listings sidebar widget
class JR_Widget_Recent_Job extends WP_Widget {

	function JR_Widget_Recent_Job() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The mossst recent job listings on your site", APP_TD) );
		$this->WP_Widget('recent-jobs', __('New Job Listings', APP_TD), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_jobs', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('New Job Listings', APP_TD) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'post_type' => 'job_listing', 'ignore_sticky_posts' => 1));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_jobs', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_jobs', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', APP_TD); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of jobs to show:', APP_TD); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}




// sidebar top Listings today widget
class JR_Widget_Top_Listings_Today2 extends WP_Widget {

    function JR_Widget_Top_Listings_Today2() {
        $widget_ops = array( 'description' => __( 'Your sidebar top listings today', APP_TD) );
        $this->WP_Widget('top_listings', __('Popular Listings Today', APP_TD), $widget_ops);
    }

    function widget( $args, $instance ) {

        extract($args);
        
        $post_type = (isset($instance['post_type']) && $instance['post_type']) ? $instance['post_type'] : 'job_listing';
        
        if ($post_type=='job_listing') :
        	$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Jobs Today', APP_TD) : $instance['title']);
		else :
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular CV  Today', APP_TD) : $instance['title']);
		endif;
		
        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;

        jr_todays_count_widgets($post_type, 10);

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['post_type'] = strip_tags(stripslashes($new_instance['post_type']));
        return $instance;
    }

    function form($instance) {
    
    $post_type = (isset($instance['post_type'])) ? $instance['post_type'] : 'job_listing';
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', APP_TD) ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ($instance['title'])) {echo esc_attr( $instance['title']);} ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Post type:', APP_TD) ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
		<option value="job_listing" <?php selected('job_listing', $post_type) ?>><?php _e('Job', APP_TD) ?></option>
		<option value="resume" <?php selected('resume', $post_type) ?>><?php _e('CV', APP_TD) ?></option>
	</select>
	</p>
<?php
    }
}




// sidebar top Listings overall widget
class JR_Widget_Top_Listings_Overall2 extends WP_Widget {

    function JR_Widget_Top_Listings_Overall2() {
        $widget_ops = array( 'description' => __( 'Your sidebar top listings overall', APP_TD) );
        $this->WP_Widget('top_listings_overall', __('Popular listings Overall', APP_TD), $widget_ops);
    }

    function widget( $args, $instance ) {

        extract($args);
        
        $post_type = (isset($instance['post_type']) && $instance['post_type']) ? $instance['post_type'] : 'job_listing';
        
        if ($post_type=='job_listing') :
        	$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Jobs Overall', APP_TD) : $instance['title']);
		else :
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular CV Overall', APP_TD) : $instance['title']);
		endif;
		
        echo $before_widget;
        if ( $title )
			echo $before_title . $title . $after_title;
        
        jr_todays_overall_count_widgets($post_type, 10);

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['post_type'] = strip_tags(stripslashes($new_instance['post_type']));
        return $instance;
    }

    function form($instance) {
    
    $post_type = (isset($instance['post_type'])) ? $instance['post_type'] : 'job_listing';
    
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', APP_TD) ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ($instance['title'])) { echo esc_attr( $instance['title']);} ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Post type:', APP_TD) ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>">
		<option value="job_listing" <?php selected('job_listing', $post_type) ?>><?php _e('Job', APP_TD) ?></option>
		<option value="resume" <?php selected('resume', $post_type) ?>><?php _e('CV', APP_TD) ?></option>
	</select>
	</p>
<?php
    }
}



// 110x75 home ad
class JR_Widget_80ads extends WP_Widget {

    function JR_Widget_80ads() {
        $widget_ops = array( 'description' => __( 'This is home featured ads, Add it only for home page', 'appthemes') );
		$control_ops = array('width' => 500, 'height' => 350);
        $this->WP_Widget(false, __('JobsApp 88x73 Home featured ads', 'appthemes'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {

        extract($args);

		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : false;
		$newin = isset( $instance['newin'] ) ? $instance['newin'] : false;


        if (isset($instance['ads'])) :

			// separate the ad line items into an array
        	$ads = explode("\n", $instance['ads']);

        	if (sizeof($ads)>0) :
echo '<div id="home-featured-right">';
				echo $before_widget;

				if ($title) echo $before_title . $title . $after_title;

				if ($newin) $newin = 'target="_blank"';
			?>

				<ul class="home-ad">
				<?php
				$alt = 1;
				foreach ($ads as $ad) :
					if ($ad && strstr($ad, '|')) {
						$alt = $alt*-1;
						$this_ad = explode('|', $ad);
						echo '<li class="';
						if ($alt==1) echo '';
						echo '"><a href="'.$this_ad[0].'" rel="'.$this_ad[3].'" '.$newin.'><img src="'.$this_ad[1].'" width="90" height="76" alt="'.$this_ad[2].'" /></a></li>';
					}
				endforeach;
				?>
				</ul></div>

				<?php
				echo $after_widget;

	        endif;

        endif;
    }

   function update($new_instance, $old_instance) {
        $instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ads'] = strip_tags( $new_instance['ads'] );
		$instance['newin'] = $new_instance['newin'];

		return $instance;
    }

	function form( $instance ) {

		// load up the default values
		$default_ads = "http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 1|nofollow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 2|follow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 3|nofollow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 4|nofollow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 5|nofollow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 6|nofollow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 7|nofollow\n"."http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/adver90.jpg|Ad 8|nofollow\n";
		$defaults = array( 'title' => __('Sponsored Ads', 'appthemes'), 'ads' => $default_ads, 'rel' => true );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label><?php _e('Title:', 'appthemes') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label><?php _e('Ads:', 'appthemes'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('ads'); ?>" cols="5" rows="5"><?php echo $instance['ads']; ?></textarea>
			<?php _e('Enter one ad entry per line in the following format:<br /> <code>URL|Image URL|Image Alt Text|rel</code><br /><strong>Note:</strong> You must hit your &quot;enter/return&quot; key after each ad entry otherwise the ads will not display properly.',APP_TD); ?>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['newin'], 'on'); ?> id="<?php echo $this->get_field_id('newin'); ?>" name="<?php echo $this->get_field_name('newin'); ?>" />
			<label><?php _e('Open ads in a new window?', 'appthemes'); ?></label>
		</p>
<?php
	}
}

// 150x150 Ad home
class JR_Widget_150ad extends WP_Widget {

    function JR_Widget_150ad() {
        $widget_ops = array( 'description' => __( 'This is home page featured ads, Add it only for home featured sidebar', 'appthemes') );
		$control_ops = array('width' => 500, 'height' => 350);
        $this->WP_Widget(false, __('JobsApp 250x160 Home page Ads', 'appthemes'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {

        extract($args);

		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : false;
		$newin = isset( $instance['newin'] ) ? $instance['newin'] : false;


        if (isset($instance['ads'])) :

			// separate the ad line items into an array
        	$ads = explode("\n", $instance['ads']);

        	if (sizeof($ads)>0) :

				echo $before_widget;
echo '<div id="home-featured-left">';
				if ($title) echo $before_title . $title . $after_title;
				
				if ($newin) $newin = 'target="_blank"';
				
				foreach ($ads as $ad) :
					if ($ad && strstr($ad, '|')) {
						$this_ad = explode('|', $ad);
						echo '<a href="'.$this_ad[0].'" rel="'.$this_ad[3].'" '.$newin.'><img src="'.$this_ad[1].'" width="250" height="160" alt="'.$this_ad[2].'" /></a>';
					}
				endforeach;

				echo $after_widget;
						echo '<div class="pad5"></div></div>';


	        endif;

        endif;
    }


   function update($new_instance, $old_instance) {
        $instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ads'] = strip_tags( $new_instance['ads'] );
		$instance['newin'] = $new_instance['newin'];

		return $instance;
    }

	function form( $instance ) {

		// load up the default values
		$default_ads = "http://sitename.com|".get_bloginfo('stylesheet_directory')."/images/250.jpg|Ad 1|follow\n";
		$defaults = array( 'title' => __('Sponsored Ads', 'appthemes'), 'ads' => $default_ads, 'rel' => true );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label><?php _e('Title:', 'appthemes') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label><?php _e('Ads:', 'appthemes'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('ads'); ?>" cols="5" rows="5"><?php echo $instance['ads']; ?></textarea>
			<?php _e('Enter one ad entry per line in the following format:<br /> <code>URL|Image URL|Image Alt Text|rel</code><br /><strong>Note:</strong> You must hit your &quot;enter/return&quot; key after each ad entry otherwise the ads will not display properly.',APP_TD); ?>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php if (isset($instance['newin'])) checked($instance['newin'], 'on'); ?> id="<?php echo $this->get_field_id('newin'); ?>" name="<?php echo $this->get_field_name('newin'); ?>" />
			<label><?php _e('Open ad in a new window?', 'appthemes'); ?></label>
		</p>
<?php
	}
}




// 180 X 150 adsense space
class JR_Widget_300ads extends WP_Widget {

    function JR_Widget_300ads() {
        $widget_ops = array( 'description' => __( 'This places an adsense space in the home page', 'appthemes') );
		$control_ops = array('width' => 180, 'height' => 150);
        $this->WP_Widget(false, __('JobsApp 180X150 Home Adsense Space', 'appthemes'), $widget_ops, $control_ops);
    }


	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $before_widget;
echo '<div id="home-featured-left">';

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
		<?php
		echo $after_widget;


						echo '<div class="pad5"></div></div>';

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>






<?php
	}
}





// facebook like box sidebar widget
class JT_Widget_Facebook extends WP_Widget {

    function JT_Widget_Facebook() {
        $widget_ops = array( 'description' => __( 'This places a Facebook page Like Box in your sidebar to attract and gain Likes from visitors.', 'appthemes') );
        $this->WP_Widget(false, __('Facebook Like Box', 'appthemes'), $widget_ops);
    }

    function widget( $args, $instance ) {

        extract($args);

        $title = apply_filters('widget_title', $instance['title'] );
		$fid = $instance['fid'];
		$connections = $instance['connections'];
		$width = $instance['width'];
		$height = $instance['height'];

        echo $before_widget;

		if ($title) echo $before_title . $title . $after_title;

        ?>
		<div class="pad5"></div>
        <iframe src="http://www.facebook.com/plugins/likebox.php?id=<?php echo $fid; ?>&amp;connections=<?php echo $connections; ?>&amp;stream=false&amp;header=true&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
		<div class="pad5"></div>
        <?php

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
       $instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fid'] = strip_tags( $new_instance['fid'] );
		$instance['connections'] = strip_tags($new_instance['connections']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);

		return $instance;
   }

   function form($instance) {

		$defaults = array( 'title' => __('Facebook Friends', 'appthemes'), 'fid' => '235898026521748', 'connections' => '12', 'width' => '250', 'height' => '320' );
		$instance = wp_parse_args( (array) $instance, $defaults );
   ?>

        <p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'appthemes') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('fid'); ?>"><?php _e('Facebook ID:', 'appthemes') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('fid'); ?>" name="<?php echo $this->get_field_name('fid'); ?>" value="<?php echo $instance['fid']; ?>" />
		</p>

		<p style="text-align:left;">
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('connections'); ?>" name="<?php echo $this->get_field_name('connections'); ?>" value="<?php echo $instance['connections']; ?>" style="width:50px;" />
			<label for="<?php echo $this->get_field_id('connections'); ?>"><?php _e('Connections', 'appthemes') ?></label>
		</p>

		<p style="text-align:left;">
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" style="width:50px;" />
			<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width', 'appthemes') ?></label>
		</p>

		<p style="text-align:left;">
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" style="width:50px;" />
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height', 'appthemes') ?></label>
		</p>

   <?php
   }
}





function jr_widgets_inits() {
    if (!is_blog_installed())
        return;
	register_widget('JT_Widget_Facebook');
	register_widget('JR_Widget_300ads');
	register_widget('JR_Widget_150ad');
	register_widget('JR_Widget_80ads');
	register_widget('JR_Widget_80ad');
	register_widget('JR_contact_Widget');
	register_widget('JR_login_Widget');
	//register_widget('JR_search_Widget');
	register_widget('JR_Widget_Recent_Job');
	register_widget('JR_Widget_Top_Listings_Today2');
	register_widget('JR_Widget_Top_Listings_Overall2');

	
    do_action('widgets_init');
}

add_action('init', 'jr_widgets_inits', 1);

function jt_unregister_widgets() {
	unregister_widget('JR_Widget_Facebook');
	unregister_widget('JR_Widget_125ads');
	unregister_widget('JR_Widget_Recent_Job');
	unregister_widget('JR_Widget_Top_Listings_Today');
	unregister_widget('JR_Widget_Top_Listings_Overall');

}

add_action('widgets_init', 'jt_unregister_widgets');








/*Widgets stats*/
function jr_todays_overall_count_widgets($post_type, $limit) {
    global $wpdb, $nowisnow;

	// get all the post view info to display
	$sql = $wpdb->prepare("SELECT t.postcount, p.ID, p.post_title
				FROM $wpdb->app_pop_total AS t
				INNER JOIN $wpdb->posts AS p ON p.ID = t.postnum
				WHERE t.postcount > 0
				AND p.post_status = 'publish' AND p.post_type = %s
				ORDER BY t.postcount DESC LIMIT %d", $post_type, $limit);

	$results = $wpdb->get_results($sql);

    echo '<ul class="pops">';

	// must be overall views
	if ($results) {

        foreach ($results as $result)
			echo '<li><a href="'.get_permalink($result->ID).'">'.$result->post_title.' ('.number_format($result->postcount).'&nbsp;'.__('views', 'appthemes') .')</li></a>';

    } else {

		echo '<li><a>' . __('No jobs viewed yet.', 'appthemes') . '</a></li>';

	}

	echo '</ul>';

}



// sidebar widget showing today's popular ads
function jr_todays_count_widgets($post_type, $limit) {
    global $wpdb, $nowisnow;

	// get all the post view info to display
	$sql = $wpdb->prepare("SELECT t.postcount, p.ID, p.post_title
			FROM $wpdb->app_pop_daily AS t
			INNER JOIN $wpdb->posts AS p ON p.ID = t.postnum
			WHERE time = '$nowisnow'
			AND t.postcount > 0 AND p.post_status = 'publish' AND p.post_type = %s
			ORDER BY t.postcount DESC LIMIT %d", $post_type, $limit);

	$results = $wpdb->get_results($sql);

	echo '<ul class="pops">';

	// must be views today
    if ($results) {

        foreach ($results as $result)
			echo '<li><a href="'.get_permalink($result->ID).'">'.$result->post_title.' ('.number_format($result->postcount).'&nbsp;'.__('views', APP_TD) .')</li></a>';

    } else {

		echo '<li><a href="aa">' . __('No jobs viewed yet.', APP_TD) . '</a></li>';
	}

	echo '</ul>';

}









/*uploaded logo function*/
function the_listing_logo_editor2( $listing_id ) {
	$images = jr_get_listing_attachments( $listing_id, 1 );

	$available_slots = 1;

	if ( $images ) {


		foreach ( $images as $image ) :
			$meta = wp_get_attachment_metadata( $image->ID );

			if ( is_array( $meta ) && isset( $meta['width'] ) && isset( $meta['height'] ) )
				$media_dims = "<span id='media-dims-".$image->ID."'>" . $meta['width'] . '&nbsp;&times;&nbsp;' . $meta['height'] . "</span>";
			else
				$media_dims = '';

			$alt = get_post_meta( $image->ID, '_wp_attachment_image_alt', true );
	?>
		
				<?php echo wp_get_attachment_link( $image->ID, 'thumbnail' ); ?>
				

			
	<?php
		endforeach;


	}
	

}





/*Updates JR 1.7*/

//*remove all include/job-form actions*//
remove_action( 'wp_loaded', 'jr_handle_job_submit_form' );
remove_action( 'wp_loaded', 'jr_handle_job_confirmation' );

remove_action( 'jr_listing_validate_fields', 'jr_validate_listing_category', 10 );
remove_action( 'jr_listing_validate_fields', 'jr_validate_listing_fields', 11 );

remove_action( 'jr_handle_listing_fields', 'jr_maybe_strip_tags', 10, 3 );
remove_action( 'jr_handle_listing_fields', 'jr_format_contact_fields', 11, 3 );

remove_filter( 'jr_handle_update_listing', 'jr_validate_update_listing' );




//*Duplicate the job-form actions*//
add_action( 'wp_loaded', 'jr_handle_job_submit_form1' );
add_action( 'wp_loaded', 'jr_handle_job_confirmation1' );

add_action( 'jr_listing_validate_fields1', 'jr_validate_listing_category1', 10 );
add_action( 'jr_listing_validate_fields1', 'jr_validate_listing_fields1', 11 );

add_action( 'jr_handle_listing_fields1', 'jr_maybe_strip_tags1', 10, 3 );
add_action( 'jr_handle_listing_fields1', 'jr_format_contact_fields1', 11, 3 );

add_filter( 'jr_handle_update_listing1', 'jr_validate_update_listing1' );

// handle free jobs - update the job status after user confirmation
function jr_handle_job_confirmation1() {

	if ( empty($_POST['job_confirm']) )
		return; 

	if ( ! $job_id = intval($_POST['ID']) ) {
		$errors = jr_get_listing_error_obj();
		$errors->add( 'submit_error', __( '<strong>ERROR</strong>: Cannot update job status. Job ID not found.', APP_TD ) );
		return;
	}
	jr_update_post_status( $job_id );

	_jr_set_job_duration( $job_id );

	wp_redirect( get_permalink( $job_id ) );
	exit();
}

// handle the main job submit form
function jr_handle_job_submit_form1() {

	if ( ! isset($_POST['job_submit']) )
		return;

	$actions = array( 'edit-job', 'new-job', 'relist-job' );
	if ( empty($_POST['action']) || !in_array( $_POST['action'], $actions ) )
			return;

	if ( !current_user_can( 'can_submit_job' ) )
		return;

	$job = jr_handle_update_job_listing1();
	if ( ! $job ) {
		// there are errors, return to current page
		return;
	}

	if ( 'edit-job' == $_POST['action'] ) {

		// maybe update job status
		if( _jr_edited_job_requires_moderation( $job ) ) {
			jr_update_post_status( $job->ID, 'publish' );

			// send notification email
			jr_edited_job_pending( $job->ID );
		}

		wp_redirect( add_query_arg( 'update_success', '1', get_permalink( $job->ID ) ) );
		exit();
	}

	$args = array( 
		'job_id' => $job->ID, 
		'step ' => jr_get_next_step()
	);

	if ( !empty($_POST['relist']) ) {
		$args['job_relist'] = $job->ID;
	}

	if ( !empty($_POST['order_id']) ) {
		$args['order_id'] = intval($_POST['order_id']);
	}

	// redirect to next step
	wp_redirect( add_query_arg( $args, jr_get_listing_create_url() ) );
	exit();

}

// creates/updates the job listing and all it's meta and terms
function jr_handle_update_job_listing1() {

	$job_cat = jr_get_listing_tax( 'job_term_cat', APP_TAX_CAT );
	$job_loc = jr_get_listing_tax( 'job_term_loc', APP_TAX_LOCATION );
	$job_type = jr_get_listing_tax( 'job_term_type', APP_TAX_TYPE );
	$job_salary = jr_get_listing_tax( 'job_term_salary', APP_TAX_SALARY );

	$args = wp_array_slice_assoc( $_POST, array( 'ID', 'post_title', 'post_content', 'tax_input' ) );

	$args['post_content'] = jr_maybe_strip_tags( $args['post_content'], 'post_content' );
	$args['post_type'] = APP_POST_TYPE;

	$errors = apply_filters( 'jr_listing_validate_fields2', jr_get_listing_error_obj() );
	if( $errors->get_error_codes() ){
		return false;
	}

	if ( isset($_POST['ID']) ) {
		$job_id = intval($_POST['ID']);
		$job = get_post( $job_id );
	}

	if ( empty($job) ) {
		$action = 'insert';
	} elseif( isset($_POST['relist']) ) {
		$action = 'relist';
	} else {
		$action = 'update';
	}

	// do_action hook
	jr_before_insert_job( $action );

	if ( empty($job) ) {
		$job_id = wp_insert_post( $args );
	} else {

		if ( 'expired' == $job->post_status ) 
			$args['post_status'] = 'draft';

		$job_id = wp_update_post( $args );
	}

	### TERMS

	wp_set_object_terms( $job_id, (int) $job_type, APP_TAX_TYPE );
	wp_set_object_terms( $job_id, (int) $job_cat, APP_TAX_CAT );
	wp_set_object_terms( $job_id, (int) $job_loc, APP_TAX_LOCATION );
	wp_set_object_terms( $job_id, (int) $job_salary, APP_TAX_SALARY );

	$tags = jr_get_listing_tags( $args['tax_input'][APP_TAX_TAG] );
	wp_set_object_terms( $job_id, $tags, APP_TAX_TAG );

	### META

	foreach ( jr_get_job_listing_fields() as $field => $meta_name ) {
		$field_value = apply_filters('jr_handle_listing_fields', _jr_get_initial_field_value( $field ), $field, $job_id );
		update_post_meta( $job_id, $meta_name, $field_value );
	}

	jr_set_coordinates( $job_id );

	### CUSTOM FIELDS

	jr_update_form_builder( $job_cat, $job_id );

	jr_handle_company_logo( $job_id );

	jr_handle_files( $job_id, $job_cat );

	// do_action hook
	jr_after_insert_job( $job_id, $action );

	return apply_filters( 'jr_handle_update_listing', get_post( $job_id ) );
}


// set the job listing geo coordinates meta
function jr_set_coordinates1( $job_id ) {

	$data = array();
	foreach ( jr_get_geo_fields() as $field => $meta_name ) {
		$data[$field] = _jr_get_initial_field_value( $field );
	}

	if ( empty($data['jr_address']) )
		return;

	if ( ! empty($data['jr_geo_latitude'])&& ! empty($data['jr_geo_longitude']) ) {

		$latitude = jr_clean_coordinate( $data['jr_geo_latitude'] );
		$longitude = jr_clean_coordinate( $data['jr_geo_longitude'] );

		update_post_meta( $job_id, '_jr_address', $data['jr_address'] );

		update_post_meta( $job_id, '_jr_geo_latitude', $data['jr_geo_latitude'] );
		update_post_meta( $job_id, '_jr_geo_longitude', $data['jr_geo_longitude'] );

		if ( $latitude && $longitude ) {
	
			// If we don't have address data, do a look-up
			if ( $data['jr_geo_short_address'] && $data['jr_geo_country'] && $data['jr_geo_short_address'] && $data['jr_geo_short_address_country'] ) {
				update_post_meta( $job_id, 'geo_address', $data['jr_geo_short_address'] );
				update_post_meta( $job_id, 'geo_country', $data['jr_geo_country'] );
				update_post_meta( $job_id, 'geo_short_address', $data['jr_geo_short_address'] );
				update_post_meta( $job_id, 'geo_short_address_country', $data['jr_geo_short_address_country'] );
			} else {
				$address = jr_reverse_geocode( $latitude, $longitude );
				update_post_meta( $job_id, 'geo_address', $address['address'] );
				update_post_meta( $job_id, 'geo_country', $address['country'] );
				update_post_meta( $job_id, 'geo_short_address', $address['short_address'] );
				update_post_meta( $job_id, 'geo_short_address_country', $address['short_address_country'] );
			};

		}

	};
}

// skip strips tags for fields where HTML is allowed
function jr_maybe_strip_tags1( $field_value, $field, $job_id = 0 ) {

	if ( ( 'apply' == $field || 'post_content' == $field ) && 'yes' == get_option('jr_html_allowed') ) {
			return $field_value;
	}
	return strip_tags( $field_value );
}

// add special formatting to specific fields
function jr_format_contact_fields1( $field_value, $field, $job_id ){

	if( 'website' == $field ) {
		$field_value = str_ireplace('http://', '', $field_value);
	}
	return $field_value;
}

// default values when post data does not exist
function _jr_get_initial_field_value1( $field ) {
	return isset( $_POST[$field] ) ? stripslashes( $_POST[$field] ) : '';
}

// retrieve the available fields (meta) for a job listing - array( 'field_name' => 'meta_name' )
function jr_get_job_listing_fields1() {
	$fields = array(
		'your_name' => '_Company',
		'website' 	=> '_CompanyURL',
		'apply'		=> '_how_to_apply',
	);
	return apply_filters( 'jr_job_fields', $fields, $_POST );
}

// retrieve the available geolocation fields (meta) for a job listing - array( 'field_name' => 'meta_name' )
function jr_get_geo_fields1() {
	$fields = array(
		'jr_address' 					=> '_jr_address',
		'jr_geo_latitude' 				=> '_jr_geo_latitude',
		'jr_geo_longitude' 				=> '_jr_geo_longitude',
		'jr_geo_country'				=> 'geo_country',
		'jr_geo_short_address' 			=> 'geo_short_address',
		'jr_geo_short_address_country' 	=> 'geo_short_address_country',
	);
	return $fields;
}

// retrieve the tags for a job listing
function jr_get_listing_tags1( $tags_string ) {
	$trim_strings = explode( ',', $tags_string );
	return array_map( 'trim', $trim_strings );
}

// retrieve the term id for a specific taxonomy
function jr_get_listing_tax1( $name, $taxonomy ) {

	if ( isset( $_REQUEST[$name] ) && $_REQUEST[$name] != -1 ) {
		$listing_tax = get_term( $_REQUEST[$name], $taxonomy );
		$term_id = is_wp_error( $listing_tax ) ? false : $listing_tax->term_id;
	} else {
		$term_id = false;
	}

	return $term_id;
}

// validate the job listing fields
function jr_validate_listing_fields1( $errors ) {
	
	$fields = wp_array_slice_assoc( $_POST, array( 'post_title', 'post_content', 'tax_input' ) );
	$fields = apply_filters( 'jr_job_required_fields', $fields );
	foreach ( $fields as $key => $name ) {
		if ( empty($_POST[$key]) ) {echo "name = $key";
			$errors->add( 'submit_error', __('<strong>ERROR</strong>: Please fill in all required fields.', APP_TD) );
		}
	}
	return $errors;

}

// validate the job listing category
function jr_validate_listing_category1( $errors ){

	if ( 'yes' != get_option('jr_submit_cat_required') )
		return $errors;

	$listing_cat = jr_get_listing_tax( 'job_term_cat', APP_TAX_CAT );
	if ( !$listing_cat ) 
		$errors->add( 'wrong-cat', __( 'No category was submitted.', APP_TD ) );
	
	return $errors;

}


function jr_validate_listing_location1( $errors ){

	if ( 'yes' != get_option('jr_submit_cat_required') )
		return $errors;

	$listing_cat = jr_get_listing_tax( 'job_term_loc', APP_TAX_LOCATION );
	if ( !$listing_loc ) 
		$errors->add( 'wrong-cat', __( 'No location was submitted.', APP_TD ) );
	
	return $errors;

}



// validates the listing data and returns the post if there are no errors. In case of errors, returns false
function jr_validate_update_listing1( $listing ) {

	$errors = jr_get_listing_error_obj();
	if ( $errors->get_error_codes() ) {
		return false;
	}
	return $listing;
}

// update the custom form fields
function jr_update_form_builder1( $job_cat, $job_id ) {
	$fields = jr_get_fields_for_cat( $job_cat );

	$to_update = scbForms::validate_post_data( $fields );

	scbForms::update_meta( $fields, $to_update, $job_id );
}

// retrieve the job listing tags
function the_job_listing_tags_to_edit1( $listing_id ) {
	$tags = get_the_terms( $listing_id, APP_TAX_TAG );

	if ( empty( $tags ) )
		return;

	echo esc_attr( implode( ', ', wp_list_pluck( $tags, 'name' ) ) );
}

// retrieve the job required fields
function jr_job_required_fields1() {

	// Check required fields
	$required = array(
		'job_title' 	=> __('Job title', APP_TD),
		'job_term_type' => __('Job type', APP_TD),
		'details' 		=> __('Job description', APP_TD),
	);

	return apply_filters( 'jr_job_required_fields', $required );
}

function _jr_needs_purchase1( $job = '' ){
	return ( jr_charge_job_listings() );
}

function jr_get_default_job_to_edit1() {

	$all_meta_fields = array_merge( jr_get_job_listing_fields(), jr_get_geo_fields() );

	if ( $job_id = get_query_var('job_id') ) {
		$job = get_post($job_id);

		$job_cat_tax =  jr_get_the_job_tax( $job->ID, APP_TAX_CAT );
		
		if ( $job_cat_tax ) $job->category = $job_cat_tax->term_id;
		$job->type = jr_get_the_job_tax( $job->ID, APP_TAX_TYPE )->term_id;
		if ( $job->salary = jr_get_the_job_tax( $job->ID, APP_TAX_SALARY ) ) {
			$job->salary = jr_get_the_job_tax( $job->ID, APP_TAX_SALARY )->term_id;
		}
		
		if ( $job->loc = jr_get_the_job_tax( $job->ID, APP_TAX_LOCATION ) ) {
			$job->loc = jr_get_the_job_tax( $job->ID, APP_TAX_LOCATION )->term_id;
		}

		foreach ( $all_meta_fields as $field => $meta_name ) {
			$job->$field = get_post_meta( $job->ID, $meta_name, true );
		}

	} else {

		require ABSPATH . '/wp-admin/includes/post.php';
		$job = get_default_post_to_edit( APP_POST_TYPE );

		$job->category = jr_get_listing_tax( 'job_term_cat', APP_TAX_CAT );
		$job->type = jr_get_listing_tax( 'job_term_type', APP_TAX_TYPE );
		$job->salary = jr_get_listing_tax( 'job_term_salary', APP_TAX_SALARY );
		$job->loc = jr_get_listing_tax( 'job_term_loc', APP_TAX_LOCATION );

		foreach ( array( 'post_title', 'post_content' ) as $field ) {
			$job->$field = _jr_get_initial_field_value( $field );
		}

		foreach ( $all_meta_fields as $field => $meta_name ) {
			$job->$field = _jr_get_initial_field_value( $field );
		}
	}

	return $job;

}

function jr_get_listing_cat_id1() {
	static $cat_id;

	if ( is_null( $cat_id ) ) {
		if ( isset( $_REQUEST['_'.APP_TAX_CAT] ) && $_REQUEST['_'.APP_TAX_CAT] != -1 ) {
			$listing_cat = get_term( $_REQUEST['_'.APP_TAX_CAT], APP_TAX_CAT );
			$cat_id = is_wp_error( $listing_cat ) ? false : $listing_cat->term_id;
		} else {
			$cat_id = false;
		}
	}

	return $cat_id;
}

function jr_job_details1( $job_id = 0 ) {
	$job_id = $job_id ? $job_id : get_the_ID();

	$job_details = get_post( $job_id );
	$meta = get_post_custom( $job_id );
	$data = jr_reset_data( $meta );

	if ( ! $job_details ) 
		return;

	$category = '';

	$cat_terms = get_the_job_terms( $job_details->ID, APP_TAX_CAT );
	if ( $cat_terms ) 
		$category = get_the_job_terms( $job_details->ID, APP_TAX_CAT )->term_id;
		
		
		
	$loc = '';

	$location_terms = get_the_job_terms( $job_details->ID, APP_TAX_LOCATION );
	if ( $location_terms ) 
		$loc = get_the_job_terms( $job_details->ID, APP_TAX_LOCATION )->term_id;

	$tags = '';	

	$salary = '';

	$salary_terms = get_the_job_terms( $job_details->ID, APP_TAX_SALARY );
	if ( $salary_terms ) 
		$salary = get_the_job_terms( $job_details->ID, APP_TAX_SALARY )->term_id;

	$tags = '';

	$tags_terms = get_the_terms( $job_details->ID, APP_TAX_TAG );
	if ( $tags_terms ) {
		foreach ($tags_terms as $term) :
			$job_tags[] = $term->name;
		endforeach;
		$tags = implode(', ', $job_tags ); 
	} 

	$details = array( 
		'your_name' => $data['_Company'],
		'website' => $data['_CompanyURL'],
		'job_title' => $job_details->post_title,
		'job_term_type' => get_the_job_terms( $job_details->ID, APP_TAX_TYPE )->slug,
		'job_term_cat' => $category,
		'job_term_loc' => $loc,
		'job_term_salary' => $salary,
		'jr_address' =>  ( !empty($data['geo_address']) ? $data['geo_address'] : '' ),
		'jr_geo_latitude' => ( !empty($data['_jr_geo_latitude']) ? $data['_jr_geo_latitude'] : '' ),
		'jr_geo_longitude' => ( !empty($data['_jr_geo_longitude']) ? $data['_jr_geo_longitude'] : '' ),
		'details' => $job_details->post_content,
		'apply' => $data['_how_to_apply'],
		'tags' => $tags,
	);
	return apply_filters( 'jr_job_details', $details );
}

// get the last step
function _jr_steps_get_last1( $steps = '' ) {
	if ( ! $steps  ) 
		$steps = jr_steps();
	return max( array_keys( $steps ) );
}

// steps descriptions and templates
function _jr_job_submit_steps1() {

	$steps = array(
		1 => array (
			'name'	=> 'register',
			'description' => __('Create account', APP_TD),
			'template' => '',
		),
		2 => array (
			'name'	=> 'submit_job',
			'description' => __('Enter Job Details', APP_TD),
			'template' => '/includes/forms/submit-job/submit-job-form.php',
		),
		3 => array (
			'name'	=> 'preview_job',
			'description' => __('Preview', APP_TD),
			'template' => '/includes/forms/preview-job/preview-job-form.php',
		),
	);

	return $steps;
}

// steps descriptions and templates
function jr_steps1() {
	$steps = _jr_job_submit_steps1();

	if ( jr_charge_job_listings() ) {
		$steps[] = _jr_select_job_plan_step();
		$description = __('Pay/Thank You', APP_TD);
	} else {
		$description = __('Confirm', APP_TD);
	}

	$steps[] = _jr_confirm_step( $description );

	return apply_filters( 'jr_job_submit_steps1', $steps );
}

function jr_get_step_by_name1( $name ) {
	foreach( jr_steps1() as $key => $step ) {
		if ( $name == $step['name'] )
			return $key;
	}
	return false;
}

function _jr_select_plans_steps1() {
	$steps = array(
		1 => array (
			'name'	=> 'select_plan',
			'description' => __('Select Plan', APP_TD),
		),
		2  => array (
			'name'	=> 'select_gateway',
			'description' => __('Pay/Thank You', APP_TD),
		),
	);
	return $steps;
}

function _jr_select_job_plan_step1() {
	$step = array (
		'name'	=> 'select_plan',
		'description' => __('Select Plan', APP_TD),
		'template' => '/includes/forms/select-plan/select-plan.php',
	);
	return $step;
}

function _jr_confirm_step1( $description ) {

	$step = array (
		'name'	=> 'confirm_job',
		'description' => $description,
		'template' => '/includes/forms/confirm-job/confirm-job-form.php',
	);
	return $step;
}

function _jr_curr_step1( $start ) {
	if ( get_query_var('step') ) {
		return get_query_var('step');
	} else {
		return $start;
	}
}

function jr_get_next_step1( $start = 2 ) {
	if ( ! is_user_logged_in() )
		$step = 1;
	else
		$step =  _jr_next_step( jr_get_listing_error_obj(), $start );

	return $step;
}

// dinamically return the next step
function _jr_next_step1( $errors, $start ) {

	$previous_step = _jr_curr_step1( $start );

	$step = $previous_step;

	if ( ! empty($_POST) && ! $errors->get_error_codes() ) {
		if ( empty($_POST['goback']) )
			$step++;
		else
			$step = $start;
	} elseif ( $errors->get_error_codes() ) {
		$step = _jr_curr_step( $start );
	}

	if ( $step > _jr_steps_get_last() ) {
		$step = $previous_step;
	}

	return apply_filters( 'jr_next_job_submit_step1', $step, $previous_step );
}












//Site url in job listings//

function jr_job_authors() {
	global $post;

	$company_name = wptexturize(strip_tags(get_post_meta($post->ID, '_Company', true)));

	if ( $company_name ) {
		if ( $company_url = esc_url( get_post_meta( $post->ID, '_CompanyURL', true ) ) ) {
?>
			<a href="<?php echo $company_url; ?>" rel="nofollow"><?php echo $company_name; ?></a>
<?php
		} else {
			echo $company_name;
		}
		$format = __('', APP_TD);
	} else {
		$format = '<a href="%s">%s</a>';
	}

	$author = get_user_by('id', $post->post_author);
	if ( $author && $link = get_author_posts_url( $author->ID, $author->user_nicename ) )
		echo sprintf( $format, $link, $author->display_name );
}


// Custom header options for theme options
function custom_head(){
?>
<?php get_template_part( header, options ); ?> 

<?php
}

add_action('wp_head', 'custom_head');


//responsive styles
function responsive_styles()
{
   wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/styles/responsive.css',false,'1.0','all');
    
}
add_action('wp_enqueue_scripts','responsive_styles');


// auto install plugins/rev slider
require_once dirname( __FILE__ ) . '/install/install.php';


// Bootstrap pagination function

function wp_bs_pagination($pages = '', $range = 1)

{  

     $showitems = ($range * 2) + 1;  

 

     global $paged;

     if(empty($paged)) $paged = 1;

 

     if($pages == '')

     {

         global $wp_query; 

		 $pages = $wp_query->max_num_pages;

         if(!$pages)

         {

             $pages = 1;

         }

     }   

 

     if(1 != $pages)

     {

        echo '<div class="text-left">'; 
        echo '<nav><ul class="pagination"><li class="disabled hidden-xs"><span><span aria-hidden="true">Page '.$paged.' of '.$pages.'</span></span></li>';

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' aria-label='First'>&laquo;<span class='hidden-xs'> First</span></a></li>";

         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> Previous</span></a></li>";
         for ($i=1; $i <= $pages; $i++)

         {

             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))

             {

                 echo ($paged == $i)? "<li class=\"active\"><span>".$i." <span class=\"sr-only\">(current)</span></span>

    </li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";

             }

         }
         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\"  aria-label='Next'><span class='hidden-xs'>Next </span>&rsaquo;</a></li>";  

         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' aria-label='Last'><span class='hidden-xs'>Last </span>&raquo;</a></li>";

         echo "</ul></nav>";
         echo "</div>";
     }

}

function job_seeker_alerts_form() {	
	global $post, $user_ID, $app_abbr;
		
	$keywords = get_user_meta($user_ID, $app_abbr.'_alert_meta_keyword', true);
	$locations = get_user_meta($user_ID, $app_abbr.'_alert_meta_location', true);
	$job_types = get_user_meta($user_ID, $app_abbr.'_alert_meta_job_type', true);
	$job_cats = get_user_meta($user_ID, $app_abbr.'_alert_meta_job_cat', true);
	$alert_status = get_user_meta($user_ID, $app_abbr.'_alert_status', true);
	
	?>
	<form action="<?php echo get_permalink( $post->ID ); ?>" method="post" id="submit_form" class="submit_form main_form">

		<p><?php _e('You can receive tailored job alerts directly on your email. Control alerts by selecting the options that best suit the job you are looking for.', APP_TD); ?></p>

		<fieldset>
	
			<legend><?php _e('Job Criteria', APP_TD); ?></legend>
			<p><?php _e('All the options are <em>inclusive</em>. This means that jobs will be matched against all your criteria. For example, adding keywords and a location will limit job results to those having that location <em>and</em> at least one of the keywords.', APP_TD); ?></p>			
			<p><?php _e('Leave the job types or job categories empty to receive alerts from all job types or job categories',APP_TD); ?></p>
			<div class='col-md-12 form-group'>
				<label class='col-md-3 col-sm-3'  for="alert_keywords"><?php _e('Key Words <small>(comma separated)</small>', APP_TD); ?></label> 
				<div class='col-md-6 col-sm-6'>
					<input type="text" class="tags text form-control" name="alert_keywords" id="alert_keywords" placeholder="<?php _e('e.g. Web Design, Designer', APP_TD); ?>" value="<?php if (!empty($keywords)) echo implode(',',$keywords); ?>" />
				</div>
			</div>
			<div class='col-md-12 form-group'>
				<label class='col-md-3 col-sm-3' for="alert_keywords"><?php _e('Key Words <small>(comma separated)</small>', APP_TD); ?></label>
				<div class='col-md-6 col-sm-6'>
						<input type="text" class="tags text form-control" name="alert_location" id="alert_location" placeholder="<?php _e('e.g. London, United Kingdom', APP_TD); ?>" value="<?php if (!empty($locations)) echo implode(',',$locations); ?>" /></p>			
					
				</div>
			</div>
			 
		</fieldset>
		
		<fieldset>
					
			<div class="optional alerts prefs_job_types"><label><?php _e('Types of Job<br/><small>(Leave empty to receive alerts from any job type)</small>', APP_TD); ?></label>
				<ul>
				<?php
				$all_job_types = jr_get_taxonomy_terms( APP_TAX_TYPE );
				if ($all_job_types && sizeof($all_job_types) > 0) {
					jr_output_alert_terms( $all_job_types, $job_types );						
				}
				?>
				</ul>
			</div>
			
		</fieldset>		
		
		<fieldset>
		
			<div class="optional alerts prefs_job_categories"><label><?php _e('Categories of Job<br/><small>(Leave empty to receive alerts from any job category)</small>', APP_TD); ?></label>
				<ul>
				<?php
				$all_job_cats = jr_get_taxonomy_terms( APP_TAX_CAT );
				if ($all_job_cats && sizeof($all_job_cats) > 0) {
					jr_output_alert_terms( $all_job_cats, $job_cats );						
				}
				?>
				</ul>
			</div>
			
		</fieldset>				

		<?php if ( get_option($app_abbr.'_job_alerts_feed') == 'yes' && $feed_key = get_user_meta($user_ID,$app_abbr.'_alert_feed_key',true) ): ?>
		
			<?php $alert_feed = trailingslashit(get_bloginfo('rss2_url')) . $feed_key; ?>

			<fieldset>

				<legend><?php _e('Alert Feed', APP_TD); ?></legend>

				<p><?php _e('This is your unique RSS feed representing your alert settings. You can use it to subscribe to <em>Google Reader</em> or any other service to keep you updated of new jobs
							fitting your criteria, as they are published.', APP_TD); ?></p>

				<label for="alert_feed"></label>
				<a href="<?php echo $alert_feed; ?>" title="<?php _e('Your Job Alert RSS Feed',APP_TD); ?>" alt="<?php _e('Your Job Alert RSS Feed',APP_TD); ?>" /><small class="alert_rss"></small></a>
				
				<div class='col-lg-8 col-md-8 col-sm-12'>
					<input type="text" class="text form-control"  style="width: 550px; color: #ADADAD;" readonly value="<?php echo $alert_feed; ?>"></input>
				</div>
			</fieldset>

		<?php endif; ?>

		<?php if ( get_option($app_abbr.'_job_alerts') == 'yes' ): ?>

			<fieldset>

				<legend><?php _e('Alerts Status', APP_TD); ?></legend>

				<p><?php _e('You can subscribe/unsubscribe to job alerts at any time.', APP_TD); ?></p>
				<label for="alert_status"></label>
				<div class='col-lg-8 col-md-8 col-sm-12'>
				<select name="alert_status" class='form-control ' id="alert_status"/>
					<option value="active" <?php selected( $alert_status, 'active' ); ?>><?php _e('Subscribed',APP_TD); ?></option>
					<option value="inactive" <?php selected( !$alert_status || $alert_status == 'inactive',1); ?>><?php _e('Unsubscribed',APP_TD); ?></option>
				</select>
				</div>

			</fieldset>

		<?php endif; ?>

		
		<div class="clear"></div>
		<br/>
		<input type="submit" class="submit btn btn-primary " name="save_alerts" value="<?php _e('Save &rarr;', APP_TD); ?>" />
	</form>

	<?php
}

function job_seeker_prefs_form() {
	
	global $post, $posted;

	$career_status 			= get_user_meta(get_current_user_id(), 'career_status', true);
	$willing_to_relocate 	= get_user_meta(get_current_user_id(), 'willing_to_relocate', true);
	$willing_to_travel 		= get_user_meta(get_current_user_id(), 'willing_to_travel', true);
	$keywords 				= get_user_meta(get_current_user_id(), 'keywords', true);
	$search_location 		= get_user_meta(get_current_user_id(), 'search_location', true);
	$job_types 				= get_user_meta(get_current_user_id(), 'job_types', true);
	
	//$your_location			= get_user_meta(get_current_user_id(), 'your_location', true);
	//$your_job_title			= get_user_meta(get_current_user_id(), 'your_job_title', true);
	
	$availability_month 	= get_user_meta(get_current_user_id(), 'availability_month', true);
	$availability_year 		= (int) get_user_meta(get_current_user_id(), 'availability_year', true);
	?>
	<form action="<?php echo get_permalink( $post->ID ); ?>" method="post" id="submit_form" class="submit_form main_form">

		<fieldset>
		
			<legend><?php _e('Publicly visible details', APP_TD); ?></legend>
			<p><?php _e('These options control what is shown publicly on your resumes.', APP_TD); ?></p>
			
			<div class='col-md-5 col-lg-5'><p class="optional">
				<label for="availability_month"><?php _e('Your Availability <small>(Leave blank for immediate availability)</small>', APP_TD); ?></label> 
			</div>
			<div class='col-md-2 col-lg-2'>
				<span class="date_field_wrap">
					<select name="availability_month" class='form-control' id="availability_month">
						<option value=""><?php _e('Month&hellip;', APP_TD); ?></option>
						<?php
							for($i=1; $i<=12; $i++) :
								$month = date('F', mktime(0, 0, 0, $i, 11, 1978));
								echo '<option value="'.$i.'"';
								if (isset($availability_month) && $availability_month==$i) echo ' selected="selected"';
								echo '>'.jr_translate_months($month).'</option>';
							endfor;
						?>
					</select>
				</span>
			</div>
			<div class='col-md-2 col-lg-2'>
				<input type="text" class="text form-control" name="availability_year" maxlength="4" size="4" placeholder="<?php _e('YYYY',APP_TD); ?>" value="<?php if ( !empty($availability_year) ) echo $availability_year; ?>" id="availability_year" />
			</div>
		</fieldset>
		
		<fieldset>
			<legend><?php _e('Your Career', APP_TD); ?></legend>
			<div class='col-md-12 col-lg-12'>
				<div class='col-md-3 col-lg-3'>
				<p style='margin-top:5px;'>	<label for="career_status" class='label-control'><?php _e('Career status', APP_TD); ?></label>
				</p>
				</div>
				<div class='col-md-3 col-lg-3'>			
					<select name="career_status" id="career_status" class='form-control'>
						<option <?php if ($career_status=='looking') echo 'selected="selected"'; ?> value="looking"><?php _e('Actively looking', APP_TD); ?></option>
						<option <?php if ($career_status=='open') echo 'selected="selected"'; ?> value="open"><?php _e('Open to new opportunities', APP_TD); ?></option>
						<option <?php if ($career_status=='notlooking') echo 'selected="selected"'; ?> value="notlooking"><?php _e('Not actively looking', APP_TD); ?></option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
			<div class='col-md-12 col-lg-12'>
				<div class='col-md-3 col-lg-3'>
					<p style='margin-top:5px;'><label for="willing_to_relocate"><?php _e('Are you willing to relocate?', APP_TD); ?></label></p>
				</div>
				<div class='col-md-2 col-lg-2'>			
					 <select name="willing_to_relocate" id="willing_to_relocate" class='form-control'>
						<option <?php if ($willing_to_relocate=='yes') echo 'selected="selected"'; ?> value="yes"><?php _e('Yes', APP_TD); ?></option>
						<option <?php if ($willing_to_relocate=='no') echo 'selected="selected"'; ?> value="no"><?php _e('No', APP_TD); ?></option>
					</select>
				</div>
			</div> 
			<div class='col-md-12 col-lg-12'>
				<div class='col-md-3 col-lg-3'>
					<p style='margin-top:5px;'><label for="willing_to_travel"><?php _e('Are you willing to travel?', APP_TD); ?></label></p>
				</div>
				<div class='col-md-6 col-lg-6'>			
					<select class='form-control' name="willing_to_travel" id="willing_to_travel">
						<option <?php if ($willing_to_travel=='100') echo 'selected="selected"'; ?> value="100"><?php _e('100% willing to travel', APP_TD); ?></option>
						<option <?php if ($willing_to_travel=='75') echo 'selected="selected"'; ?> value="75"><?php _e('Fairly willing to travel', APP_TD); ?></option>
						<option <?php if ($willing_to_travel=='50') echo 'selected="selected"'; ?> value="50"><?php _e('Not very willing to travel', APP_TD); ?></option>
						<option <?php if ($willing_to_travel=='25') echo 'selected="selected"'; ?> value="25"><?php _e('Interested in local opportunities only', APP_TD); ?></option>
						<option <?php if ($willing_to_travel=='0') echo 'selected="selected"'; ?> value="0"><?php _e('Not willing to travel/working from home', APP_TD); ?></option>
					</select>
				</div>
			</div>  
			
		</fieldset>
		
		<fieldset>
			<legend><?php _e('Other Information', APP_TD); ?></legend>
			<p><?php _e('These options control what job recommendations your receive on your dashboard.', APP_TD); ?></p>
			<div class='col-md-12 col-lg-12'>
				<div class='col-md-3 col-lg-3'>
					<p><label for="keywords"><?php _e('Key Words <small>(comma separated)</small>', APP_TD); ?></label></p>
				</div>
				<div class='col-md-5 col-lg-5'>
					<input type="text" class="tags text form-control" name="keywords" id="keywords" placeholder="<?php _e('e.g. Web Design, Designer', APP_TD); ?>" value="<?php echo $keywords; ?>" /> 
				</div>
			</div>
			<div class='col-md-12 col-lg-12'>
				<div class='col-md-3 col-lg-3'>
					<p><label for="search_location"><?php _e('Search location', APP_TD); ?></label> </p>
				</div>
				<div class='col-md-5 col-lg-5'>
					<input type="text" class="tags text form-control" name="search_location" id="search_location" placeholder="<?php _e('e.g. London, United Kingdom', APP_TD); ?>" value="<?php echo $search_location; ?>" />
				</div>
			</div>
			<div class='col-md-12 col-lg-12'>
				<div class="col-md-3 col-lg-3 optional prefs_job_types"><label><?php _e('Types of Job', APP_TD); ?></label> 
					<ul style='list-style-type:none;'>
					<?php
					$all_job_types = get_terms( 'job_type', array( 'hide_empty' => '0' ) );
					if ($all_job_types && sizeof($all_job_types) > 0) {
						foreach ($all_job_types as $type) {
							?>
							<li><label for="<?php echo $type->slug; ?>"><input type="checkbox" name="prefs_job_types[<?php echo $type->slug; ?>]" id="<?php echo $type->slug; ?>" <?php 
								if (is_array($job_types) && in_array($type->slug.'', $job_types)) echo 'checked="checked"'; 
								
							?> value="show" /> <?php echo $type->name; ?></label></li>
							<?php
						}
					}
					?>
					</ul>
				</div>
				<div class='col-md-5 col-lg-5'>
					&nbsp;
				</div>
			</div>

		</fieldset>
		<br/>
		<p><input type="submit" class="submit btn btn-primary" name="save_prefs" value="<?php _e('Save &rarr;', APP_TD); ?>" /></p>
			
		<div class="clear"></div>
			
	</form>
	<?php
}

 