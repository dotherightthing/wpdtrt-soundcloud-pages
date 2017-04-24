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
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_frontend_js' ) ) {

  /**
   * Attach JS for front-end widgets and shortcodes
   *    Generate a configuration object which the JavaScript can access.
   *    When an Ajax command is submitted, pass it to our function via the Admin Ajax page.
   *
   * @since       0.1.0
   * @see         https://codex.wordpress.org/AJAX_in_Plugins
   * @see         https://codex.wordpress.org/Function_Reference/wp_localize_script
   */
  function wpdtrt_soundcloud_pages_frontend_js() {

    wp_enqueue_script( 'wpdtrt_soundcloud_pages_frontend_js',
      WPDTRT_SOUNDCLOUD_PAGES_URL . 'views/public/js/wpdtrt-soundcloud-pages.js',
      array('jquery'),
      WPDTRT_SOUNDCLOUD_PAGES_VERSION,
      true
    );

    wp_localize_script( 'wpdtrt_soundcloud_pages_frontend_js',
      'wpdtrt_soundcloud_pages_config',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ) // wpdtrt_soundcloud_pages_config.ajax_url
      )
    );

  }

  add_action( 'wp_enqueue_scripts', 'wpdtrt_soundcloud_pages_frontend_js' );

}

?>
