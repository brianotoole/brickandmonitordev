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
define( 'DB_NAME', 'brickandmonitordev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'eH^A?_?dX!]Y7{ 7ktENmMN,x&Ux?PWeFa@z/hFi0m8&j6!)upD=t,(/hNA5T8^G' );
define( 'SECURE_AUTH_KEY',  'b)o}H/fu_e<y*w3@U]fSOk<{5YxFXu^W[{/iaO]fAk(CG_fPQK|UltEp^[h/`U=B' );
define( 'LOGGED_IN_KEY',    'fi9m|Fv>-N=xcy/U &|$I_M$4z(I2mMI.hXEATDdR#}=jd3w/JK;:l[@Fv_Efl} ' );
define( 'NONCE_KEY',        '(LBxc7yb/&Qja<{WL{<@GixD8-* N?NwP9*DqIVTAJB$TQhXIlMy5F/#zA-rM:$)' );
define( 'AUTH_SALT',        '=kmyw-6{ZjsiGxjQJ/JTC?m(08m9(^0f&&B#c3b$].}*noaj/sTu/@O3%vPiUdg{' );
define( 'SECURE_AUTH_SALT', ':},rN}d_eAT=hQdq57[N&f[+k?:(h=I^6_Ibpcdeg^+D7]U#o%|>`UX-%}B6dN(w' );
define( 'LOGGED_IN_SALT',   'W!iPn :>#u*]8^>BqY2PRNCv6F5yJ,JwtiKdTSbMjVPnS0P}X)4Ccz`8fC8ju&J=' );
define( 'NONCE_SALT',       'E+8]28$J^&}KiVFQhDuy!Y],kw%UBsCx=v,x$#Z+=ZCsKOm])QSWy bZ|@)<p<-3' );

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
