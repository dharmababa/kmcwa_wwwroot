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

define('WP_HOME','http://staging.meditateinseattle.org'); 
define('WP_SITEURL','http://staging.meditateinseattle.org');
define('WP_AUTO_UPDATE_CORE', false);


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nktkmc5_kmcwa_staging');


/** MySQL database username */
define('DB_USER', 'nktkmc5_kmcwawp');


/** MySQL database password */
define('DB_PASSWORD', '(T5S0PZd!1');


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
define('AUTH_KEY',         '_|O9I?xv9_P7%h=~l:zW!{qJ|zM1p?h2nz?uhvci84~.|d>J)wGt([FPtQ<2Rwci');

define('SECURE_AUTH_KEY',  'O/[kHcZBvV>ke!Vs6UtPAq-SfLKgN}$-b2l#x<QJLzoFb:fPpxb9-@=Wc:}u?z-@');

define('LOGGED_IN_KEY',    'vfXXj>f{xo_(q {-k,AT]NEfdh-9/|-9%^VQ$R_{P!>-U[r]ci;`wrzbT#Q%CY%M');

define('NONCE_KEY',        ')]|3.|(j{37?8Yf+5 bnkeBJV&s.vpr_i+9_u$kpIDN{oH/V~|h_sTZ8H|]Kp+|e');

define('AUTH_SALT',        '/zT$=]+5zL&r:ED.oG X*)3FF|c+)k=&i+ByvHIfdQaQzrrtyUJzXo7;HiyHUUck');

define('SECURE_AUTH_SALT', 'di!aR:,_fnbtON<+lz:k].adCoG,HZ%>3<yM}_+#tO9>e}k8=7.M$U|Sf}I-5Mhd');

define('LOGGED_IN_SALT',   'Be|xyUbzr%C=N^-3L,FkT+J=lm~~%g}J?;v-~|#(sxs ?CCE|eI%KAE7UvF. Ucz');

define('NONCE_SALT',       '*,G}%n-ARf8a084X(MsiJQn+mq?al=t)2z1;K/E*i=l7Z|qQ,XcZ+,Q|25G`){cN');


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
