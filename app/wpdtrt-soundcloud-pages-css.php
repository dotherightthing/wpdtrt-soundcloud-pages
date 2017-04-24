<?php
/**
 * CSS imports
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_css_backend' ) ) {

  /**
   * Attach CSS for Settings > SoundCloud Pages
   *
   * @since       0.1.0
   */
  function wpdtrt_soundcloud_pages_css_backend() {

    wp_enqueue_style( 'wpdtrt_soundcloud_pages_css_backend',
      WPDTRT_SOUNDCLOUD_PAGES_URL . 'views/admin/css/wpdtrt-soundcloud-pages.css',
      array(),
      WPDTRT_SOUNDCLOUD_PAGES_VERSION
      //'all'
    );
  }

  add_action( 'admin_head', 'wpdtrt_soundcloud_pages_css_backend' );

}

if ( !function_exists( 'wpdtrt_soundcloud_pages_css_frontend' ) ) {

  /**
   * Attach CSS for front-end widgets and shortcodes
   *
   * @since      0.1.0
   */
  function wpdtrt_soundcloud_pages_css_frontend() {

    wp_enqueue_style( 'wpdtrt_soundcloud_pages_css_frontend',
      WPDTRT_SOUNDCLOUD_PAGES_URL . 'views/public/css/wpdtrt-soundcloud-pages.css',
      array(),
      WPDTRT_SOUNDCLOUD_PAGES_VERSION
      //'all'
    );

  }

  add_action( 'wp_enqueue_scripts', 'wpdtrt_soundcloud_pages_css_frontend' );

}

?>
