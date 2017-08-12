/**
 * Scripts for the public front-end
 *
 * This file contains JavaScript.
 *    PHP variables are provided in wpdtrt_soundcloud_albums_config.
 *
 * @link        http://www.panoramica.co.nz
 * @since       0.1.0
 *
 * @package     WpDTRT_SoundCloud_Albums
 * @subpackage  WpDTRT_SoundCloud_Albums/views
 */

jQuery(document).ready(function($){

  /**
   * SoundCloud HTML5 Widget
   *
   * @since 0.4.0
   * @see https://developers.soundcloud.com/blog/html5-widget-api
   * @see https://developers.soundcloud.com/docs/api/html5-widget
   * @see https://w.soundcloud.com/player/api_playground.html
   * @see http://codepen.io/nickcolley/pen/uoCIy
   */
  function soundcloud_player_widget() {

    var sc_widget = '<iframe id="sc-widget" src="" width="100%" height="465" scrolling="no" frameborder="no"></iframe>';

    $('#soundcloud-player').append(sc_widget);

    // the widget iframe loads with the same URL as the one that will be loaded via SC.Widget
    $('#sc-widget').attr('src', 'https://w.soundcloud.com/player/?url=' + wpdtrt_soundcloud_albums_config.soundcloud_permalink_url);

    var widgetIframe = document.getElementById('sc-widget'),
        widget       = SC.Widget(widgetIframe);

        widget.bind(SC.Widget.Events.READY, function() {
          widget.load( wpdtrt_soundcloud_albums_config.soundcloud_permalink_url, {
            show_artwork: false,
            show_comments: false,
            auto_play: true,
            show_playcount: false,
            show_user: false,
            liking: false,
            download: false,
            sharing: false,
            buying: false
        });
      });
  }

  soundcloud_player_widget();

});
