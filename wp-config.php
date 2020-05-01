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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'playbrg' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3z(Mo7]K2:jsl2>BRQM#Lj&#A)-Db@}#,7 r[rneQkvU#f[n.T}&EnVjR2d5Lnb_' );
define( 'SECURE_AUTH_KEY',  ' A(y;#@tYxm.r`SKSP7LSljA?VWHXMT-f&nzZ8EdMLtN<T9XCBn*xjI,;Y/Wof1j' );
define( 'LOGGED_IN_KEY',    'Oeumr?gS.XDZN%2Ba;AXB|<*:xy2cj6n[OcdFv| DMS6i%<jAom^%r%~iy|edZlP' );
define( 'NONCE_KEY',        ';>#L8Q4(jl1aKH62ptvs_{Qyl>/]o7L]?pMIhzZu+nfPLX;q<T) sB2WcC`]V.u?' );
define( 'AUTH_SALT',        '_I/qQb[yEjAf37-I!rWT#.!nFZNbx`jX/e{DC@JN5nX?x]JY*]>/zmmbi3KXk* r' );
define( 'SECURE_AUTH_SALT', 'z.a,_.WgY|erE=OE9=Sp>[Jtdx^)%<u5Zob>S-R6%oIHradTq,QH:5bQ:&58JGD`' );
define( 'LOGGED_IN_SALT',   'T<7Jy{ylTEjshr,..x9G(&n0%3j;RKWF_zK2>7xw:xE|NpEGAf6j$7R1&O$OIO[#' );
define( 'NONCE_SALT',       'xJ9P`vMnM$}nzE;[]3oWRT}wK/MUvO$/pR<U6q451wxc#rmde,iF!>C:,UQvQN`Y' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
