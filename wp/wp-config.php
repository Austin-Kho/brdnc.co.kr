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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cigiko');

/** MySQL database username */
define('DB_USER', 'cigiko');

/** MySQL database password */
define('DB_PASSWORD', 'ks12090203');

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
define('AUTH_KEY',         'y&0E%ONw*PZ8OVmXCJ,w#jZ+umKMX`va^mXS.#`[u0f]f<+V<QV`Bhf${O48+BT#');
define('SECURE_AUTH_KEY',  'e|k4!>>ZXJ,MDoj&@=M)*b#gz-<L.pWz*) )eQSS5a@7@CE><d/._0MAdu_D;YyP');
define('LOGGED_IN_KEY',    'aPR!q-j`|KTmAW13qCYj6|(u*un9r2%vHdgW.Pm@K[-`&17al$gdI_to01{rXsV|');
define('NONCE_KEY',        '@k^n}kJuA^TKBKt9sVV0VM.gbXS894FlRF: =&+3pBe%/bIGS>R3e=3p+*E~N;q>');
define('AUTH_SALT',        'o)JJV/IjKk}!pA%ESmV&=*/SgJGgN.jgli_>NRV;{z0x_r|VCL/ThCu}iv/ua3}S');
define('SECURE_AUTH_SALT', '9!5)50BbR:`V+wLB,K3XP(uD!W._8e!L;DoTF2q-).x?20s5f.L4+nB$+9`SOF~&');
define('LOGGED_IN_SALT',   '*2@T%{>=+kHlxF|,V@Xi`g1D[H`&)WWhKI1&:.AQbMs^/phkCZ7U!(co1jMt49l1');
define('NONCE_SALT',       '4Y:|aq;3.3h=m}-*;&!IKZ$(+B(A#O8@q#$aIzF_nH6JKI-^X0:b[7+4tN}E7s>6');

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
define('WPLANG', 'ko_KR');

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
