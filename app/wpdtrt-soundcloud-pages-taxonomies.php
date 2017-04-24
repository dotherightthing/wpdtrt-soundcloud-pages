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

if ( !function_exists( 'wpdtrt_soundcloud_pages_taxonomy_create_interview' ) ) {

    /**
     * Create taxonomy for Interviews.
     *   Interviews are tracks that aren't musical, and aren't part of a mix.
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/taxonomy.php
     * @see         https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    function wpdtrt_soundcloud_pages_taxonomy_create_interview() {

      $labels = array(
        'name'                          => _x( 'Interviews', 'taxonomy general name', 'wpdtrt-soundcloud-pages' ),
        'singular_name'                 => _x( 'Interview', 'taxonomy singular name', 'wpdtrt-soundcloud-pages' ),
        'menu_name'                     => __( 'Interviews', 'wpdtrt-soundcloud-pages' ),
        'all_items'                     => __( 'All Interviews', 'wpdtrt-soundcloud-pages' ),
        'edit_item'                     => __( 'Edit Interview', 'wpdtrt-soundcloud-pages' ),
        'view_item'                     => __( 'View Interview', 'wpdtrt-soundcloud-pages' ),
        'update_item'                   => __( 'Update Interview', 'wpdtrt-soundcloud-pages' ),
        'add_new_item'                  => __( 'Add New Interview', 'wpdtrt-soundcloud-pages' ),
        'new_item_name'                 => __( 'New Interview Name', 'wpdtrt-soundcloud-pages' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'search_items'                  => __( 'Search Interviews', 'wpdtrt-soundcloud-pages' ),
        'popular_items'                 => __( 'Popular Interviews', 'wpdtrt-soundcloud-pages' ),
        'separate_items_with_commas'    => __( 'Separate Interviews with commas', 'wpdtrt-soundcloud-pages' ),
        'add_or_remove_items'           => __( 'Add or remove Interviews', 'wpdtrt-soundcloud-pages' ),
        'choose_from_most_used'         => __( 'Choose from the most used Interviews', 'wpdtrt-soundcloud-pages' ),
        'not_found'                     => __( 'No Interviews found.', 'wpdtrt-soundcloud-pages' ),
      );

      $args = array(
        'labels'                        => $labels,
        'public'                        => true,
        'publicly_queryable'            => true,
        'show_ui'                       => true,
        'show_in_menu'                  => true,
        'show_in_nav_menus'             => true,
        'show_in_rest'                  => true,
        'rest_base'                     => 'interview',
        'rest_controller_class'         => WP_REST_Terms_Controller,
        'show_tagcloud'                 => true,
        'show_in_quick_edit'            => true,
        'meta_box_cb'                   => null,
        'show_admin_column'             => true, // default is false
        'description'                   => __( 'Tracks that aren\'t musical', 'wpdtrt-soundcloud-pages' ),
        'hierarchical'                  => false,
        'update_count_callback'         => '_update_post_term_count',
        'query_var'                     => 'interview',
        'rewrite'                       => array( 'slug' => 'interview' ),
        //'capabilities'                => array( ... ),
        //'sort'                        => boolean
      );

      register_taxonomy( 'interview', 'soundcloud_pages', $args );
    }

    add_action( 'init', 'wpdtrt_soundcloud_pages_taxonomy_create_interview', 0 );
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_taxonomy_create_mix' ) ) {

    /**
     * Create taxonomy for Mixes.
     *   Mixes are collections of tracks, that should be played in a particular order.
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/taxonomy.php
     * @see         https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    function wpdtrt_soundcloud_pages_taxonomy_create_mix() {

      $labels = array(
        'name'                          => _x( 'Mixes', 'taxonomy general name', 'wpdtrt-soundcloud-pages' ),
        'singular_name'                 => _x( 'Mix', 'taxonomy singular name', 'wpdtrt-soundcloud-pages' ),
        'menu_name'                     => __( 'Mixes', 'wpdtrt-soundcloud-pages' ),
        'all_items'                     => __( 'All Mixes', 'wpdtrt-soundcloud-pages' ),
        'edit_item'                     => __( 'Edit Mix', 'wpdtrt-soundcloud-pages' ),
        'view_item'                     => __( 'View Mix', 'wpdtrt-soundcloud-pages' ),
        'update_item'                   => __( 'Update Mix', 'wpdtrt-soundcloud-pages' ),
        'add_new_item'                  => __( 'Add New Mix', 'wpdtrt-soundcloud-pages' ),
        'new_item_name'                 => __( 'New Mix Name', 'wpdtrt-soundcloud-pages' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'search_items'                  => __( 'Search Mixes', 'wpdtrt-soundcloud-pages' ),
        'popular_items'                 => __( 'Popular Mixes', 'wpdtrt-soundcloud-pages' ),
        'separate_items_with_commas'    => __( 'Separate Mixes with commas', 'wpdtrt-soundcloud-pages' ),
        'add_or_remove_items'           => __( 'Add or remove Mixes', 'wpdtrt-soundcloud-pages' ),
        'choose_from_most_used'         => __( 'Choose from the most used Mixes', 'wpdtrt-soundcloud-pages' ),
        'not_found'                     => __( 'No Mixes found.', 'wpdtrt-soundcloud-pages' ),
      );

      $args = array(
        'labels'                        => $labels,
        'public'                        => true,
        'publicly_queryable'            => true,
        'show_ui'                       => true,
        'show_in_menu'                  => true,
        'show_in_nav_menus'             => true,
        'show_in_rest'                  => true,
        'rest_base'                     => 'mix',
        'rest_controller_class'         => WP_REST_Terms_Controller,
        'show_tagcloud'                 => true,
        'show_in_quick_edit'            => true,
        'meta_box_cb'                   => null,
        'show_admin_column'             => true, // default is false
        'description'                   => __( 'A collection of tracks, which should be played in a set order', 'wpdtrt-soundcloud-pages' ),
        'hierarchical'                  => false,
        'update_count_callback'         => '_update_post_term_count',
        'query_var'                     => 'mix',
        'rewrite'                       => array( 'slug' => 'mix' ),
        //'capabilities'                => array( ... ),
        //'sort'                        => boolean
      );

      register_taxonomy( 'mix', 'soundcloud_pages', $args );
    }

    add_action( 'init', 'wpdtrt_soundcloud_pages_taxonomy_create_mix', 0 );
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_taxonomy_create_single' ) ) {

    /**
     * Create taxonomy for Singles.
     *   Singles are tracks that are musical, but aren't part of a mix
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/taxonomy.php
     * @see         https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    function wpdtrt_soundcloud_pages_taxonomy_create_single() {

      $labels = array(
        'name'                          => _x( 'Singles', 'taxonomy general name', 'wpdtrt-soundcloud-pages' ),
        'singular_name'                 => _x( 'Single', 'taxonomy singular name', 'wpdtrt-soundcloud-pages' ),
        'menu_name'                     => __( 'Singles', 'wpdtrt-soundcloud-pages' ),
        'all_items'                     => __( 'All Singles', 'wpdtrt-soundcloud-pages' ),
        'edit_item'                     => __( 'Edit Single', 'wpdtrt-soundcloud-pages' ),
        'view_item'                     => __( 'View Single', 'wpdtrt-soundcloud-pages' ),
        'update_item'                   => __( 'Update Single', 'wpdtrt-soundcloud-pages' ),
        'add_new_item'                  => __( 'Add New Single', 'wpdtrt-soundcloud-pages' ),
        'new_item_name'                 => __( 'New Single Name', 'wpdtrt-soundcloud-pages' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'search_items'                  => __( 'Search Singles', 'wpdtrt-soundcloud-pages' ),
        'popular_items'                 => __( 'Popular Singles', 'wpdtrt-soundcloud-pages' ),
        'separate_items_with_commas'    => __( 'Separate Singles with commas', 'wpdtrt-soundcloud-pages' ),
        'add_or_remove_items'           => __( 'Add or remove Singles', 'wpdtrt-soundcloud-pages' ),
        'choose_from_most_used'         => __( 'Choose from the most used Singles', 'wpdtrt-soundcloud-pages' ),
        'not_found'                     => __( 'No Singles found.', 'wpdtrt-soundcloud-pages' ),
      );

      $args = array(
        'labels'                        => $labels,
        'public'                        => true,
        'publicly_queryable'            => true,
        'show_ui'                       => true,
        'show_in_menu'                  => true,
        'show_in_nav_menus'             => true,
        'show_in_rest'                  => true,
        'rest_base'                     => 'single',
        'rest_controller_class'         => WP_REST_Terms_Controller,
        'show_tagcloud'                 => true,
        'show_in_quick_edit'            => true,
        'meta_box_cb'                   => null,
        'show_admin_column'             => true, // default is false
        'description'                   => __( 'Tracks that are musical, but aren\'t part of a mix', 'wpdtrt-soundcloud-pages' ),
        'hierarchical'                  => false,
        'update_count_callback'         => '_update_post_term_count',
        'query_var'                     => 'single',
        'rewrite'                       => array( 'slug' => 'single' ),
        //'capabilities'                => array( ... ),
        //'sort'                        => boolean
      );

      register_taxonomy( 'single', 'soundcloud_pages', $args );
    }

    add_action( 'init', 'wpdtrt_soundcloud_pages_taxonomy_create_single', 0 );
}

?>
