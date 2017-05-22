<?php
/**
 * Template partial for Admin Options page
 *    WP Admin > Settings > WP SoundCloud Pages
 *
 * This file contains PHP, and HTML from the WordPress_Admin_Style plugin.
 *
 * @link        http://www.panoramica.co.nz
 * @link        /wp-admin/admin.php?page=WordPress_Admin_Style#twocolumnlayout2
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Pages
 * @subpackage  WpDTRT_SoundCloud_Pages/views
 */
?>

<div class="wrap">

  <div id="icon-options-general" class="icon32"></div>
  <h1><?php esc_attr_e( 'WP SoundCloud Pages', 'wp_admin_style' ); ?></h1>

  <div id="poststuff">

    <div id="post-body" class="metabox-holder columns-2">

      <!-- main content -->
      <div id="post-body-content">

        <div class="meta-box-sortables ui-sortable">

          <?php
          /**
           * Start Scenario 1 - data selection form
           * If the user has not chosen a content type yet.
           * then $wpdtrt_soundcloud_pages_username will be set to the default of ""
           * The user must make a selection so that we know which page to query,
           * so we show the selection box first.
           */
          if ( !isset( $wpdtrt_soundcloud_pages_username ) || ( $wpdtrt_soundcloud_pages_username === '') ) :
          ?>

          <div class="postbox">

            <h2>
              <span class="step">1.</span>
              <span><?php esc_attr_e( 'Log in to your SoundCloud account', 'wp_admin_style' ); ?></span>
            </h2>

            <div class="inside">

              <form name="wpdtrt_soundcloud_pages_data_form" method="post" action="">

                <input type="hidden" name="wpdtrt_soundcloud_pages_form_submitted" value="Y" />

                <table class="form-table">
                  <tr>
                    <th>
                      <label for="wpdtrt_soundcloud_pages_username">
                        Please enter your SoundCloud username:
                         <span class="tip">(https://soundcloud.com/username)</span>
                      </label>
                    </th>
                    <td>
                      <input type="text" name="wpdtrt_soundcloud_pages_username" id="wpdtrt_soundcloud_pages_username" value="">
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <label for="wpdtrt_soundcloud_pages_clientid">
                        Please enter your SoundCloud Client ID:
                         <span class="tip">(http://soundcloud.com/you/apps/new)</span>
                      </label>
                    </th>
                    <td>
                      <input type="password" name="wpdtrt_soundcloud_pages_clientid" id="wpdtrt_soundcloud_pages_clientid" value="">
                    </td>
                  </tr>
                </table>

                <?php
                /**
                 * submit_button( string $text = null, string $type = 'primary', string $name = 'submit', bool $wrap = true, array|string $other_attributes = null )
                 */
                  submit_button(
                    $text = 'Submit',
                    $type = 'primary',
                    $name = 'wpdtrt_soundcloud_pages_submit',
                    $wrap = true,
                    $other_attributes = null
                  );
                ?>

              </form>
            </div>
            <!-- .inside -->

          </div>
          <!-- .postbox -->

          <?php
          /**
           * End Scenario 1 - data selection form
           */

          else:

          /**
           * Start Scenario 2 - data selected
           * If the user has already chosen a content type,
           * then $wpdtrt_soundcloud_pages_data will contain the body of the resulting JSON.
           */

          ?>

          <div class="postbox">

            <h2>
              <span class="step">1.</span>
              <span><?php esc_attr_e( 'Log In To Your SoundCloud Account', 'wp_admin_style'); ?></span>
            </h2>

            <div class="inside">

              <form name="wpdtrt_soundcloud_pages_data_form" method="post" action="">

                <input type="hidden" name="wpdtrt_soundcloud_pages_form_submitted" value="Y" />

                <p>
                  <label for="wpdtrt_soundcloud_pages_username">New user ID:</label>
                </p>
                <p>
                  <input type="text" name="wpdtrt_soundcloud_pages_username" id="wpdtrt_soundcloud_pages_username" value="<?php echo $wpdtrt_soundcloud_pages_username; ?>">
                </p>
                <p>

                <p>
                  <label for="wpdtrt_soundcloud_pages_clientid">New SoundCloud Client ID:</label>
                </p>
                <p>
                  <input type="password" name="wpdtrt_soundcloud_pages_clientid" id="wpdtrt_soundcloud_pages_clientid" value="<?php echo $wpdtrt_soundcloud_pages_clientid; ?>">
                </p>
                <p>
                  <?php
                    submit_button(
                      $text = 'Save &amp; load new data',
                      $type = 'primary',
                      $name = 'wpdtrt_soundcloud_pages_submit',
                      $wrap = false, // don't wrap in paragraph
                      $other_attributes = null
                    );
                  ?>
                </p>

              </form>

            </div> <!-- .inside -->

          </div>
          <!-- .postbox -->

          <div class="postbox" id="wpdtrt-soundcloud-pages-data-table">

            <h2>
              <span class="step">2.</span>
              <span><?php esc_attr_e( 'SoundCloud Albums', 'wp_admin_style' ); ?></span>
            </h2>

            <div class="inside">

              <p>Your SoundCloud account contains <?php echo count( $wpdtrt_soundcloud_pages_data ); ?> albums:</p>

              <div class="wpdtrt-soundcloud-pages-blocks">

                <form id="wpdtrt-soundcloud-pages-albums-table" method="GET">
                  <input type="hidden" name="wpdtrt_soundcloud_pages_regenerate" value="Y" />
                  <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
                  <?php
                      $wpdtrt_soundcloud_pages_albums_table->display();
                   ?>
                  <p>
                    <?php
                      submit_button(
                        $text = 'Generate pages',
                        $type = 'primary',
                        $name = 'wpdtrt_soundcloud_pages_regenerate_submit',
                        $wrap = false, // don't wrap in paragraph
                        $other_attributes = null
                      );
                    ?>
                  </p>
                </form>

              </div>

              <?php
                echo wpdtrt_soundcloud_pages_html_date();
              ?>

            </div>
            <!-- .inside -->

          </div>
          <!-- .postbox -->

          <?php
          /**
           * End Scenario 2a - data sample
           */

          /**
           * Start Scenario 2b - data viewer
           * For the purposes of debugging, we display the raw data.
           * var_dump is prefereable to print_r,
           * because it reveals the data types used,
           * so we can check whether the data is in the expected format.
           * @link http://kb.dotherightthing.co.nz/php/print_r-vs-var_dump/
           */
          ?>

          <div class="postbox">

            <h2>
              <span><?php esc_attr_e( 'Raw data', 'wp_admin_style'); ?></span>
            </h2>

            <div class="inside">

              <p>Samples of the playlist data types:</p>

              <div class="wpdtrt-soundcloud-pages-data">
                <?php

                  $demo_types = array('album', 'compilation', 'ep', 'single');

                  foreach( $wpdtrt_soundcloud_pages_data as $key => $val ) {

                    $playlist_type = $wpdtrt_soundcloud_pages_data[$key]->{'playlist_type'};

                    if ( in_array( $playlist_type, $demo_types ) ) {
                      echo "<h3>" . $playlist_type . "</h3>";
                      echo "<pre><code>{\r\n";
                      var_dump( $val );
                      echo "}\r\n";
                      echo "</code></pre>";

                      /**
                       * Remove playlist_type from demo_types array
                       * so that it is not output again
                       * @uses http://stackoverflow.com/a/36377356
                       */
                      unset( $demo_types[array_search($playlist_type, $demo_types)] );

                    }

                  }
                ?>
              </div>

            </div> <!-- .inside -->

          </div>
          <!-- .postbox -->

          <?php
          /**
           * End Scenario 2b - data viewer
           * End Scenario 2 - data selected
           */
          endif;
          ?>

        </div>
        <!-- .meta-box-sortables .ui-sortable -->

      </div>
      <!-- post-body-content -->

    </div>
    <!-- #post-body .metabox-holder .columns-2 -->

    <br class="clear">
  </div>
  <!-- #poststuff -->

</div> <!-- .wrap -->
