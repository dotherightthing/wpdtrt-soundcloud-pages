
=== WP SoundCloud Pages ===
Contributors: dotherightthingnz
Donate link: http://dotherightthing.co.nz/donate
Tags: SoundCloud, music, theming, import
Requires at least: 4.7.3
Tested up to: 4.7.3
Stable tag: 0.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generate WordPress pages from SoundCloud playlists

== Description ==

Generate WordPress pages from SoundCloud playlists

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/wpdtrt-soundcloud-pages` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin

== Frequently Asked Questions ==

= Which playlists are converted into pages? =

In SoundCloud, each playlist may be assigned one of five playlist 'types':

* Playlist (the default)
* Album
* EP
* Single
* Compilation

[SoundCloud's Album documentation](https://help.soundcloud.com/hc/en-us/articles/115003561288-Creating-an-Album) states that a playlist (set) may be marked as an 'official release', by assiging a 'Playlist type' other than the default, and by setting a release date.

These official releases then appear on your SoundCloud 'Albums' page (https://soundcloud.com/username/albums).

This plugin is intended to promote official releases, and so uses the Album system and the SoundCloud playlist types. This provides an easy way to separate finished tracks from demos, experiments and works-in-progress.

= How is SoundCloud content formatted? =

SoundCloud doesn't support HTML formatting, so:

* double line breaks are converted to paragraphs
* lines of uppercase text are converted to HTML heading 3s

= Which features are on the roadmap? =

Customisation of Playlist type labels in the plugin, for example to classify both (performance) 'Compilations' and (concept) 'Albums' as 'Mixes'.

= How do I use the widget? =

TO UPDATE

One or more widgets can be displayed within one or more sidebars:

1. Locate the widget: Appearance > Widgets > *WP SoundCloud Pages Widget*
2. Drag and drop the widget into one of your sidebars
3. Add a *Title*
4. Specify *Number of blocks to display*
5. Toggle *Link to enlargement?*

= How do I use the shortcode? =

One or more shortcodes can be used within the content editor:

* Specify *Number of blocks to display* - `number`
* Toggle *Link to enlargement?* - `enlargement` (`yes` | `no`)

```
[wpdtrt_soundcloud_pages_blocks number="2" enlargement="yes"]

[wpdtrt_soundcloud_pages_blocks number="4" enlargement="no"]
```

= How do I use the template tag? =

One or more template tags can be used within your `.php` templates:

* Specify *Number of blocks to display* - `number`
* Toggle *Link to enlargement?* - `enlargement` (`yes` | `no`)

```
<?php
    do_shortcode( '[wpdtrt_soundcloud_pages_blocks number="2" enlargement="yes"]' );
?>

<?php
    do_shortcode( '[wpdtrt_soundcloud_pages_blocks number="4" enlargement="no"]' );
?>
```

== Screenshots ==

1. The caption for ./assets/screenshot-1.(png|jpg|jpeg|gif)
2. The caption for ./assets/screenshot-2.(png|jpg|jpeg|gif)

== Changelog ==

= 0.1 =
* Initial version

== Upgrade Notice ==

= 0.1 =
* Initial release
