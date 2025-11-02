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
					<p class="subtitle"><?php _e( 'The #1 responsive video popup plugin for WordPress.', 'responsive-youtube-vimeo-popup' ); ?></p>
				</div>

				<div>
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/wp-video-popup-logo-1.png">
				</div>

			</div>

		</div>

	</div>

	<div class="heatbox-container heatbox-container-center heatbox-column-container">

		<?php settings_fields( 'wp-video-popup-settings-group' ); ?>

		<div class="heatbox-main">

			<!-- Faking H1 tag to place admin notices -->
			<h1 style="display: none;"></h1>

			<div class="heatbox wpvp-settings-metabox">
				<?php do_settings_sections( 'wp-video-popup-settings' ); ?>
			</div>

			<div class="heatbox-cta-container is-attached">
				<div class="heatbox-cta primary">
					<p><?php _e( 'This feature is available in WP Video Popup PRO!', 'responsive-youtube-vimeo-popup' ); ?></p>
					<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" class="button button-large button-primary" target="_blank">
						<?php _e( 'Get WP Video Popup PRO - 70% off!', 'responsive-youtube-vimeo-popup' ); ?>
					</a>
				</div>
			</div>

			<div class="heatbox wpvp-pro-metabox">

				<h2>
					<?php _e( 'WP Video Popup PRO', 'responsive-youtube-vimeo-popup' ); ?> <span class="badge">PRO</span>
				</h2>

				<div class="heatbox-content">

					<ul class="wpvp-pro-benefits">
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Multiple videos per page/post', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'Add multiple video lightbox popups to a single page, post or custom post type.', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Self-hosted videos', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'Display your self-hosted videos in a responsive lightbox popup with WP Video Poup PRO.', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Overlay color settings', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'Change the overlay background color of your lightbox.', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Video size settings', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'Easily change the size of the video displayed in the responsive lightbox popup.', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Autoplay on page load', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'You\'d like the lightbox to open right after page load? We\'ve got you covered!', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Trigger video lightbox based on URL', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'With multiple videos on a single page/post, this feature will allow you to load a specific video on page load by adding a URL parameter.', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
						<li>
							<span class="dashicons dashicons-yes"></span>
							<div>
								<h3><?php _e( 'Group videos into galleries', 'responsive-youtube-vimeo-popup' ); ?></h3>
								<p class="description"><?php _e( 'Group videos into galleries and allow viewers to cycle through your videos without having to close the lightbox.', 'responsive-youtube-vimeo-popup' ); ?></p>
							</div>
						</li>
					</ul>

				</div>

			</div>

			<div class="heatbox-cta-container is-attached">
				<?php _e( 'Get <strong>70% off WP Video Popup PRO</strong> today, automatically applied at checkout.', 'responsive-youtube-vimeo-popup' ); ?>
				<br><br>
				<a href="https://wp-video-popup.com/pricing/?utm_source=repository&utm_medium=settings_page&utm_campaign=wp_video_popup" class="button button-primary button-larger" target="_blank">	
					<strong style ="font-weight: 700;"><?php _e( 'Upgrade to PRO - Save 70%', 'responsive-youtube-vimeo-popup' ); ?></strong>
				</a>
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

		<h2><?php _e( 'Check out our other free WordPress products!', 'responsive-youtube-vimeo-popup' ); ?></h2>

		<ul class="products">
			<li class="heatbox">
				<a href="https://wordpress.org/plugins/ultimate-dashboard/" target="_blank">
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/ultimate-dashboard.jpg">
				</a>
				<div class="heatbox-content">
					<h3><?php _e( 'Ultimate Dashboard', 'responsive-youtube-vimeo-popup' ); ?></h3>
					<p class="subheadline"><?php _e( 'Fully customize your WordPress dashboard.', 'responsive-youtube-vimeo-popup' ); ?></p>
					<p><?php _e( 'Ultimate Dashboard is the #1 plugin to create a custom WordPress dashboard for you and your clients. It also comes with multisite support which makes it the perfect plugin for your WaaS network.', 'responsive-youtube-vimeo-popup' ); ?></p>
					<a href="https://wordpress.org/plugins/ultimate-dashboard/" target="_blank" class="button"><?php _e( 'Learn more', 'responsive-youtube-vimeo-popup' ); ?></a>
				</div>
			</li>
			<li class="heatbox">
				<a href="https://wordpress.org/themes/page-builder-framework/" target="_blank">
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/page-builder-framework.jpg">
				</a>
				<div class="heatbox-content">
					<h3><?php _e( 'Page Builder Framework', 'responsive-youtube-vimeo-popup' ); ?></h3>
					<p class="subheadline"><?php _e( 'The only theme you\'ll ever need.', 'responsive-youtube-vimeo-popup' ); ?></p>
					<p class="description"><?php _e( 'With its minimalistic design the Page Builder Framework theme is the perfect foundation for your next project. Build blazing fast websites with a theme that is easy to use, lightweight & highly customizable.', 'responsive-youtube-vimeo-popup' ); ?></p>
					<a href="https://wordpress.org/themes/page-builder-framework/" target="_blank" class="button"><?php _e( 'Learn more', 'responsive-youtube-vimeo-popup' ); ?></a>
				</div>
			</li>
			<li class="heatbox">
				<a href="https://wordpress.org/plugins/better-admin-bar/" target="_blank">
					<img src="<?php echo esc_url( WP_VIDEO_POPUP_PLUGIN_URL ); ?>assets/img/swift-control.jpg">
				</a>
				<div class="heatbox-content">
					<h3><?php _e( 'Better Admin Bar', 'responsive-youtube-vimeo-popup' ); ?></h3>
					<p class="subheadline"><?php _e( 'Replace the boring WordPress admin bar!', 'responsive-youtube-vimeo-popup' ); ?></p>
					<p><?php _e( 'Better Admin Bar is the plugin that make your clients love WordPress. It drastically improves the user experience when working with WordPress and allows you to replace the boring WordPress admin bar with your own navigation panel.', 'responsive-youtube-vimeo-popup' ); ?></p>
					<a href="https://wordpress.org/plugins/better-admin-bar/" target="_blank" class="button"><?php _e( 'Learn more', 'responsive-youtube-vimeo-popup' ); ?></a>
				</div>
			</li>
		</ul>

		<p class="credit"><?php _e( 'Made with ❤ in Torsby, Sweden', 'responsive-youtube-vimeo-popup' ); ?></p>

	</div>

</div>
