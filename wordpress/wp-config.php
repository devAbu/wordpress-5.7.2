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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '`.A1ie)w!B/EN!9v/wgyqg0i8T>2n+.qp(7bigQ-,,kd0->ekZv0EmR.5m%2Lt>l' );
define( 'SECURE_AUTH_KEY',  '-N}!*L=i--w?b0I/,,?T6Q&}[L0s<>YO-&s#hq$8sU*xU@SMH9UVRcrH:%[?*Vm|' );
define( 'LOGGED_IN_KEY',    'xlVyh!5q_bHd4quU9n@&]JflO;#eG^;FrW2#,~m+7U+,_$b*sb>A9/Av,qh*iFe=' );
define( 'NONCE_KEY',        '86RvrPTjkDR/Q:$,m,Oy#2(O2{pqf|xm%g-?4m@mHaf;1O0DRg[|n.b$6?yj~KEQ' );
define( 'AUTH_SALT',        'D-yx6fQy|$msVK5viL{j`TaX^XZ%{r[$fcJ{fuAk,nx7]*RZSxvwHL2QUTHb<.Ky' );
define( 'SECURE_AUTH_SALT', 'BN4u8N`y[Y`4@<~Nn4-S]x/S~*ja`h[Yf,cN|Ps*rZU$~g!(w^@7(EO~<=]AEnzZ' );
define( 'LOGGED_IN_SALT',   'h6;.(#06e#N ?<GEpU iQYt3[zv(n*q=7YI*(1So>]78o`SL2t#%a|uiL1Lq@InS' );
define( 'NONCE_SALT',       '.US;R#m3TB_K+1WQ}5g< 1?j&n^Np=rptm0>}<!hbUM=3Qei=*MgVISt`)Q_m~oN' );

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
