<?php
/**
 * Swift Control page template.
 *
 * @package Swift_Control
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<form method="post" action="options.php">

	<div class="neatbox has-bigger-heading is-smooth">

		<?php
		$license        = get_option( 'wp_video_popup_license_key' );
		$license_status = get_option( 'wp_video_popup_license_status' );

		settings_fields( 'swift_control_license' );
		?>

		<h2>
			<?php _e( 'License', 'wp-video-popup' ); ?>
		</h2>

		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<?php _e( 'License Key', 'wp-video-popup' ); ?>
					</th>
					<td>
						<input id="wp_video_popup_license_key" name="wp_video_popup_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
						<p class="description" for="wp_video_popup_license_key"><?php _e( 'Enter your license key.', 'wp-video-popup' ); ?></p>
					</td>
				</tr>
				<?php if ( false !== $license && '' !== $license ) { ?>
				<tr>
					<th>
						<?php _e( 'Activate License', 'wp-video-popup' ); ?>
						<!-- <a href="https://wpswiftcontrol.com/docs-category/installation/" target="_blank" class="dashicons dashicons-editor-help"></a> -->
					</th>
					<td>
						<?php if ( false !== $license_status && 'valid' === $license_status ) { ?>
							<span style="color:#fff; background:#6dbb7a; border: none; margin-right: 5px; cursor: auto;" class="button-secondary"><?php _e( 'active', 'wp-video-popup' ); ?></span>
							<?php wp_nonce_field( 'wp_video_popup_nonce', 'wp_video_popup_nonce' ); ?>
							<input type="submit" class="button-secondary" name="wp_video_popup_license_deactivate" value="<?php _e( 'Deactivate License', 'wp-video-popup' ); ?>"/>
							<?php
						} else {
							wp_nonce_field( 'wp_video_popup_nonce', 'wp_video_popup_nonce' );
							?>
							<input style="background:tomato; color: #fff; border: none;" type="submit" class="button-secondary" name="wp_video_popup_license_activate" value="<?php _e( 'Activate License', 'wp-video-popup' ); ?>"/>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<?php submit_button(); ?>

	</div>
</form>
