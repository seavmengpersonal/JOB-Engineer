<?php
	$status = ( 'no' != _jr_moderate_jobs() ?  __( 'for approval', APP_TD ) : '' );
?>
	<p><?php echo sprintf( __( 'Your job is ready to be submitted, please confirm the details are correct and then click \'Confirm\' to submit your listing %s.', APP_TD ), $status ); ?></p>
		
		
		<h2><?php
			$job_type_name = jr_get_single_term( $job->ID, APP_TAX_TYPE )->name;
			echo wptexturize( $job_type_name ).' &ndash; '; 
			echo wptexturize( $job->post_title ); 
		?></h2>
		
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
		
		<?php if ($job->your_name) : ?>
		<h4 class="header-line"><?php _e('Company/Poster',APP_TD); ?></h4>
		<p><?php
			if ( $job->website )
				echo '<a href="'. strip_tags( $job->website ).'">';
			echo strip_tags( $job->your_name );
			if ( $job->website )
				echo '</a>';
		?></p>
		<?php endif; ?>
		<h4 class="header-line"><?php _e('Job description',APP_TD); ?></h4>
		<?php echo wpautop( wptexturize( $job->post_content ) ); ?>
		<h4 class="header-line"><?php _e('Job requirement',APP_TD); ?></h4>
		<?php echo wpautop( wptexturize( $job->post_require ) ); ?>
		<?php if ( 'yes' == get_option('jr_submit_how_to_apply_display') ) : ?>
			<h4 class="header-line"><?php _e( 'How to apply', APP_TD ); ?></h4>
			<?php echo wpautop( wptexturize( $job->apply ) ); ?>
		<?php endif; ?>

