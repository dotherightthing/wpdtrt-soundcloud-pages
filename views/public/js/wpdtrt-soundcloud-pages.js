/**
 * Scripts for the public front-end
 *
 * This file contains JavaScript.
 * PHP variables are provided in wpdtrt_soundcloud_pages_config.
 *
 * @link       http://www.panoramica.co.nz
 * @since      0.3.0
 *
 * @package    WpDTRT_SoundCloud_Pages
 * @subpackage WpDTRT_SoundCloud_Pages/views
 */

jQuery(document).ready(function($){

	$('.wpdtrt-soundcloud-pages-badge').hover(function() {
		$(this).find('.wpdtrt-soundcloud-pages-badge-info').stop(true, true).fadeIn(200);
	}, function() {
		$(this).find('.wpdtrt-soundcloud-pages-badge-info').stop(true, true).fadeOut(200);
	});

  $.post( wpdtrt_soundcloud_pages_config.ajax_url, {
    action: 'wpdtrt_soundcloud_pages_data_refresh'
  }, function( response ) {
    //console.log( 'Ajax complete' );
  });

});
