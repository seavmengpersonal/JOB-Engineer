<?php
// Template Name: Password Recovery
?>
	
	<div class="col-md-12 col-lg-12">
	
		<div class="section">

			<div class="section_content">

				<h1 class="well"><?php _e('Password Recovery', APP_TD); ?></h1>

				<?php do_action( 'appthemes_notices' ); ?>
				
				<div class="col-md-6 col-lg-6">
				
					<p><?php _e('Please enter your username or email address. A new password will be emailed to you.', APP_TD) ?></p>
					
					<form action="<?php echo appthemes_get_password_recovery_url(); ?>" method="post" name="lostpassform" id="login-form" class="main_form">

						<p><label for="login_username"><?php _e('Username/Email', APP_TD); ?></label><input type="text" class="form-control text" name="user_login" id="login_username" /></p>

						<p><?php do_action('lostpassword_form'); ?><input type="submit" id="lostpass" name="lostpass" class="btn btn-lg btn-info submit" value="<?php _e('Get New Password',APP_TD); ?>" /></p>

						<!-- autofocus the field -->
						<script type="text/javascript">try{document.getElementById('login_username').focus();}catch(e){}</script>

					</form>
				
				</div>
				
				<div class="clear"></div>

			</div><!-- end section_content -->

			<div class="clear"></div>

		</div><!-- end section -->
	
	</div>
	
    <div class="clear"></div>

</div><!-- end main content -->

<?php //if (get_option('jr_show_sidebar')!=='no') get_sidebar('page'); ?>
