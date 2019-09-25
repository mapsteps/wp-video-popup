<?php
/**
 * Parser.
 *
 * @package WP_Video_Popup
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Helper class to handle video popup parser.
 */
class WP_Video_Popup_Parser {

	/**
	 * Determines which cloud video provider is being used based on the passed url.
	 *
	 * @param string $url The url.
	 *
	 * @return string The service's name.
	 */
	public static function identify_service( $url ) {

		if ( preg_match( '%youtube-nocookie\.%i', $url ) ) {
			return 'youtube-nocookie';
		} elseif ( preg_match( '%vimeo\.%i', $url ) ) {
			return 'vimeo';
		}

		return 'youtube';

	}

	/**
	 * Determines which cloud video provider is being used based on the passed url,
	 * and extracts the video id from the url.
	 *
	 * @param string $url The url.
	 *
	 * @return string The video's id.
	 */
	public static function get_url_id( $url ) {

		$service = self::identify_service( $url );

		if ( 'youtube' === $service || 'youtube-nocookie' === $service ) {
			return self::get_youtube_id( $url );
		} elseif ( 'vimeo' === $service ) {
			return self::get_vimeo_id( $url );
		}

		return '';

	}

	/**
	 * Determines which cloud video provider is being used based on the passed url,
	 * extracts the video id from the url, and builds an embed url.
	 *
	 * @param string $url The url.
	 *
	 * @return string The video's embed url on success.
	 */
	public static function get_embed_url( $url ) {

		$service = self::identify_service( $url );
		$id      = self::get_url_id( $url );

		if ( 'youtube' === $service ) {
			return self::get_youtube_embed_url( $id );
		} elseif ( 'youtube-nocookie' === $service ) {
			return self::get_youtube_embed_url( $id, 1, true );
		} elseif ( 'vimeo' === $service ) {
			return self::get_vimeo_embed_url( $id );
		}

		return $url;

	}

	/**
	 * Parses various youtube urls and returns video identifier.
	 *
	 * @param string $url The url.
	 *
	 * @return string The url's id.
	 */
	public static function get_youtube_id( $url ) {

		$youtube_url_keys = array( 'v', 'vi' );

		// Try to get ID from url parameters.
		$key_from_params = self::parse_url_for_params( $url, $youtube_url_keys );

		if ( $key_from_params ) {
			return $key_from_params;
		}

		// Try to get ID from last portion of url.
		return self::parse_url_for_last_element( $url );

	}

	/**
	 * Builds a Youtube embed url from a video id.
	 *
	 * @param string $youtube_video_id The video's id.
	 * @param int    $autoplay The autoplay argument value.
	 * @param bool   $nocookie Whether to use regular YouTube or youtube-nookie.
	 *
	 * @return string The embed url.
	 */
	public static function get_youtube_embed_url( $youtube_video_id, $autoplay = 1, $nocookie = false ) {

		$video_url  = ! $nocookie ? 'https://youtube.com' : 'https://www.youtube-nocookie.com';
		$video_url .= "/embed/$youtube_video_id?autoplay=$autoplay";

		return $video_url;

	}

	/**
	 * Parses various vimeo urls and returns video identifier.
	 *
	 * @param string $url The url.
	 *
	 * @return string The url's id.
	 */
	public static function get_vimeo_id( $url ) {
		// Try to get ID from last portion of url.
		return self::parse_url_for_last_element( $url );
	}

	/**
	 * Builds a Vimeo embed url from a video id.
	 *
	 * @param string $vimeo_video_id The video's id.
	 * @param int    $autoplay The autoplay argument value.
	 *
	 * @return string The embed url.
	 */
	public static function get_vimeo_embed_url( $vimeo_video_id, $autoplay = 1 ) {
		return "https://player.vimeo.com/video/$vimeo_video_id?byline=0&amp;portrait=0&amp;autoplay=$autoplay";
	}

	/**
	 * Find the first matching parameter value in a url from the passed params array.
	 *
	 * @access private
	 *
	 * @param string $url The url.
	 * @param array  $target_params Any parameter keys that may contain the id.
	 *
	 * @return null|string Null on failure to match a target param, the url's id on success.
	 */
	private static function parse_url_for_params( $url, $target_params ) {

		parse_str( wp_parse_url( $url, PHP_URL_QUERY ), $my_array_of_params );

		foreach ( $target_params as $target ) {
			if ( array_key_exists( $target, $my_array_of_params ) ) {
				return $my_array_of_params[ $target ];
			}
		}

		return null;

	}

	/**
	 * Find the last element in a url, without any trailing parameters.
	 *
	 * @access private
	 *
	 * @param string $url The url.
	 *
	 * @return string The last element of the url.
	 */
	private static function parse_url_for_last_element( $url ) {

		$url_parts           = explode( '/', $url );
		$prospect            = end( $url_parts );
		$prospect_and_params = preg_split( '/(\?|\=|\&)/', $prospect );

		if ( $prospect_and_params ) {
			return $prospect_and_params[0];
		} else {
			return $prospect;
		}

		return $url;

	}

}
