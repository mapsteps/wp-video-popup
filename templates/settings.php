<?php
/**
 * Settings page template.
 *
 * @package WP_Video_Popup_PRO
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="wrap heatbox-wrap">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<form method="post" action="options.php">

		<?php settings_fields( 'wp-video-popup-settings-group' ); ?>

		<div class="wpvp-admin-page">

			<div class="heatbox-column-container">

				<div class="heatbox-main">

					<div class="heatbox disable-color-picker">
						<?php do_settings_sections( 'wp-video-popup-settings' ); ?>
					</div>

					<div class="heatbox wpvp-pro-metabox">
						<?php do_settings_sections( 'wp-video-popup-pro-settings' ); ?>
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

	</form>

</div>
