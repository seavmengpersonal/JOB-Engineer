<style type="text/css">
      table td{ padding:2px 5px;}
      .info_pro td:nth-child(1){ font-weight:bold;}
</style>
<?php get_header('search'); ?>

    <div class="section" id="profile"> 
	<div class="col-md-12">
		<div class="col-md-9">
		
		<div class="section_content">
                
<h1 style="font-size:17px;"> 
<?php echo apply_filters('', get_post_meta($post->ID, '_Company', true)); ?> 
<?php if ($url = $wp_query->get_queried_object()->user_url) echo ' &ndash; <a href="'.esc_url($url).'">'. strip_tags($url) .'</a>'; ?></a>
</h1>

<?php if(isset($post->ID)){ ?>
<table width="100%">
     <tr>
         <td style="width:20%;">Email</td>
         <td>: <?php echo $wp_query->get_queried_object()->user_email; ?></td>
     </tr>
     <tr>
         <td>Phone</td>
         <td>: <?php echo get_user_meta( $wp_query->get_queried_object()->ID, 'phone', true ); ?></td>
     </tr>
     <tr>
         <td>Website</td>
         <td>: <a target="_blank" href="http://<?php echo get_user_meta( $wp_query->get_queried_object()->ID, 'website', true ); ?>">
         <?php echo get_user_meta( $wp_query->get_queried_object()->ID, 'website', true );?></td>
     </tr>
     <tr>
         <td>Address</td>
         <td>: <?php echo get_user_meta( $wp_query->get_queried_object()->ID, 'r_location', true ); ?></td>
     </tr>
 </table>
<br/>
<h2>Company Description</h2>
<?php }elseif(user_can($wp_query->get_queried_object()->ID, 'can_submit_resume')) { 
?>
<table width="100%" class="info_pro">
     <tr>
         <td style="width:20%;">First name</td>
         <td>: <?php echo $wp_query->get_queried_object()->first_name ?></td>
     </tr>
     <tr>
         <td>Last name</td>
         <td>: <?php echo $wp_query->get_queried_object()->last_name ?></td>
     </tr>
     <tr>
         <td>Email</td>
         <td>: <?php echo $wp_query->get_queried_object()->user_email ?></td>
     </tr>
     <tr>
         <td>Phone</td>
         <td>: <?php echo get_user_meta($wp_query->get_queried_object()->ID, 'phone', true); ?></td>
     </tr>
     <tr>
         <td>Nationality</td>
         <td>: <?php echo get_user_meta($wp_query->get_queried_object()->ID, 'nationality', true); ?></td>
     </tr>
     <tr>
         <td>Sex </td>
         <td>: <?php echo get_user_meta($wp_query->get_queried_object()->ID, 'r_sex', true); ?></td>
     </tr>
     <tr>
         <td>Date of Birth</td>
         <td>: <?php echo get_user_meta($wp_query->get_queried_object()->ID, 'd_day', true); ?>-<?php echo get_user_meta($wp_query->get_queried_object()->ID, 'd_month', true); ?>-<?php echo get_user_meta($wp_query->get_queried_object()->ID, 'd_year', true); ?></td>
     </tr>
     <tr>
         <td>Address</td>
         <td>: <?php echo get_user_meta($wp_query->get_queried_object()->ID, 'r_location', true); ?></td>
     </tr>
 </table>
<?php } ?>

<?php echo get_user_meta( $wp_query->get_queried_object()->ID, 'r_profile', true ); ?>

			<?php
			if ( isset( $wp_query->get_queried_object()->description ) && ! empty( $wp_query->get_queried_object()->description ) ) {
				echo wpautop( wptexturize( $wp_query->get_queried_object()->description ));
			}
			?>
 
			<?php
				$social = array();
				if ($twitter = get_user_meta( $wp_query->get_queried_object()->ID, 'twitter_id', true)) :
					$social[] = '<li class="twitter"><a href="http://twitter.com/'.urlencode( $twitter ).'">'. esc_html( sprintf( __('Follow %s on Twitter', APP_TD), $wp_query->get_queried_object()->display_name ) ).'</a></li>';
				endif;

				if ($facebook = get_user_meta( $wp_query->get_queried_object()->ID, 'facebook_id', true)) :
					$social[] = '<li class="facebook"><a href="http://facebook.com/'.urlencode( $facebook ).'">'. esc_html( sprintf( __('Add %s on Facebook', APP_TD), $wp_query->get_queried_object()->display_name ) ).'</a></li>';
				endif;

				if ($linkedin = get_user_meta( $wp_query->get_queried_object()->ID, 'linkedin_profile', true)) :
					$social[] = '<li class="linkedin"><a href="'.esc_url( $linkedin ).'">'. esc_html( sprintf( __('View %s on LinkedIn', APP_TD), $wp_query->get_queried_object()->display_name ) ).'</a></li>';
				endif;

				if (sizeof($social)>0) :
					echo '<ul class="social">'.implode('', $social).'</ul>';
				endif;
			?>

			<div class="clear"></div>

		</div>
		<?php if ( isset($_GET['blog_posts']) ) : ?>

			<h2 class="pagetitle"><?php echo esc_html( sprintf( __('%s\'s posts', APP_TD), $wp_query->get_queried_object()->display_name) ); ?></h2>
	        <?php
	        	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	       		$args = array(
					'author' => $wp_query->get_queried_object()->ID,
					'post_status' => 'publish',
					'paged' => $paged
				);
				query_posts($args);

				// call the main loop-job.php file
				get_template_part( 'loop' );
			?>

			<?php jr_paging(); ?>

		<?php elseif (user_can($wp_query->get_queried_object()->ID, 'can_submit_job')) : ?>
			<h2 class="pagetitle"><?php echo esc_html( sprintf( __('%s\'s job listings', APP_TD), apply_filters('', get_post_meta($post->ID, '_Company', true)) ) ); ?></h2>
	        <?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'author' => $wp_query->get_queried_object()->ID,
					'post_type' => 'job_listing',
					'post_status' => 'publish',
					'paged' => $paged,
					'posts_per_page' => jr_get_jobs_per_page(),
				);
				query_posts($args);

				// call the main loop-job.php file
				get_template_part( 'loop', 'job' );
			?>

			<?php jr_paging(); ?>
		<?php else : ?>

			<h2><?php echo esc_html( sprintf( __('%s\'s CV', APP_TD), $wp_query->get_queried_object()->display_name) ); ?></h2>

			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'author' => $wp_query->get_queried_object()->ID,
					'post_type' => 'resume',
					'post_status' => 'publish',
					'paged' => $paged,
					'posts_per_page' => jr_get_resumes_per_page(),
				);
				query_posts($args);

				get_template_part( 'loop', 'resume' );
			?>

        	<?php jr_paging(); ?>

		<?php endif; ?>

		<div class="clear"></div>
	 
	<!--side bar menu-->
	
	 </div>
	 
		<div class='col-md-3'>
		<h1>I'm the best.</h1> 
		<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar('resume'); ?>
	 </div>
	</div>
    </div><!-- end section -->
		
    <!-- end main content -->
	 
 <div class="clear"></div> 

	
