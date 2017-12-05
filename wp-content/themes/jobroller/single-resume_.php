<style>
	.table td{ padding: 8px 5px !important; border-spacing:0px; border-bottom:1px solid #F2EADD;border-right:1px solid #F2EADD;   background:#FAFAFC;}
	.table { border-top:1px solid #F2EADD; border-spacing:0px; font-size:12px; font-family:arial; margin-top:10px;}
	.table td:first-child{ border-left:1px solid #F2EADD; }
	.table td:nth-child(1), .table td:nth-child(3){ background:#F8F6E8 !important; font-weight:bold !important; }
	.title { font-size:18px !important;}
	.table-head td{ font-size:12px; font-family:arial; padding: 8px 5px !important; font-weight:bold;}
	#content div.resume_header{ border-bottom:none !important;}	
</style>
<?php 
	jr_resume_page_auth(); 

	$errors = new WP_Error();
	$resume_access_level = 'all';
	global $current_user;
    get_currentuserinfo();
	### Visibility check
	if ( !jr_resume_is_visible('single') && $post->post_author!=get_current_user_id() ) :

		$errors->add('resume_error', __('Sorry, you do not have permission to view individual resumes.', APP_TD) );

		if ( jr_current_user_can_subscribe_for_resumes() )
			$resume_access_level = 'subscribe';
		else
			$resume_access_level = 'none';

	endif;

	### Publish
	
	if (isset($_GET['publish']) && $_GET['publish'] && $post->post_author==get_current_user_id()) :
		
		$post_id = $post->ID;
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
			wp_safe_redirect(get_permalink($post_to_edit->ID));
		endif;
		
	endif;
	
	$show_contact_form = (get_option('jr_resume_show_contact_form') == 'yes');		
?>

	<div class="section single">

	<?php do_action( 'appthemes_notices' ); ?>

	<?php appthemes_before_loop(); ?>
		
		<?php if ($resume_access_level != 'none' && have_posts()): ?>

			<?php while (have_posts()) : the_post(); ?>
			
				<?php appthemes_before_post(); ?>
				
				<?php jr_resume_header($post); ?>

				<?php appthemes_stats_update($post->ID); //records the page hit ?>

				<div class="section_header resume_header">				

				<?php appthemes_before_post_title(); ?>

				<?php

					if ( $resume_access_level == 'subscribe' ):

						if ($notice = get_option('jr_resume_subscription_notice')) echo '<p>'.wptexturize($notice).'</p>';

						the_resume_purchase_plan_link();

						echo '<div class="clear"></div>';

					else: ?>

						<?php if (has_post_thumbnail()) the_post_thumbnail('blog-thumbnail'); ?>

						<h1 class="title resume-title"><span><?php the_title(); ?></span></h1>

						<div class="user_prefs_wrap" style="display: none"><?php echo jr_seeker_prefs( get_the_author_meta('ID') ); ?></div>												

						<?php

						if ($post->post_status=='private' && $post->post_author==get_current_user_id())
							appthemes_display_notice( 'success', sprintf(__('Your resume is currently hidden &mdash; <a href="%s">click here to publish it</a>.', APP_TD), add_query_arg('publish', 'true')) );

						?>																						

						<p class="meta"><?php 

							echo __('Resume posted by ',APP_TD) . '<strong>' .wptexturize(get_the_author_meta('display_name')) . '</strong>';

							$terms = wp_get_post_terms($post->ID, 'resume_category');
							if ($terms) :
								_e(' in ',APP_TD);
								echo '<strong>'.$terms[0]->name.'</strong>. ';
							endif;

							if ($desired_salary = get_post_meta($post->ID, '_desired_salary', true)) :
								echo sprintf( __('<br/>Desired salary: <strong>%s</strong> ', APP_TD), appthemes_get_price($desired_salary) );
							endif;

							$desired_position = wp_get_post_terms($post->ID, 'resume_job_type');
							if ($desired_position) :
								$desired_position = current($desired_position);
								echo '<br/>'.sprintf( __('Desired position type: <strong>%s</strong>. ', APP_TD), $desired_position->name );
							else :
								echo '<br/>'.__('Desired position type: <strong>Any</strong>. ', APP_TD);
							endif;

							if ($address = get_post_meta($post->ID, 'geo_short_address', true)) :
								echo '<br/>'.__('Location: ', APP_TD);
								echo wptexturize($address). ' ';
								echo wptexturize(get_post_meta($post->ID, 'geo_short_address_country', true));
							endif;
						?></p>
						
						<div class="section_content">
						<h2 ><span><?php _e('CV Information', APP_TD); ?></span></h2>
						<table class="table" style="width:100%">
							<tr>
								<td style="width:25%;">Name</td>
								<td style="width:25%;"><?php echo get_post_meta($post->ID, 'r_firstname', true).' '.get_post_meta($post->ID, 'r_lastname', true) ?></td>
								<td style="width:25%;">Sex</td>
								<td style="width:25%;"><?php echo get_post_meta($post->ID, 'r_sex', true) ?></td>
							</tr>
							<tr>
								<td>Date of Birth</td>
								<td><?php echo get_post_meta($post->ID, 'd_day', true) ?>-<?php echo get_post_meta($post->ID, 'd_month', true) ?>-<?php echo get_post_meta($post->ID, 'd_year', true) ?></td>
								<td>Marital</td>
								<td><?php echo get_post_meta($post->ID, 'r_marital', true) ?></td>
							</tr>
							<tr>
								<td>Nationality</td>
								<td><?php if(get_post_meta($post->ID, 'r_nationality', true)){ echo get_post_meta($post->ID, 'r_nationality', true); } else { echo "N/A"; } ?></td>
								<td>Apply</td>
								<td><?php if(get_post_meta($post->ID, 'desired_position', true)){ echo get_post_meta($post->ID, 'desired_position', true); } else { echo "N/A"; } ?></td>
							</tr>
							<tr>
                                                                <td>Mobile</td>
								<td><?php echo get_post_meta($post->ID, '_mobile', true) ?></td>
								<td>Email</td>
								<td><?php echo get_post_meta($post->ID, '_email_address', true) ?></td>								
							</tr>
							<tr>
                                                                <td>Job Type</td>
								<td><?php echo get_post_meta($post->ID, 'job_type', true) ?></td>
								<td>Desired salary</td>
								<td><?php echo get_post_meta($post->ID, 'job_salary', true) ?> USD</td>
							</tr>
							<tr>
								<td>Current Address</td>
								<td><?php echo get_post_meta($post->ID, 'r_location', true) ?></td>
								<td>Public Date</td>
								<td><?php the_date(); ?></td>
							</tr>
						</table>
					</div>
					<div class="section_content">
						<h2 ><span><?php _e('Career Profile', APP_TD); ?></span></h2>
						<table style="width:100%;" class="table">
							<tr>
								<td style="width:25%;">Highest Qualification</td>
								<td style="width:25%;"><?php echo get_post_meta($post->ID, 'r_highest_qualification', true); ?></td>
								<td style="width:25%;">Latest Career Level</td>
								<td style="width:25%;"><?php echo get_post_meta($post->ID, 'r_level', true) ?></td>
							</tr>
							<tr>
								<td>Latest Industry</td>
								<td><?php echo get_post_meta($post->ID, 'r_industry', true) ?></td>
								<td>Latest Position</td>
								<td><?php echo get_post_meta($post->ID, 'r_position', true) ?></td>
							</tr>
							<tr>
								<td>Latest Salary</td>
								<td><?php echo get_post_meta($post->ID, 'r_salary', true) ?> </td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>

						<!--<?php
							$contact_details = array();
							$contact_details['mobile'] = get_post_meta($post->ID, '_mobile', true);
							$contact_details['tel'] = get_post_meta($post->ID, '_tel', true);
							$contact_details['email_address'] = get_post_meta($post->ID, '_email_address', true);
							
							if ($show_contact_form && $post->post_author!=get_current_user_id()):
								echo '<p class="button"><a class="contact_button inline noscroll" href="#contact">'.sprintf(__('Contact %s', APP_TD),wptexturize(get_the_author_meta('display_name'))).'</a></p>';
							else:
								if ($contact_details && is_array($contact_details) && sizeof($contact_details)>0) :

									echo '<dl>';
									if ($contact_details['email_address']) echo '<dt class="email">'.__('Email',APP_TD).':</dt><dd><a href="mailto:'.$contact_details['email_address'].'?subject='.__('Your Resume on',APP_TD).' '.get_bloginfo('name').'">'.$contact_details['email_address'].'</a></dd>';
									if ($contact_details['tel']) echo '<dt class="tel">'.__('Tel',APP_TD).':</dt><dd>'.$contact_details['tel'].'</dd>';
									if ($contact_details['mobile']) echo '<dt class="mobile">'.__('Mobile',APP_TD).':</dt><dd>'.$contact_details['mobile'].'</dd>';
									echo '</dl>';

								endif;
							endif;

							$websites = get_post_meta($post->ID, '_resume_websites', true);

							if ($websites && is_array($websites)) :
								$loop = 0;
								echo '<dl>';
								foreach ($websites as $website) :
								echo '<dt class="email">'.strip_tags($website['name']).':</dt><dd><a href="'.esc_url($website['url']).'" target="_blank" rel="nofollow">'.strip_tags($website['url']).'</a>';
								if (get_the_author_meta('ID')==get_current_user_id()) echo ' <a class="delete" href="?delete_website='.$loop.'">[&times;]</a>';
								echo '</dd>';
								$loop++;
								endforeach;
								echo '</dl>';
							endif;
							if (get_the_author_meta('ID')==get_current_user_id()) echo '<p class="edit_button button"><a class="inline noscroll" href="#websites">'.__('+ Add Website', APP_TD).'</a></p>';
						?> -->

						<?php appthemes_after_post_title(); ?>

					</div><!-- end section_header -->
					
					

					<div class="section_content">
	
						<?php do_action('resume_main_section', $post); ?>
	
						<?php appthemes_before_post_content(); ?>

						<!--<h2 class="resume_section_heading"><span><?php _e('Summary', APP_TD); ?></span></h2>
						<div class="resume_section summary">
							<?php the_content(); ?>
						</div>
						<div class="clear"></div>-->										
						
						<h2 class="resume_section_heading"><span><?php _e('Job Prefference', APP_TD); ?></span></h2>
						<div class="resume_section summary">
						  <ul>
                                                     <li><b>Industry : </b> <?php echo get_post_meta($post->ID, 'r_p_industry', true) ?></li>
                                                     <li><b>Location : </b> <?php echo get_post_meta($post->ID, 'r_pre_loc', true) ?></li>
                                                     <li><b>Expected Salary : </b> <?php echo get_post_meta($post->ID, 'job_salary', true) ?></li>
                                                     <li><b>Job Type : </b> <?php echo get_post_meta($post->ID, 'job_type', true) ?></li>
                                                  </ul>	                                                 					
						</div>
						<div class="clear"></div>

                                               
                                               <h2 class="resume_section_heading"><span><?php _e('Education', APP_TD); ?></span></h2>
						<div class="resume_section summary">
						  <ul>
                                                     <li><b>Qualification : </b> <?php echo get_post_meta($post->ID, 'r_p_industry', true) ?></li>
                                                     <li><b>Start date : </b> <?php echo get_post_meta($post->ID, 's_day', true) ?>-<?php echo get_post_meta($post->ID, 's_month', true) ?>-<?php echo get_post_meta($post->ID, 's_year', true) ?></li>
                                                     <li><b>End Date : </b> <?php echo get_post_meta($post->ID, 'e_day', true) ?>-<?php echo get_post_meta($post->ID, 'e_month', true) ?>-<?php echo get_post_meta($post->ID, 'e_year', true) ?></li>
                                                     <li><b>University  : </b> <?php echo get_post_meta($post->ID, 'r_university', true) ?></li>
                                                     <li><b>Field of Study : </b> <?php echo get_post_meta($post->ID, 'r_field', true) ?></li>
                                                     <li><b>Description : </b> <?php echo get_post_meta($post->ID, 'r_e_description', true) ?></li>
                                                  </ul>	                                                 					
						</div>
						<div class="clear"></div>
<?php if(get_post_meta($post->ID, 'r_h_language', true) != null || get_post_meta($post->ID, 'l_r_level', true) != null){ ?>
                                               <h2 class="resume_section_heading"><span><?php _e('Language', APP_TD); ?></span></h2>
						<div class="resume_section summary">
						  <ul>
                                                     <li><b>Language: </b> <?php echo get_post_meta($post->ID, 'r_h_language', true) ?></li>
                                                     <li><b>Level : </b> <?php echo get_post_meta($post->ID, 'l_r_level', true) ?></li>                                                     
                                                  </ul>	                                                 					
						</div>
						<div class="clear"></div>
<?php } ?>

                                                <?php if(get_post_meta($post->ID, 'r_h_language1', true) != null || get_post_meta($post->ID, 'l_r_level1', true) != null){ ?>
                                                <h2 class="resume_section_heading"><span><?php _e('Language', APP_TD); ?></span></h2>
						<div class="resume_section summary">
						  <ul>
                                                     <li><b>Language: </b> <?php echo get_post_meta($post->ID, 'r_h_language1', true) ?></li>
                                                     <li><b>Level : </b> <?php echo get_post_meta($post->ID, 'l_r_level1', true) ?></li>                                                     
                                                  </ul>	                                                 					
						</div>
						<div class="clear"></div>
<?php } ?>
                                                 <h2 class="resume_section_heading"><span><?php _e('Work Experience', APP_TD); ?></span></h2>
						<div class="resume_section summary">
						  <ul>
                                                     <li><b>Company Name: </b> <?php echo get_post_meta($post->ID, 'r_p_industry', true) ?></li>
                                                     <li><b>Start date : </b> <?php echo get_post_meta($post->ID, 'w_s_day', true) ?>-<?php echo get_post_meta($post->ID, 'w_s_month', true) ?>-<?php echo get_post_meta($post->ID, 'w_s_year', true) ?></li>
                                                     <li><b>End Date : </b> <?php echo get_post_meta($post->ID, 'w_e_day', true) ?>-<?php echo get_post_meta($post->ID, 'w_e_month', true) ?>-<?php echo get_post_meta($post->ID, 'w_e_year', true) ?></li>
                                                     <li><b>Position : </b> <?php echo get_post_meta($post->ID, 'w_r_position', true) ?></li>                                                     
                                                     <li><b>Description : </b> <?php echo get_post_meta($post->ID, 'w_e_description', true) ?></li>
                                                  </ul>	                                                 					
						</div>
						<div class="clear"></div>

									

						<h2 class="resume_section_heading"><span><?php _e('Training', APP_TD); ?></span></h2>
						<div class="resume_section summary">
							<?php 
							$hobbys = array_map('trim', explode("\n", get_post_meta($post->ID, 'r_training', true)));
							if ($hobbys) :
								?>								
									<?php 
									echo '<ul>';
										foreach ($hobbys as $hobby) :
											if ($hobby) echo '<li>'.wptexturize($hobby).'</li>';
										endforeach;
									echo '</ul>';
									?>
								<?php
							endif;
							?>								
						</div>
						<div class="clear"></div>	

						<h2 class="resume_section_heading"><span><?php _e('Hobby', APP_TD); ?></span></h2>
						<div class="resume_section summary">							
							<?php 
							$hobbys = array_map('trim', explode("\n", get_post_meta($post->ID, 'r_hobby', true)));
							if ($hobbys) :
								?>								
									<?php 
									echo '<ul>';
										foreach ($hobbys as $hobby) :
											if ($hobby) echo '<li>'.wptexturize($hobby).'</li>';
										endforeach;
									echo '</ul>';
									?>
								<?php
							endif;
							?>							
						</div>
						<div class="clear"></div>
						
						<h2 class="resume_section_heading"><span><?php _e('Reference', APP_TD); ?></span></h2>
						<div class="resume_section summary">
							<?php 
							$hobbys = array_map('trim', explode("\n", get_post_meta($post->ID, 'r_reference', true)));
							if ($hobbys) :
								?>								
									<?php 
									echo '<ul>';
										foreach ($hobbys as $hobby) :
											if ($hobby) echo '<li>'.wptexturize($hobby).'</li>';
										endforeach;
									echo '</ul>';
									?>
								<?php
							endif;
							?>								
						</div>
						<div class="clear"></div>										
	
						<?php if (get_the_author_meta('ID')==get_current_user_id()) : ?>
							<p class="button edit_resume"><a href="<?php echo add_query_arg( 'edit', $post->ID, get_permalink( JR_Resume_Edit_Page::get_id() ) ); ?>"><?php _e('Edit Resume&nbsp;&rarr;',APP_TD); ?></a></p>
						<?php endif; ?>

						<?php if ( get_option('jr_ad_stats_all') == 'yes' && current_theme_supports( 'app-stats' ) ) { ?><p class="stats"><?php appthemes_stats_counter($post->ID); ?></p> <?php } ?>

						<div class="clear"></div>
						
					<?php endif; ?>

				</div><!-- end section_content -->
				
				<?php appthemes_after_post(); ?>
				
				<?php jr_resume_footer($post); ?>

			<?php endwhile; ?>

				<?php appthemes_after_endwhile(); ?>

		<?php else: ?>

			<?php jr_no_access_permission( __('Sorry, you do not have permission to View Resumes.', APP_TD ) ); ?>

			<?php appthemes_loop_else(); ?>

		<?php endif; ?>	

		<?php appthemes_after_loop(); ?>

	</div><!-- end section -->	
<ul class="section_footer" style="display:none;">
<li class="print"><a href="javascript:window.print();"><?php _e('Print Job',APP_TD); ?></a></li>
</ul>
	<div class="clear"></div>

</div><!-- end main content -->

<?php if ($show_contact_form) : ?>
	<script type="text/javascript">
	/* <![CDATA[ */
		
		jQuery('a.contact_button').fancybox({
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	true,
			'centerOnScroll':	true,
			'overlayColor'	:	'#555',
			'hideOnOverlayClick' : false
		});	
	/* ]]> */
	</script>
<?php
	endif;
?>	
<?php if (get_the_author_meta('ID')==get_current_user_id()) : ?>
	<script type="text/javascript">
	/* <![CDATA[ */
		
		jQuery('p.edit_button a, a.edit_button').fancybox({
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	true,
			'centerOnScroll':	true,
			'overlayColor'	:	'#555',
			'hideOnOverlayClick' : false
		});	
		
		jQuery('a.delete').click(function(){
    		var answer = confirm ("<?php _e('Are you sure you want to delete this? This action cannot be undone...', APP_TD); ?>")
			if (answer)
				return true;
			return false;
    	});
		
	/* ]]> */
	</script>
	<?php 
	if (get_option('jr_show_sidebar')!=='no') : get_sidebar('user'); endif; 
else :	
	if (get_option('jr_show_sidebar')!=='no') : get_sidebar('resume'); endif; 
endif; 
