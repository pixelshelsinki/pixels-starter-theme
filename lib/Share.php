<?php
/**
 * Social share methods
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Get share links for various social medias
 */
class Share {

	/**
	 * Get facebook share link
	 *
	 * @param mixed $url to be shared.
	 * @return string $link to be used in href.
	 * @since 1.0
	 */
	public static function facebook( $url = null ) {

		$url  = $url ?? self::get_current_url();
		$link = 'https://www.facebook.com/sharer.php?u=' . $url;

		return $link;
	}

	/**
	 * Get twitter share link
	 *
	 * @param mixed $url to be shared.
	 * @param mixed $message to append.
	 * @return string $link to be used in href.
	 * @since 1.0
	 */
	public static function twitter( $url = null, $message = '' ) {

		$url  = $url ?? self::get_current_url();
		$link = 'https://twitter.com/share?url=' . $url . '&text=' . $message;

		return $link;
	}

	/**
	 * Get linkedin share link
	 *
	 * @param mixed $url to be shared.
	 * @param mixed $message to append.
	 * @return string $link to be used in href.
	 * @since 1.0
	 */
	public static function linkedin( $url = null, $message = '' ) {

		$url  = $url ?? self::get_current_url();
		$link =
		'https://linkedin.com/shareArticle?url=' . $url . '&title=Linkedin';

		return $link;
	}

	/**
	 * Get currnt url
	 *
	 * @since 1.0
	 * @return string $url of current page.
	 */
	public static function get_current_url() {

		$server_var = wp_unslash( $_SERVER );

		$url = ( isset( $server_var['HTTPS'] ) ? 'https' : 'http' ) . "://$server_var[HTTP_HOST]$server_var[REQUEST_URI]";

		return $url;

	}
}
