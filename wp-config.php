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
define('DB_NAME', 'insurance');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

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
define('AUTH_KEY',         ' [TF9(;@SV^.f>4r3O7%:`}7&mc4w>BWhHVs:N}I.CVn`]#iq=s0qAA3oZBQv6/;');
define('SECURE_AUTH_KEY',  'EteQj>4.@.WBw_P=R5/fTb{({HH .wo8D{G3] N%-!-Q&t>Qg,>(;[$5UaVZ6f%N');
define('LOGGED_IN_KEY',    '>_y(Qu.q{7B+<j5O)+=VbftM:IA5CAv,.$_mXy1l8!5=<`1Vr?aB-1Hih!XxYI$%');
define('NONCE_KEY',        ' Iq<R7bJ5G,Ymmgj=QXLGu5}d4fDo$nH9{&bGSKF9)_H<Hz~9Z$|IF2n`mX7>>is');
define('AUTH_SALT',        '`{;O=Ecc0x@P}tgFNhF,LzYq&[4I|+`,muCi7qYQamN E:]&vsxP<uGP|eUWGsuF');
define('SECURE_AUTH_SALT', 'Oa1Ea%Trkg.Em,x?}xF4fFjTC~p H)Sj9L&(^JE<`.p$HD{,h`d@UU*FcI`x[6<q');
define('LOGGED_IN_SALT',   'gi~5#&9*xOW?>uWBuMD:/jG/o**w3H{vC`{~ez`.#Lf}%}OkJ`YjZW[(Tfgc>umV');
define('NONCE_SALT',       'RrJr@4.`&>dPbm5PcF[><8P$4^FO_xX&E=>p1++s_fRy;kO-<`uEF%z6Xa=g/xoO');

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
