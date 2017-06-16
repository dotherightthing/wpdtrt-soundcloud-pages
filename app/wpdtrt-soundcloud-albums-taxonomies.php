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
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/includes
 */

if ( !function_exists( 'wpdtrt_soundcloud_albums_taxonomy_albumtype' ) ) {

    /**
     * Create taxonomy for Album types.
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/taxonomy.php
     * @see         https://codex.wordpress.org/Function_Reference/register_taxonomy
     * @see         https://www.smashingmagazine.com/2012/01/create-custom-taxonomies-wordpress/
     * @see         https://code.tutsplus.com/articles/the-rewrite-api-post-types-taxonomies--wp-25488
     */
    function wpdtrt_soundcloud_albums_taxonomy_albumtype() {

      $labels = array(
        'name'                          => _x( 'Album type', 'taxonomy general name', 'wpdtrt-soundcloud-albums' ),
        'singular_name'                 => _x( 'Album type', 'taxonomy singular name', 'wpdtrt-soundcloud-albums' ),
        'menu_name'                     => __( 'Album type', 'wpdtrt-soundcloud-albums' ),
        'all_items'                     => __( 'All Album types', 'wpdtrt-soundcloud-albums' ),
        'edit_item'                     => __( 'Edit Album type', 'wpdtrt-soundcloud-albums' ),
        'view_item'                     => __( 'View Album type', 'wpdtrt-soundcloud-albums' ),
        'update_item'                   => __( 'Update Album type', 'wpdtrt-soundcloud-albums' ),
        //'add_new_item'                  => __( 'Add New Album type', 'wpdtrt-soundcloud-albums' ),
        //'new_item_name'                 => __( 'New Album type Name', 'wpdtrt-soundcloud-albums' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'search_items'                  => __( 'Search Album types', 'wpdtrt-soundcloud-albums' ),
        'popular_items'                 => __( 'Popular Album types', 'wpdtrt-soundcloud-albums' ),
        'separate_items_with_commas'    => __( 'Separate Album types with commas', 'wpdtrt-soundcloud-albums' ),
        //'add_or_remove_items'           => __( 'Add or remove Album types', 'wpdtrt-soundcloud-albums' ),
        'choose_from_most_used'         => __( 'Choose from the most used Album types', 'wpdtrt-soundcloud-albums' ),
        'not_found'                     => __( 'No Album types found.', 'wpdtrt-soundcloud-albums' ),
      );

      $args = array(
        'labels'                        => $labels,
        'public'                        => true,
        'publicly_queryable'            => true,
        'show_ui'                       => false, // allows user to manage categories, view counts by category
        'show_in_menu'                  => false,
        'show_in_nav_menus'             => true,
        //'show_in_rest'                  => true,
        //'rest_base'                     => 'albumtype',
        //'rest_controller_class'         => WP_REST_Terms_Controller,
        //'show_tagcloud'                 => true,
        'show_in_quick_edit'            => false,
        'meta_box_cb'                   => null,
        'show_admin_column'             => true, // default is false
        'description'                   => __( 'The Album type assigned in SoundCloud', 'wpdtrt-soundcloud-albums' ),
        'hierarchical'                  => true, // Hierarchical taxonomy (like categories)
        //'update_count_callback'         => '_update_post_term_count',
        'query_var'                     => 'albumtype',
        'rewrite'                       => array(
          //'slug' => '', // This controls the base slug that will display before each term // disabled as conflicts with post type
          'with_front' => false, // Don't display the category base before "/locations/"
          'hierarchical' => true // This will allow URL's like "/compilations/"
        ),
        //'capabilities'                  => array(),
        //'sort'                        => boolean
      );

      register_taxonomy( 'albumtype', 'soundcloud_albums', $args );

      // https://wordpress.stackexchange.com/a/47688
      if ( !term_exists( 'EP', 'albumtype') ) {
        wp_insert_term( 'EP', 'albumtype', array(
          'description' => 'A small collection of tracks',
          'slug' => 'ep'
        ) );
      }
      if ( !term_exists( 'Single', 'albumtype') ) {
        wp_insert_term( 'Single', 'albumtype', array(
          'description' => 'A single track and any remixes',
          'slug' => 'single'
        ) );
      }
      if ( !term_exists( 'Compilation', 'albumtype') ) {
        wp_insert_term( 'Compilation', 'albumtype', array(
          'description' => 'A full-length collection of tracks',
          'slug' => 'compilation'
        ) );
      }
      if ( !term_exists( 'Album', 'albumtype') ) {
        wp_insert_term( 'Album', 'albumtype', array(
          'description' => 'A full-length collection of tracks that are united in theme',
          'slug' => 'album'
        ) );
      }
    }

    // you need to register the Custom Taxonomy BEFORE the Custom Post Type that it belongs to in order for the rewrite rule to work.
    // The taxonomy needs to “exist” before the post type in order for WordPress to build the URL correctly.
    // https://cnpagency.com/blog/the-right-way-to-do-wordpress-custom-taxonomy-rewrites/
    add_action( 'init', 'wpdtrt_soundcloud_albums_taxonomy_albumtype', 0 );
}

?>
