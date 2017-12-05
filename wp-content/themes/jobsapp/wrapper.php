<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php global $app_abbr; ?>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="<?php echo get_option('favicon'); ?>" type="image/x-icon" />
<title><?php wp_title(''); ?></title>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/normalize.css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/theme.css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/introjs.min.css">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url')?>/home_1/css/style.css">
<script src="<?php bloginfo('template_url')?>/home_1/css/analytics.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/jquery-3.1.1.min.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/bootstrap.min.js"></script>

<script src="<?php bloginfo('template_url')?>/home_1/css/modernizr-2.6.2.min.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/english_lang-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/react.min.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/script_init-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/react-dom.min.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/script_pre_0.3-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/job_search_form-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/home-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/feature_list-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/widget-min-1.0.2.js"></script>
<script src="<?php bloginfo('template_url')?>/home_1/css/job_category_side_list-min-1.0.2.js"></script>
  	
</head>
<body>
	
	
	<nav id="menu-top">
		
		
		<div class="header">
		
			<div class="col-md-3 col-lg-3">
				<?php if (get_option('jr_use_logo') != 'No') { ?>
						<?php if (get_option('jr_logo_url')) { ?>

							<a href="<?php echo esc_url( home_url() ); ?>"><img class="logo" src="<?php echo get_option('jr_logo_url'); ?>" alt="<?php bloginfo('name'); ?>" /></a>

						<?php } else { ?>

								<a href="<?php echo esc_url( home_url() ); ?>"><img class="logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>

						<?php } ?>

				<?php } else { ?>

					<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a> <small><?php bloginfo('description'); ?></small>
			   
				<?php } ?>
			</div>
			
			
			<div class="clearfix"></div>
			
		</div>
		
    </nav>
	
    <nav id="mainNav" class="navbar navbar-default">
        <div data-reactroot="" class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-header" aria-expanded="false"><span class="sr-only">Toggle</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <div class="collapse navbar-collapse" id="menu-header">
               
			<?php wp_nav_menu( 
							array( 
								'theme_location' => 'primary', 
								'sort_column' => 'menu_order', 
								'menu_class' => 'nav navbar-nav navbar-left',
								'submenu_class' => ''
								) 
							); ?>
				<?php global $current_user; wp_get_current_user(); ?>			
				<?php if ( is_user_logged_in() ): ?>
				
				<ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-white pro">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <?php echo $current_user->user_login; ?> 
							<span class="fa fa-lock"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?= site_url("my-dashboard") ?>"> <?php _e('Dashboard',APP_TD)?></a></li>
							<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e('Log Out',APP_TD)?></a></li>
						</ul>
                    </li>
                </ul>
				
				<?php else: ?>
				
				<ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-white pro">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <?php _e('Members',APP_TD)?>
							<span class="fa fa-lock"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?= site_url("login") ?>"><?php _e('Login',APP_TD)?></a></li>
							<li><a href="<?= site_url("employer") ?>"><?php _e('Employer',APP_TD)?></a></li>
							<li><a href="<?= site_url("job-seeker") ?>"><?php _e('Job Seeker',APP_TD)?></a></li>
						</ul>
                    </li>
                </ul>
				
				<?php endif; ?>
					
            </div>
        </div>
    </nav>
	
	
	<?php if ( is_home() ) {?>
    <div id="pnlTopMsg">&nbsp;</div>
    <header id="header">
        <div data-reactroot="" class="search-wraper search-wraper-home">
            <div class="search radius-0">
                <div class="search-heading hidden-xs">Search your favourite jobs</div>
                <form method="GET" action="<?= site_url() ?>" id="frmHomeSearch">
                    <input type="hidden" value="Fri Oct 20 2017 21:55:10 GMT+0700 (SE Asia Standard Time)">
                    <div class="row form-group-lg">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="search" class="form-control" id="s" name="s" placeholder="Input your keywords">
								<input type="hidden" name="radius" value="1" />
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="form-group">
                               <select name="category_id" class="form-control">
									<option value=""><?php _e('All Job Categories',APP_TD)?></option>
									<?php 									
										$job_listings = get_terms( 'job_cat', array( 'hide_empty' => false ) );
										if ($job_listings && sizeof($job_listings) > 0) {
										foreach ($job_listings as $type) { ?>
										<option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
									<?php } }  ?>
								</select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <div class="btn-group btn-group-lg btn-group-block form-group">
                                <input type="submit" class="button btn btn-primary" style="background:#F58220; border-color:#ffb250;" value="Search">
                                <button class="icon btn btn-primary" id="jobBtnAdvanced" style="background:#F58220; border-color:#ffb250;"><span class="fa fa-filter"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="jobSeachAdvanced">
                        <div class="col-md-3 col-lg-3 form-group">
							<select name="location" class="form-control">
								<option value=""><?php _e('All Locations',APP_TD)?></option>
								<?php 
									$r_location= get_user_meta( $user_id, 'r_location', true ); 
									$job_types = get_terms( 'job_loc', array( 'hide_empty' => false ) );
									if ($job_types && sizeof($job_types) > 0) {
									foreach ($job_types as $type) { ?>
									<option <?php if ( $r_location==$type->name ) echo 'selected="selected"'; ?> value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
								<?php } }  ?>
							</select>
                        </div>
                        <div class="col-md-3 col-lg-3 form-group">
                            <select name="type_id" class="form-control">
								<option value=""><?php _e('All Company Types',APP_TD)?></option>
								<?php 									
									$job_listings = get_terms( 'type', array( 'hide_empty' => false ) );
									if ($job_listings && sizeof($job_listings) > 0) {
									foreach ($job_listings as $type) { ?>
									<option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
								<?php } }  ?>
							</select>
                        </div>
						<div class="col-md-3 col-lg-3 form-group">
                            <select name="skill_level" class="form-control">
								<option value=""><?php _e('All Job Schedules',APP_TD)?></option>
								<?php 									
									$job_listings = get_terms( 'job_type', array( 'hide_empty' => false ) );
									if ($job_listings && sizeof($job_listings) > 0) {
									foreach ($job_listings as $type) { ?>
									<option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
								<?php } }  ?>
							</select>
                        </div>
                        <div class="col-md-3 col-lg-3 form-group">
                            <select name="skill_level" class="form-control">
								<option value=""><?php _e('All Skill Levels',APP_TD)?> </option>
								<?php 									
									$job_listings = get_terms( 'level', array( 'hide_empty' => false ) );
									if ($job_listings && sizeof($job_listings) > 0) {
									foreach ($job_listings as $type) { ?>
									<option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
								<?php } }  ?>
							</select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </header>
	
	<script type="text/javascript">
		$(function(){
			$("#jobSeachAdvanced").hide();
			$("#jobBtnAdvanced").click(function(){
				$("#jobSeachAdvanced").slideToggle();
				return false;
			})
		})
	</script>
	
	<?php } ?>
    
    <div id="pnlContentWraper">
	
        <div class="partial-space">&nbsp;</div>
		
        <section id="container" class="container">
            <div>				
				<?php if ( is_home() ) {?>
				
				<div class="break-word panel">
					
					<div class="col-md-9 col-lg-9">												
						<div class="panel-heading">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" href="##panel">
									<span class="fa fa-th"></span>
									<?php _e('LASTEST JOB',APP_TD)?> 
								</a>
							</h4>
						</div>
						
						<?php get_template_part('loop-job'); ?>											
						
					</div>
					
					
					
					<div class="col-md-3 col-lg-3">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" href="##panel">
									<span class="fa fa-th"></span>
									<?php _e('OUR PARTNER',APP_TD)?> 
								</a>
							</h4>
						</div>						
						<?php if (get_option('jr_show_sidebar')!=='no') get_sidebar(); ?>								
					</div>
					
					<div class="partial-space">&nbsp;</div>
					
					<div class="col-md-12 col-lg-12">	
						<div class="panel-heading">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" href="##panel">
									<span class="fa fa-th"></span>
									<?php _e('FEATURED RECRUITERS',APP_TD)?> 
								</a>
							</h4>
						</div>
						
						<div class="" style="height:180px;">
							
						</div>
						
					</div>
						
					<div class="clear"></div>
				</div>
				
				<?php } else { ?>
					
					<div class="break-word panel">
						<?php load_template( app_template_path() ); ?>
				    </div>
					
				<?php } ?>
                
            </div>
        </section>
        <div class="clear">&nbsp;</div>
    </div>
    <footer id="footer">
        <div data-reactroot="" class="footer">
            <div class="container">
                <div>
                    <div class="col-md-3 col-lg-3 panel-body">
                        <h3>About Us</h3>
                        <p>The web site was the first of it's kind when it was established back in 2000. Since that time it has become the most popular and professional job announcements and classified advertising portal in Cambodia that offers the most legitimate service available in the country.</p>
                    </div>
                    <div class="col-md-3 col-lg-3 panel-body">
                        <h3>Contact Us</h3>
                        <p>No. 175 Street 110, Sangat Wat Phnom, Khan Daun Penh, Cambodia.</p>
                    </div>
                    <div class="col-col-3 col-lg-3 panel-body">
                        <h3>Useful Links</h3>
                        <ul class="no-list">
                            <li><a href="#term_condition.html"><span class="fa fa-balance-scale"></span><!-- react-text: 16 -->Terms and Conditions<!-- /react-text --></a></li>
                            <li><a href="#"><span class="fa fa-ticket"></span><!-- react-text: 20 -->Customer Service Support<!-- /react-text --></a></li>
                            <li><a href="#"><span class="fa fa-user"></span><!-- react-text: 24 -->Corporate Member<!-- /react-text --></a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-lg-3 panel-body">
                        <h3>Social Networks</h3>
                        <ul class="no-list">
                            <li><a href="#"><span class="fa fa-facebook-square"></span><!-- react-text: 31 -->Facebook Jobs<!-- /react-text --></a></li>
                            <li><a href="#"><span class="fa fa-facebook-square"></span><!-- react-text: 35 -->Facebook HR Management<!-- /react-text --></a></li>
                            <li><a href="#"><span class="fa fa-youtube-square"></span><!-- react-text: 39 -->YouTube Jobs<!-- /react-text --></a></li>
                            <li><a href="#"><span class="fa fa-youtube-square"></span><!-- react-text: 43 -->Youtube HR Management<!-- /react-text --></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center" id="footer-copyright">Copyright © 2017. Khmer Engineering Job.</div>
        </div>
    </footer>
    <div id="btnGotoTop" data-spy="affix" data-offset-top="250">
        <a href="##" class="fa fa-arrow-up" aria-hidden="true" data-jump-to="body"></a>
    </div>
    <div id="modalLoading" style="display: none;">
        <div class="container">
            <div id="modalLoadingContent"><span class="fa fa-pulse fa-spinner"></span></div>
        </div>
    </div>
    <div id="modal" class="modal" role="dialog" aria-labelledby="modal" tabindex="-1">&nbsp;</div>
 
</body>
</html>
