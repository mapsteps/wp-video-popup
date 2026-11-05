=== WP Video Popup – WordPress Video Lightbox for YouTube, Rumble & Vimeo ===
Contributors: davidvongries
Tags: video popup, video lightbox, youtube popup, vimeo popup, youtube lightbox
Requires at least: 4.7
Tested up to: 7.1
Requires PHP: 5.6
Stable tag: 2.11
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add a YouTube, Vimeo or Rumble video popup to WordPress. Lightweight, privacy-friendly lightbox that works with any page builder.

== Description ==

**[WP Video Popup](https://wp-video-popup.com/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)** is the simple way to add a **YouTube, Vimeo or Rumble video popup** to WordPress. Show your video in a responsive, minimalist lightbox when visitors click a button, link or image – on any page, post or custom post type, **without slowing down your site**.

Build your shortcode in seconds with the shortcode builder under *Settings → WP Video Popup*, paste it anywhere and you're done.

== Why choose WP Video Popup? ==

= ✨ Effortless integration =
Add a sleek video lightbox with a single shortcode. Let the shortcode create a "Watch video" button for you, turn any image into a video popup, or open the lightbox from any element with a CSS class.

= ⚡ Performance optimized =
Embedding YouTube or Vimeo videos can slow down your site. WP Video Popup only loads the video once a visitor opens the popup, keeping your pages fast and your Core Web Vitals happy.

= 📱 Fully responsive =
The video lightbox adapts to every screen size and supports both landscape and portrait (vertical) videos.

= ✅ Privacy-friendly =
No connection to YouTube, Vimeo or Rumble is made until the lightbox is opened. Use a youtube-nocookie.com link for YouTube's privacy-enhanced mode.

= ♿ Accessible =
The popup can be opened and closed with the keyboard, handles focus properly and is labeled for screen readers.

= 🧱 Works with your page builder =
Use it with the block editor (Gutenberg), Elementor, Divi, Bricks, Beaver Builder or any other page builder and theme.

== How to add a video popup ==

**1. Add the shortcode**

Paste the shortcode into any post, page, custom post type or template file:

`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

Tip: build it with the shortcode builder under *Settings → WP Video Popup* and copy it with one click.

**2. Add the trigger**

Choose how visitors open the lightbox:

* **Button:** add a `text` attribute and the shortcode outputs a button (styled by your theme) that opens the popup:
`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk" text="Watch video"]`
* **Image:** wrap an image (or any other content) in the shortcode to turn it into a clickable video thumbnail:
`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]<img src="thumbnail.jpg" alt="Watch video">[/wp-video-popup]`
* **Any element:** add the CSS class `wp-video-popup` to any button, link or image:
`<a href="#" class="wp-video-popup">Watch video</a>`

**Where to find the CSS class field in your page builder:**

* Block editor: *Advanced → Additional CSS class(es)*
* Elementor: *Advanced → CSS Classes*
* Divi: *Advanced → CSS ID & Classes*
* Bricks: *Style → CSS → CSS classes*

The free version supports one video popup per page. Need more? Check out [WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup).

---------

=== Example shortcodes ===

**YouTube popup:**

`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

**Vimeo popup:**

`[wp-video-popup video="https://vimeo.com/136696258"]`

**Rumble popup** (video page or embed link):

`[wp-video-popup video="https://rumble.com/embed/v4j2rri/?pub=4"]`

---------

=== Shortcode attributes ===

Customize the viewing experience with these shortcode attributes:

**Button text** (outputs a button that opens the lightbox):

`text="Watch video"`

**Mute video:**

`mute="1"`

**Start video at a specific time** (in seconds):

`start="24"`

**Portrait mode** (for vertical videos):

`portrait="1"`

**Hide related videos (YouTube):**
Since September 2018, YouTube no longer allows hiding related videos completely. Instead, videos from your own channel are shown.

`hide-related="1"`

**Example shortcode with attributes applied:**

`[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk" mute="1" start="24" text="Watch video"]`

---------

=== Advanced ===

To add additional parameters to the embed URL, use the filter below. For example, to show YouTube captions by default:

`function prefix_your_custom_embed_url_attributes( $video_url ) {
	$video_url .= '&cc_load_policy=1';
	return $video_url;
}
add_filter( 'wp_video_popup', 'prefix_your_custom_embed_url_attributes' );`

---------

=== 🚀 WP Video Popup PRO ===

Unlock advanced features like **video galleries**, **self-hosted videos**, **multiple videos per page** & more with **[WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)**!

**PRO Features:**

* Multiple video popups per page
* Self-hosted videos
* Video galleries
* Autoplay on page load
* Adjustable popup size
* Customizable overlay background color

Get **[WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup)** today!

---------

=== What's next? ===

If you like WP Video Popup make sure to check out our other products:

* **[Page Builder Framework](https://wp-pagebuilderframework.com/?utm_source=wp_video_popup&utm_medium=repository&utm_campaign=wpbf)** - A fast & minimalistic WordPress theme designed for the new WordPress era.
* **[Ultimate Dashboard](https://ultimatedashboard.io/?utm_source=wp_video_popup&utm_medium=repository&utm_campaign=udb)** - The #1 WordPress plugin to customize your WordPress dashboard and admin area.
* **[Better Admin Bar](https://betteradminbar.com/?utm_source=wp_video_popup&utm_medium=repository&utm_campaign=bab)** - The plugin to make your clients enjoy WordPress. It replaces the default admin bar to provide the best possible user experience when editing & navigating a website.

== External services ==

This plugin embeds videos from YouTube, Vimeo and Rumble. The video is only loaded from the provider once a visitor opens the popup. YouTube: [Terms](https://www.youtube.com/t/terms), [Privacy](https://policies.google.com/privacy). Vimeo: [Terms](https://vimeo.com/terms), [Privacy](https://vimeo.com/privacy). Rumble: [Terms](https://rumble.com/s/terms), [Privacy](https://rumble.com/s/privacy).

For Rumble video page links (e.g. rumble.com/v…-title.html), the plugin asks Rumble's oEmbed API (https://rumble.com/api/Media/oembed.json) once for the embed ID, sending only the video URL from your site's server. The result is cached for a month. Rumble embed links (rumble.com/embed/…) need no lookup.

== Installation ==
1. In your WordPress admin, go to *Plugins → Add New Plugin* and search for "WP Video Popup".
2. Click *Install Now*, then *Activate*.
3. Go to *Settings → WP Video Popup* to build your first video popup shortcode.

== Frequently Asked Questions ==

= How do I add a YouTube video popup in WordPress? =
Add `[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk" text="Watch video"]` to your page. It outputs a button that opens the YouTube video in a lightbox. You can also build the shortcode under *Settings → WP Video Popup*.

= How do I open a video popup when clicking an image? =
Wrap the image in the shortcode: `[wp-video-popup video="…"]<img src="thumbnail.jpg" alt="Watch video">[/wp-video-popup]`. Alternatively, add the CSS class `wp-video-popup` to the image.

= Does it work with Elementor, Divi, Bricks or the block editor? =
Yes. Add the shortcode with a Shortcode widget/module/block and add the CSS class `wp-video-popup` to the button or image that should open the popup. See **Description** for where to find the CSS class field in each builder.

= Which video platforms are supported? =
YouTube (including youtube-nocookie.com and youtu.be links), Vimeo (including private videos) and Rumble. Self-hosted videos are available in [WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup).

= Can I add multiple video popups to one page? =
The free version supports one video popup per page. [WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup) supports unlimited popups per page.

= Can the video popup open automatically on page load? =
Yes, with [WP Video Popup PRO](https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=link&utm_campaign=wp_video_popup). It can open the popup and start the video as soon as the page loads. The free version opens the popup when a visitor clicks a button, link or image.

= Will it slow down my website? =
No. The video is only loaded once a visitor opens the popup, so it doesn't affect your page load speed.

= Is WP Video Popup GDPR compliant? =
No connection to the video provider is made until a visitor opens the popup. For YouTube, use a youtube-nocookie.com link for privacy-enhanced mode.

= The video doesn't play automatically =
We add the autoplay parameter to the embed URL by default, so the video should start playing once the popup is opened. Some browsers only allow autoplay for muted videos.

To mute the video, add the `mute="1"` attribute to the shortcode like this:

`[wp-video-popup mute="1" video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

== Screenshots ==
1. A YouTube video popup lightbox on desktop
2. The responsive video popup on mobile
3. Build your video popup shortcode under Settings → WP Video Popup

== Changelog ==
= 2.11 November 04, 2026 =
* New: Shortcode can output its own trigger button via the text attribute, e.g. [wp-video-popup video="…" text="Watch video"]
* New: Wrap content (e.g. an image) in the shortcode to turn it into the trigger
* New: Getting started box with a shortcode builder on the settings page
* New: Redesigned settings page
* New: Accessible popup (keyboard support, focus handling, screen reader labels)
* Tweak: Rumble video URLs are now resolved via Rumble's own API and cached, instead of a third-party service
* Tweak: Removed legacy Internet Explorer code
* Tweak: Requires WordPress 4.7
* Fixed: Sanitize the start attribute
* Fixed: Don't output a broken popup if a video can't be identified
* Tested up to WordPress 7.1
= 2.10.4 February 19, 2026 =
* New: Added native support for private Vimeo videos
* Tested up to WordPress 6.9
= 2.10.3 November 04, 2025 =
* Fixed: Security improvements
* Tweak: Code quality and translation consistency
= 2.10.2 June 05, 2025 =
* Tested up to WordPress 6.8
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
