<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('WP_HOME','http://meditateinseattle.org'); 
define('WP_SITEURL','http://meditateinseattle.org');
define('WP_AUTO_UPDATE_CORE', false);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */http://localhost:47208/favicon.ico
define('DB_NAME', 'nktkmc5_kmcwawp');

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
define('AUTH_KEY',         'wbzmkauhta2fphjge6ssnxdvbvmbmepasdunyvwqi8btaje63v9aklitqhlmfctu');
define('SECURE_AUTH_KEY',  'sf50kszew20tt8u2ljr5angmdvvypwsw35mtjkesayaxyxgoqzqkmz0ctmgoykpv');
define('LOGGED_IN_KEY',    '8san3cxkvk3goqvx5xr0wuaerbu4coobhomo3x6uguduinfj7w7i20ekkechyhle');
define('NONCE_KEY',        'ovgzy4zbjjio6vtypg5aprdkhrmah7d2uyuny4awkegugq9j5pqcuyy15hwglr3q');
define('AUTH_SALT',        'wanoqwt5ecu7sa1a9qjwyjqemglvfxfvscpedrfgmy4qjpnlivkiyvhqt1ts5ddj');
define('SECURE_AUTH_SALT', 'kduk6eqiuunncebhmji5gtp5wsftwq3unjfifppuh3wxddvxzkex635dorgpzbda');
define('LOGGED_IN_SALT',   'lhcocanmfmvqkbjigeisb1ualrcdoh7yeeggwqlrw7awn0nefmykai739lyrfliw');
define('NONCE_SALT',       'osxenoqyiis9v7eirylm5zafsfbrei1xioruqi9jkfxv1qk2fkvhvgdzmwyoef1p');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
