<?php
/*
Template Name: Job Seeker Dashboard
*/
?>

<?php
### Prevent Caching
nocache_headers();

appthemes_auth_redirect_login();

global $message, $userdata, $posted, $find_posts_in;

do_action('jr_process_job_seeker_form');

$activeTab = 0;

$can_subscribe = jr_current_user_can_subscribe_for_resumes();
?>

	<div class="section">
		<div class='col-md-9 col-lg-9'>
		<div class="section_content">
		
			<?php 
				if (isset($_GET['delete_resume']) && is_numeric($_GET['delete_resume'])) :
			
					if (isset($_GET['confirm'])) :

						$post_id = $_GET['delete_resume'];
						$post_to_remove = get_post($post_id);
	
						global $user_ID;
	
						if ($post_to_remove->ID==$post_id && $post_to_remove->post_author==$user_ID) :
							wp_delete_post($post_to_remove->ID);
	
							$message = __('CV deleted.',APP_TD);
						endif;
						
						$activeTab = 0;
	
					endif;
					
				endif;
				
				if (isset($_GET['toggle_visibility']) && is_numeric($_GET['toggle_visibility'])) :
					
					$post_id = $_GET['toggle_visibility'];
					$post_to_edit = get_post($post_id);
	
					global $user_ID;

					if ($post_to_edit->ID==$post_id && $post_to_edit->post_author==$user_ID) :
						$update_resume = array();
						$update_resume['ID'] = $post_to_edit->ID;
						if ($post_to_edit->post_status=='private') :
							$update_resume['post_status'] = 'publish';
						else :
							$update_resume['post_status'] = 'private';
						endif;
						wp_update_post( $update_resume );

						$message = __('CV visibility modified.',APP_TD);
					endif;
					
					$activeTab = 0;
					
				endif;
			?>

			<h1><?php printf( __('%s\'s Dashboard', APP_TD), ucwords( $userdata->user_login )); ?></h1>

			<?php do_action( 'appthemes_notices' ); ?>
			
			
			
			<ul class="display_section nav nav-tabs">

				<?php do_action( 'jr_dashboard_tab_before', 'job_seeker' ); ?>

				<li><a href="#resumes" class="noscroll"><?php _e('CV', APP_TD); ?></a></li>
				<?php if ( $can_subscribe ) : ?><li><a href="#subscriptions" class="noscroll"><?php _e('Subscriptions', APP_TD); ?></a></li><?php endif; ?>
				<?php if ( jr_job_alerts_auth() ): ?>	<li><a href="#alerts" class="noscroll"><?php _e('Job Alerts', APP_TD); ?></a></li>	<?php endif; ?>
				<?php if ( $can_subscribe || jr_get_user_orders_count() > 0 ) : ?><li><a href="#orders" class="noscroll"><?php _e('Orders', APP_TD); ?></a></li><?php endif; ?>

				<?php do_action( 'jr_dashboard_tab_after', 'job_seeker' ); ?>

				<li><a href="#prefs" class="noscroll"><?php _e('Preferences', APP_TD); ?></a></li>

			</ul>
			
			
			<div id="resumes" class="myprofile_section">
				<h2><?php _e('My CV', APP_TD); ?></h2>
				<p><?php _e('Your CV are displayed below. You can create more, edit and set your CV to be publish or hidden. We recommend you to publish to make employers can easy to download your CV online.', APP_TD); ?></p>
				
				<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped data_list">
					<thead>
						<tr>
							<th><?php _e('CV Title',APP_TD); ?></th>
							<th class="center"><?php _e('Date Created',APP_TD); ?></th>
							<th class="center"><?php _e('Last Modified',APP_TD); ?></th>
							<th class="center"><?php _e('Views',APP_TD); ?></th>
							<th class="center"><?php _e('Visibility',APP_TD); ?></th>
							<th class="center"><?php _e('Actions',APP_TD); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							global $user_ID;
							$args = array(
									'ignore_sticky_posts'	=> 1,
									'posts_per_page' => -1,
									'author' => $user_ID,
									'post_type' => 'resume'
							);
							$my_query = new WP_Query($args);
							$count = 0;
						?>
						<?php if ($my_query->have_posts()) : ?>
						
							<?php while ($my_query->have_posts()) : ?>
							
								<?php $my_query->the_post(); ?>

								<?php if (get_post_meta($my_query->post->ID, 'jr_total_count', true)) $job_views = number_format(get_post_meta($my_query->post->ID, 'jr_total_count', true)); else $job_views = '-'; ?>
						
								<tr>
									<td><strong><a href="<?php the_permalink(); ?>"><?php /*the_title();*/ echo $my_query->post->post_title;  ?></a></strong></td>
									<td class="date"><strong><?php the_time('j M'); ?></strong> <span class="year"><?php the_time('Y'); ?></span></td>
									
									<td class="date"><strong><?php echo date('j M', strtotime($my_query->post->post_modified)); ?></strong> <span class="year"><?php echo date('Y', strtotime($my_query->post->post_modified)); ?></span></td>
									
									<td class="center"><?php echo $job_views; ?></td>
									<td class="center">
<?php 
 //echo jr_post_statuses_i18n($my_query->post->post_status); 
 $status ="";
 if ($my_query->post->post_status=='private') :
     $status = 'Hidden';
 else :
     $status = 'Published';
 endif;

 echo $status;
?>
</td>
									
									<td class="actions" style="width: 160px; "><a href="<?php echo add_query_arg('edit', $my_query->post->ID, get_permalink( JR_Resume_Edit_Page::get_id() ) ); ?>"><?php _e('Edit CV',APP_TD); ?></a>&nbsp;<a href="<?php echo add_query_arg('toggle_visibility', $my_query->post->ID); ?>"><?php if ($my_query->post->post_status=='private') _e('Publish',APP_TD); else _e('Hide',APP_TD); ?></a>&nbsp;<a href="<?php echo add_query_arg('delete_resume', $my_query->post->ID); ?>" class="delete-resume"><?php _e('Delete',APP_TD); ?></a></td>
									
								</tr>
								<?php 
								$count++; 
							endwhile;
						else :
							?><tr><td colspan="6"><?php _e('No CV found.',APP_TD); ?></td></tr><?php
						endif; 
						wp_reset_query();
						
						?>
					</tbody>
				</table>

				
				<form class="submit_form main_form" method="post" action="<?php echo get_permalink( JR_Resume_Edit_Page::get_id() ); ?>">
					<p><input type="submit" class="submit btn btn-primary" value="<?php _e('Add More CV &raquo;', APP_TD)?>" /></p>
				</form>
				
				<div class="clear"></div>
				
			</div>

			<div id="subscriptions" class="myprofile_section">
				<h2><?php _e('CV Subscriptions ', APP_TD); ?></h2>
				<?php get_template_part( 'includes/dashboard-resumes' ); ?>
			</div>
	
			<div id="alerts" class="myprofile_section">
				<h2><?php _e('My Job Alerts', APP_TD); ?></h2>
				<?php //jr_job_seeker_alerts_form(); ?>
				<?php 
					if (function_exists("job_seeker_alerts_form")) {   job_seeker_alerts_form();	}
				?> 
			</div>

			<div id="orders" class="myprofile_section">
				<h2><?php _e('Orders', APP_TD); ?></h2>
				<?php get_template_part( 'includes/dashboard-orders' ); ?>
			</div>

			<div id="prefs" class="myprofile_section">
				<h2><?php _e('My Preferences', APP_TD); ?></h2>
				<?php job_seeker_prefs_form(); ?>
			</div>

			<?php do_action( 'jr_dashboard_tab_content', 'job_seeker' ); ?>

		</div><!-- end section_content -->

	</div><!-- end section -->

	<?php // TODO: move to dashboard View ?>

	<script type='text/javascript' src='<?php echo esc_url( site_url() ); ?>/wp-admin/js/password-strength-meter.js?ver=20081210'></script>
	<script type="text/javascript">
	// <![CDATA[
		jQuery('ul.display_section li a').click(function(){

			jQuery('div.myprofile_section').hide();
			
			jQuery(jQuery(this).attr('href')).show();
			
			jQuery('ul.display_section li').removeClass('active');
			
			jQuery(this).parent().addClass('active');
			
			return false;
		});
		jQuery('ul.display_section li a:eq(<?php echo $activeTab; ?>)').click();

		jQuery('a.delete-resume').click(function(){
			var answer = confirm("<?php _e('Are you sure you want to delete this CV? This action cannot be undone.',APP_TD); ?>")
			if (answer){
				jQuery(this).attr('href', jQuery(this).attr('href') + '&confirm=true');
				return true;
			}
			else{
				return false;
			}
		});
	// ]]>
	</script>
</div>
<div class='col-md-3 col-lg-3'>
<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('user'); ?>

</div>
	<div class="clear"></div>

</div><!-- end main content -->

