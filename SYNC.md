# Keeping free & PRO in sync

WP Video Popup (free, `responsive-youtube-vimeo-popup`) is the base. WP Video Popup PRO (`wp-video-popup-pro`) is the base plus PRO features. Both repos contain this same file.

## Workflow

1. Change shared code in the **free** version first.
2. Carry it over to PRO: copy files that must be identical, port by hand where the versions differ on purpose.
3. Never change a shared file only in PRO. If PRO needs something, either make the shared file handle it (e.g. skip fields that don't exist) or put it in a PRO-only file.
4. Backwards compatibility comes first: existing shortcodes, settings, classes and custom CSS must keep working.

## Identical in both (copy as-is)

| Free | PRO |
| --- | --- |
| `assets/css/heatbox.css` | `assets/css/heatbox.css` |
| `assets/css/admin-page.css` | `assets/css/admin-page.css` |
| `assets/js/admin-page.js` | `assets/js/admin-page.js` |
| `assets/sass/modules/_wp-video-popup.scss` | `assets/sass/modules/_wp-video-popup.scss` |
| `assets/sass/config/_mixins.scss` | `assets/sass/config/_mixins.scss` |
| `assets/vendor/coloris/` | `assets/vendor/coloris/` (color picker, see `VERSION.txt`) |
| `assets/img/wp-video-popup-logo-1.png` | `assets/img/wp-video-popup-logo-1.png` (plugin logo) |
| `phpcs.xml` | `phpcs.xml` (excludes differ: free `persist-admin-notices-dismissal`, PRO the EDD updater) |
| `composer.json` | `composer.json` (only name & description differ) |

## Same code, different names (port by hand)

Function prefixes (`wp_video_popup_` / `wp_video_popup_pro_`), constants (`WP_VIDEO_POPUP_PLUGIN_*` / `WP_VIDEO_POPUP_PRO_PLUGIN_*`) and text domains (`responsive-youtube-vimeo-popup` / `wp-video-popup`) differ. Otherwise keep these the same:

- `inc/init.php` (PRO also loads its parser here, free loads it in the main plugin file)
- The admin enqueue & `wp_video_popup_admin_i18n()` / `wp_video_popup_pro_admin_i18n()` (labels for the shared admin script)
- `inc/class-wp-video-popup-parser.php` / `inc/class-wp-video-popup-pro-parser.php` (PRO also detects self-hosted videos)
- `templates/metaboxes/documentation.php`, `templates/metaboxes/review.php` (PRO wording mentions PRO)
- `templates/metaboxes/getting-started.php` (PRO adds the ID, gallery & autoplay fields and `data-self-hosted`, free has the upsell)
- The trigger markup of the shortcode (`wp_video_popup_trigger()` / `wp_video_popup_pro_trigger()`); PRO adds `data-wp-video-popup-target` to tie the trigger to its popup.

## Different on purpose

- **Front-end script:** `assets/js/wp-video-popup.js` (free, one popup per page) and `inc/js/wp-video-popup.js` (PRO, multiple popups & galleries) are built differently. Port fixes by hand and keep the output (markup, classes, ARIA, keyboard behaviour) the same.
- **Front-end CSS:** PRO compiles to `inc/css/`, free to `assets/css/`. PRO-only styles live in `assets/sass/modules/_wp-video-popup-pro.scss`.
- **Settings:** free has no active settings, its sanitize callback keeps the values unchanged (so PRO settings survive a downgrade). PRO sanitizes them.
- **PRO only:** `assets/js/admin-page-pro.js` (popup size device switcher), license & EDD files (`assets/edd/`, `templates/license.php`), galleries, autoplay, self-hosted videos.
- **Free only:** PRO upsells, admin notices (`inc/persist-admin-notices-dismissal/`), review notice, featured products.

## Building the front-end CSS

```bash
sass --style=compressed --no-source-map assets/sass/wp-video-popup.scss assets/css/wp-video-popup.css
```

PRO: same command with `inc/css/wp-video-popup.css` as the output.
