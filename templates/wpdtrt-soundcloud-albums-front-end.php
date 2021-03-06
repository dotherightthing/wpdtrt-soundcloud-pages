<?php
/**
 * Template partial for the public front-end
 *
 * This file contains PHP, and HTML.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/views
 */
?>

<?php
  // output widget customisations (not output with shortcode)
  echo $before_widget;
  echo $before_title . $title . $after_title;
?>

<div class="wpdtrt-soundcloud-albums-blocks frontend" data-number="<?php echo $number; ?>">
  <ul>

  <?php
  /**
   * cast the $number string to a number
   * this is required because we are doing a === comparison:
   * 1 == '1' => true
   * 1 === '1' => false
   */
    $max_length = (int)$number;
    $count = 0;
    $display_count = 1;

   /**
     * filter_var
     * @see http://stackoverflow.com/a/15075609
     */
    $has_enlargement = filter_var( $enlargement, FILTER_VALIDATE_BOOLEAN );

    foreach( $wpdtrt_soundcloud_albums_data as $key => $val ) {

      echo "<li>";

      //echo wpdtrt_soundcloud_albums_html_image( $key, $has_enlargement );

      echo "</li>\r\n";

      $count++;
      $display_count++;

      // when we reach the end of the demo sample, stop looping
      if ($count === $max_length) {
        break;
      }
    }
    // end foreach
  ?>
  </ul>
</div>

<?php
  // output widget customisations (not output with shortcode)
  echo $after_widget;
?>
