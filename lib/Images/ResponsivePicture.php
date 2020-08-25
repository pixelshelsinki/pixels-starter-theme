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
	 * Return <picture> tag html.
	 *
	 * @return string $html of image.
	 */
	public function get_picture() {
		$html = '';

		// Get urls array.
		$urls = $this->get_urls();

		$html .= '<picture>';
		$html .= $this->get_mobile_source( $urls );
		$html .= $this->get_desktop_source( $urls );
		$html .= $this->get_img_tag( $this->id );
		$html .= 'alt="' . esc_html( $this->get_alt_tag() ) . '">';

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
		if ( $urls['mobile_retina'] ) : ?>
			<source media="(max-width: <?php echo esc_html( ThemeImages::BREAKPOINT ); ?>)" srcset="<?php echo esc_html( $urls['mobile'] ); ?> 1x, <?php echo esc_html( $urls['mobile_retina'] ); ?> 2x">
			<?php
		else :
			?>
			<source media="(max-width: <?php echo esc_html( ThemeImages::BREAKPOINT ); ?>)" srcset="<?php echo esc_html( $urls['mobile'] ); ?>">
			<?php
		endif;

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
		if ( $urls['desktop_retina'] ) :
			?>
			<source media="(min-width: <?php echo esc_html( ThemeImages::BREAKPOINT ); ?>)" srcset="<?php echo esc_html( $urls['desktop'] ); ?> 1x, <?php echo esc_html( $urls['desktop_retina'] ); ?> 2x">
			<?php
		else :
			?>
			<source media="(min-width: <?php echo esc_html( ThemeImages::BREAKPOINT ); ?>)" srcset="<?php echo esc_html( $urls['desktop'] ); ?>">
			<?php
		endif;

		$desktop_source = ob_get_clean();

		return $desktop_source;
	}

	/**
	 * Return <img> tag for <picture> element.
	 *
	 * @param int $id of image.
	 * @return string $img_tag of image.
	 */
	public function get_img_tag( $id ) {
		$size = 'desktop';

		if ( $this->has_retina( $size ) ) {
			$size .= '_retina';
		}

		$src_arr = wp_get_attachment_image_src( $id, $size );
		$urls    = $this->get_urls();

		$width  = $src_arr[1];
		$height = $src_arr[2];

		ob_start();
		?>

		<img width="<?php echo esc_html( $width ); ?>px" height="<?php echo esc_html( $height ); ?>px" loading="lazy" src="<?php echo esc_html( $urls[ $size ] ); ?>" alt="<?php echo esc_html( $this->get_alt_tag() ); ?>">

		<?php
		$img_tag = ob_get_clean();

		return $img_tag;
	}
}
