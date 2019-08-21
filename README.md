## Summary

- [Description](#description)
- [Installation](#installation)
- [Usage](#usage)
- [Examples](#examples)
- [Shortcode Attributes](#shortcode-attributes)
- [Advanced](#advanced)

## Description

**WP Video Popup** lets you add a responsive YouTube or Vimeo video lightbox popup to any page or post of your website.

- This plugin is 100% GDPR compliant. No connection to YouTube or Vimeo is established before the trigger element has been clicked.
- Embedding videos can slow down your website. With **WP Video Popup**, the lightbox & video are only being loaded by the click on the trigger element.

## Installation

- From WordPress administrative area, go to _Plugins_ -> _Add New_
- Search for _wp video popup_
- Install and then activate it

## Usage

Use the shortcode:
`[wp-video-popup video="link-to-your-youtube-video"]`

or

`[wp-video-popup vimeo="1" video="link-to-your-vimeo-video"]`

in your post, page or template file to embed your YouTube or Vimeo lightbox popup.

To open the popup, add the CSS-class `wp-video-popup` to the element you wish to trigger the lightbox.

## Examples

Example Shortcode to display a **YouTube** video:

```
[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]
```

Example Shortcode to display a **Vimeo** video:

```
[wp-video-popup vimeo="1" video="https://vimeo.com/136696258"]
```

After that, CSS class needs to be added to the element you want to open the lightbox: `wp-video-popup`. So your trigger element can be like this:

```
<a href="#" class="wp-video-popup">Play Video</a>
```

## Shortcode Attributes

- `mute="1"` : Mute video by default
- `start="24"` : Start video at a specific time (value in seconds)

Example: `[wp-video-popup mute="1" start="24" video="https://www.youtube.com/watch?v=YlUKcNNmywk"]`

## Advanced

In addition to the Shortcode Attributes, there is a filter available to add more parameters to the embed-URL. By default, we only add the autoplay attribute to the embed-URL.

In the example below, we use the filter to remove the YouTube branding from the video by adding the modestbranding parameter:

```
function prefix_your_custom_embed_url_attributes( $video_url ) {
    $video_url .= '&modestbranding=1';
    return $video_url;
}

add_filter( 'wp_video_popup', 'prefix_your_custom_embed_url_attributes' );
```
