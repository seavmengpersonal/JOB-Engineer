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

<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong> </div>

<div id="type-tag"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></div>
<div id="type-tag-prev"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></div>

          

					
					
                 

						
                  

					<div id="exc-3"><?php echo substr(get_the_excerpt(), 0,150); ?> ...</div>
					
					<?php appthemes_after_post_title( 'job_listing' ); ?>

                    <dt><?php _e('location', APP_TD); ?></dt>
                    <div  id="location"><strong><?php _e('Location:', APP_TD); ?></strong> <?php if ($address = get_post_meta($post->ID, 'geo_short_address', true)) echo wptexturize($address); else _e('Anywhere',APP_TD); ?> <?php echo wptexturize(get_post_meta($post->ID, 'geo_short_address_country', true)); ?></div>

                    <dt><?php _e('Date', APP_TD); ?></dt>
                    <div id="date"><span class="year"> <?php echo date_i18n(__('d/M/Y',APP_TD), strtotime($post->post_date)); ?></span></div>
                    <div id="details-2"><strong><a href="<?php the_permalink(); ?>"><?php _e('Details', APP_TD); ?></a> </strong></div>

              

            </li>

        <?php endwhile; ?>
		
		<?php appthemes_after_endwhile( 'job_listing' ); ?>

    </ol>
    
    

<?php else: ?><?php appthemes_loop_else( 'job_listing' ); ?><?php endif; ?>

<?php appthemes_after_loop( 'job_listing' ); ?>