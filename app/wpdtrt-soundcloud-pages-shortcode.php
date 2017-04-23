<?php
/**
 * Generate a shortcode, to embed the widget inside a content area.
 *
 * This file contains PHP.
 *
 * @link       http://www.panoramica.co.nz
 * @link       https://generatewp.com/shortcodes/
 * @since      0.3.0
 *
 * @example    [wpdtrt_soundcloud_pages_blocks num_blocks="4" tooltip="on"]
 * @example    do_shortcode( '[wpdtrt_soundcloud_pages_blocks num_blocks="4" tooltip="on"]' );
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/includes
 */

/**
 * add_shortcode
 * @param string $tag
 *    Shortcode tag to be searched in post content.
 * @param callable $func
 *    Hook to run when shortcode is found.
 * @see https://codex.wordpress.org/Function_Reference/add_shortcode
 */
if ( !function_exists( 'wpdtrt_soundcloud_pages_blocks_shortcode' ) ) {

  add_shortcode( 'wpdtrt_soundcloud_pages_blocks', 'wpdtrt_soundcloud_pages_blocks_shortcode' );

  function wpdtrt_soundcloud_pages_blocks_shortcode( $atts, $content = null ) {

    // post object to get info about the post in which the shortcode appears
    global $post;

    // prevent error when the front-end.php is used
    // by a shortcode which doesn't pass these variables
    $before_widget = $before_title = $title = $after_title = $after_widget = null;

    extract( shortcode_atts(
      array(
        'number' => '4',
        'enlargement' => 'yes'
      ),
      $atts,
      ''
    ) );

    if ( $enlargement === 'yes') {
      $enlargement = '1';
    }

    if ( $enlargement === 'no') {
      $enlargement = '0';
    }

    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');
    $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    /**
     * ob_start — Turn on output buffering
     * This stores the HTML template in the buffer
     * so that it can be output into the content
     * rather than at the top of the page.
     * @see http://php.net/manual/en/function.ob-start.php
     */
    ob_start();

    require(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'views/public/partials/wpdtrt-soundcloud-pages-front-end.php');

    /**
     * ob_get_clean — Get current buffer contents and delete current output buffer
     * @see http://php.net/manual/en/function.ob-get-clean.php
     */
    $content = ob_get_clean();

    return $content;
  }

}

?>
