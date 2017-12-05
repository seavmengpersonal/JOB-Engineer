<?php
/**
 * Main loop for displaying jobs
 *
 * @package JobRoller
 * @author AppThemes
 *
 */
?>

<?php appthemes_before_loop( 'job_listing' ); ?>

<?php if (have_posts()) : $alt = 1; ?>

    <ol class="jobs">
		<?php if (get_option('ad_listings_freq')=='0') : ?>
			<li class="job">
				<div id="logoso-listing"> </div>
				<div id="exc-5">
					<div class="adblock2">
						<?php echo stripslashes(get_option('ad_listings')); ?>
					</div>
				</div>
			</li>
		<?php endif; ?>

		<?php $count = 1; ?>
        <?php while (have_posts()) : the_post(); ?>
			<?php appthemes_before_post( 'job_listing' ); ?>
            <?php
				global $featured_job_cat_id;

				$post_class = array('job');
				$expired = jr_check_expired($post);

				if ($expired) {
					$post_class[] = 'job-expired';
					$action = get_option('jr_expired_action');
					if ($action=='hide') :
						continue;
					endif;
				}
				$alt=$alt*-1;
				if ($alt==1) $post_class[] = 'job-alt';
				if ( is_object_in_term( $my_query->post->ID, 'job_cat', array($featured_job_cat_id) ) ) $post_class[] = '';
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

		<div id="titlo">
			<strong>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
			<?php 
			  if(strtotime($post->post_date) > strtotime('-7 days')){
			?>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/new2.gif" / >
			<?php  } ?>
			</strong> 
		</div>

		<div id="type-tag"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></div>
		<div id="type-tag-prev"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></div>

					<div id="exc">
					<div class="lista">
					<?php echo substr(get_the_excerpt(), 0,180); ?> ...
					</div>
					<div class="clear"></div>
					 <div class="grids">
					<b><?php _e('Company',APP_TD); ?>:</b> <?php echo $company_name; ?><?php echo wptexturize(get_post_meta($post->ID, '_Company', true)); ?>
					 <br/><b><?php _e('Salary',APP_TD); ?>:</b>  <?php jr_get_custom_taxonomy($post->ID, 'job_salary', 'jsalary'); ?>
					 <br/><b><?php _e('Job category',APP_TD); ?>:</b> 
					 <?php if(get_the_term_list($post->ID, 'job_cat'))echo get_the_term_list($post->ID, 'job_cat', '', ' - ', '' ); else echo __('', APP_TD); ?>
					</div>
					</div>
					<?php appthemes_after_post_title( 'job_listing' ); ?>

                    <dt><?php _e('location', APP_TD); ?></dt>
                   
					
					
									<?php
    switch (get_option('enable_location_field')) {

                case "": ?>
               
                <?php break;

                case "Location by Google maps": ?>
           
		   <div  id="location"><strong><?php echo stripslashes(get_option('tr_location'))  ?>: </strong> 

<?php if(get_the_term_list($post->ID, 'job_loc')) echo get_the_term_list($post->ID, 'job_loc', '', ' - ', '' ); else echo __('', APP_TD); ?>

<!--<?php if ($address = get_post_meta($post->ID, 'geo_short_address', true)) echo wptexturize($address); else _e('Anywhere',APP_TD); ?> 
<?php echo wptexturize(get_post_meta($post->ID, 'geo_short_address_country', true)); ?>--></div>

                <?php break;

                case "Location by new taxonomy": ?>
                
				
<div  id="location"><strong><?php echo stripslashes(get_option('tr_location'))  ?>: </strong><?php if(get_the_term_list($post->ID, 'job_loc')) echo get_the_term_list($post->ID, 'job_loc', '', ' - ', '' ); else echo __('', APP_TD); ?></div>

               				
            
				
                <?php break;

               
            }
?>			
					
					
					
					
					
					
<?php
$date = get_post_meta($post->ID, 'e_day', true).'-'.get_post_meta($post->ID, 'e_month', true).'-'.get_post_meta($post->ID, 'e_year', true);
 ?>
                    <dt><?php _e('Date', APP_TD); ?></dt>
                    <div id="date"><span class="year"> <?php echo /*date_i18n(__('d/M/Y',APP_TD), strtotime($post->post_date));*/ $date; ?></span></div>
                   
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

       <?php if ($count == get_option('ad_listings_freq')) : ?>
<!-- conditional header ad starts here-->

<?php if (get_option('adv_listings')=='Yes') : ?>
   <li class="<?php echo implode(' ', $post_class); ?>">
   <div id="logoso-listing"> </div>
   <div id="exc-5">
<div class="adblock2">

			<?php echo stripslashes(get_option('ad_listings')); ?>
			


</div></div>
</li>
<?php endif; ?>










<!--Ad ends here-->
<?php endif; $count++; ?>
  

        <?php endwhile; ?>
        
        
		
		<?php appthemes_after_endwhile( 'job_listing' ); ?>

    </ol>

<?php else: ?>

	<?php appthemes_loop_else( 'job_listing' ); ?>        
	
<?php endif; ?>

<?php appthemes_after_loop( 'job_listing' ); ?>