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
define('DB_NAME', 'socialdesk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=f2kpV24]qbYhHNQW7wORy|faK|wqL6y^16A.soTQ0MAC!+-c.Bf-U(mUux7j812');
define('SECURE_AUTH_KEY',  '~Ee)%JlS3UW}~%]}M#F>YXnVQk`Z3dX1hG6dA@!wbWQlbwX|E>bK-ziPm<a`ZwNi');
define('LOGGED_IN_KEY',    '/ei2<GTbgI=>8.hnTf,!$</o9WW_#Fj|+[vSVQr<>w#t1d(RRm 8:3*5NC<NFY=?');
define('NONCE_KEY',        '4h/FkE4m8:*yfR`vR AQ44uec_n,JU>4*3|j^oPdAyaa2oNTV|!HUW[8=P)>xZ6B');
define('AUTH_SALT',        '5l6TqKs%gIYtZDk/[:)k-rS=QuJ]ake~|r87$`cf*TIVWhqo$i[v~w9GEAwNQR>!');
define('SECURE_AUTH_SALT', '!49JN~eu+|:1>Y~ZP/1/8twB8p*KeUWv(].fuw!Va$ehUXnWm7WUl1;wzY!hfYn-');
define('LOGGED_IN_SALT',   'Fx7.M#=w]</ueU3 ]B1 _&kST2W0ODT;R)i3[S4]Q*.4.1WtilF%e3%t+srI_ 94');
define('NONCE_SALT',       '%Rf0r0@MNeBHhY`8Z74Ue0`*q4xM:Vq;o[fkj<HH!sJizzr{9JLB9w%W{yz=%(<{');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
