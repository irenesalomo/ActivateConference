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
 
 /**
 * Section: The base dir for wordpress
 * =============================================================================
 * WordPress needs to know where it is installed. Normally one of the last
 * things that get defined in the standard wp-config.php file. However we have
 * moved it up the chain a little bit. So that we can use it ourselves.
 */

if (!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__).'/');

/**
 * Section: Environment Specific Configuration
 * =============================================================================
 * Here we define our database connection details and any other environment
 * specific configuration. We use some simple environment detection so that
 * we can easily define different values regardless of where we run.
 */

call_user_func(function()
{
	// This is where the magic happens
	$env = function($host)
	{
		// Do we have a direct match with the hostname of the OS
		if ($host == gethostname())
		{
			return true;
		}

		// NOTE: The HTTP_HOST can be spoofed, remove if super paranoid.
		if (isset($_SERVER['HTTP_HOST']))
		{
			if ($host == $_SERVER['HTTP_HOST'])
			{
				return true;
			}
		}

		// This next bit is stolen from Laravel's str_is helper
		$pattern = '#^'.str_replace('\*', '.*', preg_quote($host, '#')).'\z#';

		if ((bool) preg_match($pattern, gethostname()))
		{
			return true;
		}

		// NOTE: The HTTP_HOST can be spoofed, remove if super paranoid.
		if (isset($_SERVER['HTTP_HOST']))
		{
			if ((bool) preg_match($pattern, $_SERVER['HTTP_HOST']))
			{
				return true;
			}
		}

		// No match
		return false;
	};

	// Here you can define as many `cases` or environments as you like.
	// Here are the usual 3 for starters.

	switch(true)
	{
		// Irene Local
		case $env('IreneSalomo'):
		{
			define('FRUCTIFY_ENV', 'local');
			define('DOMAIN_CURRENT_SITE', 'activateconference.au.dev-156.k-d.com.au');
			define('DB_NAME', 'activate_conference');
			define('DB_USER', 'root');
			define('DB_PASSWORD', 'root');
			define('DB_HOST', 'localhost');
			break;
		}
		
		// Irene Home Local
		case $env('Mack_Irene'):
		{
			define('FRUCTIFY_ENV', 'local');
			define('DOMAIN_CURRENT_SITE', 'activateconference.dev.ibs.com.au');
            define('DB_NAME', 'irene_activate');
			define('DB_USER', 'root');
			define('DB_PASSWORD', 'root');
			define('DB_HOST', 'localhost');
			break;
		}

		// Production
		default:
		{
			define('FRUCTIFY_ENV', 'production');
			define('DOMAIN_CURRENT_SITE', 'http://activateconference.org/');
			define('DB_NAME', 'actv8ftp_wrdp1');
			define('DB_USER', 'actv8ftp_wrdp1');
			define('DB_PASSWORD', 'mbaQOJOTuB3s');
			define('DB_HOST', 'mysql');
			define('FORCE_SSL_ADMIN', true);
		}
	}
});

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'D:\Workspace\WordpressProject\ActivateConference\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager


/**
 * Section: WordPress Database Table prefix.
 * =============================================================================
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

$table_prefix  = 'wp_';

/**
 * Section: WordPress debugging mode.
 * =============================================================================
 * For any environment that is not production lets show PHP errors, warnings
 * and notices. I know legacy WordPress code can throw a heap of warnings and
 * deprecated notices but hopefully by forcing these errors to be shown in
 * development environments we will end up with better code.
 */

define('WP_DEBUG', false);
define('SCRIPT_DEBUG', false);

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
define('AUTH_KEY',         '@j?ipQ1nR,yuuCW@Uactivateconference.orgAS-{%gQEpSr_+<dyb+>:Yd#nWbetyh~4rmMUap4Q6rZEcZy');
define('SECURE_AUTH_KEY',  '+hOIBXnJ~C;ftmT([CA|]_wDSactivateconference.orgG<K?#S8{H>//EaLy7]h:jhRfj.K=Usg#g&$9+ox');
define('LOGGED_IN_KEY',    'c8K?-u_wU{BZ2yHK_sbOo1@?!activateconference.org}H<`PM%7^l6VJTY,~DSOJ,zCtVI@Ym$WZi1@5x5');
define('NONCE_KEY',        's5,9YV+%:+HFX#l~ %RE`AZ/pactivateconference.orgUzn<&<R%71t-|[H-L+}AtN9/thH&dMcVM8WN|Q}');
define('AUTH_SALT',        'KUEIq@~d.Tk+~t>1:HS9$8G_*activateconference.orgzG,jcuq2l=7l#KE[-1c)QW3a{LwGi-kwhRVP&]g');
define('SECURE_AUTH_SALT', ';0GoKVCGWIZh:YOa*h[]-T&Diactivateconference.orgnp=:iQ;z$>OkEYNi2@Y`|5-c|n:Jb #}97E?LX7');
define('LOGGED_IN_SALT',   'we3RP{hVolwbVh-((L%LEcHKlactivateconference.org[IaA9<bDvi`h/M:3U7xK8S]A|.Q,2$|*jcOqWNB');
define('NONCE_SALT',       '~<MckLITBiGaIV)497^JDbe-)activateconference.orgG:*}/Prup?HeQMLNLz2kG~d/306X7Noin@gGh7+');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
