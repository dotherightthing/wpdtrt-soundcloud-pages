<?php
/*
Plugin Name:  WP SoundCloud Pages
Plugin URI:   http://www.panoramica.co.nz
Description:  Generate WordPress pages from SoundCloud pages
Version:      0.3.0
Author:       Dan Smith
Author URI:   http://dotherightthing.co.nz
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wpdtrt-soundcloud-pages
Domain Path:  /languages
*/

/**
 * Constants
 * WordPress makes use of the following constants when determining the path to the content and plugin directories.
 * These should not be used directly by plugins or themes, but are listed here for completeness.
 * WP_CONTENT_DIR  // no trailing slash, full paths only
 * WP_CONTENT_URL  // full url
 * WP_PLUGIN_DIR  // full path, no trailing slash
 * WP_PLUGIN_URL  // full url, no trailing slash
 *
 * WordPress provides several functions for easily determining where a given file or directory lives.
 * Always use these functions in your plugins instead of hard-coding references to the wp-content directory
 * or using the WordPress internal constants.
 * plugins_url()
 * plugin_dir_url()
 * plugin_dir_path()
 * plugin_basename()
 *
 * @see https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Constants
 * @see https://codex.wordpress.org/Determining_Plugin_and_Content_Directories#Plugins
 */

/**
 * Plugin version
 * WP provides get_plugin_data(), but it only works within WP Admin,
 * so we define a constant instead.
 * @example $plugin_data = get_plugin_data( __FILE__ ); $plugin_version = $plugin_data['Version'];
 * @link https://wordpress.stackexchange.com/questions/18268/i-want-to-get-a-plugin-version-number-dynamically
 */
if( ! defined( 'WPDTRT_SOUNDCLOUD_PAGES_VERSION' ) ) {
  define( 'WPDTRT_SOUNDCLOUD_PAGES_VERSION', '0.1' );
}

/**
 * plugin_dir_path
 * @param string $file
 * @return The filesystem directory path (with trailing slash)
 * @link https://developer.wordpress.org/reference/functions/plugin_dir_path/
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 */
if( ! defined( 'WPDTRT_SOUNDCLOUD_PAGES_PATH' ) ) {
  define( 'WPDTRT_SOUNDCLOUD_PAGES_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * The version information is only available within WP Admin
 * @param string $file
 * @return The URL (with trailing slash)
 * @link https://codex.wordpress.org/Function_Reference/plugin_dir_url
 * @link https://developer.wordpress.org/plugins/the-basics/best-practices/#prefix-everything
 */
if( ! defined( 'WPDTRT_SOUNDCLOUD_PAGES_URL' ) ) {
  define( 'WPDTRT_SOUNDCLOUD_PAGES_URL', plugin_dir_url( __FILE__ ) );
}


/**
 * Store all of our plugin options in an array
 * So that we only use have to consume one row in the WP Options table
 * WordPress automatically serializes this (into a string)
 * because MySQL does not support arrays as a data type
 */
  $wpdtrt_soundcloud_pages_options = array();

/**
 * Include plugin logic
 */

  // API data
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-api.php');

  // Views
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-options-page.php');
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-widget.php');
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-post-types.php');
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-taxonomies.php');

  // Theming
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-html.php');
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-css.php');
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-js.php');

  // Shortcode
  require_once(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'app/wpdtrt-soundcloud-pages-shortcode.php');

?>
