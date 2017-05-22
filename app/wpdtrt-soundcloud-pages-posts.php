<?php
/**
 * Create Posts.
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.4.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_create_post' ) ) {

    /**
     * Create a SoundCloud Page as a post
     *
     * @param       number $wpdtrt_soundcloud_pages_page_author
     *    The ID of the author to attribute the page to
     * @param       string $wpdtrt_soundcloud_pages_page_slug
     *    The page slug
     * @param       number $wpdtrt_soundcloud_pages_page_title
     *    The page title
     *
     * @return      number Post ID or error code
     *    -1 if the post was never created
     *    -2 if a post with the same title exists
     *    the post ID if the post was created successfully
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/post.php
     * @see         https://codex.wordpress.org/Plugin_API/Action_Reference/wp_insert_post
     * @see         https://tommcfarlin.com/programmatically-create-a-post-in-wordpress/
     * @see         https://wordpress.stackexchange.com/questions/37163/proper-formatting-of-post-date-for-wp-insert-post#37164
     */
    function wpdtrt_soundcloud_pages_create_post( $author_id, $slug, $title, $date, $content, $category ) {

        $postExists = get_page_by_title($title, OBJECT, 'soundcloud_pages');

        // If the page doesn't already exist, then create it
        if ( is_null( $postExists ) ) {

            $my_post = array(
              'comment_status'  =>  'closed',
              'ping_status'   =>  'closed',
              'post_author'   =>  $author_id,
              'post_name'   =>  $slug,
              'post_title'    =>  $title,
              'post_status'   =>  'publish',
              'post_type'   =>  'soundcloud_pages',
              'post_date' => date("Y-m-d H:i:s", strtotime($date)),
              'post_content' => $content
            );

            $post_id = wp_insert_post( $my_post );

            // add post to the correct category
            wp_set_post_terms( $post_id, array( (int)$category ), 'playlisttype' );

        // else update the existing page
        } else {

          $post_id = $postExists->ID;

          $my_post = array(
            'ID' => $post_id,
            'post_title' => $title,
            'post_content' => $content
          );

          wp_update_post( $my_post );

          // add post to the correct category
          wp_set_post_terms( $post_id, array( (int)$category ), 'playlisttype' );
        }
    }

}

if ( !function_exists( 'wpdtrt_soundcloud_pages_create_posts' ) ) {

    /**
     * Create all SoundCloud Pages
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/post.php
     * @see         https://codex.wordpress.org/Plugin_API/Action_Reference/wp_insert_post
     * @see         https://tommcfarlin.com/programmatically-create-a-post-in-wordpress/
     */

    function wpdtrt_soundcloud_pages_create_posts() {

      /**
       * Load the plugin data stored in the WP Options table
       * Retrieves an option value based on an option name.
       * @example get_option( string $option, mixed $default = false )
       */
      $wpdtrt_soundcloud_pages_options = get_option( 'wpdtrt_soundcloud_pages' );

      if ( $wpdtrt_soundcloud_pages_options !== '' ) {

        $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

        foreach( $wpdtrt_soundcloud_pages_data as $key => $val ) {

          $author = 1; // To check, could make an option for this
          $slug = wpdtrt_soundcloud_pages_post_slug( $key );
          $title = wpdtrt_soundcloud_pages_post_title( $key );
          $date = wpdtrt_soundcloud_pages_post_date($key, '-');
          $content = wpdtrt_soundcloud_pages_post_content($key);
          $category = wpdtrt_soundcloud_pages_post_category($key);

          if ( ( $slug !== '') && ( $title !== '' ) ) {
            wpdtrt_soundcloud_pages_create_post( $author, $slug, $title, $date, $content, $category );
          }
          else {
            error_log($key);
          }
        }
      }
    }

    // taxonomies do not exist yet
    //add_filter( 'after_setup_theme', 'wpdtrt_soundcloud_pages_create_posts' ); // TODO - times out
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_title' ) ) {

  /**
   * Retrieve the page title
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string title
   *
   * @since       0.1.0
   */
  function wpdtrt_soundcloud_pages_post_title( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');

    if ( $wpdtrt_soundcloud_pages_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_pages_data[$key]->{'title'} ) ) {

      $str .= $wpdtrt_soundcloud_pages_data[$key]->{'title'};

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_slug' ) ) {

  /**
   * Retrieve the page slug
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string slug
   *
   * @since       0.1.0
   */
  function wpdtrt_soundcloud_pages_post_slug( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');

    if ( $wpdtrt_soundcloud_pages_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_pages_data[$key]->{'permalink'} ) ) {

      $str .= $wpdtrt_soundcloud_pages_data[$key]->{'permalink'};

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_date' ) ) {

  /**
   * Retrieve the release date
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string date
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_pages_post_date( $key, $separator ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');

    if ( $wpdtrt_soundcloud_pages_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_pages_data[$key]->{'release_day'} ) ) {

      $release_day = $wpdtrt_soundcloud_pages_data[$key]->{'release_day'};
      $release_month = $wpdtrt_soundcloud_pages_data[$key]->{'release_month'};
      $release_year = $wpdtrt_soundcloud_pages_data[$key]->{'release_year'};

      $release_date = $release_year . $separator . $release_month . $separator . $release_day;

      $str .= $release_date;

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_content' ) ) {

  /**
   * Retrieve the content
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string content
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_pages_post_content( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');

    if ( $wpdtrt_soundcloud_pages_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_pages_data[$key]->{'description'} ) ) {

      $str .= $wpdtrt_soundcloud_pages_data[$key]->{'description'};

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_category' ) ) {

  /**
   * Retrieve the category
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string category
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_pages_post_category( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_pages_options = get_option('wpdtrt_soundcloud_pages');

    if ( $wpdtrt_soundcloud_pages_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_pages_data[$key]->{'playlist_type'} ) ) {

      $category = $wpdtrt_soundcloud_pages_data[$key]->{'playlist_type'};
      error_log('term='.$category);

      $term = get_term_by('slug', $category, 'playlisttype'); // , 'my_custom_taxonomy'
      $str = $term->term_id;
      error_log('term_id='.$str );
    }

    return $str;
  }
}

?>
