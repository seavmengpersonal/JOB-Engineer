<?php
/*
Template Name: View Profile
*/

nocache_headers();

appthemes_auth_redirect_login();
?>

<div class="section">
		
		<div class="section_content"> 

		</div><!-- end section_content -->

	</div><!-- end section -->

	<div class="clear"></div>

</div><!-- end main content -->

<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('user'); ?>