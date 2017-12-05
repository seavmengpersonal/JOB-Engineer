<?php
// Template Name: Login
$redirect = $action = $role = '';
// set a redirect for after logging in
if ( isset( $_REQUEST['redirect_to'] ) ) {
	$redirect = $_REQUEST['redirect_to'];
}
?>
	
	

	
	<div class="col-md-12 col-lg-12">
	
		<div class="section">

			<div class="section_content">

				<?php if (!is_user_logged_in()) : ?>
					
					   
    				

					<h1 class="well"><?php _e('Login', APP_TD); ?></h1>

						<div class="col-md-4 col-lg-4">
							<?php do_action( 'jr_display_login_form', $action, $redirect );  ?>
						</div>

						<div class="col-md-6 col-lg-6">
							 <?php  //do_action( 'jr_display_register_form', $redirect, $role ); ?>
						</div>
					
				<?php endif; ?>

				<div class="clear"></div>

			</div><!-- end section_content -->
	 
			<div class="clear"></div>

		</div><!-- end section -->
	
	</div>
	

    <div class="clear"></div>

</div><!-- end main content -->

<!-- autofocus the field -->

<?php //if (get_option('jr_show_sidebar')!=='no') get_sidebar('login'); ?>