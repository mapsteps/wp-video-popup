<?php
/**
 * Settings page template.
 *
 * @package WP_Video_Popup_PRO
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="wrap heatbox-wrap wpvp-admin-page">

	<div class="heatbox-header heatbox-margin-bottom">

		<div class="heatbox-container heatbox-container-center">

			<div class="logo-container">

				<div>
					<span class="title">
						<?php echo esc_html( get_admin_page_title() ); ?>
						<span class="version"><?php echo esc_html( WP_VIDEO_POPUP_PLUGIN_VERSION ); ?></span>
					</span>
					<p class="subtitle"><?php _e( 'The #1 Responsive Video Popup Plugin for WordPress.', 'wp-video-popup' ); ?></p>
				</div>

				<div>
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/wp-video-popup-logo-1.png">
				</div>

			</div>

			<!--
			<nav>
				<ul class="tab-navigation">
					<li class="tab-nav-menu-item settings"><a href="#settings"><?php _e( 'General', 'wp-video-popup' ); ?></a></li>
					<li class="tab-nav-menu-item recommended"><a href="#recommended"><?php _e( 'Recommended Plugins', 'wp-video-popup' ); ?></a></li>
				</ul>
			</nav>
			-->

		</div>

	</div>

	<div class="heatbox-container heatbox-container-center heatbox-column-container">

		<?php settings_fields( 'wp-video-popup-settings-group' ); ?>

		<div class="heatbox-main">

			<div class="heatbox-admin-panel settings-panel">

				<!-- Faking H1 tag to place admin notices -->
				<h1 style="display: none;"></h1>

				<div class="heatbox wpvp-settings-metabox">
					<?php do_settings_sections( 'wp-video-popup-settings' ); ?>
				</div>

				<div class="heatbox-cta-container is-attached">
					<div class="heatbox-cta primary">
						<p><?php _e( 'This feature is available in WP Video Popup PRO.', 'wp-video-popup' ); ?></p>
						<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" class="button button-large button-primary" target="_blank">
							<?php _e( 'Get WP Video Popup PRO - 30% OFF', 'wp-video-popup' ); ?>
						</a>
					</div>
				</div>

				<div class="heatbox wpvp-pro-metabox">
					<?php require __DIR__ . '/metaboxes/pro-features.php'; ?>
				</div>

			</div>

		</div>

		<div class="heatbox-sidebar">

			<?php
			require __DIR__ . '/metaboxes/documentation.php';
			require __DIR__ . '/metaboxes/review.php';
			?>

		</div>

	</div>

</div>
