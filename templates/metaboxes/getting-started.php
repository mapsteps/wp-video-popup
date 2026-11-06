<?php
/**
 * Getting started metabox: how to add a popup, with a shortcode builder.
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );
?>

<div class="heatbox wpvp-getting-started">
	<h2>
		<?php esc_html_e( 'Getting started', 'responsive-youtube-vimeo-popup' ); ?>
	</h2>
	<div class="heatbox-content">

		<ol class="heatbox-steps">
			<li>
				<h3><?php esc_html_e( 'Add the shortcode', 'responsive-youtube-vimeo-popup' ); ?></h3>
				<p class="description"><?php esc_html_e( 'Build your shortcode below, then paste it into any page, post or template.', 'responsive-youtube-vimeo-popup' ); ?></p>

				<div class="wpvp-builder">

					<div class="wpvp-builder-field">
						<label for="wpvp-builder-video"><?php esc_html_e( 'Video URL', 'responsive-youtube-vimeo-popup' ); ?></label>
						<div class="wpvp-builder-video">
							<input type="url" id="wpvp-builder-video" class="large-text" placeholder="https://www.youtube.com/watch?v=YlUKcNNmywk" aria-describedby="wpvp-builder-video-hint" autocomplete="off">
							<span class="wpvp-service" id="wpvp-builder-service" hidden></span>
						</div>
						<p class="description" id="wpvp-builder-video-hint" data-default="<?php esc_attr_e( 'A YouTube, Vimeo or Rumble link.', 'responsive-youtube-vimeo-popup' ); ?>" data-invalid="<?php esc_attr_e( 'This doesn\'t look like a YouTube, Vimeo or Rumble link.', 'responsive-youtube-vimeo-popup' ); ?>">
							<?php esc_html_e( 'A YouTube, Vimeo or Rumble link.', 'responsive-youtube-vimeo-popup' ); ?>
						</p>
					</div>

					<div class="wpvp-builder-row">
						<div class="wpvp-builder-field">
							<div class="wpvp-builder-label">
								<label for="wpvp-builder-text"><?php esc_html_e( 'Button text (optional)', 'responsive-youtube-vimeo-popup' ); ?></label>
								<span class="heatbox-tooltip" tabindex="0">
									<span class="dashicons dashicons-editor-help" aria-hidden="true"></span>
									<span class="tooltip-content" id="wpvp-builder-text-hint">
										<?php esc_html_e( 'Outputs a button (matching your theme\'s style) which opens the popup.', 'responsive-youtube-vimeo-popup' ); ?>
										<?php esc_html_e( 'Follow step 2 to assign the trigger yourself.', 'responsive-youtube-vimeo-popup' ); ?>
									</span>
								</span>
							</div>
							<input type="text" id="wpvp-builder-text" class="regular-text" placeholder="<?php esc_attr_e( 'Watch video', 'responsive-youtube-vimeo-popup' ); ?>" aria-describedby="wpvp-builder-text-hint" autocomplete="off">
						</div>
						<div class="wpvp-builder-field">
							<label for="wpvp-builder-start"><?php esc_html_e( 'Start at (seconds)', 'responsive-youtube-vimeo-popup' ); ?></label>
							<input type="number" id="wpvp-builder-start" class="small-text" min="0" step="1" placeholder="0">
						</div>
					</div>

					<div class="wpvp-chips">
						<label class="wpvp-chip">
							<input type="checkbox" id="wpvp-builder-mute">
							<span class="dashicons dashicons-controls-volumeoff" aria-hidden="true"></span>
							<?php esc_html_e( 'Mute video', 'responsive-youtube-vimeo-popup' ); ?>
						</label>
						<label class="wpvp-chip">
							<input type="checkbox" id="wpvp-builder-portrait">
							<span class="dashicons dashicons-smartphone" aria-hidden="true"></span>
							<?php esc_html_e( 'Portrait video', 'responsive-youtube-vimeo-popup' ); ?>
						</label>
					</div>

					<div class="wpvp-code">
						<code id="wpvp-builder-output">[wp-video-popup video="https://www.youtube.com/watch?v=YlUKcNNmywk"]</code>
						<button type="button" class="wpvp-code-copy wpvp-copy" data-copied="<?php esc_attr_e( 'Copied!', 'responsive-youtube-vimeo-popup' ); ?>" data-copy-target="wpvp-builder-output" aria-label="<?php esc_attr_e( 'Copy shortcode', 'responsive-youtube-vimeo-popup' ); ?>">
							<span class="dashicons dashicons-admin-page" aria-hidden="true"></span>
							<span class="wpvp-copy-label"><?php esc_html_e( 'Copy', 'responsive-youtube-vimeo-popup' ); ?></span>
						</button>
					</div>

				</div>
			</li>
			<li>
				<h3><?php esc_html_e( 'Add the trigger', 'responsive-youtube-vimeo-popup' ); ?></h3>
				<p class="description"><?php esc_html_e( 'Add this CSS class to any button, link or image that should open the popup:', 'responsive-youtube-vimeo-popup' ); ?></p>

				<div class="wpvp-code is-inline">
					<code id="wpvp-trigger-class">wp-video-popup</code>
					<button type="button" class="wpvp-code-copy wpvp-copy" data-copied="<?php esc_attr_e( 'Copied!', 'responsive-youtube-vimeo-popup' ); ?>" data-copy-target="wpvp-trigger-class" aria-label="<?php esc_attr_e( 'Copy CSS class', 'responsive-youtube-vimeo-popup' ); ?>">
						<span class="dashicons dashicons-admin-page" aria-hidden="true"></span>
						<span class="wpvp-copy-label"><?php esc_html_e( 'Copy', 'responsive-youtube-vimeo-popup' ); ?></span>
					</button>
				</div>

				<p class="description">
					<?php
					printf(
						/* translators: %s: Example of the enclosing shortcode. */
						esc_html__( 'Or wrap an image in the shortcode to make it the trigger: %s', 'responsive-youtube-vimeo-popup' ),
						'<code>[wp-video-popup video="…"]&lt;img …&gt;[/wp-video-popup]</code>'
					);
					?>
				</p>
			</li>
		</ol>

		<span class="screen-reader-text" role="status" id="wpvp-copy-status"></span>

	</div>
</div>

<div class="heatbox-cta-container is-attached">
	<div class="heatbox-cta secondary">
		<p><?php esc_html_e( 'The free version supports one video popup per page.', 'responsive-youtube-vimeo-popup' ); ?></p>
		<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=getting_started&utm_campaign=wp_video_popup" class="button" target="_blank">
			<?php esc_html_e( 'Get multiple popups with PRO', 'responsive-youtube-vimeo-popup' ); ?>
		</a>
	</div>
</div>
