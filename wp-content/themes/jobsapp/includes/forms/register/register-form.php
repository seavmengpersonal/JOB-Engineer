<?php
/**
 * JobRoller Registration Form
 * Function outputs the registration form
 *
 *
 * @version 1.6.3
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */

add_action( 'jr_display_register_form', 'jr_register_form', 10, 2 );

function jr_register_form( $redirect = '', $role = 'job_lister' ) {
	global $posted, $app_abbr;

	if ( get_option('users_can_register') ) {

		if ( ! $redirect ) $redirect = get_permalink( JR_Dashboard_Page::get_id() );
		
		$show_password_fields = apply_filters('show_password_fields_on_registration', true);
    ?>

            <form action="<?php echo appthemes_get_registration_url(); ?>" method="post" class="account_form" name="registerform" id="login-form">
				
				<?php 
					if ( 'yes' == get_option('jr_allow_job_seekers') ) :
						if (!$role) :
							?>
							<p class="role" >
								<label><input id="watch-me" type="radio" name="role" tabindex="5" value="job_lister" <?php if($_GET['role']=="employer"){  echo "checked"; } ?><?php checked( isset($posted['role']) && $posted['role']=='job_lister' ); ?> /> <?php _e( 'I am an <strong>Employer</strong>', APP_TD ); ?></label>
								<label class="alt"><input class="watch-me3"  type="radio" tabindex="6" name="role" value="job_seeker" <?php if($_GET['role']=="jobseeker"){  echo "checked"; } ?> <?php checked( isset($posted['role']) && $posted['role']=='job_seeker' ); ?> /> <?php _e( 'I am a <strong>Job Seeker</strong>', APP_TD ); ?></label>
							</p>
							
						<?php if ( 'yes' == get_option( $app_abbr.'_allow_recruiters' ) ) : ?>
							<p class="role"><label class="alt"><input id="watch-me2" type="radio" tabindex="7" name="role" value="recruiter" <?php checked( isset($posted['role']) && $posted['role']=='recruiter' ); ?> /> <?php _e( 'I am a <strong>Recruiter</strong>', APP_TD ); ?></label></p>
						<?php endif; ?>
							<?php
						elseif ( $role == 'job_lister' ) :
							echo '<input type="hidden" name="role" value="job_lister" />';
						elseif ( $role == 'job_seeker') :
							echo '<input type="hidden" name="role" value="job_seeker" />';
						elseif ( $role == 'recruiter' && 'yes' == get_option( $app_abbr.'_allow_recruiters' ) ) :
							echo '<input type="hidden" name="role" value="recruiter" />';
						endif;
					endif;
				?>
				
		<div class="account_form_fields">
					
				<p style="display:none;">
				 <label for="first_name" style="display:none;"><?php echo stripslashes(get_option('tr_first_name'))  ?></label><br/>
				 <input class="form-control text" style="display:none;" type="text" name="first_name" id="first_name" value=<?php if (isset($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>>		
			   </p>   
					
			   <p style="display:none;">
				 <label for="last_name" style="display:none;"><?php echo stripslashes(get_option('tr_last_name'))  ?></label><br/>
				 <input class="form-control text" style="display:none;" type="text" name="last_name" id="last_name" value=<?php if (isset($_POST['last_name'])) echo esc_attr($_POST['last_name']); ?>>		
			   </p>
				
			   <p style="display:none;">
				 <label for="phone" style="display:none;"><?php echo stripslashes(get_option('tr_phone'))  ?></label><br/>
				 <input class="form-control text" style="display:none;" type="text" name="phone" id="phone" value=<?php if (isset($_POST['phone'])) echo esc_attr($_POST['phone']); ?>>		
			   </p>
				
				<?php if( $role == 'job_lister' ): ?>
					<div id="show-me">
						 <p>
						 <label for="company"><?php _e('Company', APP_TD); ?></label><br/>
						 <input class="form-control text" placeholder="Enter Company.." type="text" name="company" id="company" value=<?php if (isset($_POST['company'])) echo esc_attr($_POST['company']); ?>>		
					   </p>
					</div>				
				<?php endif; ?>

				<div id="show-me2" style="display:none">   				   				
					<p>
					 <label for="company"><?php _e('Company', APP_TD); ?></label><br/>
					 <input class="form-control text" type="text" name="company" id="company" value=<?php if (isset($_POST['company'])) echo esc_attr($_POST['company']); ?>>		
				   </p>
				</div>

				<div id="show-me3" style="display:none">   				
					 <p>
						 <label for="company"><?php _e('Major', APP_TD); ?></label><br/>
						 <select class="form-control" name="r_industry" style="padding: 5px; width: 263px;" id="r_industry">
							<?php
							$job_types = get_terms( 'job_cat', array( 'hide_empty' => false ) );
							if ($job_types && sizeof($job_types) > 0) {
								foreach ($job_types as $type) {
									?>
									<option <?php if ( $posted['r_industry']==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->name; ?>"><?php echo $type->name; ?></option>
									<?php
								}
							} ?>
						</select>   
					</p>
				</div>   
  
				<style type="text/css">
				.at_fieldset { border: 1px solid #ccc; padding: 10px; border-radius: 5px; }
				.at_referral_note { font-size: 12px; color: #ccc; }
				.at_number { width: 100px }
				</style>
				
	                <p>
	                    <label for="user_login"><?php _e('Username', APP_TD); ?></label><br/>
	                    <input type="text" class="form-control text" placeholder="Enter Username.." tabindex="7" name="user_login" id="user_login" value="<?php if (isset($_POST['user_login'])) echo esc_attr(stripslashes($_POST['user_login'])); ?>" />
	                </p>
	
	                <p>
	                    <label for="user_email"><?php _e('Email', APP_TD); ?></label><br/>
	                    <input type="text" class="form-control text" placeholder="Enter Email.." tabindex="8" name="user_email" id="user_email" value="<?php if (isset($_POST['user_email'])) echo esc_attr(stripslashes($_POST['user_email'])); ?>" />
	                </p>
					
					<?php if (get_option('jr_allow_registration_password')=='yes') : ?>
	                <p>
	                    <label for="your_password"><?php _e('Enter a password', APP_TD); ?></label><br/>
	                    <input type="password" class="form-control text" placeholder="Enter Password.." tabindex="9" name="pass1" id="pass1" value="" />
	                </p>
	
	                <p>
	                    <label for="your_password_2"><?php _e('Enter password again', APP_TD); ?></label><br/>
	                    <input type="password" class="form-control text" placeholder="Confirm Password.." tabindex="10" name="pass2" id="pass21" value="" />
	                </p>

					<!---<p>
						<div id="pass-strength-result" class="hide-if-no-js"><?php _e('Strength indicator'); ?></div>-->
						<p>
							<span class="description indicator-hint">
								<?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', APP_TD ); ?>
							</span>
						</p>
					</p>
	                <?php endif; ?>       
	                
	                <?php
					// include the spam checker if enabled();
					if ( current_theme_supports( 'app-recaptcha' ) )
						appthemes_recaptcha();
	                ?>
	                
					<?php if ( get_option('jr_terms_page_id') > 0 || 'yes' == get_option('jr_enable_terms_conditions') ) : ?><p>
						<input type="checkbox" name="terms" tabindex="12" value="yes" id="terms" <?php if (isset($_POST['terms'])) echo 'checked="checked"'; ?> /> <label for="terms"><?php _e('I accept the ', APP_TD); ?><a href="<?php echo get_permalink( JR_Terms_Conditions_Page::get_id() ); ?>" target="_blank"><?php _e('terms &amp; conditions', APP_TD); ?></a>.</label>
					</p><?php endif; ?>
					
					<?php do_action('register_form'); ?>
	                
					<p>
						<input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect); ?>" />
	                    <input type="submit" class="btn btn-lg btn-info submit" tabindex="13" name="register" value="<?php _e('Create Account &rarr;', APP_TD); ?>" />
	                </p>

			</div>

			<!-- autofocus the field -->
			<script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>

		</form>
<?php
	};
}