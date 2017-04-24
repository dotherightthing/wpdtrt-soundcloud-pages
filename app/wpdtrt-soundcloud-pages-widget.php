<?php
/**
 * Generate a widget, which is configured in WP Admin, and can be displayed in sidebars.
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/app
 */

  /**
   * Extend WP_Widget
   *    This class must be extended for each widget, and WP_Widget::widget() must be overridden.
   *    Class names should use capitalized words separated by underscores. Any acronyms should be all upper case.
   *
   * @since       0.1.0
   * @uses        ../../../../wp-includes/class-wp-widget.php:
   * @see         https://developer.wordpress.org/reference/classes/wp_widget/
   * @see         https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/#naming-conventions
   */
if ( !class_exists( 'WpDTRT_SoundCloud_Pages_Widget' ) ) {

  class WpDTRT_SoundCloud_Pages_Widget extends WP_Widget {

    function __construct() {
      // Instantiate the parent object
      parent::__construct( false, 'WP SoundCloud Pages Widget' );
    }

    /**
     * Echoes the widget content to the front-end
     */
    function widget( $args, $instance ) {

      /**
       * extract
       * 1. predeclare the variables
       * 2. only overwrite the predeclared variables
       * Removing this causes the widget title to lose its HTML formatting
       * @see http://kb.network.dan/php/wordpress/extract/
       */
      $before_widget = $before_title = $title = $after_title = $after_widget = null;
      extract($args, EXTR_IF_EXISTS);

      /**
       * apply_filters( $tag, $value );
       * Apply the 'widget_title' filter to get the title of the instance.
       * Display the title of this instance, which the user can optionally customise
       */
      $title = apply_filters( 'widget_title', $instance['title'] );
      $number = $instance['number'];
      $enlargement = $instance['enlargement'];

      $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');
      $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

      /**
       * Get the unique ID
       * @see https://kylebenk.com/how-to-wordpress-widget-id/
       */
      // $instance_id = $this->id;

    /**
     * Load the HTML template
     * This function's variables will be available to this template.
     */
      require(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'views/public/partials/wpdtrt-soundcloud-pages-front-end.php');
    }

    /**
     * Updates a particular instance of a widget, by replacing the old instance with data from the new instance
     */
    function update( $new_instance, $old_instance ) {
      // Save user input (widget options)

      $instance = $old_instance;

      /**
       * strip_tags — Strip HTML and PHP tags from a string
       * @example string strip_tags ( string $str [, string $allowable_tags ] )
       * @see http://php.net/manual/en/function.strip-tags.php
       */
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['number'] = strip_tags( $new_instance['number'] );
      $instance['enlargement'] = strip_tags( $new_instance['enlargement'] );

      return $instance;
    }

    /**
     * Outputs the settings update form in wp-admin.
     */
    function form( $instance ) {

      /**
        * Escape HTML attributes to sanitize the data.
        * @example esc_attr( string $text )
        * @see https://developer.wordpress.org/reference/functions/esc_attr/
        */
      $title = esc_attr( $instance['title'] );
      $number = esc_attr( $instance['number'] );
      $enlargement = esc_attr( $instance['enlargement'] );

      $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');
      $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    /**
     * Load the HTML template
     * This function's variables will be available to this template.
     */
      require(WPDTRT_SOUNDCLOUD_PAGES_PATH . 'views/admin/partials/wpdtrt-soundcloud-pages-widget.php');
    }
  }

}

if ( !function_exists( 'wpdtrt_soundcloud_pages_register_widgets' ) ) {

  /**
   * Register the widget
   *
   * @since       0.1.0
   * @uses        ../../../../wp-includes/widgets.php
   * @see         https://codex.wordpress.org/Function_Reference/register_widget#Example
   */

  function wpdtrt_soundcloud_pages_register_widgets() {
    register_widget( 'WpDTRT_SoundCloud_Pages_Widget' );
  }

  add_action( 'widgets_init', 'wpdtrt_soundcloud_pages_register_widgets' );

}

?>
