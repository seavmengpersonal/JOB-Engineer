<?php
/**
 * JobRoller Preview Job form
 * Function outputs the job preview form
 *
 *
 * @version 1.0
 * @author AppThemes
 * @package JobRoller
 * @copyright 2010 all rights reserved
 *
 */
 ?>
		<form action="<?php echo esc_url( $form_action ) ?>" method="post" enctype="multipart/form-data" id="submit_form" class="submit_form main_form">
		<?php wp_nonce_field('submit_job', 'nonce') ?>
		<p><?php _e('Below is a preview of what your job listing will look like when published:', APP_TD); ?></p>
		
		<div class="col-md-9 col-lg-9">
			<table style="width:100%; margin-top:10px;" class="bold">
				<tr>
					<td style="width:20%"><?php _e('Company',APP_TD)?></td>
					<td>: 
						<?php
						$format = __('<a href="%s">%s</a>', APP_TD);
						$author = get_user_by('id', $job->post_author); 
						if ( $author && $link = get_author_posts_url( $author->ID, $author->user_nicename ) )
						echo sprintf( $format, $link, apply_filters('', get_post_meta($job->ID, '_Company', true)) ); ?>
						</td>
				</tr>
				<tr>
					<td>Type</td>
					<td>: <?php echo apply_filters('', get_post_meta($job->ID, 'j_type', true)); ?></td>
				</tr>
				<tr>
					<td>Category</td>
					<td>: <?php if(get_the_term_list($job->ID, 'job_cat')) echo get_the_term_list($job->ID, 'job_cat', '', ' - ', '' ); else echo __('No Categories', APP_TD); ?></td>
				</tr>
			</table>
		</div>
		
		<div class="col-md-3 col-lg-3">
			<div id="logoso3">
				<img width="90px"  height="75px" src="<?php if ($job->company-logo) :echo ($job->company-logo);else :endif;?>">
				<?php the_listing_logo_editor2( $job->ID ); ?>
			 </div>
		</div>
		
		<div class="clearfix"></div>		
		
		<h4 class="header-line"><?php _e('Job Information', APP_TD); ?></h4>
		<table style="white-space: nowrap;" class="table table-bordered col-md-12 col-lg-12">
			<tr>
				<td style="width:23%">Career Level</td>
				<td style="width:27%"><?php echo apply_filters('', get_post_meta($job->ID, 'level', true)); ?></td>
				<td style="width:23%">Term</td>
				<td style="width:27%"><?php jr_get_custom_taxonomy($job->ID, 'job_type', 'jtype'); ?></td>
			</tr>
			<tr>
				<td>Numer of Experience (Year)</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'experience', true)); ?></td>
				<td>Location</td>
				<td><?php if(get_the_term_list($job->ID, 'job_loc')) echo get_the_term_list($job->ID, 'job_loc', '', ' - ', '' ); else echo __('', APP_TD); ?></td>
			</tr>
			<tr>
				<td>Hiring (Person)</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'hire', true)); ?></td>
				<td>Industry</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'industry', true)); ?></td>
			</tr>
			<tr>
				<td>Salary</td>
				<td><?php jr_get_custom_taxonomy($job->ID, 'job_salary', 'jsalary'); ?></td>
				<td>Qualification</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'qualification', true)); ?></td>
			</tr>
			<tr>
				<td>Sex</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'sex', true)); ?></td>
				<td>Language</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'language', true)); ?></td>
			</tr>
			<tr>
				<td>Age</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'age', true)); ?></td>
				<td>Public Date</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 's_day', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 's_month', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 's_year', true)); ?></td>
			</tr>
			<tr>
				<td>Close Date</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'e_day', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 'e_month', true)); ?>-<?php echo apply_filters('', get_post_meta($post->ID, 'e_year', true)); ?></td>
				<td>Maritals</td>
				<td><?php echo apply_filters('', get_post_meta($job->ID, 'marital', true)); ?></td>
			</tr>
		</table>
	
		<div class="clearfix"></div>
		
		<p><?php _e('The job listing&rsquo;s page will contain the following information:', APP_TD); ?></p>
		
		
		<h4 class="header-line"><?php _e('Job description',APP_TD); ?></h4>
		<?php echo wpautop(wptexturize($job->post_content)); ?>
		<h4 class="header-line"><?php _e('Job requirement',APP_TD); ?></h4>
		<?php echo wpautop(wptexturize($job->post_require)); ?>
		<?php if (get_option('jr_submit_how_to_apply_display')=='yes') : ?>
			<h4 class="header-line"><?php _e('How to apply',APP_TD); ?></h4>
			<?php echo wpautop(wptexturize($job->apply)); ?>
		<?php endif; ?>
		

		<?php do_action( 'jr_after_preview_job_form' ); ?>
		<input type="hidden" name="action" value="<?php echo esc_attr($post_action); ?>" />
		<input type="hidden" name="ID" value="<?php echo esc_attr($job->ID); ?>">
		<input type="hidden" name="order_id" value="<?php echo esc_attr($order_id); ?>">
		<input type="hidden" name="step" value="<?php echo esc_attr($step); ?>"/>
		<p>
			<input type="submit" class="goback btn btn-danger" name="goback" value="<?php esc_attr_e( 'Go Back',APP_TD ); ?>"  /> 
			<input type="submit" class="submit btn btn-primary" name="preview_submit" value="<?php esc_attr_e( 'Next &rarr;', APP_TD ); ?>" />
		</p>
		<div class="clear"></div>
	</form>
<?php
