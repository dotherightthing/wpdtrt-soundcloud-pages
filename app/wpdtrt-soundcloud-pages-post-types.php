<?php
/**
 * Custom Post Type
 *
 * This file contains PHP.
 *
 * @link       http://www.panoramica.co.nz
 * @since      0.3.0
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/includes
 */

/**
 * wpdtrt_soundcloud_pages_post_type
 * @return The registered SoundCloud pages post type object, or an error object.
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', 'wpdtrt_soundcloud_pages_post_type' );

function wpdtrt_soundcloud_pages_post_type() {

  /**
   * register_post_type( $post_type, $args );
   * Create or modify a post type.
   * @return The registered post type object, or an error object.
   *
   * $post_type,
   * (string) (required) Post type.
   * (max. 20 characters, cannot contain capital letters or spaces)
   * Default: None
   */
  register_post_type( 'soundcloud_pages', array(
    'labels' => array(
      /**
       * name
       * general name for the post type, usually plural.
       * The same and overridden by $post_type_object->label.
       * Default is Posts/Pages
       */
      'name' => 'SoundCloud Pages',
      /**
       * singular_name
       * name for one object of this post type.
       * Default is Post/Page
       */
      'singular_name' => 'SoundCloud Page',
      /**
       * add_new
       * the add new text.
       * The default is "Add New" for both hierarchical and non-hierarchical post types.
       * When internationalizing this string, please use a gettext context matching your post type.
       * example: _x('Add New', 'product')
       */
      'add_new' => 'Add SoundCloud Page',
      /**
       * add_new_item
       * Default is Add New Post/Add New Page.
       */
      'add_new_item' => 'Add SoundCloud Page',
      /**
       * edit_item
       * Default is Edit Post/Edit Page.
       */
      'edit_item' => 'Edit SoundCloud Page',
      /**
       * new_item
       * Default is New Post/New Page.
       */
      'new_item' => 'New SoundCloud Page',
      /**
       * view_item
       * Default is View Post/View Page.
       */
      'view_item' => 'View SoundCloud Page',
      /**
       * view_items
       * Label for viewing post type archives.
       * Default is 'View Posts' / 'View Pages'.
       */
      'view_items' => 'View SoundCloud Pages',
      /**
       * search_items
       * Default is Search Posts/Search Pages.
       */
      'search_items' => 'Search SoundCloud Pages',
      /**
       * not_found
       * Default is No posts found/No pages found.
       */
      'not_found' =>  'No SoundCloud Pages Found',
      /**
       * not_found_in_trash
       * Default is No posts found in Trash/No pages found in Trash.
       */
      'not_found_in_trash' => 'No SoundCloud Pages found in Trash',
      /**
       * parent_item_colon
       * This string isn't used on non-hierarchical types.
       * In hierarchical ones the default is 'Parent Page:'.
       */
      'parent_item_colon' => '',
      /**
       * all_items
       * String for the submenu.
       * Default is All Posts/All Pages.
       */
      'all_items' => 'All SoundCloud Pages',
      /**
       * archives
       * String for use with archives in nav menus.
       * Default is Post Archives/Page Archives.
       */
      'archives' => 'SoundCloud Archives',
      /**
       * attributes
       * Label for the attributes meta box.
       * Default is 'Post Attributes' / 'Page Attributes'.
       */
      'attributes' => 'SoundCloud Page Attributes',
      /**
       * insert_into_item
       * String for the media frame button.
       * Default is Insert into post/Insert into page.
       */
      'insert_into_item' => 'Insert into SoundCloud Page',
      /**
       * uploaded_to_this_item
       * String for the media frame filter.
       * Default is Uploaded to this post/Uploaded to this page.
       */
      'uploaded_to_this_item' => 'Uploaded to this SoundCloud page',
      /**
       * featured_image
       * Default is Featured Image.
       */
      'featured_image' => 'Featured Image',
      /**
       * set_featured_image
       * Default is Set featured image.
       */
      'set_featured_image' => 'Set featured image',
      /**
       * remove_featured_image
       * Default is Remove featured image.
       */
      'remove_featured_image' => 'Remove featured image',
      /**
       * use_featured_image
       * Default is Use as featured image.
       */
      'use_featured_image' => 'Use as featured image.',
      /**
       * menu_name
       * Default is the same as `name`.
       */
      'menu_name' => 'SC Pages',
      /**
       * filter_items_list
       * String for the table views hidden heading.
       */
      'filter_items_list' => '',
      /**
       * items_list_navigation
       * String for the table pagination hidden heading.
       */
      'items_list_navigation' => '',
      /**
       * items_list
       * String for the table hidden heading.
       */
       'items_list' => '',
      /**
       * name_admin_bar
       * String for use in New in Admin menu bar.
       * Default is the same as `singular_name`.
       */
      'name_admin_bar' => 'SoundCloud Page'
    ),
    /**
     * description
     * A short descriptive summary of what the post type is.
     * Default: blank
     */
    'description' => '',
    /**
     * public
     * Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers
     * Default: false
     */
    'public' => true,
    /**
     * exclude_from_search
     * Whether to exclude posts with this post type from front end search results.
     * Default: value of the opposite of public argument
     */
    'exclude_from_search' => false,
    /**
     * publicly_queryable
     * Whether queries can be performed on the front end as part of parse_request().
     * Default: value of public argument
     */
    'publicly_queryable' => true,
    /**
     * show_ui
     * Whether to generate a default UI for managing this post type in the admin.
     * Default: value of public argument
     */
    'show_ui' => true,
    /**
     * show_in_nav_menus
     * Whether post_type is available for selection in navigation menus.
     * Default: value of public argument
     */
    'show_in_nav_menus' => true,
    /**
     * show_in_menu
     * Where to show the post type in the admin menu. show_ui must be true.
     * Default: value of show_ui argument
     */
    'show_in_menu' => true,
    /**
     * show_in_admin_bar
     * Whether to make this post type available in the WordPress admin bar.
     * Default: value of the show_in_menu argument
     */
    'show_in_admin_bar' => true,
    /**
     * menu_position
     * The position in the menu order the post type should appear. show_in_menu must be true.
     * Default: null - defaults to below Comments
     */
    'menu_position' => 20, // below pages
    /**
     * menu_icon
     * The url to the icon to be used for this menu or the name of the icon from the iconfont
     * Default: null - defaults to the posts icon
     * Non-dashicon classes are converted to a (broken) image path, but a base64 encoded SVG is supported
     * @link https://wordpress.stackexchange.com/questions/126609/how-to-add-font-awesome-icons-to-wordpress-menus
     */
    'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="black" d="M528 1372l16-241-16-523q-1-10-7.5-17t-16.5-7q-9 0-16 7t-7 17l-14 523 14 241q1 10 7.5 16.5t15.5 6.5q22 0 24-23zm296-29l11-211-12-586q0-16-13-24-8-5-16-5t-16 5q-13 8-13 24l-1 6-10 579q0 1 11 236v1q0 10 6 17 9 11 23 11 11 0 20-9 9-7 9-20zm-1045-340l20 128-20 126q-2 9-9 9t-9-9l-17-126 17-128q2-9 9-9t9 9zm86-79l26 207-26 203q-2 9-10 9-9 0-9-10l-23-202 23-207q0-9 9-9 8 0 10 9zm280 453zm-188-491l25 245-25 237q0 11-11 11-10 0-12-11l-21-237 21-245q2-12 12-12 11 0 11 12zm94-7l23 252-23 244q-2 13-14 13-13 0-13-13l-21-244 21-252q0-13 13-13 12 0 14 13zm94 18l21 234-21 246q-2 16-16 16-6 0-10.5-4.5t-4.5-11.5l-20-246 20-234q0-6 4.5-10.5t10.5-4.5q14 0 16 15zm383 475zm-289-621l21 380-21 246q0 7-5 12.5t-12 5.5q-16 0-18-18l-18-246 18-380q2-18 18-18 7 0 12 5.5t5 12.5zm94-86l19 468-19 244q0 8-5.5 13.5t-13.5 5.5q-18 0-20-19l-16-244 16-468q2-19 20-19 8 0 13.5 5.5t5.5 13.5zm98-40l18 506-18 242q-2 21-22 21-19 0-21-21l-16-242 16-506q0-9 6.5-15.5t14.5-6.5q9 0 15 6.5t7 15.5zm392 742zm-198-746l15 510-15 239q0 10-7.5 17.5t-17.5 7.5-17-7-8-18l-14-239 14-510q0-11 7.5-18t17.5-7 17.5 7 7.5 18zm99 19l14 492-14 236q0 11-8 19t-19 8-19-8-9-19l-12-236 12-492q1-12 9-20t19-8 18.5 8 8.5 20zm212 492l-14 231q0 13-9 22t-22 9-22-9-10-22l-6-114-6-117 12-636v-3q2-15 12-24 9-7 20-7 8 0 15 5 14 8 16 26zm1112-19q0 117-83 199.5t-200 82.5h-786q-13-2-22-11t-9-22v-899q0-23 28-33 85-34 181-34 195 0 338 131.5t160 323.5q53-22 110-22 117 0 200 83t83 201z"/></svg>
'),
    /**
     * capability_type
     * The string to use to build the read, edit, and delete capabilities.
     * Default: "post"
     */
    'capability_type' => 'post',
    /**
     * capabilities
     * An array of the capabilities for this post type.
     * Default: capability_type is used to construct
     * 'do_not_allow': Removes support for the "Add New" function, including Super Admins
     * @link http://stackoverflow.com/questions/3235257/wordpress-disable-add-new-on-custom-post-type#27488805
     */
    'capabilities' => array(
      'create_posts' => 'do_not_allow'
    ),
    //'capabilities',
    /**
     * map_meta_cap
     * Whether to use the internal default meta capability handling.
     * Default: null
     * Set to false, if users are not allowed to edit/delete existing posts
     * @link http://stackoverflow.com/questions/3235257/wordpress-disable-add-new-on-custom-post-type#27488805
     */
    'map_meta_cap' => null,
    /**
     * hierarchical
     * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified.
     * The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
     * Default: false
     */
    'hierarchical' => false,
    /**
     * supports
     * An alias for calling add_post_type_support() directly.
     * As of 3.5, boolean false can be passed as value instead of an array to prevent default (title and editor) behavior.
     * Default: title and editor
     * Available:
     * 'title'
     * 'editor' (content)
     * 'author'
     * 'thumbnail' (featured image, current theme must also support post-thumbnails)
     * 'excerpt'
     * 'trackbacks'
     * 'custom-fields'
     * 'comments' (also will see comment count balloon on edit screen)
     * 'revisions' (will store revisions)
     * 'page-attributes' (menu order, hierarchical must be true to show Parent option)
     * 'post-formats' add post formats, see Post Formats
     */
    'supports' => array(
      'title',
      'editor',
      'revisions'
    ),
    /**
     * register_meta_box_cb
     * Provide a callback function that will be called when setting up the meta boxes for the edit form.
     * The callback function takes one argument $post, which contains the WP_Post object for the currently edited post.
     * Do remove_meta_box() and add_meta_box() calls in the callback.
     * Default: None
     */
    //'register_meta_box_cb'
    /**
     * taxonomies
     * An array of registered taxonomies like category or post_tag that will be used with this post type.
     * This can be used in lieu of calling register_taxonomy_for_object_type() directly.
     * Custom taxonomies still need to be registered with register_taxonomy().
     * Default: no taxonomies
     */
    //'taxonomies' => array('')
    /**
     * has_archive
     * Enables post type archives.
     * Will use $post_type as archive slug by default.
     * Default: false
     */
    'has_archive' => false,
    /**
     * rewrite
     * Triggers the handling of rewrites for this post type.
     * To prevent rewrites, set to false.
     * If registering a post type inside of a plugin, call flush_rewrite_rules()
     * in your activation and deactivation hook to refresh your permalink structure.
     * Default: true and use $post_type as slug
     */
    'rewrite' => array(
      'slug' => 'music'
    ),
    /**
     * permalink_epmask
     * The default rewrite endpoint bitmasks.
     * Default: EP_PERMALINK
     */
    'permalink_epmask' => EP_PERMALINK,
    /**
     * query_var
     * Sets the query_var key for this post type.
     * Default: true - set to $post_type
     */
    // query_var
    /**
     * can_export
     * Can this post_type be exported.
     * Default: true
     */
    'can_export' => true,
    /**
     * delete_with_user
     * Whether to delete posts of this type when deleting a user.
     * Default: null
     */
    'delete_with_user' => null,
    /**
     * show_in_rest
     * Whether to expose this post type in the REST API.
     * Default: false
     */
    'show_in_rest' => false,
    /**
     * rest_base
     * The base slug that this post type will use when accessed using the REST API.
     * Default: $post_type
     */
    //'rest_base'
    /**
     * rest_controller_class
     * An optional custom controller to use instead of WP_REST_Posts_Controller.
     * Must be a subclass of WP_REST_Controller.
     * Default: WP_REST_Posts_Controller
     */
    'rest_controller_class' => WP_REST_Posts_Controller
  ));
}

/**
 * wpdtrt_soundcloud_pages_post_type_rewrite_flush
 * The register_activation_hook function registers a plugin function to be run when the plugin is activated.
 * Rewrite rules are them removed and then recreated (instead of Settings > Permalinks > Save changes)
 * This is an expensive operation so it should only be used when absolutely necessary.
 * @link https://codex.wordpress.org/Function_Reference/register_post_type#Flushing_Rewrite_on_Activation
 */

register_activation_hook( __FILE__, 'wpdtrt_soundcloud_pages_post_type_rewrite_flush' );

function wpdtrt_soundcloud_pages_post_type_rewrite_flush() {
  // First, we "add" the custom post type via the above written function.
  // Note: "add" is written with quotes, as CPTs don't get added to the DB,
  // They are only referenced in the post_type column with a post entry,
  // when you add a post of this CPT.
  wpdtrt_soundcloud_pages_post_type();

  // ATTENTION: This is *only* done during plugin activation hook in this example!
  // You should *NEVER EVER* do this on every page load!!
  flush_rewrite_rules();
}

?>