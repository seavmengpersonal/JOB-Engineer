<?php
/*
Template Name: My Jobs Template
*/
?>

<?php
### Prevent Caching
nocache_headers();

appthemes_auth_redirect_login();
if ( !current_user_can('can_submit_job') ) 
	redirect_profile();

global $userdata, $user_ID, $message, $jr_options;

$myjobsID = JR_Dashboard_Page::get_id();

$pending_payment_jobs = _jr_pending_payment_jobs_for_user( $user_ID );

$can_subscribe = jr_current_user_can_subscribe_for_resumes();
?>
	
	<div class="col-md-9 col-lg-9" style="padding:0 25px;">
	
		<div class="section_content">

		<h1><?php printf(__("%s's Dashboard", APP_TD), ucwords($userdata->user_login)); ?></h1>

		<?php do_action( 'appthemes_notices' ); ?>
		
		<ul class="nav nav-tabs">
			<?php do_action( 'jr_dashboard_tab_before', 'job_lister' ); ?>
			<li class="active"><a href="#live" data-toggle="tab"><?php _e('Live', APP_TD); ?></a></li>
			<li><a href="#pending" data-toggle="tab"><?php _e('Pending', APP_TD); ?></a></li>
            <li><a href="#seeker" data-toggle="tab"><?php _e('Search CV', APP_TD); ?></a></li>
			<li><a href="#ended" data-toggle="tab"><?php _e('Ended', APP_TD); ?></a></li>
			<li><a href="#subscriptions" data-toggle="tab"><?php _e('Subscriptions', APP_TD); ?></a></li>
			
			<?php do_action( 'jr_dashboard_tab_after', 'job_lister' ); ?>
		</ul>
		
		<div class="tab-content">
		
			<div id="seeker" class="tab-pane fade ">
				<h4><?php _e('Job Seeker Apply', APP_TD); ?></h4>
				<p><?php _e('Below you will find a list of resumes that apply you have previously posted which are visible on the site.', APP_TD); ?></p>
					
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><?php _e('Resume Title',APP_TD); ?></th>
							<th class="center"><?php _e('Date Created',APP_TD); ?></th>
							<th class="center"><?php _e('Last Modified',APP_TD); ?></th>
							<th class="center"><?php _e('Views',APP_TD); ?></th>
							<th class="center"><?php _e('Visibility',APP_TD); ?></th>
							<th class="right"><?php _e('Actions',APP_TD); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							global $user_ID;
							$args = array(
									'ignore_sticky_posts'	=> 1,
									'posts_per_page' => -1,
									/*'author' => $user_ID,*/
									'post_type' => 'resume',
									'post_status' =>'publish'
							);
							$my_query = new WP_Query($args);                                                        
							$count = 0;
						?>
						<?php if ($my_query->have_posts()) : ?>
							<?php while ($my_query->have_posts()) : ?>
								<?php $my_query->the_post(); ?>
								<?php if (get_post_meta($my_query->post->ID, 'jr_total_count', true)) $job_views = number_format(get_post_meta($my_query->post->ID, 'jr_total_count', true)); else $job_views = '-'; ?>
								<tr>
									<td><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></td>
									<td class="date"><strong><?php the_time('j M'); ?></strong> <span class="year"><?php the_time('Y'); ?></span></td>
									<td class="date"><strong><?php echo date('j M', strtotime($my_query->post->post_modified)); ?></strong> <span class="year"><?php echo date('Y', strtotime($my_query->post->post_modified)); ?></span></td>
									<td class="center"><?php echo $job_views; ?></td>
									<td class="center"><?php echo jr_post_statuses_i18n($my_query->post->post_status); ?></td>
									<td class="actions"></td>
								</tr>
								<?php 
								$count++; 
							endwhile;
						else :
							?><tr><td colspan="6"><?php _e('No resumes found.',APP_TD); ?></td></tr><?php
						endif; 
						wp_reset_query();
						
						?>
					</tbody>
				</table>
			</div>
					
			<div id="live" class="tab-pane fade in active">
				<h4><?php _e('Live Jobs', APP_TD); ?></h4>
				<?php
					global $user_ID;

					if ( get_query_var('tab') && 'live' == get_query_var('tab') ) {
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					} else {
						$paged = 1;
					}

					$args = array(
							'ignore_sticky_posts'	=> true,
							'author' 				=> $user_ID,
							'post_type' 			=> APP_POST_TYPE,
							'post_status' 			=> 'publish',
							'posts_per_page' 		=> jr_get_jobs_per_page(),
							'paged' 				=> $paged,
					);
					$my_query = new WP_Query($args);
				?>
				<?php if ($my_query->have_posts()) : ?>

				<p><?php _e('Below you will find a list of jobs you have previously posted which are visible on the site.', APP_TD); ?></p>

				<table cellpadding="0" cellspacing="0" class="data_list footable table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th data-class="expand center" style="text-align:center !important; "><?php _e('Job Title',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Date Posted',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Days Remaining',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Views',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Actions',APP_TD); ?></th>
						</tr>
					</thead>
					<tbody>

					<?php while ($my_query->have_posts()) : ?>

						<?php $my_query->the_post(); ?>

						<?php if (get_post_meta($my_query->post->ID, 'jr_total_count', true)) $job_views = number_format(get_post_meta($my_query->post->ID, 'jr_total_count', true)); else $job_views = '-'; ?>

						<?php if (jr_check_expired($post)) continue; ?>

						<tr>
							<td><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php the_job_addons(); ?>
							</strong></td>
							<td class="center date"><?php the_time(__('j M',APP_TD)); ?> <?php the_time(__('Y',APP_TD)); ?></td>
							<td class="center days" style="text-align:center !important; "><?php echo jr_remaining_days($my_query->post); ?></td>
							<td class="center"><?php echo $job_views; ?></td>
							<td class="actions center" style="text-align:center !important; ">
								<?php the_job_edit_link( $my_query->post->ID ); ?>
								<?php the_job_end_link( $my_query->post->ID ); ?>
							</td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
				<?php //if (function_exists("wp_bs_pagination"))  {   wp_bs_pagination();}  ?> 
				<?php jr_paging( $my_query, 'paged', array ( 'add_args' => array( 'tab' => 'live' ) ) ); ?>
				<?php jr_paging( $my_query, 'paged', array ( 'add_args' => array( 'tab' => 'seeker' ) ) ); ?>

				<?php else: ?>
					<p><?php _e('No live jobs found.',APP_TD); ?></p>
				<?php endif; ?>
	 
				<form action="<?= site_url("submit-job"); ?>" method="post" class="submit_form main_form">
					<p><input type="submit" class="btn btn-danger" value="Add More Job »" class="submit"></p>
				</form>

			</div>

			<?php
			if ( 'pack' == $jr_options->plan_type && jr_charge_job_listings() ) :
				get_template_part( '/includes/dashboard-packs' );
			endif; 
			?>

			<div id="pending" class="tab-pane fade">

				<h4><?php _e('Pending Jobs', APP_TD); ?></h4>

				<?php
					global $user_ID;

					if ( get_query_var('tab') && 'pending' == get_query_var('tab') ) {
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					} else {
						$paged = 1;
					}

					$args = array(
						'ignore_sticky_posts'	=> true,
						'author' 				=> $user_ID,
						'post_type' 			=> APP_POST_TYPE,
						'post_status' 			=> array( 'pending', 'draft' ),
						'posts_per_page' 		=> jr_get_jobs_per_page(),
						'paged' 				=> $paged,
					);
					$my_query = new WP_Query($args);
				?>
				<?php if ($my_query->have_posts()) : ?>

				<p><?php _e('The following jobs are pending and are not visible to users.', APP_TD); ?></p>
				
				<table cellpadding="0" cellspacing="0" class="data_list footable table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th data-class="expand"><?php _e('Job Title',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Date Posted',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Status',APP_TD); ?></th>
							<th class="right" data-hide="phone"><?php _e('Actions',APP_TD); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
							<tr>
								<td>
								<?php
									// only users with 'edit_jobs' capability can preview pending jobs
									if ( current_user_can( 'edit_jobs', $post->ID ) ) { ?>
										<strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
								<?php } else { ?>
										<strong><?php the_title(); ?></strong>
								<?php } ?>
								</td>
								<td class="date"><strong><?php the_time(__('j M',APP_TD)); ?></strong> <span class="year"><?php the_time(__('Y',APP_TD)); ?></span></td>
								<td class="center"><?php

									$can_edit = jr_allow_editing();

									$job_status = jr_get_job_status( $my_query->post, $pending_payment_jobs );

									if ( $order_status = jr_get_job_order_status( $my_query->post, $pending_payment_jobs ) )
										echo sprintf( ' %s', $order_status  );
									else
										echo sprintf( ' %s', $job_status );

								?></td>
								<td class="actions"><?php the_job_actions( $my_query->post, $pending_payment_jobs ); ?>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
				
				<?php jr_paging( $my_query, 'paged', array ( 'add_args' => array( 'tab' => 'pending' ) ) ); ?>

				<?php else : ?>
					<p><?php _e('No pending jobs found.', APP_TD); ?></p>
				<?php endif; ?>

			</div>
				
			<div id="ended" class="tab-pane fade">

				<h4><?php _e('Ended/Expired Jobs', APP_TD); ?></h4>

				<?php
					global $user_ID;

					if ( get_query_var('tab') && 'ended' == get_query_var('tab') ) {
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					} else {
						$paged = 1;
					}

					$args = array(
						'ignore_sticky_posts'	=> true,
						'author' 				=> $user_ID,
						'post_type' 			=> APP_POST_TYPE,
						'post_status' 			=> 'expired',
						'posts_per_page' 		=> jr_get_jobs_per_page(),
						'paged' 				=> $paged,
					);

					$my_query = new WP_Query($args);
				?>

				<?php if ( $my_query->have_posts() ): ?>

				<p><?php _e('The following jobs have expired or have been ended and are not visible to users.', APP_TD); ?></p>
				
				<table cellpadding="0" cellspacing="0" class="data_list footable table table-hover table-striped table-bordered ">
					<thead>
						<tr>
							<th data-class="expand"><?php _e('Job Title',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Date Posted',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Status',APP_TD); ?></th>
							<th class="center" data-hide="phone"><?php _e('Views',APP_TD); ?></th>
							<th class="right" data-hide="phone"><?php _e('Actions',APP_TD); ?></th>
						</tr>
					</thead>
					<tbody>

					<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

						<?php if (get_post_meta($my_query->post->ID, 'jr_total_count', true)) $job_views = number_format(get_post_meta($my_query->post->ID, 'jr_total_count', true)); else $job_views = '-'; ?>

						<tr>
							<td><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></td>
							<td class="date"><strong><?php the_time(__('j M',APP_TD)); ?></strong> <span class="year"><?php the_time(__('Y',APP_TD)); ?></span></td>
							<td class="center"><?php
						
								$job_status = jr_get_job_status( $my_query->post );

								if ( $order_status = jr_get_job_order_status( $my_query->post, $pending_payment_jobs ) )
									echo sprintf( ' %s', $order_status  );
								else
									echo sprintf( ' %s', $job_status );

							?>
							<td class="center"><?php echo $job_views; ?></td>
							<td class="actions"><?php the_job_actions( $my_query->post, $pending_payment_jobs ); ?></td>
						</tr>

					<?php endwhile; ?>

					</tbody>
				</table>

				<?php jr_paging( $my_query, 'paged', array ( 'add_args' => array( 'tab' => 'ended' ) ) ); ?>

				<?php else: ?>
					<p><?php _e('No expired jobs found.', APP_TD); ?></p>
				<?php endif; ?>

			</div>

			<div id="subscriptions" class="myjobs_section">
				<h4><?php _e('Resume Subscriptions ', APP_TD); ?></h4>
				<?php get_template_part( 'includes/dashboard-resumes' ); ?>
			</div>

			<div id="orders" class="myjobs_section">
				<h4><?php _e('Orders', APP_TD); ?></h4>
				<?php get_template_part( 'includes/dashboard-orders' ); ?>
			</div>

			<?php do_action( 'jr_dashboard_tab_content', 'job_lister' ); ?>

			</div><!-- end section_content -->
			
		</div>
		
	</div><!-- end section -->
	
	<div class="col-md-3 col-lg-3" >
		<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('user'); ?>
	</div>
	
	<div class="clear"></div>

</div><!-- end main content -->


