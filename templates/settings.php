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

			<nav>
				<ul class="tab-navigation">
					<li class="tab-nav-menu-item settings"><a href="#settings"><?php _e( 'General', 'wp-video-popup' ); ?></a></li>
					<li class="tab-nav-menu-item recommended"><a href="#recommended"><?php _e( 'PRO Features', 'wp-video-popup' ); ?></a></li>
				</ul>
			</nav>

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

				<div class="heatbox-cta primary heatbox-margin-bottom">
					<p><?php _e( 'This feature is available in WP Video Popup PRO.', 'wp-video-popup' ); ?></p>
					<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" class="button button-large button-primary" target="_blank">
						<?php _e( 'Get WP Video Popup PRO - 30% off!', 'wp-video-popup' ); ?>
					</a>
				</div>

			</div>

			<div class="heatbox-admin-panel recommended-panel">
				<?php require __DIR__ . '/metaboxes/pro-features.php'; ?>
			</div>

		</div>

		<div class="heatbox-sidebar">

			<?php
			require __DIR__ . '/metaboxes/documentation.php';
			require __DIR__ . '/metaboxes/review.php';
			?>

		</div>

		<div class="heatbox-divider"></div>

	</div>

	<div class="heatbox-container heatbox-container-wide heatbox-container-center featured-products">

		<h2><?php _e( 'Check out our other free WordPress products!', 'wp-video-popup' ); ?></h2>

		<ul class="products">
			<li class="heatbox">
				<a href="https://wordpress.org/plugins/ultimate-dashboard/" target="_blank">
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/ultimate-dashboard.jpg">
				</a>
				<div class="heatbox-content">
					<h3><?php _e( 'Ultimate Dashboard', 'wp-video-popup' ); ?></h3>
					<p class="subheadline"><?php _e( 'Fully customize your WordPress Dashboard.', 'wp-video-popup' ); ?></p>
					<p><?php _e( 'Ultimate Dashboard is the #1 plugin to create a Custom WordPress Dashboard for you and your clients. It also comes with Multisite Support which makes it the perfect plugin for your WaaS network.', 'wp-video-popup' ); ?></p>
					<a href="https://wordpress.org/plugins/ultimate-dashboard/" target="_blank" class="button"><?php _e( 'View Features', 'wp-video-popup' ); ?></a>
				</div>
			</li>
			<li class="heatbox">
				<a href="https://wordpress.org/themes/page-builder-framework/" target="_blank">
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/page-builder-framework.jpg">
				</a>
				<div class="heatbox-content">
					<h3><?php _e( 'Page Builder Framework', 'wp-video-popup' ); ?></h3>
					<p class="subheadline"><?php _e( 'The only Theme you\'ll ever need.', 'wp-video-popup' ); ?></p>
					<p class="description"><?php _e( 'With its minimalistic design the Page Builder Framework theme is the perfect foundation for your next project. Build blazing fast websites with a theme that is easy to use, lightweight & highly customizable.', 'wp-video-popup' ); ?></p>
					<a href="https://wordpress.org/themes/page-builder-framework/" target="_blank" class="button"><?php _e( 'View Features', 'wp-video-popup' ); ?></a>
				</div>
			</li>
			<li class="heatbox">
				<a href="https://wordpress.org/plugins/swift-control/" target="_blank">
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/swift-control.jpg">
				</a>
				<div class="heatbox-content">
					<h3><?php _e( 'WP Swift Control', 'wp-video-popup' ); ?></h3>
					<p class="subheadline"><?php _e( 'Replace the boring WordPress Admin Bar with this!', 'wp-video-popup' ); ?></p>
					<p><?php _e( 'Swift Control is the plugin that make your clients love WordPress. It drastically improves the user experience when working with WordPress and allows you to replace the boring WordPress admin bar with your own navigation panel.', 'wp-video-popup' ); ?></p>
					<a href="https://wordpress.org/plugins/swift-control/" target="_blank" class="button"><?php _e( 'View Features', 'wp-video-popup' ); ?></a>
				</div>
			</li>
		</ul>

		<p class="credit"><?php _e( 'Made with ❤ in Aschaffenburg, Germany', 'wp-video-popup' ); ?></p>

	</div>

</div>
