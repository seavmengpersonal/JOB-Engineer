<?php
/**
* Main loop for displaying jobs
*
* @package JobRoller
* @author AppThemes
*
*/
?>
<?php if (have_posts()) : $alt = 1; ?>
	<ul class="bt-list job-list thumb-list">

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
	  <li class="sticky">
			<div class="thumb clearfix">
			    <?php if ( has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('thumbnail', array('class' => 'logoso')); ?>
				  <?php endif; ?>
			</div>
			<div class="desc">
				<h5 class="title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h5>		
				  <?php
					$format = __('<a href="%s">%s</a>', APP_TD);
					$author = get_user_by('id', $post->post_author); 
					if ( $author && $link = get_author_posts_url( $author->ID, $author->user_nicename ) )
					echo sprintf( $format, $link, apply_filters('', get_post_meta($post->ID, '_Company', true)) ); ?>
					
					( <?php if(get_the_term_list($post->ID, 'job_loc')) 
							echo get_the_term_list($post->ID, 'job_loc', '', ' - ', '' ); else echo __('', APP_TD); ?> )
				  <div class="info">
					<div>
					  <span class="fa fa-clock-o"></span>
					  9 days			  
					</div>
					<div title="Closing Date" data-toggle="tooltip" data-placement="bottom">
					  <span class="fa fa-calendar-times-o"></span>			  
					</div>
				  </div>
			</div>
			<div class="blank"></div>
		</li>
	   
	  <!--Ad ends here-->
	  <?php $count++; ?>
	  <?php endwhile; ?>  
	</ul>
<?php endif; ?>
