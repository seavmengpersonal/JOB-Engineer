<?php
// Template Name: Job Seeker - Register
$redirect = $action = $role = 'job_seeker';
// set a redirect for after logging in
if ( isset( $_REQUEST['redirect_to'] ) ) {
	$redirect = $_REQUEST['redirect_to'];
}
?>
	
	<div class="col-md-12 col-lg-12">
	
		<div class="section">

			<div class="section_content">

				<?php if (!is_user_logged_in()) : ?>
										
					<h1 class="well"><?php _e('Register / Job Seeker', APP_TD); ?></h1>

						<div class="col-md-6 col-lg-6">
							 <?php  do_action( 'jr_display_register_form', $redirect, $role ); ?>
						</div>
					
				<?php endif; ?>

				<div class="clear"></div>

			</div><!-- end section_content -->
	 
			<div class="clear"></div>

		</div><!-- end section -->
	
	</div>
	

    <div class="clear"></div>

</div><!-- end main content -->

<?php //if (get_option('jr_show_sidebar')!=='no') get_sidebar('login'); ?>