
	<div class="col-md-9 col-lg-9">
	
	<?php appthemes_before_loop(); ?>
		
		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>
			
				<?php appthemes_before_post(); ?>

				<?php appthemes_stats_update($post->ID); //records the page hit ?>				

					<div class="col-md-9 col-lg-9">							
						<?php appthemes_before_post_title(); ?>
						<div class="tito">										
							<h2 class="title">
								<?php the_title(); ?>
							</h2>																		
							<?php appthemes_after_post_title(); ?>
						</div>
						
						<div class="date-s">
							<small><?php the_date(__('',APP_TD)); ?></small>
						</div>
						<div class="clear"></div>
					</div>
					
					<div class="col-md-9 col-lg-9">
						<table style="width:100%; margin-top:10px;" class="bold">
							<tr>
								<td style="width:20%"><?php _e('Company',APP_TD)?></td>
								<td>: 
									<?php
									$format = __('<a href="%s">%s</a>', APP_TD);
									$author = get_user_by('id', $post->post_author); 
									if ( $author && $link = get_author_posts_url( $author->ID, $author->user_nicename ) )
									echo sprintf( $format, $link, apply_filters('', get_post_meta($post->ID, '_Company', true)) ); ?>
									</td>
							</tr>
							<tr>
								<td>Type</td>
								<td>: <?php echo apply_filters('', get_post_meta($post->ID, 'j_type', true)); ?></td>
							</tr>
							<tr>
								<td>Category</td>
								<td>: <?php if(get_the_term_list($post->ID, 'job_cat')) echo get_the_term_list($post->ID, 'job_cat', '', ' - ', '' ); else echo __('No Categories', APP_TD); ?></td>
							</tr>
						</table>
					</div>
					 
					<div class="col-md-3 col-lg-3">
						<a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail(); ?> </a>
					</div>
					
					<div class="clearfix"></div>
					
					<h4 class="header-line"><?php _e('Job Information', APP_TD); ?></h4>
					
					<table style="white-space: nowrap;" class="table table-bordered col-md-12 col-lg-12">
						<tr>
							<td style="width:23%">Career Level</td>
							<td style="width:27%"><?php echo apply_filters('', get_post_meta($post->ID, 'level', true)); ?></td>
							<td style="width:23%">Term</td>
							<td style="width:27%"><?php jr_get_custom_taxonomy($post->ID, 'job_type', 'jtype'); ?></td>
						</tr>
						<tr>
							<td>Numer of Experience (Year)</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'experience', true)); ?></td>
							<td>Location</td>
							<td><?php if(get_the_term_list($post->ID, 'job_loc')) echo get_the_term_list($post->ID, 'job_loc', '', ' - ', '' ); else echo __('', APP_TD); ?></td>
						</tr>
						<tr>
							<td>Hiring (Person)</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'hire', true)); ?></td>
							<td>Industry</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'industry', true)); ?></td>
						</tr>
						<tr>
							<td>Salary</td>
							<td><?php jr_get_custom_taxonomy($post->ID, 'job_salary', 'jsalary'); ?></td>
							<td>Qualification</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'qualification', true)); ?></td>
						</tr>
						<tr>
							<td>Sex</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'sex', true)); ?></td>
							<td>Language</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'language', true)); ?></td>
						</tr>
						<tr>
							<td>Age</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'age', true)); ?></td>
							<td>Public Date</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 's_day', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 's_month', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 's_year', true)); ?></td>
						</tr>
						<tr>
							<td>Close Date</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'e_day', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 'e_month', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 'e_year', true)); ?></td>
							<td>Maritals</td>
							<td><?php echo apply_filters('', get_post_meta($post->ID, 'marital', true)); ?></td>
						</tr>
					</table>
				
				<div class="clearfix"></div>
				
				<div class="section_content">
				
					<?php do_action('job_main_section', $post); ?>

					<?php if (get_option('jr_sharethis_id')) { ?>
						<p class="sharethis">
							<span class="st_twitter_hcount" displayText="Tweet"></span>
							<span class="st_facebook_hcount" displayText="Share"></span>
						</p>
						<div class="clear"></div>
					<?php } ?>					
					
					<?php if (get_option('adv_job')=='Yes') : ?>
				
						<div id="jobad"><?php echo stripslashes(get_option('ad_job')); ?></div>
						<div class="clear"></div>
				
					<?php endif; ?>
			
					<div id="margin"></div>
					
					<h4 class="header-line"><?php _e('Job Description', APP_TD); ?></h4>
					
					<div id="margin"></div>
					
					<?php appthemes_before_post_content(); ?>					
					
					<?php the_content(); ?>
					
					<div id="margin"></div>
					
					<h4 class="header-line"><?php _e('Job Requirement', APP_TD); ?></h4>
					
					<div id="margin"></div>
					
					<?php echo apply_filters('the_content', get_post_meta($post->ID, 'post_require', true)); ?>

					<?php the_job_listing_fields(); ?>

					<?php the_listing_files(); ?>

					<?php appthemes_after_post_content(); ?>

					<?php if (get_option('jr_enable_listing_banner')=='yes') : ?><div id="listingAd"><?php echo stripslashes(get_option('jr_listing_banner')); ?></div><?php endif; ?>

					<?php if (get_option('jr_submit_how_to_apply_display')=='yes' && get_post_meta($post->ID, '_how_to_apply', true)) { ?>
						
						<div id="margin"></div>
						
						<h4 class="header-line"><?php _e('How to Apply',APP_TD) ?></h4>
						
						<div id="margin"></div>	
						
						<?php echo apply_filters('the_content', get_post_meta($post->ID, '_how_to_apply', true)); ?>
						
						<h4 class="header-line"><?php _e('Contact Information',APP_TD) ?></h4>
						
						<table class="table-data" style="width:100%;">                                                    
							 <tr>
								 <td style="width:20%">Phone</td>
								 <td>: <?php echo apply_filters('', get_post_meta($post->ID, 'phone', true)); ?></td>
							 </tr>
							 <tr>
								 <td>Email</td>
								 <td>: <?php echo apply_filters('', get_post_meta($post->ID, 'email', true)); ?></td>
							 </tr>
							 <tr>
								 <td>Website</td>
								 <td>: <?php echo apply_filters('', get_post_meta($post->ID, 'website', true)); ?></td>
							 </tr>
							 <tr>
								 <td>Address</td>
								 <td>: <?php echo apply_filters('', get_post_meta($post->ID, 'j_location', true)); ?></td>
							 </tr>
						</table>
						
					<?php } ?>

					<div class="clear"></div>

				</div><!-- end section_content -->
								
				<?php
					// load up theme-actions.php and display the apply form
					do_action('job_footer');                
				?>			
				
				<div class="spacer"></div>
				
				<?php appthemes_after_post(); ?>

			<?php endwhile; ?>

				<?php appthemes_after_endwhile(); ?>

		<?php else: ?>

			<?php appthemes_loop_else(); ?>

		<?php endif; ?>	

		<?php appthemes_after_loop(); ?>

	</div><!-- end section -->	
	
	<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('job'); ?>
	
	<div class="clear"></div>

</div><!-- end main content -->

