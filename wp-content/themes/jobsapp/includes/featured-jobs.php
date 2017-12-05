<?php
	$my_query = jr_get_featured_jobs();
	
	ob_start();
?>
<?php if ( $my_query && $my_query->have_posts() ) : $alt = 1; echo '<div class="section"><h2 class="pagetitle"><small class="rss"><a href="'.jr_get_featured_jobs_rss_url().'"><img src="'.get_bloginfo('template_url').'/images/feed.png" title="'.__('Featured Jobs RSS Feed',APP_TD).'" alt="'.__('Featured Jobs RSS Feed',APP_TD).'" /></a></small> '.__('Featured Jobs',APP_TD).'</h2><ol class="jobs">'; while ($my_query->have_posts()) : $my_query->the_post();

	$post_class = array( 'job', 'job-featured' );

	$found = true;

	$alt=$alt*-1; 

	if ($alt==1) $post_class[] = 'job-alt';
	$post_class[] = 'job-featured';
?>


 <li class="<?php echo implode(' ', $post_class); ?>">

<div id="logoso-listing">
 <?php if ( has_post_thumbnail()) : ?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
<?php the_post_thumbnail('thumbnail', array('class' => 'logoso')); ?>

   </a>
 <?php endif; ?>


 </div>
<?php appthemes_before_post_title( 'job_listing' ); ?>

<div id="titlo-featured">

<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong> </div>

<div id="type-tag"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></div>
<div id="type-tag-prev"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></div>


					<div id="exc">
					<?php echo substr(get_the_excerpt(), 0,180); ?> ...
					</div>
					<?php appthemes_after_post_title( 'job_listing' ); ?>

                    <dt><?php _e('location', APP_TD); ?></dt>
                    
					
					
					
									<?php
    switch (get_option('enable_location_field')) {

                case "": ?>
               
                <?php break;

                case "Location by Google maps": ?>
           
		   <div  id="location"><strong><?php _e('Location:', APP_TD); ?></strong> <?php if ($address = get_post_meta($post->ID, 'geo_short_address', true)) echo wptexturize($address); else _e('Anywhere',APP_TD); ?> <?php echo wptexturize(get_post_meta($post->ID, 'geo_short_address_country', true)); ?></div>

                <?php break;

                case "Location by new taxonomy": ?>
                
				
<div  id="location"><strong><?php _e('Location:', APP_TD); ?></strong><?php if(get_the_term_list($post->ID, 'job_loc')) echo get_the_term_list($post->ID, 'job_loc', '', ' - ', '' ); else echo __('', APP_TD); ?></div>

               				
            
				
                <?php break;

               
            }
?>	

                    <dt><?php _e('Date', APP_TD); ?></dt>
                    <div id="date"><span class="year"> <?php echo date_i18n(__('d/M/Y',APP_TD), strtotime($post->post_date)); ?></span></div>
                   
					<div id="details-2"><strong><a href="<?php the_permalink(); ?>"><?php _e('Details', APP_TD); ?></a> </strong></div>
                    			
					
		<?php switch (get_option('enable_sharing')) {

                case "": ?>
               
                <?php break;

                case "Share to Facebook": ?>
             <div id="faceb"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" >Facebook</a></div>
			 

                <?php break;

                case "Share to Linkedin": ?>
   			
	<div id="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&summary=<?php echo substr(get_the_excerpt(), 0,140); ?>" target="_blank" rel="nofollow">Linkedin</a></div>
   			
			
			
	 <?php break;

                case "Share to Twitter": ?>
   			
	<div id="twitter"><a href="http://www.twitter.com/home?status=<?php the_permalink(); ?>+<?php the_title(); ?> - <?php echo substr(get_the_excerpt(), 0,140); ?>" target="_blank" rel="nofollow">Twitter</a></div>		
			
			
                <?php break;
            
            }
?>				
			

              

            </li>
	
<?php 
	endwhile; 
		echo '</ol></div><!-- End section -->';
	endif; 
	
	// Prevents empty list
	if ( ! empty($found) ) {
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	} else {
		ob_end_clean();
	}
