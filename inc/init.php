<?php
/**
 * Init.
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Settings page.
 */
function wp_video_popup_options_page() {
	add_options_page( 'WP Video Popup', 'WP Video Popup', 'manage_options', 'wp-video-popup', 'wp_video_popup_settings_page_template' );
}
add_action( 'admin_menu', 'wp_video_popup_options_page' );

/**
 * Settings page callback.
 */
function wp_video_popup_settings_page_template() {
	require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/settings-template.php';
}

// Settings.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/settings.php';

// Parser.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/class-wp-video-popup-parser.php';
