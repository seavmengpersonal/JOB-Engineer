<?php
	// Empty search fixes
	if ( isset($_GET['resume_search']) && $_GET['resume_search'] ) : 
		if (isset($_GET['s']) && isset($_GET['location']) && !empty($_GET['location'])) : get_template_part('search-resume'); return; endif;
		wp_safe_redirect(get_post_type_archive_link('resume'));
		exit;
	endif;
	if (isset($_GET['s']) && isset($_GET['location']) && !empty($_GET['location'])) : get_template_part('search-home'); return; endif;
?>



<?php // do_action('jobs_will_display'); ?>

<?php
if ( get_query_var('paged') )
    $paged = get_query_var('paged');
elseif ( get_query_var('page') )
    $paged = get_query_var('page');
else
    $paged = 1;

?>
	<?php //  do_action('before_front_page_jobs'); ?>
	


<!--h2 class="pagetitle">

			<small class="rss"><a href="<?php echo add_query_arg('post_type', 'job_listing', get_bloginfo('rss2_url')); ?>"><img src="<?php bloginfo('template_url'); ?>/images/feed.png" title="<?php _e('Latest Jobs RSS Feed',APP_TD); ?>" alt="<?php _e('Latest Jobs RSS Feed',APP_TD); ?>" /></a></small>

			<?php _e('Latest Jobs',APP_TD); ?> <?php if ($paged>1) { ?>(<?php _e('page', APP_TD ) ?> <?php echo $paged; ?>)<?php } ?>

			<?php if (isset($_GET['action']) && $_GET['action'] == 'Filter') { ?>
				<small> &mdash; <a href="<?php echo jr_get_current_url(); ?>"><?php _e('Remove Filters',APP_TD); ?></a></small>
			<?php } ?>

		</h2-->

	
	
		

		<div id="content">
<div class="inner-r">


<?php
//header advertising
 if (get_option('adv_header')=='Home page only') : ?>
				<div id="header-ad"  style="float:<?php echo stripslashes(get_option('ad_header_float'))  ?> !important;width: <?php echo stripslashes(get_option('ad_header_size'))  ?>px !important ; overflow: hidden;"><?php echo stripslashes(get_option('ad_header')); ?></div>
<?php endif; ?>
		
<?php if (get_option('adv_header')=='Entire site') : ?>
				<div id="header-ad"  style="float:<?php echo stripslashes(get_option('ad_header_float'))  ?> !important;width: <?php echo stripslashes(get_option('ad_header_size'))  ?>px !important ; overflow: hidden;"><?php echo stripslashes(get_option('ad_header')); ?></div>
<?php endif; ?>

<div class="clear"></div>




		



<div id="mainContent">

<?php 

// Home page content
if( !get_option(content_home) ) {
} else {?>
<div class="home-content">
<?php echo stripslashes(get_option('content_home')); ?>
<?php 
if( !get_option(content_home_image) ) {
} else {?>
<div class="home-image" style="float: <?php echo get_option('home_image_float'); ?> !important "> <img border="0" src="<?php echo get_option('content_home_image'); ?>"> </div>
<?php }  ?>
</div><!-- End home content-->
<div class="clear"></div>
<?php }  ?>
  




<div class="clear"></div>
<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar(home); ?>
<div class="clear"></div>

 


<?php 
//Display modern layout - conditional function
if ( get_option('layout_style') == 'Modern' ) { ?>	
<?php /*Home page tabs*/ get_template_part( home, tabs ); ?> 

</div> 

<?php echo do_shortcode('[jw_easy_logo slider_name="Feature Company"]'); ?>
</div>
<?php  }  else { ?>	
<?php /*Home page tabs*/ get_template_part( home, simple ); ?> 
</div>

<?php  } ?>	


 <div id="sidebar">
 <div class="sidebarhome">
 <?php if (get_option('adv_home')=='Yes') : ?>
  <ul class="widgets"><li class="widget-submit">
 <div class="shadowblock-h">
  
		<?php echo stripslashes(get_option('ad_home')); ?>
		</div>
		</li>
		</ul>
		<?php endif; ?>	
</div>

<div class="clear"></div>
<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar(); ?>
</div>

