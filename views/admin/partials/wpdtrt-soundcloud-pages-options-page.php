<?php
/**
 * Template partial for Admin Options page
 * WP Admin > Settings > WP SoundCloud Pages
 *
 * This file contains PHP, and HTML from the WordPress_Admin_Style plugin.
 *
 * @link       http://www.panoramica.co.nz
 * @link       /wp-admin/admin.php?page=WordPress_Admin_Style#twocolumnlayout2
 * @since      0.3.0
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/views
 */
?>

<div class="wrap">

  <div id="icon-options-general" class="icon32"></div>
  <h1><?php esc_attr_e( 'WP SoundCloud Pages', 'wp_admin_style' ); ?>: Placeholder blocks</h1>

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
              <span><?php esc_attr_e( 'Your SoundCloud Account', 'wp_admin_style' ); ?></span>
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

          /**
           * Start Scenario 2a - data sample
           * We display a sample of the data
           * so the user can verify that they have chosen the type
           * which meets their needs.
           */
          ?>

          <div class="postbox">

            <h2>
              <span><?php esc_attr_e( 'Sample blocks', 'wp_admin_style' ); ?></span>
            </h2>

            <div class="inside">

              <p>Your SoundCloud account contains <?php echo count( $wpdtrt_soundcloud_pages_data ); ?> track pages.</p>

              <p>The first 6 are listed below:</p>

              <div class="wpdtrt-soundcloud-pages-blocks">
                <ul>

                <?php
                  $max_length = 6;
                  $count = 0;
                  $display_count = 1;

                  foreach( $wpdtrt_soundcloud_pages_data as $key => $val ) {
                    //echo "<li>" . wpdtrt_soundcloud_pages_html_image( $key ) . "</li>\r\n";

                    $count++;
                    $display_count++;

                    // when we reach the end of the demo sample, stop looping
                    if ($count === $max_length) {
                      break;
                    }
                  }
                  // end foreach
                ?>
                </ul>
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
              <span><?php esc_attr_e( 'Raw block data', 'wp_admin_style'); ?></span>
            </h2>

            <div class="inside">

              <p>The data used to generate the list above.</p>

              <div class="wpdtrt-soundcloud-pages-data"><pre><code><?php echo "{\r\n";

                  //$count = 0;
                  //$max_length = 6;

                  //foreach( $wpdtrt_soundcloud_pages_data as $key => $val ) {
                    var_dump( $wpdtrt_soundcloud_pages_data );

                    //$count++;

                    // when we reach the end of the demo sample, stop looping
                    //if ($count === $max_length) {
                    //  break;
                   // }

                  //}

                  echo "}\r\n"; ?></code></pre></div>

            </div> <!-- .inside -->

          </div>
          <!-- .postbox -->

          <?php
          /**
           * End Scenario 2b - data viewer
           */

          /**
           * End Scenario 2 - data selected
           */
          endif;
          ?>

        </div>
        <!-- .meta-box-sortables .ui-sortable -->

      </div>
      <!-- post-body-content -->

      <!-- sidebar -->
      <div id="postbox-container-1" class="postbox-container">

        <div class="meta-box-sortables">

          <?php
          /**
           * Start Scenario 2 - data selected
           */

          /**
           * Start Scenario 2c - data re-selection form
           * If the user has already chosen a content type
           * then we'll provide the selection form again,
           * so that they can choose a different content type.
           * But this time we'll give it secondary importance
           * by displaying it in a sidebar:
           */
            if ( isset( $wpdtrt_soundcloud_pages_username ) && ( $wpdtrt_soundcloud_pages_username !== '') ) :
          ?>

          <div class="postbox">

            <h2>
              <span><?php esc_attr_e( 'Update preferences', 'wp_admin_style'); ?></span>
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

          <?php
          /**
           * End Scenario 2c - data re-selection form
           */

          /**
           * End Scenario 2 - data selected
           */
          endif;
          ?>

        </div>
        <!-- .meta-box-sortables -->

      </div>
      <!-- #postbox-container-1 .postbox-container -->

    </div>
    <!-- #post-body .metabox-holder .columns-2 -->

    <br class="clear">
  </div>
  <!-- #poststuff -->

</div> <!-- .wrap -->
