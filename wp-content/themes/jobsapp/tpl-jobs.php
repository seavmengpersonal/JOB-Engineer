<?php
/*
Template Name: Template last jobs
*/
?>


<?php 
	get_header('search');
	
	do_action('jobs_will_display');
?>

	<div class="section">

    	<div class="section_content">

				<h3 class="desco"><?php the_title(); ?></h3>

			
		  
		  
		   <?php
		  
		  $job_cat_slug = get_query_var('job_cat');
		  $job_cat = get_term_by( 'slug', $job_cat_slug, 'job_cat');
		  
		  ?>
		  

	
		
		<?php 
echo "<!--";
			$args = jr_filter_form();
echo "-->";
			$args = array_merge(
				array(
					'job_cat' => $job_cat_slug
				),
				$args
			);
			query_posts($args);
		?>
		
		<?php get_template_part( 'loop', 'job' ); ?>


<?php if (function_exists("pagination")) {
    pagination($additional_loop->max_num_pages);
} ?>

<?php jr_paging(); ?>
		  
		  
		  
		  
		  
		  

			<div class="clear"></div>

    	</div><!-- end section_content -->

		<div class="clear"></div>

	</div><!-- end section -->

    <div class="clear"></div>

</div><!-- end main content -->

<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('job'); ?>