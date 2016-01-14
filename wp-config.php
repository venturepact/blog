<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'resources.venturepact.com');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'vp@321123');

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
define('AUTH_KEY',         '$RJ~Ek4#(E@{Y!D.w,YU|s%lSm426_o&TCn+Db?UI||B6(@PAd:E-93FGAamr<<R');
define('SECURE_AUTH_KEY',  'EZ|1&:gy0a[VBbw?p(dWd/Lg?7XPl8Tj!W[58,)a(,;TMT0T-`;H/:nCQsjxZ3CP');
define('LOGGED_IN_KEY',    '[h,)I&+X&SD8|Xo)@/m,lh8lw5|}}_!2mD5,JtSUk3JWyT.00S>@pIY,B{c}ZhXF');
define('NONCE_KEY',        '-bc-*{X^<dM!Q8^kYz45M{>;8a#Jvnv]:WgY}Hb(8^Xa-ivdC,tbInI!!hFquO~W');
define('AUTH_SALT',        '+K|gc2r-M,MDW*7Oxa+zbkUW]W_|9VTTm%gK6mWLuI2 )3[hw2^2UxlP53i;-31?');
define('SECURE_AUTH_SALT', '8|c)]~~4^tC>l|F:A>52`~b?EuAxb_|(OABa]=_Z/|:;%O9Hm_pGp9Z@|nzsI7G>');
define('LOGGED_IN_SALT',   '?NDlBW&lO?u1Z7)*<gW7juo@90ELw^<j:6mXFAn8oc|/PVy9f(TJlc#<;bMr=~u@');
define('NONCE_SALT',       '1=#Z%f|lbF`8UIii<P]Vc(=6.hxb>@{y6|(@=+6_f,D||;-]BtKcM4!v27Hc7hE4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
