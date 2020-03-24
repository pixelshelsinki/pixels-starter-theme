<?php
/**
 * Retina Interface
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Images;

/**
 * Retina interface
 */
interface RetinaInterface {

	/**
	 * Check if image size has retina version.
	 *
	 * @param string $size_name of image.
	 * @return bool $has_retina true/false.
	 */
	public function has_retina( $size_name );

	/**
	 * Get retina size, if exists.
	 *
	 * @param string $size_name of image.
	 * @return mixed $retina bool/string false or url of image.
	 */
	public function get_retina( $size_name );
}
