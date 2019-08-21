<?php
/**
 * Plugin Name: WP Video Popup
 * Plugin URI: https://wp-video-popup.com
 * Description: Add beautiful responsive YouTube & Vimeo Video lightbox popups to your WordPress website.
 * Version: 2.4
 * Author: David Vongries
 * Author URI: https://mapsteps.com
 * Text Domain: wp-video-popup
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Plugin constants.
define( 'WP_VIDEO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_VERSION', '2.4' );

/**
 * Load text domain
 *
 * @return void
 */
function wp_video_popup_textdomain() {
	load_plugin_textdomain( 'wp-video-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'wp_video_popup_textdomain' );

// Clean up behind us.
if ( get_option( '_site_transient_disable-ryv-notice' ) ) {
	delete_option( '_site_transient_disable-ryv-notice' );
}

// Persist Admin notice Dismissals.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/persist-admin-notices-dismissal/persist-admin-notices-dismissal.php';

/**
 * Pro ad
 *
 * @return void
 */
function wp_video_popup_pro_ad() {
	if ( ! PAnD::is_admin_notice_active( 'wp-video-popup-pro-ad-forever' ) ) {
		return;
	}

	?>

	<div data-dismissible="wp-video-popup-pro-ad-forever" class="notice notice-info is-dismissible">
		<p>
			<?php
			// phpcs:ignore -- is ok.
			_e( 'WP Video Popup PRO is now available! <strong>Save 30%</strong> and download <a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=admin_notice&utm_campaign=wp_video_popup" target="_blank"><strong>WP Video Popup PRO</strong></a> today.', 'wp-video-popup' ); 
			?>
		</p>
	</div>

	<?php

}
add_action( 'admin_notices', 'wp_video_popup_pro_ad' );
add_action( 'admin_init', array( 'PAnD', 'init' ) );

/**
 * Enqueue styles & scripts
 *
 * @return void
 */
function wp_video_popup_styles() {
	wp_register_style( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/wp-video-popup.css', [], WP_VIDEO_POPUP_PLUGIN_VERSION );
	wp_enqueue_style( 'wp-video-popup' );

	wp_register_script( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/js/wp-video-popup.js', array( 'jquery' ), WP_VIDEO_POPUP_PLUGIN_VERSION, true );
	wp_enqueue_script( 'wp-video-popup' );
}
add_action( 'wp_enqueue_scripts', 'wp_video_popup_styles' );

/**
 * Popup shortcode
 *
 * @param array $wp_video_popup_atts The shortcode attributes.
 * @return string wp_video_popup_output The popup markup.
 */
function wp_video_popup_shortcode( $wp_video_popup_atts ) {
	$wp_video_popup_atts = shortcode_atts(
		array(
			'video'        => 'https://www.youtube.com/embed/YlUKcNNmywk',
			'vimeo'        => 0,
			'mute'         => 0,
			'hide-related' => 0,
			'start'        => 0,
		),
		$wp_video_popup_atts,
		'wp-video-popup'
	);

	// vars.
	$video        = $wp_video_popup_atts['video'];
	$vimeo        = $wp_video_popup_atts['vimeo'] ? 1 : 0;
	$mute         = $wp_video_popup_atts['mute'] ? 1 : 0;
	$hide_related = $wp_video_popup_atts['hide-related'] ? 1 : 0;
	$start        = $wp_video_popup_atts['start'];

	$video_id = WP_Video_Popup_Parser::get_url_id( $video );

	if ( $vimeo ) {
		$video_url = 'https://player.vimeo.com/video/' . $video_id . '?autoplay=1';
	} else {
		if ( false !== strpos( $video, 'youtube-nocookie.com' ) ) {
			$video_url = 'https://www.youtube-nocookie.com/embed/' . $video_id . '?autoplay=1';
		} else {
			$video_url = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=1';
		}
	}

	/* URL Parameters */

	// remove related videos.
	if ( $hide_related && ! $vimeo ) {
		$video_url .= '&amp;rel=0';
	}

	// mute Vimeo video.
	if ( $mute && $vimeo ) {
		$video_url .= '&amp;muted=1';
	}

	// mute YouTube video.
	if ( $mute && ! $vimeo ) {
		$video_url .= '&amp;mute=1';
	}

	$video_url = apply_filters( 'wp_video_popup', $video_url );

	// start Vimeo video at specific time.
	if ( $start && $vimeo ) {
		$video_url .= '#t=' . $start;
	}

	// start YouTube video at specific time.
	if ( $start && ! $vimeo ) {
		$video_url .= '&amp;start=' . $start;
	}

	return '
	<div class="wp-video-popup-wrapper">
		<div class="wp-video-popup-wrapper">
			<div class="wp-video-popup-close"></div>
			<iframe class="wp-video-popup-video" src="" data-wp-video-popup-url="' . esc_url( $video_url ) . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay">
			</iframe>
		</div>
	</div>
	';
}
add_shortcode( 'wp-video-popup', 'wp_video_popup_shortcode' );

/* Required Files */

// Backwards Compatibility.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/backwards-compatibility.php';

// Parser.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/class-wp-video-popup-parser.php';
