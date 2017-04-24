<?php
/**
 * Custom Post Type
 *
 * This file contains PHP.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.4.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/app
 */

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_type_create' ) ) {

    /**
     * Create custom post type for SoundCloud Pages
     *    Pages may only be generated by the plugin.
     *    'do_not_allow' (capabilities) removes support for the "Add New" function
     * @see         http://stackoverflow.com/questions/3235257/wordpress-disable-add-new-on-custom-post-type#27488805
     *
     * @return      The registered post type object, or an error object.
     *
     * @since       0.4.0
     * @uses        ../../../../wp-includes/post.php
     * @see         https://codex.wordpress.org/Function_Reference/register_post_type
     */
    function wpdtrt_soundcloud_pages_post_type_create() {

        $labels = array(
            'name' =>                   __('SoundCloud Pages', 'wpdtrt-soundcloud-pages'),
            'singular_name' =>          __('SoundCloud Page', 'wpdtrt-soundcloud-pages'),
            'add_new' =>                _x('Add new SoundCloud Page', 'post', 'wpdtrt-soundcloud-pages'),
            'add_new_item' =>           __('Add SoundCloud Page', 'wpdtrt-soundcloud-pages'),
            'edit_item' =>              __('Edit SoundCloud Page', 'wpdtrt-soundcloud-pages'),
            'new_item' =>               __('New SoundCloud Page', 'wpdtrt-soundcloud-pages'),
            'view_item' =>              __('View SoundCloud Page', 'wpdtrt-soundcloud-pages'),
            'view_items' =>             __('View SoundCloud Pages', 'wpdtrt-soundcloud-pages'),
            'search_items' =>           __('Search SoundCloud Pages', 'wpdtrt-soundcloud-pages'),
            'not_found' =>              __('No SoundCloud Pages Found', 'wpdtrt-soundcloud-pages'),
            'not_found_in_trash' =>     __('No SoundCloud Pages found in Trash', 'wpdtrt-soundcloud-pages'),
            'parent_item_colon' =>      '',
            'all_items' =>              __('All', 'wpdtrt-soundcloud-pages'),
            'archives' =>               __('SoundCloud Archives', 'wpdtrt-soundcloud-pages'),
            'attributes' =>             __('SoundCloud Page Attributes', 'wpdtrt-soundcloud-pages'),
            'insert_into_item' =>       __('Insert into SoundCloud Page', 'wpdtrt-soundcloud-pages'),
            'uploaded_to_this_item' =>  __('Uploaded to this SoundCloud page', 'wpdtrt-soundcloud-pages'),
            'featured_image' =>         __('Featured Image', 'wpdtrt-soundcloud-pages'),
            'set_featured_image' =>     __('Set featured image', 'wpdtrt-soundcloud-pages'),
            'remove_featured_image' =>  __('Remove featured image', 'wpdtrt-soundcloud-pages'),
            'use_featured_image' =>     __('Use as featured image.', 'wpdtrt-soundcloud-pages'),
            'menu_name' =>              __('Sound Pages', 'wpdtrt-soundcloud-pages'),
            'filter_items_list' =>      '',
            'items_list_navigation' =>  '',
             'items_list' =>            '',
            'name_admin_bar' =>         __('SoundCloud Page', 'wpdtrt-soundcloud-pages'),
        );

        register_post_type( 'soundcloud_pages', array(
            'labels' =>                 $labels,
            'description' =>            __('A page showcasing an audio file or files hosted on SoundCloud', 'wpdtrt-soundcloud-pages'),
            'public' =>                 true,
            'exclude_from_search' =>    false,
            'publicly_queryable' =>     true,
            'show_ui' =>                true,
            'show_in_nav_menus' =>      true,
            'show_in_menu' =>           true,
            'show_in_admin_bar' =>      true,
            'menu_position' =>          20, // below pages
            'menu_icon' =>              'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="M528 1372l16-241-16-523q-1-10-7.5-17t-16.5-7q-9 0-16 7t-7 17l-14 523 14 241q1 10 7.5 16.5t15.5 6.5q22 0 24-23zm296-29l11-211-12-586q0-16-13-24-8-5-16-5t-16 5q-13 8-13 24l-1 6-10 579q0 1 11 236v1q0 10 6 17 9 11 23 11 11 0 20-9 9-7 9-20zm-1045-340l20 128-20 126q-2 9-9 9t-9-9l-17-126 17-128q2-9 9-9t9 9zm86-79l26 207-26 203q-2 9-10 9-9 0-9-10l-23-202 23-207q0-9 9-9 8 0 10 9zm280 453zm-188-491l25 245-25 237q0 11-11 11-10 0-12-11l-21-237 21-245q2-12 12-12 11 0 11 12zm94-7l23 252-23 244q-2 13-14 13-13 0-13-13l-21-244 21-252q0-13 13-13 12 0 14 13zm94 18l21 234-21 246q-2 16-16 16-6 0-10.5-4.5t-4.5-11.5l-20-246 20-234q0-6 4.5-10.5t10.5-4.5q14 0 16 15zm383 475zm-289-621l21 380-21 246q0 7-5 12.5t-12 5.5q-16 0-18-18l-18-246 18-380q2-18 18-18 7 0 12 5.5t5 12.5zm94-86l19 468-19 244q0 8-5.5 13.5t-13.5 5.5q-18 0-20-19l-16-244 16-468q2-19 20-19 8 0 13.5 5.5t5.5 13.5zm98-40l18 506-18 242q-2 21-22 21-19 0-21-21l-16-242 16-506q0-9 6.5-15.5t14.5-6.5q9 0 15 6.5t7 15.5zm392 742zm-198-746l15 510-15 239q0 10-7.5 17.5t-17.5 7.5-17-7-8-18l-14-239 14-510q0-11 7.5-18t17.5-7 17.5 7 7.5 18zm99 19l14 492-14 236q0 11-8 19t-19 8-19-8-9-19l-12-236 12-492q1-12 9-20t19-8 18.5 8 8.5 20zm212 492l-14 231q0 13-9 22t-22 9-22-9-10-22l-6-114-6-117 12-636v-3q2-15 12-24 9-7 20-7 8 0 15 5 14 8 16 26zm1112-19q0 117-83 199.5t-200 82.5h-786q-13-2-22-11t-9-22v-899q0-23 28-33 85-34 181-34 195 0 338 131.5t160 323.5q53-22 110-22 117 0 200 83t83 201z"/></svg>
            '
        ),
        'capability_type' =>            'post',
        'capabilities' =>               array( 'create_posts' => 'do_not_allow' ),
        'map_meta_cap' =>               null,
        'hierarchical' =>               false,
        'supports' =>                   array( 'title', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes' ),
        'taxonomies' =>                 array( 'interview', 'single', 'mix' ),
        'has_archive' =>                false,
        'rewrite' =>                    array( 'slug' => 'music' ),
        'permalink_epmask' =>           EP_PERMALINK,
        'query_var' =>                  'soundcloud_pages',
        'can_export' =>                 true,
        'delete_with_user' =>           null,
        'show_in_rest' =>               false,
        'rest_base' =>                  'soundcloud_pages',
        'rest_controller_class' =>      WP_REST_Posts_Controller
      ));
    }

    add_action( 'init', 'wpdtrt_soundcloud_pages_post_type_create' );
}

if ( !function_exists( 'wpdtrt_soundcloud_pages_post_type_create_rewrite_flush' ) ) {

    /**
     * Remove and recreate rewrite rules
     *    Registers a plugin function to be run when the plugin is activated.
     *    Rewrite rules are them removed and then recreated (instead of Settings > Permalinks > Save changes).
     *    This is an expensive operation.
     *
     * @since       0.4.0
     * @see         https://codex.wordpress.org/Function_Reference/register_post_type#Flushing_Rewrite_on_Activation
     */
    function wpdtrt_soundcloud_pages_post_type_create_rewrite_flush() {

        wpdtrt_soundcloud_pages_post_type_create();

        flush_rewrite_rules();
    }

    register_activation_hook( __FILE__, 'wpdtrt_soundcloud_pages_post_type_create_rewrite_flush' );
}

?>
