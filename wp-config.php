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
define( 'DB_NAME', 'profile.razaa_db' );

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
define( 'AUTH_KEY',         ':CI,2rPYWzM!D_f8*tw;.C=^.~&q;/*Y*fx{CP 2pO*Iv#<u57C:SYb#WXSv02S%' );
define( 'SECURE_AUTH_KEY',  'S?nu@*;p{c03>VVjG[RQgqx%SACgp7?sgm%6`14Uy)rU9J!FS6U>A5)0<I$TcK6b' );
define( 'LOGGED_IN_KEY',    'fZpb^*hN);b[j&$o)X`yFYp;ajpu,E~;:BU2>JKtmpe,d#Lo5]Yh^Ka:z#V5#vin' );
define( 'NONCE_KEY',        'ooFP2JF<qpf `XD7/6wq2NNO#2p0a.Cao<IpPG$/0Wg,oo9z8>,dUZ%]GBwVv&hW' );
define( 'AUTH_SALT',        'z|A5x&gglciM}dShST X`lWkF*25mqa#J?d+$YbCX)IO!FSvT<AF<X[*1sLCDUzl' );
define( 'SECURE_AUTH_SALT', '-p$]u~,2Z=sRY}`qM*n~Kz:_a|(~Zf*7w7w.X(>f_vq8WLPi!gec){rdGh|?/Jmd' );
define( 'LOGGED_IN_SALT',   'C*Ohzy&ej)/%<vEm:T`i6yD/KBB!&0FD!Is_:V9WEo!_H-K^ zhQk37qdQ3do$!^' );
define( 'NONCE_SALT',       '?Us1FM&d$(]pT+w5NX4%7*i~^R>w3.!!LI$`4tw7AR^(qD:aft5!J<L6_*un~Rb$' );

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
