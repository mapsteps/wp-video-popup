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
	require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'templates/settings.php';
}

/**
 * Add settings link to plugin list page.
 *
 * @param array  $actions     An array of plugin action links.
 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
 * @param array  $plugin_data An array of plugin data. See `get_plugin_data()`.
 * @param string $context     The plugin context. By default this can include 'all', 'active', 'inactive',
 *                            'recently_activated', 'upgrade', 'mustuse', 'dropins', and 'search'.
 *
 * @return array The modified plugin action links.
 */
function wp_video_popup_add_settings_link( $actions, $plugin_file, $plugin_data, $context ) {
	if ( WP_VIDEO_POPUP_PLUGIN_BASENAME === $plugin_file ) {
		$settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=wp-video-popup' ) ) . '">' . __( 'Settings', 'wp-video-popup' ) . '</a>';

		array_unshift( $actions, $settings_link );
	}

	return $actions;
}
add_filter( 'plugin_action_links', 'wp_video_popup_add_settings_link', 10, 4 );

// Settings.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/settings.php';

// Parser.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/class-wp-video-popup-parser.php';
