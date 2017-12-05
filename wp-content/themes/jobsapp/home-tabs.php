<!-- Home tabs-->
<div class="tabcontrol">
            <ul class="tabnavig">
		
 <?php  switch (get_option('tab_1')) {

            case "Nothing": ?>
            <?php break; case "Featured": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_1', '');  ?>"><span class="big"><?php echo get_option('tab_1_name', '');?></span></a></li>
            <?php break; case "Categories": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_1', '');  ?>"><span class="big"><?php echo get_option('tab_1_name', '');?></span></a></li>
            <?php break; case "Locations": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_1', '');  ?>"><span class="big"><?php echo get_option('tab_1_name', '');?></span></a></li>
			<?php break;case "Last-jobs": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_1', '');  ?>"><span class="big"><?php echo get_option('tab_1_name', '');?></span></a></li>
			<?php break; case "Sponsored": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_1', '');  ?>"><span class="big"><?php echo get_option('tab_1_name', '');?></span></a></li>
			
	    <?php break; }
		
	?>
 <?php  switch (get_option('tab_2')) {

            case "Nothing": ?>
            <?php break; case "Featured": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_2', '');  ?>"><span class="big"><?php echo get_option('tab_2_name', '');?></span></a></li>
            <?php break; case "Categories": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_2', '');  ?>"><span class="big"><?php echo get_option('tab_2_name', '');?></span></a></li>
            <?php break; case "Locations": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_2', '');  ?>"><span class="big"><?php echo get_option('tab_2_name', '');?></span></a></li>
			<?php break;case "Last-jobs": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_2', '');  ?>"><span class="big"><?php echo get_option('tab_2_name', '');?></span></a></li>
			<?php break; case "Sponsored": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_2', '');  ?>"><span class="big"><?php echo get_option('tab_2_name', '');?></span></a></li>
			
	    <?php break; }
		
	?>
 <?php  switch (get_option('tab_3')) {

            case "Nothing": ?>
            <?php break; case "Featured": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_3', '');  ?>"><span class="big"><?php echo get_option('tab_3_name', '');?></span></a></li>
            <?php break; case "Categories": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_3', '');  ?>"><span class="big"><?php echo get_option('tab_3_name', '');?></span></a></li>
            <?php break; case "Locations": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_3', '');  ?>"><span class="big"><?php echo get_option('tab_3_name', '');?></span></a></li>
			<?php break;case "Last-jobs": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_3', '');  ?>"><span class="big"><?php echo get_option('tab_3_name', '');?></span></a></li>
			<?php break; case "Sponsored": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_3', '');  ?>"><span class="big"><?php echo get_option('tab_3_name', '');?></span></a></li>
			
	    <?php break; }
		
	?>
  <?php  switch (get_option('tab_4')) {

            case "Nothing": ?>
            <?php break; case "Featured": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_4', '');  ?>"><span class="big"><?php echo get_option('tab_4_name', '');?></span></a></li>
            <?php break; case "Categories": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_4', '');  ?>"><span class="big"><?php echo get_option('tab_4_name', '');?></span></a></li>
            <?php break; case "Locations": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_4', '');  ?>"><span class="big"><?php echo get_option('tab_4_name', '');?></span></a></li>
			<?php break;case "Last-jobs": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_4', '');  ?>"><span class="big"><?php echo get_option('tab_4_name', '');?></span></a></li>
			<?php break; case "Sponsored": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_4', '');  ?>"><span class="big"><?php echo get_option('tab_4_name', '');?></span></a></li>
			
	    <?php break; }
		
	?>
  <?php  switch (get_option('tab_5')) {

            case "Nothing": ?>
            <?php break; case "Featured": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_5', '');  ?>"><span class="big"><?php echo get_option('tab_5_name', '');?></span></a></li>
            <?php break; case "Categories": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_5', '');  ?>"><span class="big"><?php echo get_option('tab_5_name', '');?></span></a></li>
            <?php break; case "Locations": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_5', '');  ?>"><span class="big"><?php echo get_option('tab_5_name', '');?></span></a></li>
			<?php break;case "Last-jobs": ?>
			<li class="tab"><a href="#<?php echo get_option('tab_5', '');  ?>"><span class="big"><?php echo get_option('tab_5_name', '');?></span></a></li>
			<?php break; case "Sponsored": ?>
            <li class="tab"><a href="#<?php echo get_option('tab_5', '');  ?>"><span class="big"><?php echo get_option('tab_5_name', '');?></span></a></li>
			
	    <?php break; }
		
	?>
             <li class="tab"><a href="#Salary"><span class="big">Job by Salary</span></a></li>
             <li class="tab"><a href="#Type"><span class="big">Job by Type</span></a></li>
	</ul>



<!-- featured jobs -->	
<div id="Featured" class="blocks">
 <div  class="section">   
 <div id="wrap">
	
		<ul id="job-o" class="list clearfix">
			<!-- row 1 -->
			<li class="clearfix">
				<section class="left">
							<?php
			$args = jr_filter_form();
			query_posts($args);

			// call the featured jobs loop-job-featured.php file
			get_template_part( 'loop', 'job-featured' );
		?>

		
		<?php wp_reset_query(); ?>
					
				</section>
			</li>
		</ul>
</div>
</div>
</div>			

<!-- latest jobs -->
<div id="Last-jobs" class="blocks">
<div  class="section">   
<div id="wrap">

		<ul id="job-o2" class="list2 clearfix">
			<!-- row 1 -->
			<li class="clearfix">
				<section class="left">
						<?php
			$args = jr_filter_form();
			query_posts($args);

			// call the main loop-job.php file
			get_template_part( 'loop', 'job-home' );
		?>

		<?php jr_paging_static(); ?>
		
		<?php wp_reset_query(); ?>
					
				</section>
			</li>
		
		</ul>
 
  </div>
  </div> 
</div>
		
<!--  By cats -->		
<div id="Categories" class="blocks">
<div  class="section">   
<div id="col">

<ul>
<?php

	// By Cat
		$args = array(
		    'hierarchical'       => false,
		    'parent'             => 0,
			'hide_empty'		 => (int)get_option('jr_show_empty_categories'),
			'orderby'			=> 'NAME',
			'order' 			=> 'ASC',
			'exclude' 			=>$featured_job_cat_id

		);
		$terms = get_terms( 'job_cat', apply_filters('jr_nav_job_cat', $args) );

		if ($terms) :

                    foreach($terms as $term) :

                        echo '<li class="cato';
                        if ( isset($wp_query->queried_object->slug) && $wp_query->queried_object->slug==$term->slug ) echo 'current_page_item';
                        echo '"><a href="'.get_term_link( $term->slug, 'job_cat' ).'" title="'.$term->name.'">'.substr($term->name,0,25).' ... <span id="count">['. $term->count .']</span></a></li>';
                    endforeach;

                    echo '</ul>';
		endif;
		
		
?>
<div class="clear"></div>
<div class="catsi"><?php echo stripslashes(get_option('content_home_tab1'))  ?></div>
</div>
</div>
</div>		
<!-- featured locations -->	
<div id="Locations" class="blocks">
 <div  class="section">   
             <div id="col">

<ul>
<?php

	// By Locs
		$args = array(
		    'hierarchical'       => false,
		    'parent'             => 0,
			'hide_empty'		 => (int)get_option('jr_show_empty_categories'),
			'orderby'			=> 'NAME',
			'order' 			=> 'ASC',
			'exclude' 			=>$featured_job_cat_id

		);
		$terms = get_terms( 'job_loc', apply_filters('jr_nav_job_loc', $args) );

		if ($terms) :

                    foreach($terms as $term) :

                        echo '<li class="cato';
                        if ( isset($wp_query->queried_object->slug) && $wp_query->queried_object->slug==$term->slug ) echo 'current_page_item';
                        echo '"><a href="'.get_term_link( $term->slug, 'job_loc' ).'">'.$term->name.' <span id="count">['. $term->count .']</span></a></li>';
                    endforeach;

                    echo '</ul>';
		endif;

?>
<div class="clear"></div>
<div class="catsi"><?php echo stripslashes(get_option('content_home_tab2'))  ?></div>
</div>
</div>
</div>


<!-- sponsored jobs -->
<div id="Sponsored" class="blocks">
<div  class="section">   
<?php do_action('before_front_page_jobs'); ?>
<?php  do_action('after_front_page_jobs'); ?>
</div>
</div>  

<!-- featured locations -->	
<div id="Salary" class="blocks">
 <div  class="section">   
             <div id="col">

<ul>
<?php

	// By Locs
		$args = array(
		    'hierarchical'       => false,
		    'parent'             => 0,
			'hide_empty'		 => (int)get_option('jr_show_empty_categories'),
			'orderby'			=> 'NAME',
			'order' 			=> 'ASC',
			'exclude' 			=>$featured_job_cat_id

		);
		$terms = get_terms( 'job_salary', apply_filters('jr_nav_job_loc', $args) );

		if ($terms) :

                    foreach($terms as $term) :

                        echo '<li class="cato';
                        if ( isset($wp_query->queried_object->slug) && $wp_query->queried_object->slug==$term->slug ) echo 'current_page_item';
                        echo '"><a href="'.get_term_link( $term->slug, 'job_salary' ).'">'.$term->name.' <span id="count">['. $term->count .']</span></a></li>';
                    endforeach;

                    echo '</ul>';
		endif;

?>
<div class="clear"></div>
<div class="catsi"><?php echo stripslashes(get_option('content_home_tab2'))  ?></div>
</div>
</div>
</div>


<!-- featured locations -->	
<div id="Type" class="blocks">
 <div  class="section">   
             <div id="col">

<ul>
<?php

	// By Locs
		$args = array(
		    'hierarchical'       => false,
		    'parent'             => 0,
			'hide_empty'		 => (int)get_option('jr_show_empty_categories'),
			'orderby'			=> 'NAME',
			'order' 			=> 'ASC',
			'exclude' 			=>$featured_job_cat_id

		);
		$terms = get_terms( 'job_type', apply_filters('jr_nav_job_loc', $args) );

		if ($terms) :

                    foreach($terms as $term) :

                        echo '<li class="cato';
                        if ( isset($wp_query->queried_object->slug) && $wp_query->queried_object->slug==$term->slug ) echo 'current_page_item';
                        echo '"><a href="'.get_term_link( $term->slug, 'job_type' ).'">'.$term->name.' <span id="count">['. $term->count .']</span></a></li>';
                    endforeach;

                    echo '</ul>';
		endif;

?>

<div class="clear"></div>
<div class="catsi"><?php echo stripslashes(get_option('content_home_tab2'))  ?></div>

</div>


</div>

</div>
