<?php
/**
 * Backwards Compatibility
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Popup shortcode
 *
 * @param array $ryv_popup_atts The shortcode attributes.
 * @return string The popup markup.
 */
function ryv_popup_shortcode( $ryv_popup_atts ) {

	$ryv_popup_atts = shortcode_atts(
		array(
			'video' => 'https://www.youtube.com/embed/YlUKcNNmywk',
		),
		$ryv_popup_atts,
		'ryv-popup'
	);

	return '
	<div class="ryv-popup-wrapper">
		<div class="ryv-popup-wrapper">
			<div class="ryv-popup-close"></div>
			<iframe class="ryv-popup-video" src="" data-ryv-popup-url="' . $ryv_popup_atts['video'] . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
	</div>
	';

}
add_shortcode( 'ryv-popup', 'ryv_popup_shortcode' );
