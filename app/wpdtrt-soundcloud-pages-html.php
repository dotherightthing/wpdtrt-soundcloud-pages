<?php
/**
 * Functions which generate HTML strings
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_html_date' ) ) {

  /**
   * Generate the HTML for the last modified date
   *
   * @return      string <p class="wpdtrt_soundcloud_pages_date">Last updated 23rd April 2017</p>
   *
   * @since       0.1.0
   */
  function wpdtrt_soundcloud_pages_html_date() {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');

    if ( $wpdtrt_soundcloud_pages_options === '' ) {
      return '';
    }

    // the data set
    $last_updated = $wpdtrt_soundcloud_pages_options['last_updated'];

    // use the date format set by the user
    $wp_date_format = get_option('date_format');

    $str = '<p class="wpdtrt-soundcloud-pages-date">Data last updated: ' . date( $wp_date_format, $last_updated ) . '. </p>';

    return $str;
  }
}

?>
