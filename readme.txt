=== WP Video Popup – WordPress Video Lightbox for YouTube & Vimeo ===
Contributors: davidvongries
Tags: YouTube, Vimeo, Lightbox, Popup, YouTube Lightbox, Vimeo Lightbox, Video Lightbox, Video Popup, GDPR, DSGVO, WP Video Lightbox, WP Video Popup, Responsive Lightbox, Responsive Popup
Requires at least: 4.0
Tested up to: 6.1
Stable tag: 2.9.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
=== The best WordPress Video Lightbox Plugin! ===

**[WP Video Popup](https://wp-video-popup.com/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)** lets you add a responsive YouTube or Vimeo video lightbox to any page, post or custom post type of your website.

Add beautiful, minimalistic video lightbox popups to your WordPress website with just a few clicks & **without sacrificing performance**.

[youtube https://www.youtube.com/watch?v=QBEppQ7mslo]

Use the shortcode 

`[wp-video-popup video="link-to-your-youtube-or-vimeo-video"]`

in your post, page, custom post type or template file to add a responsive YouTube or Vimeo video lightbox to your WordPress website.

To open the lightbox, simply add the **CSS-class**

`wp-video-popup`

to the element you wish to open/trigger the lightbox.

= GDPR Compliance =
WP Video Popup is 100% GDPR compliant. No connection to YouTube or Vimeo is established before the trigger element has been clicked.

= Page Speed & Performance =
Embedding YouTube or Vimeo videos can slow down your website. With WP Video Lightbox the video is only being loaded by the click on the trigger element for the maximum performance & fast loading speeds.

= Fully Responsive =
The WordPress video lightbox is fully responsive and adjusts to the device width & height the video is viewed on.

---------

=== Usage ===
Example Shortcode to display a **YouTube video lightbox**:

`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

Example Shortcode to display a **Vimeo video lightbox**:

`[wp-video-popup video="https://vimeo.com/136696258"]`

CSS class that needs to be added to the element you want to open/trigger the video lightbox:

`wp-video-popup`

Trigger Element Example (Link):

`<a href="#" class="wp-video-popup">Play Video</a>`

---------

=== Shortcode Attributes ===

There are attributes available to add parameters to the embed-URL that’s dynamically generated from the video link provided in the shortcode.

Mute video:

`mute="1"`

Hide related YouTube videos:
Since September 2018, hiding related videos is no longer possible. Instead videos from your channel will be shown.

`hide-related="1"`

Start video at a specific time (value in seconds):

`start="24"`

Portrait mode (Vimeo only):

`portrait="1"`

Example Shortcode with shortcode attributes:

`[wp-video-popup mute="1" start="24" video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

---------

=== Advanced ===

In addition to the shortcode attributes, there is a filter available that allows you to add more parameters to the embed-URL. By default, only the `autoplay` attribute is added to the embed-URL.

In the example below, we use the filter to remove the YouTube branding from the video by adding the `modestbranding` parameter:

`function prefix_your_custom_embed_url_attributes( $video_url ) {
	$video_url .= '&amp;modestbranding=1';
	return $video_url;
}
add_filter( 'wp_video_popup', 'prefix_your_custom_embed_url_attributes' );`

---------

=== WP Video Popup PRO ===

For multiple popups on a single page, video galleries, autoplay on page load, self-hosted videos & more check out **[WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)**!

**PRO Features:**

* Multiple Popups on a single Page/Post/CPT
* Self-Hosted Videos (New!)
* Video Galleries (New!)
* Autoplay on Page-Load
* Adjustable Popup Size
* Overlay Background-Color Setting

**NEW!** - Create video lightbox galleries with **[WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)**:

[youtube https://youtu.be/7HK2CxGvaDM]

Get **[WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)** today!

---------

=== What's next? ===

If you like WP Video Popup make sure to check out our other products:

* **[Page Builder Framework](https://wp-pagebuilderframework.com/?utm_source=wp_video_popup&utm_medium=repository&utm_campaign=wpbf)** - A fast & minimalistic WordPress theme designed for the new WordPress era.
* **[Ultimate Dashboard](https://ultimatedashboard.io/?utm_source=wp_video_popup&utm_medium=repository&utm_campaign=udb)** - The #1 WordPress plugin to customize your WordPress dashboard and admin area.
* **[Better Admin Bar](https://betteradminbar.com/?utm_source=wp_video_popup&utm_medium=repository&utm_campaign=bab)** - The plugin to make your clients enjoy WordPress. It replaces the default admin bar to provide the best possible user experience when editing & navigating a website.

== Installation ==
1. Download the responsive-youtube-vimeo-popup.zip file to your computer.
2. Unzip the file.
3. Upload the `responsive-youtube-vimeo-popup` folder to your `/wp-content/plugins/` directory.
4. Activate the plugin through the *Plugins* menu in WordPress.

== Frequently Asked Questions ==
= How do i use this plugin? =
WP Video Popup doesn’t create an admin settings page. To trigger and display the lightbox popup, please follow the steps under **Description**.
= The video doesn't play automatically =
We add the autoplay attribute to the embed-URL by default. That being said, the video should play automatically after the trigger element has been clicked. Some browsers have changed their autoplay policy and videos only start playing if they're muted.

To mute the video, add the `mute="1"` attribute to the shortcode like this:

`[wp-video-popup mute="1" video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`
= What about private Vimeo videos =
Private vimeo videos add an extra string to the URL like this: `https://vimeo.com/xxxx/yyyy`.

When adding the URL to the shortcode, simply remove the last string so that your shortcode would look something like this: `[wp-video-popup video="https://vimeo.com/xxxx"]`.

== Screenshots ==
1. Live Example
2. Desktop Example
3. Mobile Example

== Changelog ==
= 2.9.4 November 11, 2022 =
* Tested up to 6.1
* Removed deprecated webkitallowfullscreen & mozallowfullscreen
= 2.9.3 July 01, 2022 =
* Tested up to 6.0
= 2.9.2 March 02, 2022 =
* Tested up to 5.9
* Updated plugin description
= 2.9.1 March 15, 2021 =
* Slight improvements to the settings page design
* Tested up to 5.7
= 2.9 February 23, 2021 =
* Refactored settings page design
= 2.8.1 December 04, 2020 =
* WordPress 5.6 compatibility
* Minor tweaks & improvements
= 2.8 June 17, 2020 =
* Maintenance release
= 2.7 October 15, 2019 =
* New: Added support for portrait videos (Vimeo). To declare a vertical video, simply add the `portrait="1"` parameter to your shortcode.
= 2.6 September 26, 2019 =
* Code Improvements
= 2.5.1 September 16, 2019 =
* Fixed: Safari full-screen mode doesn't work
= 2.5 August 27, 2019 =
* New: youtube-nocookie.com support
* Deprecated: vimeo="1" parameter to declare a Vimeo video. No longer required. We now check that for you in the background.
* Tweak: Improved backwards compatibility
* Overall code improvements
= 2.4 April 8, 2019 =
* Tweak: Added allow="autoplay" parameter to iframe to allow autoplay in Chrome (Thanks @owenmack)
* Fixed: A bug where URL Parameters weren't added properly using Shortcode Attributes
* Fixed: Vimeo video was not muted with mute="1"
* Deprecated: hide-related Shortcode Attribute
= 2.3 December 12, 2018 =
* New: Shortcode Attributes to add URL Parameters (mute, hide-related, start)
* Tweak: Updated PAnD to the latest version
* Tested up to WordPress 5.0
= 2.2 September 23, 2018 =
* New: filter to add attributes to the embed-URL
= 2.1 September 4, 2018 =
* New: minor tweaks & improvements
= 2.0 August 25, 2018 =
* New: shortcode has changed to [wp-video-popup video="link-to-your-video"] for YouTube videos and [wp-video-popup vimeo="1" video="link-to-your-video"] for vimeo videos
* New: instead of the embed-URL, the direct YouTube/Vimeo video link can now be used in the shortcode
* Fixed: nesting the shortcode causes other elements overlapping the lightbox.
* 100% backwards compatibility
* minor CSS tweaks and improvements
= 1.1.2 05/16/2017 =
* removed admin notice
* updated plugin description
= 1.1.1 05/20/2017 =
* Added: Elementor support – by adding !important to the video iframe width and max-width attributes to prevent Elementor (and others) from overwriting.
= 1.1 02-27-2017 =
* stability & maintenance release
* Added: use ESC-key on your keyboard to close the popup
= 1.0.1 =
* Tweak: Increased z-index to make sure ryv-popup is on top
= 1.0 =
* Initial Release