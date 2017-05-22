<?php
/**
 * Taxonomies
 * Custom categories for organising SoundCloud tracks
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.4.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/includes
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_taxonomy_playlisttype' ) ) {

    /**
     * Create taxonomy for Playlist types.
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/taxonomy.php
     * @see         https://codex.wordpress.org/Function_Reference/register_taxonomy
     * @see         https://www.smashingmagazine.com/2012/01/create-custom-taxonomies-wordpress/
     */
    function wpdtrt_soundcloud_pages_taxonomy_playlisttype() {

      $labels = array(
        'name'                          => _x( 'Playlist type', 'taxonomy general name', 'wpdtrt-soundcloud-pages' ),
        'singular_name'                 => _x( 'Playlist type', 'taxonomy singular name', 'wpdtrt-soundcloud-pages' ),
        'menu_name'                     => __( 'Playlist type', 'wpdtrt-soundcloud-pages' ),
        'all_items'                     => __( 'All Playlist types', 'wpdtrt-soundcloud-pages' ),
        'edit_item'                     => __( 'Edit Playlist type', 'wpdtrt-soundcloud-pages' ),
        'view_item'                     => __( 'View Playlist type', 'wpdtrt-soundcloud-pages' ),
        'update_item'                   => __( 'Update Playlist type', 'wpdtrt-soundcloud-pages' ),
        //'add_new_item'                  => __( 'Add New Playlist type', 'wpdtrt-soundcloud-pages' ),
        //'new_item_name'                 => __( 'New Playlist type Name', 'wpdtrt-soundcloud-pages' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'search_items'                  => __( 'Search Playlist types', 'wpdtrt-soundcloud-pages' ),
        'popular_items'                 => __( 'Popular Playlist types', 'wpdtrt-soundcloud-pages' ),
        'separate_items_with_commas'    => __( 'Separate Playlist types with commas', 'wpdtrt-soundcloud-pages' ),
        //'add_or_remove_items'           => __( 'Add or remove Playlist types', 'wpdtrt-soundcloud-pages' ),
        'choose_from_most_used'         => __( 'Choose from the most used Playlist types', 'wpdtrt-soundcloud-pages' ),
        'not_found'                     => __( 'No Playlist types found.', 'wpdtrt-soundcloud-pages' ),
      );

      $args = array(
        'labels'                        => $labels,
        'public'                        => true,
        'publicly_queryable'            => true,
        'show_ui'                       => false, // allows user to manage categories, view counts by category
        'show_in_menu'                  => false,
        'show_in_nav_menus'             => true,
        //'show_in_rest'                  => true,
        //'rest_base'                     => 'playlisttype',
        //'rest_controller_class'         => WP_REST_Terms_Controller,
        //'show_tagcloud'                 => true,
        'show_in_quick_edit'            => false,
        'meta_box_cb'                   => null,
        'show_admin_column'             => true, // default is false
        'description'                   => __( 'The Playlist type assigned in SoundCloud', 'wpdtrt-soundcloud-pages' ),
        'hierarchical'                  => true, // Hierarchical taxonomy (like categories)
        //'update_count_callback'         => '_update_post_term_count',
        'query_var'                     => 'playlisttype',
        'rewrite'                       => array(
          //'slug' => '', // This controls the base slug that will display before each term // disabled as conflicts with post type
          'with_front' => false, // Don't display the category base before "/locations/"
          'hierarchical' => true // This will allow URL's like "/compilations/"
        ),
        //'capabilities'                  => array(),
        //'sort'                        => boolean
      );

      register_taxonomy( 'playlisttype', 'soundcloud_pages', $args );

      // https://wordpress.stackexchange.com/a/47688
      if ( !term_exists( 'EP', 'playlisttype') ) {
        wp_insert_term( 'EP', 'playlisttype', array(
          'description' => 'A small collection of tracks',
          'slug' => 'ep'
        ) );
      }
      if ( !term_exists( 'Single', 'playlisttype') ) {
        wp_insert_term( 'Single', 'playlisttype', array(
          'description' => 'A single track and any remixes',
          'slug' => 'single'
        ) );
      }
      if ( !term_exists( 'Compilation', 'playlisttype') ) {
        wp_insert_term( 'Compilation', 'playlisttype', array(
          'description' => 'A full-length collection of tracks',
          'slug' => 'compilation'
        ) );
      }
      if ( !term_exists( 'Album', 'playlisttype') ) {
        wp_insert_term( 'Album', 'playlisttype', array(
          'description' => 'A full-length collection of tracks that are united in theme',
          'slug' => 'album'
        ) );
      }
    }

    add_action( 'init', 'wpdtrt_soundcloud_pages_taxonomy_playlisttype', 0 );
}

?>
