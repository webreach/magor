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
define('DB_NAME', 'magor_wp1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'Q8E4pHn2X26fjwXl8AQ3yHZUCq3RioFPQ8CAEYINWYYNc1QaPwb76jF9km88Xsc1');
define('SECURE_AUTH_KEY',  '7Kl4RPLZ6ENzUTkfnhG6r6TuqEXb1nDhsFRmiTM1LoY8K2mpdrpGBSGJKp9qoTZa');
define('LOGGED_IN_KEY',    'zuSJ5hZzKozIpcfvLxIwCYfUtWAgNfjdIJkY3fteQD77ZOzl0WuX6Kaky7sy9VGM');
define('NONCE_KEY',        'gqkQSMX1iXf7yR49nEVwkvHdkVCvfAIEweyzPhtMA3jXJ1vOpi8RJakefsWhPzD0');
define('AUTH_SALT',        'vd2YQPGJhv0StWoEGMBr1R1zyO8RKO4vsXr7emHeL6TB6SvB9B978ybowNPXnWKm');
define('SECURE_AUTH_SALT', 'bPq1wDQSa5Y7n75s9wmcDZZdOxC80Fky6qCDOg2jzDd2kkMjVPrfBUGIQXdFCEbq');
define('LOGGED_IN_SALT',   'NV2GjYZeOKrfF5Ej755uMFMGYvmij3732VlgGqpyrbgEBXPbKXk01EGVqhjI3srN');
define('NONCE_SALT',       'rzqrfxMZ6kx7c1c7DKUeg1bV6DYlH3hcM9FxXElQPAhJAojTVnsoLARx2507yA2Y');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
