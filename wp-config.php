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

@include __DIR__ . '/local-config.php';

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'database_name_here' );

/** MySQL database username */
define( 'DB_USER', 'username_here' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password_here' );

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
define( 'AUTH_KEY',         'Vu%i:e{oA6Ys *@.`LF*b)V[)1z|P@]^Atc2S>t!J#|<L(2 +;85N3T.1D^pBd&*' );
define( 'SECURE_AUTH_KEY',  'mx(f9YGO[`2}r_;}(:NP&31,yzOg(=[PL|aAF2@Z0<.T:Wp1` yc*s);z9x>kmr9' );
define( 'LOGGED_IN_KEY',    'AQza}<tV;jm?JF+V*AdVa9F7 Q o<?r`XWqBD;_%Zo7z0[]7>D/d:!l!FXK8a|NZ' );
define( 'NONCE_KEY',        '[xO>R7|0W0[Db0T6;LTw*I0lId3t{l~|LauUE`U/KJX-^rqs%*kB#w5HkrFS,MO,' );
define( 'AUTH_SALT',        '#&EwCJzE:G$Crh$v}NrHBO_dIsYG@LF7uJE D((PRMBiS#j0?=&{As7s;/-##mmh' );
define( 'SECURE_AUTH_SALT', '<R@#)a1oRPV-,m?}bXIy5tIDf<USir>0]w/#Q-vxb1HY+=#$vyIlO$m0Fy[)Iyb5' );
define( 'LOGGED_IN_SALT',   '.~$E/t,fEKDC9^C2vt]xmHb^+on/|F&!u67tU ,yyHycO>mqNdFt]ZaNF,{.6N64' );
define( 'NONCE_SALT',       'D=9[tEt&:Ev`AxL)&Nt--Jm.dnd@YpyZ&>]je/(D)uN@]U4V<=mG;8Wu#xnMBW$g' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bzg_';

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
