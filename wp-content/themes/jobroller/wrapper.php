<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php global $app_abbr; ?>
<!--[if lt IE 7 ]> <html class="ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php wp_title(''); ?></title>
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('jr_feedburner_url') <> "" ) { echo get_option('jr_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" id="at-main-css" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
    <?php if (get_option('jr_child_theme')) $child_theme = get_option('jr_child_theme'); else $child_theme = 'style-default.css'; ?>
	<?php if ( apply_filters('jr_load_style', ! is_child_theme()) ): ?>
		<link rel="stylesheet" id="at-color-css" href="<?php if (file_exists(get_stylesheet_directory().'/styles/'.$child_theme)) echo get_stylesheet_directory_uri(); else bloginfo('template_url'); ?>/styles/<?php echo $child_theme; ?>" type="text/css" />
	<?php endif; ?>
    <?php if ( is_singular() ) { ?><link rel="stylesheet" href="<?php  if (file_exists(get_stylesheet_directory().'/styles/print.css')) echo get_stylesheet_directory_uri(); else bloginfo('template_url'); ?>/styles/print.css" type="text/css" media="print" /><?php } ?>
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>

</head>

<body id="top" <?php
	// TODO: use APP_VIEW instance from framework
	$classes = '';
	if (get_option('jr_show_sidebar')=='no') $classes .= 'wider ';
	if (get_option('jr_child_theme')) $classes .= str_replace('.css','',get_option('jr_child_theme')).' ';
	body_class( $classes );
	?>>

	<?php appthemes_before(); ?>
	
	<nav id="mainNav" class="navbar navbar-default">
        <div data-reactroot="" class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-header" aria-expanded="false"><span class="sr-only">Toggle</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <div class="collapse navbar-collapse" id="menu-header">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#">Job List</a></li>
                    <li><a href="#">Job Category</a></li>
                    <li><a href="#">Company List</a></li>
                    <li><a href="#">Job Location</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-white pro">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Members
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">Employer</a></li>
							<li><a href="#">Job Seeker</a></li>
						</ul>
                    </li>
                   <li class="dropdown dropdown-white icon"><a class="dropdown-toggle" data-toggle="dropdown" role="button"><span class="fa fa-gear"></span><span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#">Khmer</a></li>
							<li><a href="#">English</a></li>                        							
						</ul>
					</li>
                </ul>
            </div>
        </div>
    </nav>
	
    <div id="wrapper">

		<?php if(get_option('jr_debug_mode') == 'yes'){ ?><div class="debug"><h3><?php _e('Debug Mode On',APP_TD); ?></h3><?php print_r($wp_query->query_vars); ?></div><?php } ?>

		<?php appthemes_before_header(); ?>
		<?php get_header(); ?>
		<?php appthemes_after_header(); ?>

		<div class="clear"></div>
		<div id="content">
			<div class="inner">

				<div id="mainContent" class="<?php global $header_search; if (!$header_search) echo 'nosearch'; ?>">

				<?php load_template( app_template_path() ); ?>

            <div class="clear"></div>

        </div><!-- end inner -->
    </div><!-- end content -->

	<?php appthemes_before_footer(); ?>
 	<?php get_footer( app_template_base() ); ?>
	<?php appthemes_after_footer(); ?>

</div><!-- end wrapper -->

<?php appthemes_after(); ?>

<?php wp_footer(); ?>

</body>

</html>
