<?php
/**
 * Class for responsive image
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Images;

use Pixels\Theme\Images as ThemeImages;

/**
 * Handle responsive image.
 * --> Get img urls by sizes
 * --> Append retina urls.
 * --> Output html
 */
class ResponsiveImage {

	/**
	 * Image / attatchment id.
	 *
	 * @var int.
	 */
	private $id;

	/**
	 * Image size names
	 *
	 * @var array.
	 */
	private $sizes;

	/**
	 * Alternative tag.
	 *
	 * @var string.
	 */
	private $alt;

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
		$this->sizes['mobile'] = $mobile_size;
	}

	/**
	 * Set desktop size name.
	 *
	 * @param string $desktop_size name.
	 */
	public function set_desktop_size( $desktop_size ) {
		$this->sizes['desktop'] = $desktop_size;
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
		$mobile        = wp_get_attachment_image_src( $this->id, $this->sizes['mobile'] )[0];
		$mobile_retina = $this->get_retina( $this->sizes['mobile'] );

		// Check if mobile & desktop are the same.
		if ( $this->sizes['mobile'] === $this->sizes['desktop'] ) :
			$desktop        = $mobile;
			$desktop_retina = $mobile_retina;
		else :
			$desktop        = wp_get_attachment_image_src( $this->id, $this->sizes['desktop'] )[0];
			$desktop_retina = $this->get_retina( $this->sizes['desktop'] );
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

	/**
	 * Return <picture> tag html.
	 *
	 * @return string $html of image;
	 */
	public function get_picture() {
		$html = '';

		// Get urls array.
		$urls = $this->get_urls();

		$html .= '<picture>';
		$html .= $urls['mobile_retina'] ? $this->get_mobile_source_retina( $urls ) : $this->get_mobile_source( $urls );
		$html .= $urls['desktop_retina'] ? $this->get_desktop_source_retina( $urls ) : $this->get_desktop_source( $urls );
		$html .= '<img src="' . esc_html( $urls['desktop'] ) . '">';

		return $html;
	}

	/**
	 * Return <source> tag for mobile.
	 *
	 * @param array $urls of image.
	 * @return string $mobile_source of image.
	 */
	public function get_mobile_source( $urls ) {
		ob_start();
		?>
		<source media="(max-width: 576px)" srcset="<?php echo esc_html( $urls['mobile'] ); ?>">
		<?php
		$mobile_source = ob_get_clean();

		return $mobile_source;
	}

	/**
	 * Return retina <source> tag for mobile.
	 *
	 * @param array $urls of image.
	 * @return string $mobile_source of image.
	 */
	public function get_mobile_source_retina( $urls ) {
		ob_start();
		?>
		<source media="(max-width: 576px)" srcset="<?php echo esc_html( $urls['mobile'] ); ?> 1x, <?php echo esc_html( $urls['mobile_retina'] ); ?> 2x">
		<?php
		$mobile_source = ob_get_clean();

		return $mobile_source;
	}

	/**
	 * Return <source> tag for desktop.
	 *
	 * @param array $urls of image.
	 * @return string $desktop_source of image.
	 */
	public function get_desktop_source( $urls ) {
		ob_start();
		?>
		<source media="(min-width: 576px)" srcset="<?php echo esc_html( $urls['desktop'] ); ?>">
		<?php
		$desktop_source = ob_get_clean();

		return $desktop_source;
	}

	/**
	 * Return retina <source> tag for desktop.
	 *
	 * @param array $urls of image.
	 * @return string $desktop_source of image.
	 */
	public function get_desktop_source_retina( $urls ) {
		ob_start();
		?>
		<source media="(min-width: 576px)" srcset="<?php echo esc_html( $urls['desktop'] ); ?> 1x, <?php echo esc_html( $urls['desktop_retina'] ); ?> 2x">
		<?php
		$desktop_source = ob_get_clean();

		return $desktop_source;
	}
}
