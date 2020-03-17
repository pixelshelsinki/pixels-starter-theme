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
	 * Class constructor
	 *
	 * @param int $id of attachment.
	 */
	public function __construct( $id ) {
		parent::__construct( $id );
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
