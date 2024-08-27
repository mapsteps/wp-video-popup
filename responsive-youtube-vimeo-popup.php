<?php
/**
 * Plugin Name: WP Video Popup
 * Plugin URI: https://wp-video-popup.com
 * Description: Add beautiful responsive YouTube, Rumble & Vimeo Video lightbox popups to your WordPress website.
 * Version: 2.10.1
 * Author: David Vongries
 * Author URI: https://mapsteps.com
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

// Plugin constants.
define( 'WP_VIDEO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_VIDEO_POPUP_PLUGIN_VERSION', '2.10.1' );
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
				<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/wp-video-popup-logo-1.png">
			</div>
			<div class="notice-content">
				<h2>
					<?php _e( 'Welcome to WP Video Popup!', 'wp-video-popup' ); ?>
				</h2>
				<p>
					<?php _e( 'Thank you for downloading WP Video Popup! As a valued customer you can get <strong style="color: tomato">70% off WP Video Popup PRO</strong> for a limited time, automatically applied at checkout. Grab it while it lasts.', 'wp-video-popup' ); ?>
				</p>
				<p>
					<a href="<?php echo esc_url( admin_url( 'options-general.php?page=wp-video-popup' ) ); ?>" class="button"><?php _e( 'Learn more', 'wp-video-popup' ); ?></a>
					<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=admin_notice&utm_campaign=wp_video_popup" target="_blank" class="button button-primary"><?php _e( 'Get WP Video Popup PRO - 70% off!', 'wp-video-popup' ); ?></a>
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

	if ( ! current_user_can( 'activate_plugins' ) || 'true' == get_option( 'wp_video_popup_plugin_activated' ) ) {
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
	$notice   = sprintf( __( '%1$s Love using WP Video Popup? - That\'s awesome! Help us spread the word and leave us a %2$s 5-star review %3$s in the WordPress repository.', 'wp-video-popup' ), $emoji, $link_start, $link_end );
	$btn_text = __( 'Sure! You deserve it!', 'wp-video-popup' );
	$notice  .= '<br/>';
	$notice  .= "<a href=\"$review_url\" style=\"margin-top: 15px;\" target='_blank' class=\"button-primary\">$btn_text</a>";

	echo '<div class="notice notice-info wp-video-popup-review-notice is-dismissible">';
	echo '<p>' . $notice . '</p>';
	echo '</div>';

}
add_action( 'admin_notices', 'wp_video_popup_review_notice' );

/**
 * Dismiss admin notice.
 */
function wp_video_popup_dismiss_review_notice() {

	$nonce   = isset( $_POST['nonce'] ) ? $_POST['nonce'] : 0;
	$dismiss = isset( $_POST['dismiss'] ) ? absint( $_POST['dismiss'] ) : 0;

	if ( empty( $dismiss ) ) {
		wp_send_json_error( __( 'Invalid Request', 'wp-video-popup' ) );
	}

	if ( ! wp_verify_nonce( $nonce, 'WP_Video_Popup_Dismiss_Review_Notice' ) ) {
		wp_send_json_error( __( 'Invalid Token', 'wp-video-popup' ) );
	}

	update_option( 'wp_video_popup_review_notice', 1 );
	wp_send_json_success( __( 'Discount notice has been dismissed', 'wp-video-popup' ) );

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

	wp_enqueue_script( 'wp-video-popup-review', WP_VIDEO_POPUP_PLUGIN_URL . '/assets/js/review-notice.js', array( 'jquery' ), WP_VIDEO_POPUP_PLUGIN_VERSION, true );

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
 * Admin scripts & styles.
 */
function wp_video_popup_admin_scripts_styles( $hook ) {

	wp_enqueue_style( 'wpvp-activation-notice', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/activation-notice.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );

	// Stop here if we're not on the settings page.
	if ( 'settings_page_wp-video-popup' !== $hook ) {
		return;
	}

	wp_enqueue_style( 'heatbox', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/heatbox.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );
	wp_enqueue_style( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/css/admin-page.css', array(), WP_VIDEO_POPUP_PLUGIN_VERSION );

	// Color picker.
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-video-popup', WP_VIDEO_POPUP_PLUGIN_URL . 'assets/js/admin-page.js', array( 'wp-color-picker' ), WP_VIDEO_POPUP_PLUGIN_VERSION, true );

}
add_action( 'admin_enqueue_scripts', 'wp_video_popup_admin_scripts_styles' );

/**
 * Admin body class.
 *
 * @param string $classes The class names.
 */
function wp_video_popup_admin_body_class( $classes ) {

	$screen = get_current_screen();

	if ( $screen->id !== 'settings_page_wp-video-popup' ) {
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
 * @param array $wp_video_popup_atts The shortcode attributes.
 *
 * @return string wp_video_popup_output The popup markup.
 */
function wp_video_popup_shortcode( $wp_video_popup_atts ) {

	$wp_video_popup_atts = shortcode_atts(
		array(
			'video'        => 'https://www.youtube.com/embed/YlUKcNNmywk',
			'mute'         => 0,
			'start'        => 0,
			'hide-related' => 0,
			'portrait'     => 0,
		),
		$wp_video_popup_atts,
		'wp-video-popup'
	);

	// Shortcode attributes.
	$video        = esc_url( $wp_video_popup_atts['video'] );
	$mute         = $wp_video_popup_atts['mute'] ? 1 : 0;
	$start        = $wp_video_popup_atts['start'];
	$hide_related = $wp_video_popup_atts['hide-related'] ? 1 : 0;
	$viewport     = $wp_video_popup_atts['portrait'] ? 'is-portrait' : 'is-landscape';

	// Parser data.
	$video_type = WP_Video_Popup_Parser::identify_service( $video );
	$video_url  = WP_Video_Popup_Parser::get_embed_url( $video );

	/* Construct Output */

	// Add class to landscape YouTube & Vimeos to dynamically resize them.
	if ( 'is-landscape' === $viewport ) {
		$viewport .= ' is-resizable';
	}

	if ( 'vimeo' === $video_type ) {

		// Mute Vimeo video.
		if ( $mute ) {
			$video_url .= '&amp;muted=1';
		}

	} elseif ( 'rumble' === $video_type ) {

		if ( $hide_related ) {
			$video_url .= '&amp;rel=0';
		}

	} else {

		// Remove YouTube related videos.
		if ( $hide_related ) {
			$video_url .= '&amp;rel=0';
		}

		// Mute YouTube video.
		if ( $mute ) {
			$video_url .= '&amp;mute=1';
		}

	}

	// Filter to let people add other URL parameters.
	$video_url = apply_filters( 'wp_video_popup', $video_url );

	if ( 'vimeo' === $video_type ) {

		// Start Vimeo video at specific time.
		if ( $start ) {
			$video_url .= '#t=' . $start;
		}

	} else {

		// Start YouTube video at specific time.
		if ( $start ) {
			$video_url .= '&amp;start=' . $start;
		}

	}

	return '
	<div class="wp-video-popup-wrapper">
		<div class="wp-video-popup-close"></div>
		<iframe class="wp-video-popup-video is-hosted ' . $viewport . '" src="" data-wp-video-popup-url="' . esc_url( $video_url ) . '" frameborder="0" allowfullscreen allow="autoplay">
		</iframe>
	</div>
	';

    return $output;

}
add_shortcode( 'wp-video-popup', 'wp_video_popup_shortcode' );
add_shortcode( 'ryv-popup', 'wp_video_popup_shortcode' ); // Backwards compatibility.

// Required files.
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/class-wp-video-popup-parser.php';
require_once WP_VIDEO_POPUP_PLUGIN_DIR . 'inc/init.php';
