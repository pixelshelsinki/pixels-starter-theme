<?php
/**
 * Abstract for our custom image types.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Images;

use Pixels\Theme\Images as ThemeImages;

/**
 * Contains methods & props common for
 * our responsive images.
 */
abstract class AbstractImage {

	/**
	 * Image / attatchment id.
	 *
	 * @var int.
	 */
	protected $id;

	/**
	 * Mobile size name
	 *
	 * @var string.
	 */
	protected $mobile_size;

	/**
	 * Desktop size name
	 *
	 * @var string.
	 */
	protected $desktop_size;

	/**
	 * Alternative tag.
	 *
	 * @var string.
	 */
	protected $alt;

	/**
	 * Class constructor
	 *
	 * @param int $id of attachment.
	 */
	public function __construct( $id ) {
		$this->id = $id;
	}

	/**
	 * Set mobile size name.
	 *
	 * @param string $mobile_size name.
	 */
	public function set_mobile_size( $mobile_size ) {
		$this->mobile_size = $mobile_size;
	}

	/**
	 * Set desktop size name.
	 *
	 * @param string $desktop_size name.
	 */
	public function set_desktop_size( $desktop_size ) {
		$this->desktop_size = $desktop_size;
	}

	/**
	 * Get mobile size name.
	 *
	 * @return string $mobile_size name.
	 */
	public function get_mobile_size() {
		return $this->mobile_size;
	}

	/**
	 * Get desktop size name.
	 *
	 * @return string $desktop_size name.
	 */
	public function get_desktop_size() {
		return $this->desktop_size;
	}

	/**
	 * Set image alt tag.
	 *
	 * @param string $alt text of image.
	 */
	public function set_alt_tag( $alt ) {
		$this->alt = $alt;
	}

	/**
	 * Return urls array of image.
	 */
	abstract public function get_urls();
}
