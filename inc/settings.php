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
	register_setting( 'wp-video-popup-settings-group', 'ryv-popup' );

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

	echo '<input type="text" name="ryv-popup[ryv_popup_background_color]" value="" class="color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.88)" disabled />';

}

/**
 * Popup size callback.
 */
function wp_video_popup_size_callback() {

	echo '<input type="text" name="ryv-popup[ryv_popup_size]" size="12" placeholder="75%" value="" disabled />';
	echo '<p class="description">';
	_e( 'Default: 1200px', 'wp-video-popup' );
	echo '</p>';

}
