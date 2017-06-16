<?php
/**
 * JS imports
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @see         https://codex.wordpress.org/AJAX_in_Plugins
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_albums_frontend_js' ) ) {

  /**
   * Attach JS for front-end widgets and shortcodes
   *    Generate a configuration object which the JavaScript can access.
   *    When an Ajax command is submitted, pass it to our function via the Admin Ajax page.
   *
   * @since       0.1.0
   * @see         https://codex.wordpress.org/AJAX_in_Plugins
   * @see         https://codex.wordpress.org/Function_Reference/wp_localize_script
   */
  function wpdtrt_soundcloud_albums_frontend_js() {

    wp_enqueue_script( 'wpdtrt_soundcloud_albums_player_js',
      'https://w.soundcloud.com/player/api.js',
      array('wpdtrt_soundcloud_albums_frontend_js'),
      false,
      true
    );

    wp_enqueue_script( 'wpdtrt_soundcloud_albums_frontend_js',
      WPDTRT_SOUNDCLOUD_ALBUMS_URL . 'views/public/js/wpdtrt-soundcloud-albums.js',
      array('jquery'),
      WPDTRT_SOUNDCLOUD_ALBUMS_VERSION,
      true
    );

    global $post;

    wp_localize_script( 'wpdtrt_soundcloud_albums_frontend_js',
      'wpdtrt_soundcloud_albums_config',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ), // wpdtrt_soundcloud_albums_config.ajax_url
        'soundcloud_permalink_url' => get_post_meta($post->ID, 'soundcloud_permalink_url', true)
      )
    );

  }

  add_action( 'wp_enqueue_scripts', 'wpdtrt_soundcloud_albums_frontend_js' );

  // https://wordpress.stackexchange.com/questions/69579/how-to-get-the-post-id-when-creating-js-variables-with-localize-script
  //add_action( 'wp', 'my_localize_post_id' );
}

?>
