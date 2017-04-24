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
     * Create posts for each of the SoundCloud Pages
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
     */
    function wpdtrt_soundcloud_pages_create_post( $wpdtrt_soundcloud_pages_page_author, $wpdtrt_soundcloud_pages_page_slug, $wpdtrt_soundcloud_pages_page_title ) {

        // Initialize the page ID to -1. This indicates no action has been taken.
        $post_id = -1;

        // Setup the author, slug, and title for the post
        $author_id = $wpdtrt_soundcloud_pages_page_author;
        $slug = $wpdtrt_soundcloud_pages_page_slug;
        $title = $wpdtrt_soundcloud_pages_page_title;

        // If the page doesn't already exist, then create it
        if ( null == get_page_by_title( $title ) ) {

            // Set the post ID so that we know the post was created successfully
            $post_id = wp_insert_post(
                array(
                    'comment_status'  =>  'closed',
                    'ping_status'   =>  'closed',
                    'post_author'   =>  $author_id,
                    'post_name'   =>  $slug,
                    'post_title'    =>  $title,
                    'post_status'   =>  'publish',
                    'post_type'   =>  'post'
                )
            );

            // Otherwise, we'll stop
            } else {
                // Arbitrarily use -2 to indicate that the page with the title already exists
                $post_id = -2;
            } // end if
        }
    }

    add_filter( 'after_setup_theme', 'wpdtrt_soundcloud_pages_create_post' );
}

?>
