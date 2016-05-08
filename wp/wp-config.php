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
define('DB_NAME', 'brinc');

/** MySQL database username */
define('DB_USER', 'brinc');

/** MySQL database password */
define('DB_PASSWORD', 'qkfoa5928');

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
define('AUTH_KEY',         'n MOVO-^H%}Be?=sNzh*4R(8n!L?It-@@rzx0IToE>zqF%.hk>@QgE{r0Lh|YnkW');
define('SECURE_AUTH_KEY',  'OZ}(L,vMyQW,viu/Aap9s|N:a7L1M7lwDYjRp4_@?=_th14#pql`qkCxUSg!^b{(');
define('LOGGED_IN_KEY',    'xA7=_n8S{xOGBzo=i(6/Thu,;LD+1p_O3Hn#P`.I0|6y,r;$~jQ~7ruG1(Y:*~-^');
define('NONCE_KEY',        'Di6Pp5ljP(_+lUV~q/X7nl>5MvUtD{*SS/D9OMXT,Gu/b]VSH_r4TXZk^QnS;{WO');
define('AUTH_SALT',        'i%Hld`E/0$jLtMNSx=Z;sY0:klTd}x*?kjwuqZF~%;gP~/Kpo^5x$hq(?~gy{]~S');
define('SECURE_AUTH_SALT', 'wgr}7.eS&?4Msm>+o0&Glv8P(]g14=csx?AC~[ge_ga5m]p ;)Np{R#o[f]tH_V~');
define('LOGGED_IN_SALT',   '<2$tSfS|HEQ,#e9);R`/khf$#W-n=N}@X~_Rhky-IA}`4~nag(L)3K8 ><Lw#5;)');
define('NONCE_SALT',       ';G&2?yB*c0H1YlD`czEMz^+1 ?9.g&gTH~I6R/%ORM3tb/HCFeX{Cn0?eRB&/OD|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
