<?php
/**
 * Backwards Compatibility
 *
 * @package WP Video Popup
 */
 
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Shortcode
function ryv_popup_shortcode( $ryv_popup_atts ) {

	$ryv_popup_atts = shortcode_atts( array(
		'video' => 'https://www.youtube.com/embed/YlUKcNNmywk',
	), $ryv_popup_atts, 'ryv-popup' );

	// Initialize output
	$ryv_output = '';

	// Popup Wrapper
	$ryv_output .= '<div class="ryv-popup-wrapper">';

	// Close Icon
	$ryv_output .= '<div class="ryv-popup-close"></div>';

	// Video
	$ryv_output .= '<iframe class="ryv-popup-video" src="" data-ryv-popup-url="'. $ryv_popup_atts['video'] .'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

	// Close Popup Wrapper
	$ryv_output .= '</div>';

	return $ryv_output;

}
add_shortcode( 'ryv-popup', 'ryv_popup_shortcode' );