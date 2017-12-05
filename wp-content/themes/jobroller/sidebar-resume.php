<div id="sidebar" class="ff">

	<ul class="widgets">
	
		<?php/// appthemes_before_sidebar_widgets( 'resume' ); ?>
		
		<?php ///get_template_part( 'includes/sidebar-resume-nav' ); ?>

                <?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('user'); ?>
		
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar_resume')) : else : ?>

			<!-- no dynamic sidebar so don't do anything -->

		<?php endif; ?>
		
		<?php appthemes_after_sidebar_widgets( 'resume' ); ?>

	</ul>

</div><!-- end sidebar -->
