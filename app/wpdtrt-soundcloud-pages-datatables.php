<?php
  /**
   * Admin data tables
   *
   * This file contains PHP.
   *
   * @link        http://www.panoramica.co.nz
   * @since       0.4.0
   *
   * @package     WpDTRT_SoundCloud_Pages
   * @subpackage  WpDTRT_SoundCloud_Pages/app
   * @see         https://www.sitepoint.com/using-wp_list_table-to-create-wordpress-admin-tables/
   */

  if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
  }

  class WpDTRT_SoundCloud_Pages_List_Table extends WP_List_Table {

    /**
     * Class constructor
     *
     * @see http://stackoverflow.com/questions/5844814/how-to-pass-php-variable-into-a-class-function
     */

    public function __construct() {

      parent::__construct( [
        'singular' => __( 'Album', 'sp' ), //singular name of the listed records
        'plural'   => __( 'Albums', 'sp' ), //plural name of the listed records
        'ajax'     => false //does this table support ajax?
      ] );

    }

    /**
     * Retrieve albums data
     *
     * @param int $per_page (not used)
     * @param int $page_number (not used)
     *
     * @return mixed
     */
    public function get_albums( $per_page = 5, $page_number = 1 ) {

      global $wpdtrt_soundcloud_pages_options;

      $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

      $wpdtrt_soundcloud_pages_data_array_a = array();

      foreach( $wpdtrt_soundcloud_pages_data as $key => $val ) {

        $playlist_type = $wpdtrt_soundcloud_pages_data[$key]->{'playlist_type'};
        $permalink_url = $wpdtrt_soundcloud_pages_data[$key]->{'permalink_url'};
        $title = $wpdtrt_soundcloud_pages_data[$key]->{'title'};
        $username = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_username'];
        $release_day = $wpdtrt_soundcloud_pages_data[$key]->{'release_day'};
        $release_month = $wpdtrt_soundcloud_pages_data[$key]->{'release_month'};
        $release_year = $wpdtrt_soundcloud_pages_data[$key]->{'release_year'};
        $release_date = $release_year . '.' . $release_month . '.' . $release_day;

        $id = str_replace('http://soundcloud.com/' . $username . '/sets/', '', $permalink_url);

        if ( isset( $playlist_type ) ) {

          /**
           * Build an associative array
           *  as that is what WP expects from an SQL query, when ARRAY_A is specified
           * @example $wpdb->get_results( $sql, 'ARRAY_A' );
           */
          $wpdtrt_soundcloud_pages_data_array_a[] = array(
            'title' => $title,
            'type' => ucfirst($playlist_type),
            'release_date' => $release_date,
            'id' => $id
          );
        }
      }

      /**
       * Get the ordering parameters from the URL
       * @uses https://www.smashingmagazine.com/2011/11/native-admin-tables-wordpress/#comment-173455
       * @todo Support date sorting (release_date)
       */
      $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';
      $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'type';

      /**
       * Sort the associative array
       *  as a SQL query would also be sorted
       * @uses http://stackoverflow.com/a/22610655
       */
      usort($wpdtrt_soundcloud_pages_data_array_a, function($a, $b) use ($orderby, $order) {
        // $orderby and $order are available in this scope (PHP 5.3+)
        if ( $order === 'asc' ) {
          return strcmp( $a[ $orderby ], $b[ $orderby ] );
        }
        else if ( $order === 'desc' ) {
          return strcmp( $b[ $orderby ], $a[ $orderby ] );
        }

      });

      return $wpdtrt_soundcloud_pages_data_array_a;
    }


    /**
     * Returns the count of albums in the array
     *
     * @return null|string
     * @todo this could be out, if default playlists are included here
     */
    public static function album_count() {

      global $wpdtrt_soundcloud_pages_options;

      $wpdtrt_soundcloud_pages_data = $wpdtrt_soundcloud_pages_options['wpdtrt_soundcloud_pages_data'];

      return count( $wpdtrt_soundcloud_pages_data );
    }


    /** Text displayed when no album data is available */
    public function no_items() {
      _e( 'No albums available.', 'sp' );
    }


    /**
     * Render a column when no column specific method exist.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default( $item, $column_name ) {
      switch ( $column_name ) {
        case 'title':
        case 'type':
        case 'release_date':
          return $item[ $column_name ];
        default:
          return print_r( $item, true ); //Show the whole array for troubleshooting purposes
      }
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     * @see https://www.sitepoint.com/community/t/using-wp-list-table-to-create-wordpress-admin-tables/189427/6
     */
    public function column_cb( $item ) {
      return sprintf(
        '<input type="checkbox" name="%1$s" value="%2$s" />',
        $item['id'], //$1%s
        $item['title']//$2%s
      );
    }


    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    public function column_name( $item ) {

      $delete_nonce = wp_create_nonce( 'sp_delete_album' );

      $title = '<strong>' . $item['name'] . '</strong>';

      //$actions = [
      //  'delete' => sprintf( '<a href="?page=%s&action=%s&album=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $delete_nonce )
      //];

      //return $title . $this->row_actions( $actions );
      return $title;
    }


    /**
     *  Associative array of columns
     *
     * @return array
     */
    public function get_columns() {
      $columns = array(
        'cb'            => '<input type="checkbox" />',
        'title'         => __( 'Title', 'wpdtrt_soundcloud_pages' ),
        'type'          => __( 'Type', 'wpdtrt_soundcloud_pages' ),
        'release_date'  => __( 'Release date', 'wpdtrt_soundcloud_pages' ),
      );

      return $columns;
    }


    /**
     * Columns to make sortable.
     *
     * @return array
     */
    public function get_sortable_columns() {
      $sortable_columns = array(
        'title'         => array('title', true), // sortable
        'type'          => array('type', true), // sortable
        //'release_date'  => array('release_date', true) // sortable
      );

      // note: 'title' => 'title' outputs the query parameter as orderby=t
      // note: 'release_date' => 'release_date' outputs the query parameter as orderby=r

      return $sortable_columns;
    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions() {
      $actions = [
        'bulk-delete' => 'Delete'
      ];

      return $actions;
    }

    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items() {

      //$this->_column_headers = $this->get_column_info(); // nope, returns nothing

      $columns = $this->get_columns();
      $hidden = array();
      $sortable = $this->get_sortable_columns();
      $this->_column_headers = array($columns, $hidden, $sortable);

      /** Process bulk action */
      $this->process_bulk_action();

      $current_page = $this->get_pagenum();
      $total_items  = self::album_count();
      $per_page     = $this->get_items_per_page( 'albums_per_page', $total_items );

      $this->set_pagination_args( [
        'total_items' => $total_items, //WE have to calculate the total number of items
        'per_page'    => $per_page //WE have to determine how many items to show on a page
      ] );

      $this->items = self::get_albums( $per_page, $current_page );
    }

    public function process_bulk_action() {

      //Detect when a bulk action is being triggered...
      if ( 'delete' === $this->current_action() ) {

        // In our file that handles the request, verify the nonce.
        $nonce = esc_attr( $_REQUEST['_wpnonce'] );

        if ( ! wp_verify_nonce( $nonce, 'sp_delete_album' ) ) {
          die( 'Go get a life script kiddies' );
        }
        else {
          self::delete_album( absint( $_GET['album'] ) );

                      // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
                      // add_query_arg() return the current url
                      wp_redirect( esc_url_raw(add_query_arg()) );
          exit;
        }

      }

      // If the delete bulk action is triggered
      if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
           || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
      ) {

        $delete_ids = esc_sql( $_POST['bulk-delete'] );

        // loop over the array of record IDs and delete them
        foreach ( $delete_ids as $id ) {
          self::delete_album( $id );

        }

        // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
              // add_query_arg() return the current url
              wp_redirect( esc_url_raw(add_query_arg()) );
        exit;
      }
    }

  }

?>
