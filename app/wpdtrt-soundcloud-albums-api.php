<?php
/**
 * API requests
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_albums_get_userid' ) ) {

  /**
   * Get the user's SoundCloud user ID
   *
   * @param       string $wpdtrt_soundcloud_albums_username
   *    The user's SoundCloud user name (https://soundcloud.com/username)
   * @param      string $wpdtrt_soundcloud_albums_clientid
   *    The user's SoundCloud Client ID (http://soundcloud.com/you/apps/new)
   * @return      string The user ID
   *
   * @since       0.4.0
   * @see         https://developers.soundcloud.com/docs/api/reference#resolve
   */
  function wpdtrt_soundcloud_albums_get_userid( $wpdtrt_soundcloud_albums_username, $wpdtrt_soundcloud_albums_clientid ) {

    $resource = 'http://api.soundcloud.com/resolve?url=http://soundcloud.com/' . $wpdtrt_soundcloud_albums_username . '&client_id=' . $wpdtrt_soundcloud_albums_clientid;

    $args = array(
      'timeout' => 60 // seconds to wait for the request to complete
    );

    /**
     * wp_remote_get( string $url, array $args = array() )
     * Retrieve the raw response from the HTTP request using the GET method.
     * @see https://developer.wordpress.org/reference/functions/wp_remote_get/
     */
    $response = wp_remote_get(
      $resource,
      $args
    );

    $data = json_decode( $response['body'] );

    $userid = $data->{'id'};

    return $userid;
  }
}


if ( !function_exists( 'wpdtrt_soundcloud_albums_get_data' ) ) {

  /**
   * Request the data from the API
   *
   * To access public SoundCloud resources, you just have to pass a client_id parameter.
   *
   * @param       string $wpdtrt_soundcloud_albums_username
   *    The user's SoundCloud user name (https://soundcloud.com/username)
   * @param      string $wpdtrt_soundcloud_albums_clientid
   *    The user's SoundCloud Client ID (http://soundcloud.com/you/apps/new)
   * @return      object The response body in JSON format
   *
   * @since       0.1.0
   * @uses        ../../../../wp-includes/http.php
   * @see         https://developer.wordpress.org/reference/functions/wp_remote_get/
   * @see         https://developers.soundcloud.com/docs/api/reference
   */
  function wpdtrt_soundcloud_albums_get_data( $wpdtrt_soundcloud_albums_username, $wpdtrt_soundcloud_albums_clientid ) {

    $wpdtrt_soundcloud_albums_userid = wpdtrt_soundcloud_albums_get_userid( $wpdtrt_soundcloud_albums_username, $wpdtrt_soundcloud_albums_clientid );

    $endpoint = 'https://api.soundcloud.com/users/' . $wpdtrt_soundcloud_albums_userid . '/playlists?client_id=' . $wpdtrt_soundcloud_albums_clientid;

    $response = wp_remote_get(
      $endpoint,
      $args
    );

    /**
     * Return the body, not the header
     * Note: There is an optional boolean argument, which returns an associative array if TRUE
     */
    $data = json_decode( $response['body'] );

    return $data;
  }

}

if ( !function_exists( 'wpdtrt_soundcloud_albums_data_refresh' ) ) {

  /**
   * Refresh the data from the API
   *    The 'action' key's value, wpdtrt_soundcloud_albums_data_refresh,
   *    matches the latter half of the action 'wp_ajax_wpdtrt_soundcloud_albums_data_refresh' in our AJAX handler.
   *    This is because it is used to call the server side PHP function through admin-ajax.php.
   *    If an action is not specified, admin-ajax.php will exit, and return 0 in the process.
   *
   * @since       0.1.0
   * @see         https://codex.wordpress.org/AJAX_in_Plugins
   */
  function wpdtrt_soundcloud_albums_data_refresh() {

    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');
    $last_updated = $wpdtrt_soundcloud_albums_options['last_updated'];

    $current_time = time();
    $update_difference = $current_time - $last_updated;
    $one_hour = (1 * 60 * 60);

    if ( $update_difference > $one_hour ) {

      $wpdtrt_soundcloud_albums_username = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_username'];
      $wpdtrt_soundcloud_albums_clientid = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_clientid'];

      $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'] = wpdtrt_soundcloud_albums_get_data( $wpdtrt_soundcloud_albums_username, $wpdtrt_soundcloud_albums_clientid );

      // inspecting the database will allow us to check
      // whether the profile is being updated
      $wpdtrt_soundcloud_albums_options['last_updated'] = time();

      update_option('wpdtrt_soundcloud_albums', $wpdtrt_soundcloud_albums_options);
    }

    /**
     * Let the Ajax know when the entire function has completed
     *
     * wp_die() vs die() vs exit()
     * Most of the time you should be using wp_die() in your Ajax callback function.
     * This provides better integration with WordPress and makes it easier to test your code.
     */
    wp_die();

  }

  add_action('wp_ajax_wpdtrt_soundcloud_albums_data_refresh', 'wpdtrt_soundcloud_albums_data_refresh');

}

?>
