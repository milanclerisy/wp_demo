<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'demo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );

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
define( 'AUTH_KEY',         '^>(rE+v/Ul#Y=o_#;H9,PpDfME<gFk2)-VKy2RF,z%(,mp_syjfV%`h**it?P`TC' );
define( 'SECURE_AUTH_KEY',  '.BU7_BEP6c0/@RPBJcSUX@)7=/*0l&+:m]=vY,G#u<Bh6-G9r~/e`J]ts7ZM/]nP' );
define( 'LOGGED_IN_KEY',    '_ZKyEh]*`Qs#_5:J&e=9(:l2eXTS6X|nB2kn?C^>_/H7Oa~iepRUsmYc?FC8} Tg' );
define( 'NONCE_KEY',        'uAHnsTa@^^y}xO@iB-.O1J_E9kT{@56A5e4ZymY]RC!Z-c<K$X^#uWk1kH0c jms' );
define( 'AUTH_SALT',        '*d8k^qA>/h<ciAC,}z;&8&4I]!<e/g%EJXeZdLr.;YHQt{G+uq=w7])@90;H KxF' );
define( 'SECURE_AUTH_SALT', '::]*J;f7ugn~} WT$gu&G0%@blvZ[A$/paD?&+Bt6W9H!q6fs .;z+fsU9H~r{-y' );
define( 'LOGGED_IN_SALT',   ' )3[>[we+hjHe`$~gJwoOgGh5s=L,WFJ(_$&AGE{Z5WQ}rl;^.Znahb()XY&BsGh' );
define( 'NONCE_SALT',       'n9ofrx%Pv#1t=u[.iF%c(tRFK>$@66^cwA_w%g9`DR4c4t}7s?}D;jAdXr=wLQy:' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */
//Great wordpress in terms of security: MK
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

