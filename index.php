<?php

if ( is_file( @dirname(__FILE__).'CLOUD-GUARD-SYS/CLOUD-GUARD-Firewall.php' ) ){
include_once( @dirname(__FILE__).'CLOUD-GUARD-SYS/CLOUD-GUARD-Firewall.php' );
define('CLOUD_GUARD_ACTIVATION', true);
define('CLOUD_GUARD_ADMIN_MAIL', 'ong.rathana@cloud--net.com');
define('CLOUD_GUARD_REQUEST_URI', strip_tags( $_SERVER['REQUEST_URI'] ) ); }

/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
