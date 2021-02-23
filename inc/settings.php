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

	// Settings fields.
	add_settings_field( 'wp-video-popup-background-color', __( 'Overlay Background Color', 'wp-video-popup' ), 'wp_video_popup_background_color_callback', 'wp-video-popup-settings', 'wp-video-popup-settings-section' );
	add_settings_field( 'wp-video-popup-size', __( 'Popup Size', 'wp-video-popup' ), 'wp_video_popup_size_callback', 'wp-video-popup-settings', 'wp-video-popup-settings-section' );

}
add_action( 'admin_init', 'wp_video_popup_settings' );

/**
 * Background color callback.
 */
function wp_video_popup_background_color_callback() {
	echo '<input type="text" name="wpvp_popup[bg_color]" value="" class="color-picker wp-video-popup-color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.88)" />';
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
				<input type="text" name="wpvp_popup[sizes][desktop]" class="wpvp-size-field" placeholder="75%" value="" />

				<p class="description">
					<?php _e( 'Default: 1200px', 'wp-video-popup' ); ?>
				</p>
			</li>
			<li class="wpvp-responsive-size wpvp-responsive-size-tablet" data-size-device="tablet">
				<input type="text" name="wpvp_popup[sizes][tablet]" class="wpvp-size-field" value="" />
			</li>
			<li class="wpvp-responsive-size wpvp-responsive-size-mobile" data-size-device="mobile">
				<input type="text" name="wpvp_popup[sizes][mobile]" class="wpvp-size-field" value="" />
			</li>
		</ul>
	</div>

	<?php

}
