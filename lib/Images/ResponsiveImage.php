<?php
/**
 * Class for responsive image
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Images;

// Contracts.
use Pixels\Theme\Images\AbstractImage;
use Pixels\Theme\Images\RetinaInterface;


use Pixels\Theme\Images as ThemeImages;

/**
 * Handle responsive image.
 * --> Get img urls by sizes
 * --> Append retina urls.
 * --> Output html
 */
class ResponsiveImage extends AbstractImage implements RetinaInterface {

	/**
	 * Check if image size has retina version.
	 *
	 * @param string $size_name of image.
	 * @return bool $has_retina true/false.
	 */
	public function has_retina( $size_name ) {
		$has_retina = ThemeImages::SIZES[ $size_name ][3];

		return $has_retina;
	}

	/**
	 * Get retina size, if exists.
	 *
	 * @param string $size_name of image.
	 * @return mixed $retina bool/string false or url of image.
	 */
	public function get_retina( $size_name ) {
		$retina = false;

		if ( $this->has_retina( $size_name ) ) :
			$retina = wp_get_attachment_image_src( $this->id, $size_name . '-retina' );
		endif;

		return $retina[0];
	}

	/**
	 * Return urls array of image.
	 *
	 * @return array $urls of image;
	 */
	public function get_urls() {

		// Get sizes by id.
		$mobile        = wp_get_attachment_image_src( $this->id, $this->get_mobile_size() )[0];
		$mobile_retina = $this->get_retina( $this->get_mobile_size() );

		// Check if mobile & desktop are the same.
		if ( $this->get_mobile_size() === $this->get_desktop_size() ) :
			$desktop        = $mobile;
			$desktop_retina = $mobile_retina;
		else :
			$desktop        = wp_get_attachment_image_src( $this->id, $this->get_desktop_size() )[0];
			$desktop_retina = $this->get_retina( $this->get_desktop_size() );
		endif;

		// Get original image for comparison.
		$original = wp_get_attachment_image_src( $this->id, 'full' )[0];

		// Falsify retinas if right sizes dont exist.
		if ( $mobile_retina === $original ) :
			$mobile_retina = false;
		endif;

		if ( $desktop_retina === $original ) :
			$desktop_retina = false;
		endif;

		$urls = array(
			'mobile'         => $mobile,
			'mobile_retina'  => $mobile_retina,
			'desktop'        => $desktop,
			'desktop_retina' => $desktop_retina,
		);

		return $urls;
	}
}
