=== WP Video Popup – WordPress Video Lightbox for YouTube, Rumble & Vimeo ===
Contributors: davidvongries
Tags: YouTube Lightbox, Vimeo Lightbox, Rumble Lightbox, Video Lightbox, Video Popup
Requires at least: 4.0
Tested up to: 6.6
Stable tag: 2.10.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

**[WP Video Popup](https://wp-video-popup.com/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)** lets you add a responsive YouTube, Rumble or Vimeo video lightbox to any page, post or custom post type of your website. Add beautiful, minimalist video lightbox popups to your WordPress site with just a few clicks - **without sacrificing performance**.

== Why choose WP Video Popup? == 

= ✨Effortless integration =
Add a sleek, minimalist video lightbox to any page, post, or custom post type using a simple shortcode.

= ⚡Performance optimized =
Embedding YouTube or Vimeo videos can slow down your site. With WP Video Popup, videos are only loaded when users click to view them, ensuring fast page speeds and optimal performance.

= 📱Fully responsive =
 Our lightbox plugin adapts to all screen sizes, offering a flawless viewing experience on any device.

= ✅GDPR compliant =
WP Video Popup is GDPR compliant. No video connections are made until the lightbox is triggered.

[youtube https://www.youtube.com/watch?v=QBEppQ7mslo]

== How it works ==

**Add the shortcode** 

`[wp-video-popup video="link-to-your-youtube-or-vimeo-video"]`

anywhere to your post, page, custom post type or template file to embed the responsive video lightbox to your WordPress website.

**Trigger the lightbox:** Add the CSS class `wp-video-popup` to the element that should open the lightbox. This can be any element.

**Example (Link):**

`<a href="#" class="wp-video-popup">Watch Video</a>`

---------

=== Example Shortcodes ===

For **YouTube**:

`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

For **Vimeo**:

`[wp-video-popup video="https://vimeo.com/136696258"]`

For **Rumble**:

`[wp-video-popup video="https://rumble.com/embed/v4j2rri/?pub=4"]`

---------

=== Shortcode attributes ===

Here is a list of available shortcode attributes to further customize the viewing experience.

**Mute video:**

`mute="1"`

**Hide related videos (YouTube):**
Since September 2018, hiding related videos is no longer possible. Instead, videos from your channel will be shown.

`hide-related="1"`

**Start video at a specific time (value in seconds):**

`start="24"`

**Portrait mode (Vimeo):**

`portrait="1"`

**Example shortcode with shortcode attributes applied:**

`[wp-video-popup mute="1" start="24" video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

---------

=== Advanced ===

To add additional parameters to the embed URL, use the filter below. For example, to remove the YouTube branding:

`function prefix_your_custom_embed_url_attributes( $video_url ) {
	$video_url .= '&amp;modestbranding=1';
	return $video_url;
}
add_filter( 'wp_video_popup', 'prefix_your_custom_embed_url_attributes' );`

---------

=== 🚀 WP Video Popup PRO ===

Unlock advanced features like **video galleries**, **self-hosted videos**, **multiple videos per page** & more with **[WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)**!

**PRO Features:**

* Multiple popups per page
* Self-hosted videos
* Video galleries
* Autoplay on page load
* Adjustable popup size
* Customizable Overlay background color

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

When adding the URL to the shortcode, try to remove the last string so that your shortcode would look something like this: `[wp-video-popup video="https://vimeo.com/xxxx"]`.

== Screenshots ==
1. Live example
2. Desktop example
3. Mobile example

== Changelog ==
= 2.10.1 August 27, 2024 =
* Tweak: Added support for Rumble video URLs, allowing users to provide the video URL directly instead of the embed URL
= 2.10 August 23, 2024 =
* New: Added support for Rumble videos
* Tested up to WordPress 6.6
= 2.9.7 May 10, 2024 =
* Tested up to WordPress 6.5
= 2.9.6 December 01, 2023 =
* Tested up to WordPress 6.4
= 2.9.5 April 17, 2023 =
* Tested up to WordPress 6.2
* Minor tweaks & improvements
= 2.9.4 November 11, 2022 =
* Tested up to WordPress 6.1
* Removed deprecated webkitallowfullscreen & mozallowfullscreen
= 2.9.3 July 01, 2022 =
* Tested up to WordPress 6.0
= 2.9.2 March 02, 2022 =
* Tested up to WordPress 5.9
* Updated plugin description
= 2.9.1 March 15, 2021 =
* Slight improvements to the settings page design
* Tested up to WordPress 5.7
= 2.9 February 23, 2021 =
* Refactored settings page design
= 2.8.1 December 04, 2020 =
* WordPress 5.6 compatibility
* Minor tweaks & improvements
= 2.8 June 17, 2020 =
* Maintenance release
= 2.7 October 15, 2019 =
* New: Added support for portrait videos (Vimeo). To declare a vertical Vimeo video, simply add the `portrait="1"` parameter to your shortcode.
= 2.6 September 26, 2019 =
* Code improvements
= 2.5.1 September 16, 2019 =
* Fixed: Safari full-screen mode doesn't work
= 2.5 August 27, 2019 =
* New: youtube-nocookie.com support
* Deprecated: vimeo="1" parameter to declare a Vimeo video. No longer required. We now check that for you in the background.
* Tweak: Improved backwards compatibility
* Overall code improvements
= 2.4 April 8, 2019 =
* Tweak: Added allow="autoplay" parameter to iframe to allow autoplay in Chrome (thanks @owenmack)
* Fixed: A bug where URL parameters weren't added properly using shortcode attributes
* Fixed: Vimeo video was not muted with mute="1"
* Deprecated: hide-related shortcode attribute
= 2.3 December 12, 2018 =
* New: Shortcode attributes to add URL parameters (mute, hide-related, start)
* Tweak: Updated PAnD to the latest version
* Tested up to WordPress 5.0
= 2.2 September 23, 2018 =
* New: Filter to add attributes to the embed-URL
= 2.1 September 4, 2018 =
* New: Minor tweaks & improvements
= 2.0 August 25, 2018 =
* New: Shortcode has changed to [wp-video-popup video="link-to-your-video"] for YouTube videos and [wp-video-popup vimeo="1" video="link-to-your-video"] for vimeo videos
* New: Instead of the embed-URL, the direct YouTube/Vimeo video link can now be used in the shortcode
* Fixed: Nesting the shortcode causes other elements overlapping the lightbox
* 100% backwards compatibility
* Minor CSS tweaks and improvements
= 1.1.2 05/16/2017 =
* Removed admin notice
* Updated plugin description
= 1.1.1 05/20/2017 =
* New: Elementor support – by adding !important to the video iframe width and max-width attributes to prevent Elementor (and others) from overriding.
= 1.1 02-27-2017 =
* Stability & maintenance release
* New: Use ESC-key on your keyboard to close the popup
= 1.0.1 =
* Tweak: Increased z-index to make sure ryv-popup is on top
= 1.0 =
* Initial release