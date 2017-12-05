<div id="sidebar">

<ul class="widgets">
<?php 
global $current_user;
 get_currentuserinfo();
?>

<?php if ( is_user_logged_in() ) { ?>



<li class="widget widget_user_options">
<div class="shadowblock" id="%2$s">
<div class="widget_content">

	<h2 class="widget_title"><?php _e('Login',APP_TD); ?> </h2>
			
<ul>

<li> <a><?php _e('Welcome, ',APP_TD); ?><strong><?php echo $current_user->user_login; ?></strong></a></li>
<li><?php echo '<a href="'.get_permalink( JR_Dashboard_Page::get_id() ).'">'.__('My Dashboard', APP_TD).'</a> ';?></li>
<li><a href="<?php echo wp_logout_url(); ?>"><?php _e('Log out',APP_TD); ?></a></li>

</ul>
</div></div>
</li>



<?php } else { ?>
		<li class="widget widget_user_options">
<div class="shadowblock" id="%2$s">
<div class="widget_content">

	<h2 class="widget_title"><?php _e('Login',APP_TD); ?> </h2>


<?php



	global $posted;
	
	if (!$action) $action = site_url('wp-login.php');
	if ( ! $redirect ) $redirect = jr_get_dashboard_url();
	?>

	<form action="<?php echo APP_Login::get_url(); ?>" method="post" class="account_form" id="login-form">
		
           
               <div id="lefty" > <label id="lefty" for="login_username"><?php _e('Username', APP_TD); ?>:</label></div>
                <input type="text" class="text2" name="log" id="login_username" value="<?php if (isset($posted['login_username'])) echo $posted['login_username']; ?>" />
          

   <div id="spacer"></div>
              <div id="lefty" > <label id="lefty" for="login_password"><?php _e('Password', APP_TD); ?>:</label></div>
                <input type="password" class="text2" name="pwd" id="login_password" value="" />
          
           
                <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect); ?>" />
                <input type="hidden" name="rememberme" value="forever" />
 <div id="spacer"></div>
<div id="lefty"></div>

              <div id="lefty1" >
				<label></label><input type="checkbox" name="rememberme" class="checkbox" tabindex="3" id="rememberme" value="forever" checked="checked"/></label>
				</div>
			<label for="rememberme"><?php _e('Remember me', APP_TD ); ?></label>
			
               
                   

	        <p>
	        <div id="lefty" ></div>

                <input type="submit" class="submit2" name="login" value="<?php _e('Login &rarr;', APP_TD); ?>" />
	            <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect); ?>" />

   <div id="spacer"></div>
           <div id="lefty" ></div>     <a class="lostpass" href="<?php echo appthemes_get_password_recovery_url(); ?>" title="<?php echo esc_attr( __('Password Lost and Found', APP_TD) ); ?>"><?php echo esc_attr( __('Lost your password?', APP_TD) ); ?></a>
            

	</form>

</div></div>
</li>
     
	<?php
	}
?>

		<?php appthemes_before_sidebar_widgets(); ?>
	  
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar_login')) : else : ?>

			<!-- no dynamic sidebar so don't do anything -->

		<?php endif; ?>
		<?php appthemes_after_sidebar_widgets(); ?>

	</ul>

</div><!-- end sidebar -->