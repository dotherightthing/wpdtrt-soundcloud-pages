<?php
/**
 * Create Posts.
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.4.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_albums_create_post' ) ) {

    /**
     * Create a SoundCloud Page as a post
     *
     * @param       number $wpdtrt_soundcloud_albums_page_author
     *    The ID of the author to attribute the page to
     * @param       string $wpdtrt_soundcloud_albums_page_slug
     *    The page slug
     * @param       number $wpdtrt_soundcloud_albums_page_title
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
    function wpdtrt_soundcloud_albums_create_post( $author_id, $slug, $title, $date, $excerpt, $content, $category, $soundcloud_permalink_url ) {

        $postExists = get_page_by_title($title, OBJECT, 'soundcloud_albums');

        // If the page doesn't already exist, then create it
        if ( is_null( $postExists ) ) {

            $my_post = array(
              'comment_status'  =>  'closed',
              'ping_status'   =>  'closed',
              'post_author'   =>  $author_id,
              'post_name'   =>  $slug,
              'post_title'    =>  $title,
              'post_status'   =>  'publish',
              'post_type'   =>  'soundcloud_albums',
              'post_date' => date("Y-m-d H:i:s", strtotime($date)),
              'post_excerpt' => $excerpt,
              'post_content' => $content
            );

            $post_id = wp_insert_post( $my_post );

            // add post to the correct category
            wp_set_post_terms( $post_id, array( (int)$category ), 'albumtype' );

            // store the SoundCloud permalink URL so we can reference it in the template
            add_post_meta($post_id, 'soundcloud_permalink_url', $soundcloud_permalink_url, $unique);

        // else update the existing page
        } else {

          $post_id = $postExists->ID;

          $my_post = array(
            'ID' => $post_id,
            'post_title' => $title,
            'post_excerpt' => $excerpt,
            'post_content' => $content
          );

          wp_update_post( $my_post );

          // add post to the correct category
          wp_set_post_terms( $post_id, array( (int)$category ), 'albumtype' );

          // update the SoundCloud permalink URL which is referenced in the template
          if ( ! add_post_meta($post_id, 'soundcloud_permalink_url', $soundcloud_permalink_url, true) ) {
             update_post_meta( $post_id, 'soundcloud_permalink_url', $soundcloud_permalink_url );
          }

        }
    }

}

if ( !function_exists( 'wpdtrt_soundcloud_albums_create_posts' ) ) {

    /**
     * Create all SoundCloud Albums
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/post.php
     * @see         https://codex.wordpress.org/Plugin_API/Action_Reference/wp_insert_post
     * @see         https://tommcfarlin.com/programmatically-create-a-post-in-wordpress/
     */

    function wpdtrt_soundcloud_albums_create_posts() {

      /**
       * Load the plugin data stored in the WP Options table
       * Retrieves an option value based on an option name.
       * @example get_option( string $option, mixed $default = false )
       */
      $wpdtrt_soundcloud_albums_options = get_option( 'wpdtrt_soundcloud_albums' );

      if ( $wpdtrt_soundcloud_albums_options !== '' ) {

        $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

        foreach( $wpdtrt_soundcloud_albums_data as $key => $val ) {

          $author = 1; // To check, could make an option for this
          $slug = wpdtrt_soundcloud_albums_post_slug($key);
          $title = wpdtrt_soundcloud_albums_post_title( $key );
          $date = wpdtrt_soundcloud_albums_post_date($key, '-');
          $excerpt = wpdtrt_soundcloud_albums_post_excerpt($key);
          $content = wpdtrt_soundcloud_albums_post_content($key);

          if ( $excerpt == null ){
            $excerpt = 'No excerpt..';
          }

          $tracklist = wpdtrt_soundcloud_albums_post_tracklist($key);
          $tracklist_html = wpdtrt_soundcloud_albums_html_tracklist( 'Tracklisting', $tracklist );
          $content .= $tracklist_html;

          $category = wpdtrt_soundcloud_albums_post_category($key);
          $soundcloud_permalink_url = wpdtrt_soundcloud_albums_post_permalink_url($key);

          if ( ( $slug !== '') && ( $title !== '' ) ) {
            wpdtrt_soundcloud_albums_create_post( $author, $slug, $title, $date, $excerpt, $content, $category, $soundcloud_permalink_url );
          }
          else {
            error_log($key);
          }
        }
      }
    }

    // taxonomies do not exist yet
    //add_filter( 'after_setup_theme', 'wpdtrt_soundcloud_albums_create_posts' ); // TODO - times out
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_title' ) ) {

  /**
   * Retrieve the page title
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string title
   *
   * @since       0.1.0
   */
  function wpdtrt_soundcloud_albums_post_title( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'title'} ) ) {

      $str .= $wpdtrt_soundcloud_albums_data[$key]->{'title'};

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_slug' ) ) {

  /**
   * Retrieve the page slug
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string slug
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_albums_post_slug( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'permalink'} ) ) {

      $str .= $wpdtrt_soundcloud_albums_data[$key]->{'permalink'};

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_permalink_url' ) ) {

  /**
   * Retrieve the SoundCloud page's permalink_url
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string slug
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_albums_post_permalink_url( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'permalink_url'} ) ) {

      $str .= $wpdtrt_soundcloud_albums_data[$key]->{'permalink_url'};

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_date' ) ) {

  /**
   * Retrieve the release date
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string date
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_albums_post_date( $key, $separator ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'release_day'} ) ) {

      $release_day = $wpdtrt_soundcloud_albums_data[$key]->{'release_day'};
      $release_month = $wpdtrt_soundcloud_albums_data[$key]->{'release_month'};
      $release_year = $wpdtrt_soundcloud_albums_data[$key]->{'release_year'};

      $release_date = $release_year . $separator . $release_month . $separator . $release_day;

      $str .= $release_date;

    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_excerpt' ) ) {

  /**
   * Extract excerpt from SoundCloud content
   *
   * @since 0.4.0
   * @uses http://www.codecheese.com/2013/11/get-the-first-paragraph-as-an-excerpt-for-wordpress/
   */
  function wpdtrt_soundcloud_albums_post_excerpt($key) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $excerpt = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'description'} ) ) {

      $content = $wpdtrt_soundcloud_albums_data[$key]->{'description'};

      $content_paragraphs = explode("\n", $content);

      // we want to return everything except the first paragraph
      $offset = strlen( $content_paragraphs[0] );

      $excerpt = substr( $content, 0, $offset );

      return $excerpt;
    }
  }

}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_content' ) ) {

  /**
   * Retrieve the content
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string content
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_albums_post_content( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'description'} ) ) {

      $content = $wpdtrt_soundcloud_albums_data[$key]->{'description'};

      $content_paragraphs = explode("\n", $content);

      /**
       * Convert SoundCloud 'headings' into HTML headings
       *  Regex: uppercase strings of more than 2 letters, followed by a line break
       *
       * @since 0.4.0
       * @see http://www.regexr.com/
       * @see https://www.functions-online.com/preg_match_all.html
       * @see http://stackoverflow.com/questions/2638288/preg-replace-to-capitalize-a-letter-after-a-quote
       */

      $pattern = '/^([A-Z0-9 ]{2,}[\n])$/m';
      $content = preg_replace_callback($pattern, function ($matches) {
        return "<h3>" . ucwords( strtolower($matches[0]) ) . "</h3>\n";
      }, $content);

      // we want to return everything except the first paragraph
      $offset = strlen( $content_paragraphs[0] );

      // reset content
      $content_less_excerpt = substr( $content, $offset );

      // output the trimmed content
      $str = $content_less_excerpt;
    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_category' ) ) {

  /**
   * Retrieve the category
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      string category
   *
   * @since       0.4.0
   */
  function wpdtrt_soundcloud_albums_post_category( $key ) {

    // if options have not been stored, exit
    $wpdtrt_soundcloud_albums_options = get_option('wpdtrt_soundcloud_albums');

    if ( $wpdtrt_soundcloud_albums_options === '' ) {
      return '';
    }

    // the data set
    $wpdrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];

    $str = '';

    if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'playlist_type'} ) ) {

      $category = $wpdtrt_soundcloud_albums_data[$key]->{'playlist_type'};
      error_log('term='.$category);

      $term = get_term_by('slug', $category, 'albumtype'); // , 'my_custom_taxonomy'
      $str = $term->term_id;
      error_log('term_id='.$str );
    }

    return $str;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_tracklist' ) ) {

  /**
   * Retrieve the tracklist (if album is a mix)
   *
   * @param       string $key
   *    The key of the corresponding JSON object
   * @return      array $tracklist
   *
   * @since       0.5.0
   */
  function wpdtrt_soundcloud_albums_post_tracklist( $key ) {

    // if options have not been stored, exit
    $tracklist = array();

    $wpdtrt_soundcloud_albums_options = get_option( 'wpdtrt_soundcloud_albums' );

    if ( $wpdtrt_soundcloud_albums_options !== '' ) {

      $wpdtrt_soundcloud_albums_data = $wpdtrt_soundcloud_albums_options['wpdtrt_soundcloud_albums_data'];
      $album_title = wpdtrt_soundcloud_albums_post_title( $key ) . ' ';
      $str = '';

      if ( isset( $wpdtrt_soundcloud_albums_data[$key]->{'tracks'} ) ) {

        $tracks = $wpdtrt_soundcloud_albums_data[$key]->{'tracks'};
        $tracklist_length = count($tracks);

        if ( $tracklist_length > 1 ) {

          $counter = 1;
          $elapsedDuration = 0;

          foreach ($tracks as $track) {

            // tracks are verbosely named in SoundCloud, so that they context when played individually
            $title = str_replace( $album_title, '', $track->{'title'} );
            // strip remaining dash and digits (- 01, - 02 etc)
            $title = preg_replace( '/(^- )+([0-9]+)( )+/', '', $title);

            $tracklist[] = array(
              "index" => ( $counter++ ),
              //"duration" => gmdate('H:i:s', $track->{'duration'}),
              "duration" => wpdtrt_soundcloud_albums_post_hms( $track->{'duration'} ),
              //$elapsedDuration = ( $elapsedDuration + $track['duration'] );
              //"downloadable" => $track->{'downloadable'},
              //"download_url" => $track->{'download_url'},
              //"purchase_url" => $track->{'purchase_url'},
              "title" => $title,
              "description" => $track->{'description'}
            );
          }
        }
      }
    }

    return $tracklist;
  }
}

if ( !function_exists( 'wpdtrt_soundcloud_albums_post_hms' ) ) {

  /**
   * Convert the track duration into hours/minutes/seconds
   * Added span wraps to apply titles
   *
   * @param       number duration The duration in milliseconds
   * @return      str $hms
   * @see         http://www.laughing-buddha.net/jon/php/sec2hms/
   *
   * @since       0.5.0
   */
  function wpdtrt_soundcloud_albums_post_hms( $milliseconds, $padHours = false ) {
    $sec = $milliseconds/1000;

    // holds formatted string
    $hms = "";

    // there are 3600 seconds in an hour, so if we
    // divide total seconds by 3600 and throw away
    // the remainder, we've got the number of hours
    $hours = intval(intval($sec) / 3600);

    // add to $hms, with a leading 0 if asked for
    $hms .= ($padHours)
          ? '<span title="hours">' . str_pad($hours, 2, "0", STR_PAD_LEFT). '</span>:'
          : '<span title="hours">' . $hours. '</span>:';

    // dividing the total seconds by 60 will give us
    // the number of minutes, but we're interested in
    // minutes past the hour: to get that, we need to
    // divide by 60 again and keep the remainder
    $minutes = intval(($sec / 60) % 60);

    // then add to $hms (with a leading 0 if needed)
    $hms .= '<span title="minutes">' . str_pad($minutes, 2, "0", STR_PAD_LEFT). '</span>:';

    // seconds are simple - just divide the total
    // seconds by 60 and keep the remainder
    $seconds = intval($sec % 60);

    // add to $hms, again with a leading 0 if needed
    $hms .= '<span title="seconds">' . str_pad($seconds, 2, "0", STR_PAD_LEFT). '</span>';

    // done!
    return $hms;

  }
}

?>
