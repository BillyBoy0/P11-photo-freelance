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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}


define('AUTH_KEY',         'tj8iJ1J75DHWfVh2f61IXlgjVESGyhhEuX5sSZcIXZiOoDWZdW9qr3Z+NLjb8LnT6cy8+qBoYcgxv2bqewr6vg==');
define('SECURE_AUTH_KEY',  'fWoK8BVVbNeKfhh7llV/vJRNYZIcq4zOl4mnTC6SFHyowl2TU4KkBLijwniab22V5z6UtcRB+a23haGWQzSCCg==');
define('LOGGED_IN_KEY',    'I/whktz47YZCq6xg0UZIJblhxw6BXdZEva8MFiknDUry5suEgHEv9Jci08EZQTI0WAiNZTPfj/tKk1r1dx28+A==');
define('NONCE_KEY',        'g9+5hcqv4w/6VvIeLM4nftqCCCfb9uIJmXsOOaa0LM8aHCiZ0hgeGig8dTvJUJ1xHHeTnC3cH9cy0pnZ9pf7fA==');
define('AUTH_SALT',        'WtSQjabS8AJQrs0yW1WnE/NQg3+iQtjvGUpuAVzo6zbOZRYBLj/539+WxHVQfARojnknXYtDQXks6FAKpolbaQ==');
define('SECURE_AUTH_SALT', 'MEgeYDMJbrhSXRozN8k4tFMG3uH4aeEHCt+wWFBIygSB5sT3flVjagXVDsV4JxOsW0fLvbtFJcLaStHllshVGw==');
define('LOGGED_IN_SALT',   'eWbmZ93yfgpeMBrKXipcXuyka45Hen4jhDSGR1KroG3gkgonpwPX78glpdTTg46+WzOAJzO/k3GtjzP7jMFsbw==');
define('NONCE_SALT',       '4VtUjhoHT8cqGos0NVhlyfsLYcYt9PXe07Q4APb2EXIKeD3NqahqxYA+Cktegno4yIwjpNiQqoIC69jYiqgYPw==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
