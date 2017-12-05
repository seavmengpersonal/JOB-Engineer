<div class="inner">
   <div id="topNav">
      <div style="width:990px; height:30px; margin:auto; text-align:right;">
           <?php wp_nav_menu( array( 'theme_location' => 'top', 'sort_column' => 'menu_order', 'container' => 'menu-header', 'fallback_cb' =>
 'default_top_nav' ) ); ?>
      </div>
   </div>

<div class="clear"></div>
<div id="topNav1">
</div>

</div>

<div id="wrapo">
	
	
	<div class="inner">

		
		
		
		<div class="menu-tabs"> 
			
	
		<div class="header-l">
		<div class="logo_wrap">

			<?php if (is_front_page()) { ?><div id="logo"><?php } else { ?><div id="logo"><?php } ?>

			<?php if (get_option('jr_use_logo') != 'No') { ?>

					<?php if (get_option('jr_logo_url')) { ?>

						<a href="<?php echo esc_url( home_url() ); ?>"><img class="logo" src="<?php echo get_option('jr_logo_url'); ?>" alt="<?php bloginfo('name'); ?>" /></a>

					<?php } else { ?>

							<a href="<?php echo esc_url( home_url() ); ?>"><img class="logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>

					<?php } ?>

			<?php } else { ?>

				<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a> <small><?php bloginfo('description'); ?></small>
		   
			<?php } ?>

			<?php if (is_front_page()) { ?></div><?php } else { ?></div><?php } ?>

			</div>
			
			
			<!--div id="head-button">
			</div-->
			
			<!--advert-->
			<?php if (get_option('jr_enable_header_banner')=='yes') : ?>
				<div id="headerAd"><?php echo stripslashes(get_option('jr_header_banner')); ?></div>
			<?php endif; ?>
			<!--end-advert-->
		
			<div class="clear"></div>

 


		</div><!-- end logo_wrap -->
		
<div class="header-ino">		

		<div class="menus-s">
		<nav>
                        <?php if (is_user_logged_in() && current_user_can('can_submit_resume')) : ?>

                        <?php wp_nav_menu( array( 'theme_location' => 'job_seeker', 'sort_column' => 'menu_order', 'container' => 'menu-header', 'fallback_cb' => 'default_top_nav' ) ); ?>

                        <?php elseif (is_user_logged_in() && !current_user_can('can_submit_resume')) : ?>

                        <?php wp_nav_menu( array( 'theme_location' => 'employer', 'sort_column' => 'menu_order', 'container' => 'menu-header', 'fallback_cb' => 'default_top_nav' ) ); ?>

                        <?php else : ?>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'sort_column' => 'menu_order', 'container' => 'menu-header', 'fallback_cb' => 'default_top_nav' ) ); ?>

                        <?php endif; ?>
			
		</nav>
		
	
<ul class="dashboard" >
<?php
//Pick add-button action whether the user is job seeker or jobs lister

if ( is_user_logged_in() ) 
if (current_user_can('can_submit_job')){
echo'
		<li class="dashboard" style="display:none;">
<a href="'.get_permalink( JR_Dashboard_Page::get_id() ).'">'.__( 'Dashboard',APP_TD ).'</a>
</li>
<li class="dashboard" style="display:none;"><a href="'.get_permalink( JR_Job_Submit_Page::get_id() ).'">'.stripslashes(get_option('tr_submit_job')).'</a></li>
';} 
else{echo'
		<li class="dashboard" style="display:none;">
<a href="'.get_permalink( JR_Dashboard_Page::get_id() ).'">'.__( 'Dashboard ',APP_TD ).'</a>
</li>
<li style="display:none;" class="dashboard"><a href="'.get_permalink( JR_Resume_Edit_Page::get_id()).'">'.stripslashes(get_option('tr_submit_resume')).'</a></li>
';}
else { 


?>

<li class="dashboard"><a href="http://khmer-engineeringjob.com/login/">Login</a></li>

	<?php
    switch (get_option('enable_menu_button')) {

                case "None": ?>
               
                <?php break;

                case "Submit a Job": ?>
             
			     <li class="dashboard" style="display:none;">
<?php echo'<a href="'.get_permalink( JR_Job_Submit_Page::get_id() ).'">'.stripslashes(get_option('tr_submit_job')).'</a>'; ?>
</li>
                <?php break;

                case "Submit a CV": ?>
                <li class="dashboard" style="display:none;">
				

<?php if ( is_user_logged_in() && current_user_can('can_submit_resume') ) { ?>
		<?php echo'<a href="'.get_permalink( JR_Resume_Edit_Page::get_id()).'">'.stripslashes(get_option('tr_submit_resume')).'</a>';?>
		<?php } else {?>
		<?php echo'<a href="'.site_url('wp-login.php').'">'.stripslashes(get_option('tr_submit_resume')).'</a>';?>
		<?php } ?>



</li>
               				
            
				
                <?php break;

               
            }
?>	
	

<?php
 } 
?>
</ul>

		
		</div>
		
	
<div class="under-menu"></div>		
		
		<div class="menus-bg"> 
		<?php get_template_part( 'header', 'search-main' );?>
		</div>
		
		<div class="clear"></div>
		
		
<div id="stk"><?php echo get_option('header-1'); ?></div>
<div id="stk1"><?php echo get_option('header-2'); ?></div>
<div id="stk2"><?php echo get_option('header-3'); ?></div>
		

<?php
    switch (get_option('enable_landing_header')) {

                case "No": ?>
               
                <?php break;

                case "Home page only": ?>
				
					<?php
if ( is_home() ) {
    // This is a homepage
?>
            
			<div class="menu-tabs-ss"> 
					
				
		<div class="header-landing">
		<div class="clear"></div>
		<div id="liner"></div>
		
		
		
		<div id="lefto">
		<div id="head-img-1"><img border="0" src="<?php echo get_option('header_left_image'); ?>" width ="180px" height="110px"></div>
		<div class="right"><?php echo stripslashes(get_option('header_left')); ?></div>
		
		<div id="depos"><div id="deps">
		
		
		
		<?php if ( is_user_logged_in() && current_user_can('can_submit_resume') ) { ?>
		<?php echo'<a href="'.get_permalink( JR_Resume_Edit_Page::get_id()).'">'.get_option('submit_resume_name').'</a>';?>
		<?php } else {?>
		<?php echo'<a href="'.site_url('wp-login.php').'">'.get_option('submit_resume_name').'</a>';?>
		<?php } ?>
		</div></div>
		</div>
		
		
		
		
		
		<div id="lefto">
		<div id="head-img-2"><img border="0" src="<?php echo get_option('header_right_image'); ?>" width ="180px" height="110px"></div>
		<div class="left"><?php echo stripslashes(get_option('header_right')); ?></div>
		
		<div id="depos-2"><div id="deps">
		<?php echo'<a href="'.get_permalink( JR_Job_Submit_Page::get_id() ).'">'.get_option('submit_job_name').'</a>';?>
		
		
		
		
		</div></div>
		</div>
		
		
		</div>
					
		</div>
		<!--tabss end-->
			
			<?php } else { // This is not a homepage
			} ?>
			
			
			
			
                <?php break;

                case "Entire site": ?>
				
				
				
			            
			<div class="menu-tabs-ss"> 
					
				
		<div class="header-landing">
		<div id="liner"></div>
		
		<div id="lefto">
		<div id="head-img-1"><img border="0" src="<?php echo get_option('header_left_image'); ?>" width ="180px" height="110px"></div>
		<div class="right"><?php echo stripslashes(get_option('header_left')); ?></div>
		
		<div id="depos"><div id="deps">
		
		
		
		<?php if ( is_user_logged_in() && current_user_can('can_submit_resume') ) { ?>
		<?php echo'<a href="'.get_permalink( JR_Resume_Edit_Page::get_id()).'">'.get_option('submit_resume_name').'</a>';?>
		<?php } else {?>
		<?php echo'<a href="'.site_url('wp-login.php').'">'.get_option('submit_resume_name').'</a>';?>
		<?php } ?>
		</div></div>
		</div>
		
		
		
		
		
		<div id="lefto">
		<div id="head-img-2"><img border="0" src="<?php echo get_option('header_right_image'); ?>" width ="180px" height="110px"></div>
		<div class="left"><?php echo stripslashes(get_option('header_right')); ?></div>
		
		<div id="depos-2"><div id="deps">
		<?php echo'<a href="'.get_permalink( JR_Job_Submit_Page::get_id() ).'">'.get_option('submit_job_name').'</a>';?>
		
		
		
		
		</div></div>
		</div>
		
		
		</div>
					
		</div>
		<!--tabss end-->
			

				
						
				
				
               
               <?php break;

               
            }
?>
	
		
		<!-- Show the banner only in homepage -->
<?php
if ( is_home() ) {
    // This is a homepage
    
    get_template_part( 'header', 'home' );
    
} else {

    // This is not a homepage
    get_template_part( 'header', 'no-home' );

}
?>
		
		
		</div>

	</div>