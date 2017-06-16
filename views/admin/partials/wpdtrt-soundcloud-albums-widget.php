<?php
/**
 * Template partial for Widget administration
 *    WP Admin > Appearance > Widgets > WP SoundCloud Albums
 *
 * This file contains PHP, and HTML fields.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/views
 */
?>

<p>
  <label for="<?php echo $this->get_field_name('title'); ?>">Title</label>
  <input class="widefat" id="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_name('number'); ?>">Number of blocks to display</label>
  <input size="4" id="<?php echo $this->get_field_name('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo $number; ?>" aria-describedby="<?php echo $this->get_field_name('number'); ?>-tip" />
  <span id="<?php echo $this->get_field_name('number'); ?>-tip" class="wpdtrt-soundcloud-albums-tip">Minimum: 1 | Maximum: <?php echo count($wpdtrt_soundcloud_albums_data); ?></span>
</p>

<?php
/**
 * Checked
 * For use in checkbox and radio button form fields.
 * Compares two given values (for example, a saved option vs. one chosen in a form)
 * and, if the values are the same, adds the checked attribute to the current radio button or checkbox.
 * @example <?php checked( $checked, $current, $echo ); ?>
 * @see https://codex.wordpress.org/Function_Reference/checked
 */
?>
<p>
  <label for="<?php echo $this->get_field_name('enlargement'); ?>">Link to enlargement?</label>
  <input type="checkbox" id="<?php echo $this->get_field_name('enlargement'); ?>" name="<?php echo $this->get_field_name('enlargement'); ?>" value="1" <?php checked( $enlargement, 1 ); ?> />
</p>
