<?php
/**
 * Data requests
 *
 * This file contains PHP.
 *
 * @link       http://www.panoramica.co.nz
 * @since      0.3.0
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/includes
 */

/**
 * wpdtrt_soundcloud_pages_data_get
 * @param string $wpdtrt_soundcloud_pages_datatype Required. The type of data to return.
 * @return object $wpdtrt_soundcloud_pages_data. The body of the JSON.
 */
if ( !function_exists( 'wpdtrt_soundcloud_pages_data_get' ) ) {

  function wpdtrt_soundcloud_pages_data_get( $wpdtrt_soundcloud_pages_datatype ) {
    $json_feed_url = 'http://jsonplaceholder.typicode.com/' . $wpdtrt_soundcloud_pages_datatype;

    $args = array(
      'timeout' => 30 // seconds to wait for the request to complete
    );

    /**
     * wp_remote_get( string $url, array $args = array() )
     * Retrieve the raw response from the HTTP request using the GET method.
     * @link https://developer.wordpress.org/reference/functions/wp_remote_get/
     */
    $json_feed = wp_remote_get(
      $json_feed_url,
      $args
    );

    /**
     * Return the body, not the header
     * Note: There is an optional boolean argument, which returns an associative array if TRUE
     */
    $wpdtrt_soundcloud_pages_data = json_decode( $json_feed['body'] );

    return $wpdtrt_soundcloud_pages_data;
  }

}

/**
 * wpdtrt_soundcloud_pages_data_refresh
 * a custom hook that can be used by JavaScript AJAX calls
 * wp_ajax_ is a common prefix
 */
if ( !function_exists( 'wpdtrt_soundcloud_pages_data_refresh' ) ) {

  /**
   * Refresh data
   *
   * The 'action' key's value 'wpdtrt_soundcloud_pages_data_refresh',
   * matches the latter half of the action 'wp_ajax_wpdtrt_soundcloud_pages_data_refresh' in our AJAX handler.
   * This is because it is used to call the server side PHP function through admin-ajax.php.
   * If an action is not specified, admin-ajax.php will exit, and return 0 in the process.
   * @link https://codex.wordpress.org/AJAX_in_Plugins
   */
  add_action('wp_ajax_wpdtrt_soundcloud_pages_data_refresh', 'wpdtrt_soundcloud_pages_data_refresh');

  function wpdtrt_soundcloud_pages_data_refresh() {

    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');
    $last_updated = $wpdtrt_soundcloud_pages_options['last_updated'];

    $current_time = time();
    $update_difference = $current_time - $last_updated;
    $one_hour = (1 * 60 * 60);

    if ( $update_difference > $one_hour ) {

      $wpdtrt_soundcloud_pages_datatype = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_datatype'];

      $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'] = wpdtrt_soundcloud_pages_data_get( $wpdtrt_soundcloud_pages_datatype );

      // inspecting the database will allow us to check
      // whether the profile is being updated
      $wpdtrt_soundcloud_pages_options['last_updated'] = time();

      update_option('wpdtrt_soundcloud_pages', $wpdtrt_soundcloud_pages_options);
    }

    /**
     * Let the Ajax know when the entire function has completed
     *
     * wp_die() vs die() vs exit()
     * Most of the time you should be using wp_die() in your Ajax callback function.
     * This provides better integration with WordPress and makes it easier to test your code.
     * @link https://codex.wordpress.org/AJAX_in_Plugins
     */
    wp_die();

  }

}

?>
