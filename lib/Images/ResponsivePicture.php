<?php
/**
 * Class for responsive image
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Images;

use Pixels\Theme\Images\ResponsiveImage;
use Pixels\Theme\Images as ThemeImages;

/**
 * Handle responsive image.
 * --> Get img urls by sizes
 * --> Append retina urls.
 * --> Output html
 */
class ResponsivePicture extends ResponsiveImage {

	/**
	 * Class constructor
	 *
	 * @param int $id of attachment.
	 */
	public function __construct( $id ) {
		parent::__construct( $id );
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
