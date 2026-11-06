<?php
/**
 * Plugin Name: WP Video Popup
 * Plugin URI: https://wp-video-popup.com
 * Description: Add a YouTube, Vimeo or Rumble video popup to WordPress. Lightweight, privacy-friendly lightbox that works with any page builder.
 * Version: 2.11
 * Requires at least: 4.7
 * Requires PHP: 5.6
 * Author: David Vongries
 * Author URI: https://mapsteps.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: responsive-youtube-vimeo-popup
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Plugin constants.
define( 'WP_VIDEO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_VERSION', '2.11' );
define( 'WP_VIDEO_POPUP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Clean up behind us.
if ( get_option( '_site_transient_disable-ryv-notice' ) ) {
	delete_option( '_site_transient_disable-ryv-notice' );
}

// Persist Admin notice Dismissals.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/persist-admin-notices-dismissal/persist-admin-notices-dismissal.php';

/**
 * PRO admin notice.
 */
function wp_video_popup_pro_ad() {

	if ( ! PAnD::is_admin_notice_active( 'wp-video-popup-pro-ad-forever' ) ) {
		return;
	}

	?>

	<div class="notice notice-info wpvp-activation-notice is-dismissible" data-dismissible="wp-video-popup-pro-ad-forever">

		<div class="notice-body">
			<div class="notice-icon">
				<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/wp-video-popup-logo-1.png" alt="">
			</div>
			<div class="notice-content">
				<h2>
					<?php esc_html_e( 'Welcome to WP Video Popup!', 'responsive-youtube-vimeo-popup' ); ?>
				</h2>
				<p>
					<?php echo wp_kses_post( __( 'Thank you for downloading WP Video Popup! As a valued customer you can get <strong style="color: tomato">70% off WP Video Popup PRO</strong> for a limited time, automatically applied at checkout. Grab it while it lasts.', 'responsive-youtube-vimeo-popup' ) ); ?>
				</p>
				<p>
					<a href="<?php echo esc_url( admin_url( 'options-general.php?page=wp-video-popup' ) ); ?>" class="button"><?php esc_html_e( 'Learn more', 'responsive-youtube-vimeo-popup' ); ?></a>
					<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=admin_notice&utm_campaign=wp_video_popup" target="_blank" class="button button-primary"><?php esc_html_e( 'Get WP Video Popup PRO - 70% off!', 'responsive-youtube-vimeo-popup' ); ?></a>
				</p>
			</div>
		</div>

	</div>

	<?php

}
add_action( 'admin_notices', 'wp_video_popup_pro_ad' );
add_action( 'admin_init', array( 'PAnD', 'init' ) );

/**
 * Plugin activation.
 */
function wp_video_popup_activation() {

	if ( ! current_user_can( 'activate_plugins' ) || 'true' === get_option( 'wp_video_popup_plugin_activated' ) ) {
		return;
	}

	add_option( 'wp_video_popup_install_date', current_time( 'mysql' ) );
	add_option( 'wp_video_popup_plugin_activated', 'true' );

}
add_action( 'init', 'wp_video_popup_activation' );

/**
 * Plugin deactivation.
 */
function wp_video_popup_deactivation() {

	delete_option( 'wp_video_popup_install_date' );
	delete_option( 'wp_video_popup_plugin_activated' );
	delete_option( 'wp_video_popup_review_notice' );

}
register_deactivation_hook( __FILE__, 'wp_video_popup_deactivation' );

/**
 * Review notice.
 */
function wp_video_popup_review_notice() {

	// Stop here if notice has been dismissed.
	if ( ! empty( get_option( 'wp_video_popup_review_notice', 0 ) ) ) {
		return;
	}

	// Stop here if current user can't manage options.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Review notice.
	$install_date = get_option( 'wp_video_popup_install_date', '' );

	// Stop if there's no install date.
	if ( empty( $install_date ) ) {
		return;
	}

	$diff = round( ( time() - strtotime( $install_date ) ) / 24 / 60 / 60 );

	// Only go past this point if WP Video Popup is running for more than 5 days.
	if ( $diff < 5 ) {
		return;
	}

	$emoji      = '😍';
	$review_url = 'https://wordpress.org/support/plugin/responsive-youtube-vimeo-popup/reviews/?rate=5#new-post';
	$link_start = '<a href="' . $review_url . '" target="_blank">';
	$link_end   = '</a>';
	// translators: %1$s: Emoji, %2$s: Link start tag, %3$s: Link end tag.
	$notice   = sprintf( __( '%1$s Love using WP Video Popup? - That\'s awesome! Help us spread the word and leave us a %2$s 5-star review %3$s in the WordPress repository.', 'responsive-youtube-vimeo-popup' ), $emoji, $link_start, $link_end );
	$btn_text = __( 'Sure! You deserve it!', 'responsive-youtube-vimeo-popup' );
	$notice  .= '<br/>';
	$notice  .= "<a href=\"$review_url\" style=\"margin-top: 15px;\" target='_blank' class=\"button-primary\">$btn_text</a>";

	echo '<div class="notice notice-info wp-video-popup-review-notice is-dismissible">';
	echo '<p>' . wp_kses_post( $notice ) . '</p>';
	echo '</div>';

}
add_action( 'admin_notices', 'wp_video_popup_review_notice' );

/**
 * Dismiss admin notice.
 */
function wp_video_popup_dismiss_review_notice() {

	if ( ! check_ajax_referer( 'WP_Video_Popup_Dismiss_Review_Notice', 'nonce', false ) ) {
		wp_send_json_error( __( 'Invalid Token', 'responsive-youtube-vimeo-popup' ) );
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( __( 'Insufficient permissions', 'responsive-youtube-vimeo-popup' ) );
	}

	$dismiss = isset( $_POST['dismiss'] ) ? absint( $_POST['dismiss'] ) : 0;

	if ( empty( $dismiss ) ) {
		wp_send_json_error( __( 'Invalid Request', 'responsive-youtube-vimeo-popup' ) );
	}

	update_option( 'wp_video_popup_review_notice', 1 );
	wp_send_json_success( __( 'Review notice has been dismissed', 'responsive-youtube-vimeo-popup' ) );

}
add_action( 'wp_ajax_wp_video_popup_review_notice_dismissal', 'wp_video_popup_dismiss_review_notice' );

/**
 * Script that handles discount notice dismissal.
 */
function wp_video_popup_review_notice_script() {

	// Stop here if notice has been dismissed.
	if ( ! empty( get_option( 'wp_video_popup_review_notice', 0 ) ) ) {
		return;
	}

	// Stop here if current user can't manage options.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	wp_enqueue_script( 'wp-video-popup-review', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/js/review-notice.js', array( 'jquery' ), WP_VIDEO_POPUP_PLUGIN_VERSION, true );

	wp_localize_script(
		'wp-video-popup-review',
		'WPVideoPopupDismissal',
		array(
			'nonces' => array(
				'dismissalNonce' => wp_create_nonce( 'WP_Video_Popup_Dismiss_Review_Notice' ),
			),
		)
	);

}
add_action( 'admin_enqueue_scripts', 'wp_video_popup_review_notice_script' );

/**
 * Translatable labels for the settings page scripts.
 *
 * @return array The labels.
 */
function wp_video_popup_admin_i18n() {

	return array(
		'defaultColor' => __( 'Default', 'responsive-youtube-vimeo-popup' ),
		'colorPicker'  => array(
			'clearLabel' => __( 'Clear', 'responsive-youtube-vimeo-popup' ),
			'a11y'       => array(
				'open'        => __( 'Open color picker', 'responsive-youtube-vimeo-popup' ),
				'close'       => __( 'Close color picker', 'responsive-youtube-vimeo-popup' ),
				'clear'       => __( 'Clear the selected color', 'responsive-youtube-vimeo-popup' ),
				/* translators: {s} & {v} are placeholders for the saturation & brightness values, keep them as they are. */
				'marker'      => __( 'Saturation: {s}. Brightness: {v}.', 'responsive-youtube-vimeo-popup' ),
				'hueSlider'   => __( 'Hue slider', 'responsive-youtube-vimeo-popup' ),
				'alphaSlider' => __( 'Opacity slider', 'responsive-youtube-vimeo-popup' ),
				'input'       => __( 'Color value field', 'responsive-youtube-vimeo-popup' ),
				'format'      => __( 'Color format', 'responsive-youtube-vimeo-popup' ),
				'swatch'      => __( 'Color swatch', 'responsive-youtube-vimeo-popup' ),
				'instruction' => __( 'Saturation and brightness selector. Use up, down, left and right arrow keys to select.', 'responsive-youtube-vimeo-popup' ),
			),
		),
	);

}

/**
 * Admin scripts & styles.
 *
 * @param string $hook The current admin page hook.
 */
function wp_video_popup_admin_scripts_styles( $hook ) {

	wp_enqueue_style( 'wpvp-activation-notice', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/activation-notice.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );

	// Stop here if we're not on the settings page.
	if ( 'settings_page_wp-video-popup' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'heatbox', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/heatbox.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );
	wp_enqueue_style( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/admin-page.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );

	// Color picker (Coloris).
	wp_enqueue_style( 'coloris', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/vendor/coloris/coloris.min.css', array(), '0.25.0' );
	wp_enqueue_script( 'coloris', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/vendor/coloris/coloris.min.js', array(), '0.25.0', true );

	wp_enqueue_script( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/js/admin-page.js', array( 'jquery', 'coloris' ), WP_VIDEO_POPUP_PLUGIN_VERSION, true );
	wp_localize_script( 'wp-video-popup', 'wpVideoPopupAdmin', wp_video_popup_admin_i18n() );

}
add_action( 'admin_enqueue_scripts', 'wp_video_popup_admin_scripts_styles' );

/**
 * Admin body class.
 *
 * @param string $classes The class names.
 *
 * @return string The class names.
 */
function wp_video_popup_admin_body_class( $classes ) {

	$screen = get_current_screen();

	if ( ! $screen || 'settings_page_wp-video-popup' !== $screen->id ) {
		return $classes;
	}

	$classes .= ' heatbox-admin has-header';

	return $classes;

}
add_filter( 'admin_body_class', 'wp_video_popup_admin_body_class' );

/**
 * Enqueue scripts & styles.
 */
function wp_video_popup_styles() {

	wp_enqueue_style( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/wp-video-popup.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );
	wp_enqueue_script( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/js/wp-video-popup.js', array( 'jquery' ), WP_VIDEO_POPUP_PLUGIN_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'wp_video_popup_styles' );

/**
 * Popup shortcode.
 *
 * Usage:
 * [wp-video-popup video="URL"] – popup only, opened by any element with the class wp-video-popup.
 * [wp-video-popup video="URL" text="Watch video"] – popup plus a trigger button.
 * [wp-video-popup video="URL"]<img …>[/wp-video-popup] – popup plus the content wrapped in a trigger.
 *
 * @param array  $wp_video_popup_atts The shortcode attributes.
 * @param string $content The enclosed content (optional).
 *
 * @return string wp_video_popup_output The popup markup.
 */
function wp_video_popup_shortcode( $wp_video_popup_atts, $content = null ) {

	$wp_video_popup_atts = shortcode_atts(
		array(
			'video'        => 'https://www.youtube.com/embed/YlUKcNNmywk',
			'mute'         => 0,
			'start'        => 0,
			'hide-related' => 0,
			'portrait'     => 0,
			'text'         => '',
		),
		$wp_video_popup_atts,
		'wp-video-popup'
	);

	// Shortcode attributes.
	$video        = esc_url( $wp_video_popup_atts['video'] );
	$mute         = $wp_video_popup_atts['mute'] ? 1 : 0;
	$start        = absint( $wp_video_popup_atts['start'] );
	$hide_related = $wp_video_popup_atts['hide-related'] ? 1 : 0;
	$viewport     = $wp_video_popup_atts['portrait'] ? 'is-portrait' : 'is-landscape';

	// Parser data.
	$video_type = WP_Video_Popup_Parser::identify_service( $video );
	$video_url  = WP_Video_Popup_Parser::get_embed_url( $video );

	// Don't output a broken popup if the video couldn't be identified.
	if ( ! $video_url ) {
		return '';
	}

	/* Construct Output */

	// Add class to landscape YouTube & Vimeos to dynamically resize them.
	if ( 'is-landscape' === $viewport ) {
		$viewport .= ' is-resizable';
	}

	if ( 'vimeo' === $video_type ) {

		// Mute Vimeo video.
		if ( $mute ) {
			$video_url .= '&muted=1';
		}

	} elseif ( 'rumble' === $video_type ) {

		if ( $hide_related ) {
			$video_url .= '&rel=0';
		}

	} else {

		// Remove YouTube related videos.
		if ( $hide_related ) {
			$video_url .= '&rel=0';
		}

		// Mute YouTube video.
		if ( $mute ) {
			$video_url .= '&mute=1';
		}

	}

	// Filter to let people add other URL parameters.
	$video_url = apply_filters( 'wp_video_popup', $video_url );

	// Start the video at a specific time (Vimeo uses a hash, YouTube & Rumble a parameter).
	if ( $start ) {
		$video_url .= 'vimeo' === $video_type ? '#t=' . $start : '&start=' . $start;
	}

	$popup = '
	<div class="wp-video-popup-wrapper" role="dialog" aria-modal="true" aria-label="' . esc_attr__( 'Video', 'responsive-youtube-vimeo-popup' ) . '">
		<button type="button" class="wp-video-popup-close" aria-label="' . esc_attr__( 'Close video', 'responsive-youtube-vimeo-popup' ) . '"></button>
		<iframe class="wp-video-popup-video is-hosted ' . $viewport . '" src="" data-wp-video-popup-url="' . esc_url( $video_url ) . '" title="' . esc_attr__( 'Video', 'responsive-youtube-vimeo-popup' ) . '" frameborder="0" allowfullscreen allow="autoplay; fullscreen; picture-in-picture">
		</iframe>
	</div>
	';

	return wp_video_popup_trigger( $content, $wp_video_popup_atts['text'] ) . $popup;

}

/**
 * Trigger markup for the popup shortcode.
 *
 * Enclosed content wins over the text attribute. Without either, no trigger is output
 * and any element with the class wp-video-popup opens the popup (the classic way).
 *
 * @param string|null $content The enclosed content.
 * @param string      $text The button text.
 *
 * @return string The trigger markup.
 */
function wp_video_popup_trigger( $content, $text ) {

	// Remove the stray paragraph & line break tags wpautop leaves around enclosed content.
	$content = preg_replace( '#^(\s*(</p>|<br\s*/?>))+|((<p>|<br\s*/?>)\s*)+$#i', '', trim( (string) $content ) );
	$content = trim( do_shortcode( shortcode_unautop( trim( $content ) ) ) );

	if ( '' !== $content ) {

		// Block-level content needs a block-level wrapper to keep the markup valid.
		$tag = preg_match( '#<(p|div|figure|h[1-6]|ul|ol|table|section|blockquote)[\s>]#i', $content ) ? 'div' : 'span';

		// The front-end script makes the wrapper focusable and keyboard-operable.
		return '<' . $tag . ' class="wp-video-popup wp-video-popup-trigger is-wrapper">' . $content . '</' . $tag . '>';

	}

	$text = trim( (string) $text );

	if ( '' !== $text ) {
		return '<button type="button" class="wp-video-popup wp-video-popup-trigger">' . esc_html( $text ) . '</button>';
	}

	return '';

}
add_shortcode( 'wp-video-popup', 'wp_video_popup_shortcode' );
add_shortcode( 'ryv-popup', 'wp_video_popup_shortcode' ); // Backwards compatibility.

// Required files.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/class-wp-video-popup-parser.php';
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/init.php';
