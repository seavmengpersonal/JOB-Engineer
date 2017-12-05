<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tem_job2016');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mkK&$)P0GNfK-8;t)rW)tI&hsz{W@#NQ6ozUj2lG%]Ir#zkA~f8}~X.4+A+2sC+j');
define('SECURE_AUTH_KEY',  'KnLY!Y<X{V.vJa!KiC79,rH|EUuW~N,M>u@ygAwDs1.dtP+lekh:PPq^M^+Q?e{W');
define('LOGGED_IN_KEY',    'xek}Vq0|r6dm*Jz&|uS}/wBK~ScNCo(`*_$~H:Fd|~eQ~@w h5Q;zUEDhT4c<VLL');
define('NONCE_KEY',        'qV5kmgo@/-Tf|e:f0bQk:W,w$7G!dHG{T7TxYE|E3|sT`w:>N]LST$m3AK,gH|&#');
define('AUTH_SALT',        '|B`6dB%/KuJpSVt<6hLuBVcA-fENq~EH7fk.#DQw)rzl][5eg{ %9AYGD1WHi-QH');
define('SECURE_AUTH_SALT', 'K9=|gxT>mKf|!Y@<7<v3J=.6m_DB%n`h2hzj:2D--Qq9{4C5=xn3,9+IW*-wd#u]');
define('LOGGED_IN_SALT',   '-^eNp?x4[2zJEr}LR}H&c&uQ+&_0Zuy!.}n@[>9i<UXp~LD?&Jk/+z.,x{p^|wGI');
define('NONCE_SALT',       '?s#Wpzl4*hx.e2%&kN 7L9QFe}X dU.Wxv%=Q$?CUqOJr?Xy2&x}~1h+Q-n]?{N=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'cl0ud_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
