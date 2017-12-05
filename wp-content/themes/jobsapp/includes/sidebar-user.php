<?php global $userdata; ?>

<?php if ( is_user_logged_in() ): ?>

<div id="pnl-job-cat" style="margin-top:30px;">
	<div data-reactroot="" class="panel panel-default panel-collapse">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" href="##panel-1">
					<span class="fa fa-th"></span>
					<?php _e('Account Options',APP_TD); ?>
				</a>
			</h4>
		</div>
		<div class="list-group collapse in" id="panel-1">									
				
			<?php if (is_user_logged_in()) : ?>
				<a class="list-group-item" href="<?php echo get_permalink( JR_Dashboard_Page::get_id() ) ?>">
					<?php _e('My Dashboard',APP_TD)?>
				</a>
			<?php endif; ?>
			
			<a class="list-group-item" href="<?php $author = get_user_by('id', get_current_user_id()); if ($author && $link = get_author_posts_url( $author->ID, $author->user_nicename )) echo $link; ?>">
				<?php _e('View Profile',APP_TD)?>
			</a>			
			
			<a class="list-group-item" href="<?php echo get_permalink( JR_User_Profile_Page::get_id() ) ?>?action=edit-profile">
				<?php _e('Edit Profile',APP_TD)?>
			</a>			
			
			<?php if ( jr_resume_is_visible() || (is_user_logged_in() && jr_viewing_resumes_require_subscription()) ) :
				echo '<a class="list-group-item" href="'.get_post_type_archive_link('resume').'">'.__('Search CV', APP_TD).'</a>';
			endif;?>
	
			<?php if (current_user_can('edit_others_posts')) { ?>
				<a class="list-group-item" href="<?php echo get_option('siteurl'); ?>/wp-admin/"><?php _e('Administrator',APP_TD)?></a>
			<?php } ?>
			
			<a class="list-group-item" href="<?php echo wp_logout_url( home_url() ); ?>">
				<?php _e('Log Out',APP_TD)?>
			</a>
		</div>
	</div>
</div>

<div id="pnl-job-cat">
	<div data-reactroot="" class="panel panel-default panel-collapse">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a role="button" data-toggle="collapse" href="##panel-2">
					<span class="fa fa-th"></span>
					<?php _e('Account Info',APP_TD); ?>
				</a>
			</h4>
		</div>
		<div class="list-group collapse in" id="panel-2">									
			<ul>
				<li><strong><?php _e('Username:',APP_TD)?></strong> <?php echo $userdata->user_login; ?></li>
				<li><strong><?php _e('Account type:',APP_TD)?></strong> <?php
					$user = new WP_User( $userdata->ID );
					if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
						foreach ( $user->roles as $role )
							echo jr_translate_role($role) . '<br/>' ;					
					}
				?></li>
				<li><strong><?php _e('Member Since:',APP_TD)?></strong> <?php echo appthemes_display_date($userdata->user_registered); ?></li>
				<li><strong><?php _e('Last Login:',APP_TD); ?></strong> <?php echo appthemes_display_date( get_user_meta($userdata->ID, 'last_login', true) ); ?></li>
			</ul>
		</div>
	</div>
</div>


<?php endif; ?>