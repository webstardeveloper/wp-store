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
define('DB_NAME', 'wpstore');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'e:G`Mp]l=2&kz]2@V`[4g*8v]({(?5rI3t?9P_j:zXVr}0+LLna3A>[7QbKVi4kr');
define('SECURE_AUTH_KEY',  '9xNPz=9+<5lg;-uNJ[M`h9I[;o*lHpfvPWlDROUU@]V[@3jsU^r bI0DyHo|P,lO');
define('LOGGED_IN_KEY',    'y&V%A>#M`,r!Khj:y#.bc[(#wXfK[eZ&%sq~Uw)`h8}oC|2pTx%/q}S}!e+@vWw$');
define('NONCE_KEY',        'C=NK1U? PV?-B5b0UbEO&57+xnv#*%Xz?PFSRKW9NfAk1R.V-@QUk^IpQ>S *-]/');
define('AUTH_SALT',        'ko-Bz jZ#!(*ho)_kDbmFkm5t6b,8IO@sp#BhtbiZCJG1}Vh!,kNP,xS/]KP_ ns');
define('SECURE_AUTH_SALT', 'HSh)7X7hOKbwwj9DhKR{D?Bf(O-%Dh#@5tXUA@Kn|NX53z30{`Nq$w/|6K{&AO?W');
define('LOGGED_IN_SALT',   'i!LB7djW*Xyk+Jl5;<>GFGQA[PoEHS<P=ecH2JI9*%jO!p.knRBsIzZ{Kdzr<{Db');
define('NONCE_SALT',       '`KOX*Qq-5lw*Gml.V.zxi?2baV6nSOoReV{^ZL`=>N.PrFT;Nj+9 t^JWjaW[!B]');

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

define('DISABLE_WP_CRON', false);

define( 'WP_ALLOW_REPAIR', true );
