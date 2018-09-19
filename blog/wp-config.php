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
define('DB_NAME', 'dakbroblog');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '02.[!_*R}Jo4;GZ$+ ]u4Q$a(N(/|HiosM]?kHbdIc(enD3v}g66&z9a*fT!O^:i');
define('SECURE_AUTH_KEY',  'e5_(f>xqOcFY_$~+ik%)_Z6xP(#zaCJMFw)LSHts9sa(n_:z{9u:w._g.XBzZ5xs');
define('LOGGED_IN_KEY',    'IZI7Q-]5-gKCh*ZehB*S{H7Z2`_EZ;@GCD#d}bm02^CZW`Kz)LafZjUHdOPJjT;K');
define('NONCE_KEY',        '!oo%^*J1_tI`[4>K/[jgH+$oEuN7M+)`/k93@>2,%peqw{Jz8,PM/>2*qYEyf?5a');
define('AUTH_SALT',        '0^OIhT4D]fRBhv[WpR@C*!od<1d?)WO acPL_Ui>S>K[+U;IaVQ4RWh)k6LK{42i');
define('SECURE_AUTH_SALT', 'mQ1(AjJ{Tba3&`A9P#A`.C^%-)kKe6r_&kgZ~xe*fsjXSg*TG+m06U6G~k0Y+xtz');
define('LOGGED_IN_SALT',   'x<y%ZUdg}O_H|9%)?l:7Cn!0Ty?zM>8zB9qIBHeqAH3Hwbd{(PoO;Aj.%bvH@x@P');
define('NONCE_SALT',       'E17UAeu>r[.VnHg&q]8On>-C!{8=UMIqQdpk=Ary[n->lVdU)lS5_/!Bi<2/9!)o');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dk_';

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
