<?php
/**
 * Settings page template.
 *
 * @package WP_Video_Popup_PRO
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

?>

<div class="wrap settingstuff">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<form method="post" action="options.php">
		<?php settings_fields( 'wp-video-popup-settings-group' ); ?>

		<div class="neatbox has-bigger-heading is-smooth">
			<?php do_settings_sections( 'wp-video-popup-settings' ); ?>
		</div>
		<?php submit_button(); ?>
	</form>

</div>
