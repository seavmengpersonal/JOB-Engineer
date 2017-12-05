<?php
	if ( get_query_var('paged') )
		$paged = get_query_var('paged');
	elseif ( get_query_var('page') )
		$paged = get_query_var('page');
	else
		$paged = 1;
?>
<div class="blocks">
<?php do_action('jobs_will_display'); ?>
<div class="clear pado"></div>
<?php do_action('before_front_page_jobs'); ?>
<div class="clear"></div>	
<?php
			$main_wp_query = $wp_query;

			 $args = jr_filter_form();
			 query_posts( $args );

			// call the main loop-job.php file
			appthemes_load_template( 'loop-job.php', array( 'main_wp_query' => $main_wp_query ) );
		?>
		
		<?php jr_paging(); ?>
		
		<?php wp_reset_query(); ?>
		
<div class="clear"></div>	

<?php  do_action('after_front_page_jobs'); ?>	
</div>