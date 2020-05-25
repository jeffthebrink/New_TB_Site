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
define( 'DB_NAME', 'TravelBrinkley' );

/** MySQL database username */
define( 'DB_USER', 'jeffthebrink' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mjwbjwb0583' );

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
define( 'AUTH_KEY',         '+d<YQ&QbIm-Dw).u:a~6vu%_f::,1-|< $?,n*w6N-0SZ`qEaRW+]f+W{N k]CgX' );
define( 'SECURE_AUTH_KEY',  'pBQ<PvL^SlG~~M!rIlql;Pl11s1|:,lKN7vjDCz]_S`PM(u]Q8+]&ZCh}8Ku0vmm' );
define( 'LOGGED_IN_KEY',    '&98~_C]^RJh3,7J*oCRz~wb)v<L=+7MN%n^jCgye(25p2Q][=gFVnZvK]&GbdZ@7' );
define( 'NONCE_KEY',        'Q(&fo7{)Ml-N:7%4`GFXa}zwnaBx!x9uE{/Bpae(3HePb6X=PcT[rqb/fu4?Z9_O' );
define( 'AUTH_SALT',        'C8vxq.KJ0Sf OC*w1@qMglbD[$DhFDjfPcTSkEkD^xamPofE@V6FG_Jk9WW)dmZK' );
define( 'SECURE_AUTH_SALT', 'Qn2$:n%cs_-63?:{v~Wmlydum31m;>kMl&W&[3}D,S(Zj?~!3(?sZ8;QqT+ATWyF' );
define( 'LOGGED_IN_SALT',   '5maFZ/7i}h=N!Vr^msVbRYQ!g.r~[/epZ5<X.4)r<cR/~g8t:^t 8 o*W{L.gm7:' );
define( 'NONCE_SALT',       'wW@T)1.F3TRazO7=b=MA<#P E#@-@stR^}S=>@]Oj1B!P@xHN0[dhji}!%Ho[H,V' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
