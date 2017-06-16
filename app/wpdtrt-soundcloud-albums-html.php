<?php
/**
 * Functions which generate HTML strings
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_albums_html_date' ) ) {

  /**
   * Generate the HTML for the last modified date
   *
   * @return      string <p class="wpdtrt_soundcloud_albums_date">Last updated 23rd April 2017</p>
   *
   * @since       0.1.0
   */
  function wpdtrt_soundcloud_albums_html_date() {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $last_updated = $wpdtrt_soundcloud_albums_options['last_updated'];

    // use the date format set by the user
    $wp_date_format = get_option('date_format');

    $str = '<p class="wpdtrt-soundcloud-pages-date">Data last updated: ' . date( $wp_date_format, $last_updated ) . '. </p>';

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_html_tracklist' ) ) {

  /**
   * Generate the HTML for the album tracklist
   *
   * @param       string $heading - The tracklist heading
   * @param       array $tracklist - The mix tracklist
   * @return      string $str - <div class="tracklist">...</div>
   *
   * @since       0.5.0
   */
  function wpdtrt_soundcloud_albums_html_tracklist( $heading, $tracklist ) {

    //if ( ( !isset($tracklist) || count($tracklist) < 2 ) ) {
    //  return;
    //}

    $str = '<div class="tracklisting">' . "\r\n";
    $str .= '<h3 id="tracklisting">' . $heading . ':</h3>' . "\r\n";
    $str .= '<dl>' . "\r\n";

    foreach( $tracklist as $track ) {

      $str .= '<dt class="track number">' . $track['index'] . '</dt>' . "\r\n";
      $str .= '<dd class="track">' . "\r\n";
      $str .= '<dl>' . "\r\n";
      $str .= '<dt class="title nav"><span>' . $track['title'] . '</span></dt>' . "\r\n";
      $str .= '<dd class="duration">' . $track['duration'] . '</dd>' . "\r\n";
      $str .= '<dd class="desc">' . $track['description'] . '</dd>' . "\r\n";
      $str .= '</dl>' . "\r\n";
      $str .= '</dd>' . "\r\n";

    }

    $str .= '</dl>' . "\r\n";
    $str .= '</div>' . "\r\n";

    return $str;
  }
}

?>
