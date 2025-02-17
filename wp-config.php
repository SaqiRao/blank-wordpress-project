<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'blank-wordpress-project' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '!g3 `UzAX$WUp+}Vq-P</kA&|NfRm(O+eHV>G?` sl^B9u&0BMwD`Q8da/UJF9hq' );
define( 'SECURE_AUTH_KEY',  'qZp>25`*QB0`Q{vTEE%T(GZ$c@&.jd0ZX:tI)x<pkutumHn-RZUm(;2]2DBWDWN;' );
define( 'LOGGED_IN_KEY',    '^;8~;g!.K&kXxX+*7@;_4Lmkdf4?c%7E^R8BOB>>84M+tdxNmb<-9@ Yp^m64.s6' );
define( 'NONCE_KEY',        '}^9}4D#O^VQz[kJ$`JDmg/U-YLN`Ra++{{/,*ufk5M5QWss:qjqS~Z.,7^DQZUP+' );
define( 'AUTH_SALT',        'e-1A^!~YUs#]QS&PNbyU?(<~)w.h];{?$kQ8Mx9Ua`2$|Ip9z6~9zsuz,PJ[K-I#' );
define( 'SECURE_AUTH_SALT', '|vS7 }$moC+e*a4B&N]^Jaiwiy[yRhR-P7EM{{ *g1[<(N+B,lU5w9EW$yDh f&>' );
define( 'LOGGED_IN_SALT',   'N4Qv(XhgRiP,F1e56e=V8c1}QZaYQgN#^<ER@]c0i7EW%xcC?vQHODr+[$I;Y]i!' );
define( 'NONCE_SALT',       'uo*[7R0BqT/H]NTgWR{CTvN/9B9_EtcK}xRMV8RRzQbUA%YF&hx[RpoK(k5a0%Uq' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
