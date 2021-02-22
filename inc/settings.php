<?php
/**
 * Settings.
 *
 * @package WP_Video_Popup_PRO
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Popup settings.
 */
function wp_video_popup_settings() {

	// Register settings.
	register_setting( 'wp-video-popup-settings-group', 'wpvp_popup' );

	// Settings sections.
	add_settings_section( 'wp-video-popup-settings-section', __( 'Settings', 'wp-video-popup' ), '', 'wp-video-popup-settings' );
	add_settings_section( 'wp-video-popup-pro-section', __( 'WP Video Popup PRO - 30% OFF!', 'wp-video-popup' ), '', 'wp-video-popup-pro-settings' );

	// Settings fields.
	add_settings_field( 'wp-video-popup-background-color', __( 'Overlay Background Color', 'wp-video-popup' ), 'wp_video_popup_background_color_callback', 'wp-video-popup-settings', 'wp-video-popup-settings-section' );
	add_settings_field( 'wp-video-popup-size', __( 'Popup Size', 'wp-video-popup' ), 'wp_video_popup_size_callback', 'wp-video-popup-settings', 'wp-video-popup-settings-section' );

	add_settings_field( 'wp-video-popup-pro', '', 'wp_video_popup_pro_callback', 'wp-video-popup-pro-settings', 'wp-video-popup-pro-section' );

}
add_action( 'admin_init', 'wp_video_popup_settings' );

/**
 * Background color callback.
 */
function wp_video_popup_background_color_callback() {

	echo '<input type="text" name="wpvp_popup[bg_color]" value="" class="color-picker wp-video-popup-color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.88)" disabled />';

}

/**
 * Popup size callback.
 */
function wp_video_popup_size_callback() {

	?>

	<div class="wpvp-size-settings">
		<ul class="wpvp-responsive-controls">
			<li class="wpvp-responsive-control is-active" data-device="desktop">
				<button type="button" class="wpvp-device-button" data-hint="<?php _e( 'Desktop', 'wp-video-popup' ); ?>">
					<i class="dashicons dashicons-desktop"></i>
				</button>
			</li>
			<li class="wpvp-responsive-control" data-device="tablet">
				<button type="button" class="wpvp-device-button" data-hint="<?php _e( 'Tablet', 'wp-video-popup' ); ?>">
					<i class="dashicons dashicons-tablet"></i>
				</button>
			</li>
			<li class="wpvp-responsive-control" data-device="mobile">
				<button type="button" class="wpvp-device-button" data-hint="<?php _e( 'Mobile', 'wp-video-popup' ); ?>">
					<i class="dashicons dashicons-smartphone"></i>
				</button>
			</li>
		</ul>

		<ul class="wpvp-responsive-sizes">
			<li class="wpvp-responsive-size wpvp-responsive-size-desktop is-active" data-size-device="desktop">
				<input type="text" name="wpvp_popup[sizes][desktop]" class="wpvp-size-field" placeholder="75%" value="" disabled />

				<p class="description">
					<?php _e( 'Default: 1200px', 'wp-video-popup' ); ?>
				</p>
			</li>
			<li class="wpvp-responsive-size wpvp-responsive-size-tablet" data-size-device="tablet">
				<input type="text" name="wpvp_popup[sizes][tablet]" class="wpvp-size-field" placeholder="50%" value="" disabled />

				<p class="description">&nbsp;</p>
			</li>
			<li class="wpvp-responsive-size wpvp-responsive-size-mobile" data-size-device="mobile">
				<input type="text" name="wpvp_popup[sizes][mobile]" class="wpvp-size-field" placeholder="90%" value="" disabled />

				<p class="description">&nbsp;</p>
			</li>
		</ul>
	</div>

	<br>

	<p style="margin-top: 20px; margin-bottom: 10px; border-top: 1px solid #ddd; display: inline-block; padding-top: 15px;">
		<?php echo sprintf( __( 'This feature is available in %1$s.', 'wp-video-popup' ), '<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" target="_blank">WP Video Popup PRO</a>' ); ?>
	</p>

	<br>

	<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" class="button button-primary" target="_blank">
	<?php _e( 'Get WP Video Popup PRO', 'wp-video-popup' ); ?>
	</a>

	<?php

}

function wp_video_popup_pro_callback() {

	?>

	<p>
		As a valued <strong>WP Video Popup</strong> user you receive <strong style="color: green;">30% off</strong>, automatically applied at checkout!
	</p>

	<h3>
		<?php _e( 'PRO Features:', 'wp-video-popup' ); ?>
	</h3>

	<ul>
		<li>✅ <?php _e( 'Multiple Videos per Page/Post', 'wp-video-popup' ); ?></li>
		<li>✅ <?php _e( 'Self-Hosted Videos', 'wp-video-popup' ); ?></li>
		<li>✅ <?php _e( 'Overlay Color Settings', 'wp-video-popup' ); ?></li>
		<li>✅ <?php _e( 'Video Size Settings', 'wp-video-popup' ); ?></li>
		<li>✅ <?php _e( 'Autoplay on Page Load', 'wp-video-popup' ); ?></li>
		<li>✅ <?php _e( 'Trigger Video Lightbox Based on URL', 'wp-video-popup' ); ?></li>
		<li>✅ <?php _e( 'Video Lightbox Galleries', 'wp-video-popup' ); ?></li>
	</ul>

	<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" class="button button-primary" target="_blank">	
		<?php _e( 'Get WP Video Popup PRO', 'wp-video-popup' ); ?>
	</a>

	<?php

}
