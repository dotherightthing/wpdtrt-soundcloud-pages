<?php
/**
 * CSS imports
 *
 * This file contains PHP.
 *
 * @link       http://www.panoramica.co.nz
 * @since      0.3.0
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/app
 */

/**
 * Specify and attach CSS for Settings > Boilerplate
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_css_backend' ) ) {

  add_action( 'admin_head', 'wpdtrt_soundcloud_pages_css_backend' );

  function wpdtrt_soundcloud_pages_css_backend() {

    wp_enqueue_style( 'wpdtrt_soundcloud_pages_css_backend',
      WPDTRT_SOUNDCLOUD_PAGES_URL . 'views/admin/css/wpdtrt-soundcloud-pages.css',
      array(),
      WPDTRT_SOUNDCLOUD_PAGES_VERSION
      //'all'
    );
  }

}

/**
 * Specify and attach CSS for the front-end widget
 */
if ( !function_exists( 'wpdtrt_soundcloud_pages_css_frontend' ) ) {

  add_action( 'wp_enqueue_scripts', 'wpdtrt_soundcloud_pages_css_frontend' );

  function wpdtrt_soundcloud_pages_css_frontend() {

    wp_enqueue_style( 'wpdtrt_soundcloud_pages_css_frontend',
      WPDTRT_SOUNDCLOUD_PAGES_URL . 'views/public/css/wpdtrt-soundcloud-pages.css',
      array(),
      WPDTRT_SOUNDCLOUD_PAGES_VERSION
      //'all'
    );

  }
}

?>
