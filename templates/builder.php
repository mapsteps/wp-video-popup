<?php
/**
 * Shortcode builder card: one card, one job.
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );
?>

<section class="heatbox wpvp-studio" aria-labelledby="wpvp-studio-title">

	<header class="wpvp-studio-header">
		<h2 id="wpvp-studio-title"><?php esc_html_e( 'Create a video popup', 'responsive-youtube-vimeo-popup' ); ?></h2>
		<p><?php esc_html_e( 'Paste a link, pick your options and copy the shortcode into any page, post or template.', 'responsive-youtube-vimeo-popup' ); ?></p>
	</header>

	<div class="wpvp-studio-body">

		<div class="wpvp-studio-field is-primary">
			<label for="wpvp-builder-video"><?php esc_html_e( 'Video link', 'responsive-youtube-vimeo-popup' ); ?></label>
			<div class="wpvp-builder-video">
				<input type="url" id="wpvp-builder-video" placeholder="https://www.youtube.com/watch?v=YlUKcNNmywk" aria-describedby="wpvp-builder-video-hint" autocomplete="off">
				<span class="wpvp-service" id="wpvp-builder-service" hidden></span>
			</div>
			<p class="wpvp-studio-hint" id="wpvp-builder-video-hint" data-default="<?php esc_attr_e( 'A YouTube, Vimeo or Rumble link.', 'responsive-youtube-vimeo-popup' ); ?>" data-invalid="<?php esc_attr_e( 'This doesn\'t look like a YouTube, Vimeo or Rumble link.', 'responsive-youtube-vimeo-popup' ); ?>">
				<?php esc_html_e( 'A YouTube, Vimeo or Rumble link.', 'responsive-youtube-vimeo-popup' ); ?>
			</p>
		</div>

		<div class="wpvp-studio-field">
			<label for="wpvp-builder-text"><?php esc_html_e( 'Button text', 'responsive-youtube-vimeo-popup' ); ?> <span class="wpvp-studio-optional"><?php esc_html_e( 'optional', 'responsive-youtube-vimeo-popup' ); ?></span></label>
			<input type="text" id="wpvp-builder-text" placeholder="<?php esc_attr_e( 'Watch video', 'responsive-youtube-vimeo-popup' ); ?>" aria-describedby="wpvp-builder-text-hint" autocomplete="off">
			<p class="wpvp-studio-hint" id="wpvp-builder-text-hint"><?php esc_html_e( 'Adds a button that opens the popup. Leave it empty to use your own trigger.', 'responsive-youtube-vimeo-popup' ); ?></p>
		</div>

		<div class="wpvp-chips" role="group" aria-label="<?php esc_attr_e( 'Options', 'responsive-youtube-vimeo-popup' ); ?>">
			<label class="wpvp-chip">
				<input type="checkbox" id="wpvp-builder-mute">
				<span class="dashicons dashicons-controls-volumeoff" aria-hidden="true"></span>
				<?php esc_html_e( 'Mute', 'responsive-youtube-vimeo-popup' ); ?>
			</label>
			<label class="wpvp-chip">
				<input type="checkbox" id="wpvp-builder-portrait">
				<span class="dashicons dashicons-smartphone" aria-hidden="true"></span>
				<?php esc_html_e( 'Portrait', 'responsive-youtube-vimeo-popup' ); ?>
			</label>
		</div>

		<details class="wpvp-studio-advanced">
			<summary><?php esc_html_e( 'Advanced', 'responsive-youtube-vimeo-popup' ); ?> <span><?php esc_html_e( 'Start time', 'responsive-youtube-vimeo-popup' ); ?></span></summary>

			<div class="wpvp-studio-grid">
				<div class="wpvp-studio-field">
					<label for="wpvp-builder-start"><?php esc_html_e( 'Start at', 'responsive-youtube-vimeo-popup' ); ?></label>
					<div class="wpvp-studio-unit">
						<input type="number" id="wpvp-builder-start" min="0" step="1" placeholder="0">
						<span aria-hidden="true"><?php esc_html_e( 'sec', 'responsive-youtube-vimeo-popup' ); ?></span>
					</div>
				</div>
			</div>
		</details>

	</div>

	<footer class="wpvp-studio-result">
		<div class="wpvp-code">
			<code id="wpvp-builder-output">[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]</code>
			<button type="button" class="wpvp-code-copy wpvp-copy" data-copied="<?php esc_attr_e( 'Copied!', 'responsive-youtube-vimeo-popup' ); ?>" data-copy-target="wpvp-builder-output" aria-label="<?php esc_attr_e( 'Copy shortcode', 'responsive-youtube-vimeo-popup' ); ?>">
				<span class="dashicons dashicons-admin-page" aria-hidden="true"></span>
				<span class="wpvp-copy-label"><?php esc_html_e( 'Copy shortcode', 'responsive-youtube-vimeo-popup' ); ?></span>
			</button>
		</div>

		<p class="wpvp-studio-trigger">
			<span id="wpvp-trigger-hint"><?php esc_html_e( 'Your own trigger: add this class to any button, link or image', 'responsive-youtube-vimeo-popup' ); ?></span>
			<button type="button" class="wpvp-class-chip wpvp-copy" data-copied="<?php esc_attr_e( 'Copied!', 'responsive-youtube-vimeo-popup' ); ?>" data-copy-target="wpvp-trigger-class" aria-label="<?php esc_attr_e( 'Copy CSS class', 'responsive-youtube-vimeo-popup' ); ?>">
				<code id="wpvp-trigger-class">wp-video-popup</code>
				<span class="dashicons dashicons-admin-page" aria-hidden="true"></span>
				<span class="wpvp-copy-label screen-reader-text"><?php esc_html_e( 'Copy', 'responsive-youtube-vimeo-popup' ); ?></span>
			</button>
		</p>
	</footer>

	<span class="screen-reader-text" role="status" id="wpvp-copy-status"></span>

</section>

<div class="heatbox-cta-container is-attached">
	<div class="heatbox-cta secondary">
		<p><?php esc_html_e( 'The free version supports one video popup per page.', 'responsive-youtube-vimeo-popup' ); ?></p>
		<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=getting_started&utm_campaign=wp_video_popup" class="button" target="_blank">
			<?php esc_html_e( 'Get multiple popups with PRO', 'responsive-youtube-vimeo-popup' ); ?>
		</a>
	</div>
</div>
