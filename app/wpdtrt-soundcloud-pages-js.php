<?php
/**
 * JS imports
 *
 * This file contains PHP.
 *
 * @link       http://www.panoramica.co.nz
 * @link       https://codex.wordpress.org/AJAX_in_Plugins
 * @since      0.3.0
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/includes
 */

/**
 * Specify and attach JS for the front-end widget
 */
if ( !function_exists( 'wpdtrt_soundcloud_pages_frontend_js' ) ) {

  add_action( 'wp_enqueue_scripts', 'wpdtrt_soundcloud_pages_frontend_js' );

  function wpdtrt_soundcloud_pages_frontend_js() {

    wp_enqueue_script( 'wpdtrt_soundcloud_pages_frontend_js',
      WPDTRT_SOUNDCLOUD_PAGES_URL . 'views/public/js/wpdtrt-soundcloud-pages.js',
      array('jquery'),
      WPDTRT_SOUNDCLOUD_PAGES_VERSION,
      true
    );

    /**
     * Permit the Ajax call when an Ajax command is submitted,
     * passing it through the Admin Ajax page, and then onto our refresh_data function.
     *
     * wp_localize_script
     * @param string $handle
     * @param string $name
     * @param array $data
     * @link https://codex.wordpress.org/AJAX_in_Plugins
     * @link https://codex.wordpress.org/Function_Reference/wp_localize_script
     */
    wp_localize_script( 'wpdtrt_soundcloud_pages_frontend_js',
      'wpdtrt_soundcloud_pages_config',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ) // wpdtrt_soundcloud_pages_config.ajax_url
      )
    );

  }

}

?>
