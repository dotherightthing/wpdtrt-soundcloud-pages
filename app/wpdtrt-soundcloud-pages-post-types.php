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
      'menu_name' => 'SoundCloud Pages',
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
     */
    'menu_icon' => 'dashicons-media-audio',
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
     */
    //'capabilities',
    /**
     * map_meta_cap
     * Whether to use the internal default meta capability handling.
     * Default: null
     */
    'map_meta_cap' -> null,
    /**
     * hierarchical
     * Whether the post type is hierarchical (e.g. page). Allows Parent to be specified.
     * The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
     * Default: false
     */
    'hierarchical' -> false,
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
    //'taxonomies' -> array('')
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

/**
 * wpdtrt_soundcloud_pages_post_type_rewrite_flush
 * Remove rewrite rules and then recreate rewrite rules (instead of Settings > Permalinks > Save changes)
 * Note: This is an expensive operation so it should only be used when absolutely necessary.
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
}
?>