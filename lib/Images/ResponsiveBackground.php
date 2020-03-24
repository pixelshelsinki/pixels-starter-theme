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
 * --> Output <style> tag.
 */
class ResponsiveBackground extends ResponsiveImage {

	/**
	 * CSS selector.
	 * Background applies to this element.
	 *
	 * @var string.
	 */
	private $selector;

	/**
	 * Set css selector for background.
	 *
	 * @param string $selector elem.
	 */
	public function set_selector( $selector ) {
		$this->selector = $selector;
	}

	/**
	 * Get css selector for background.
	 *
	 * @return string $selector elem.
	 */
	public function get_selector() {
		return $this->selector;
	}


	/**
	 * Return background <style> tag html.
	 *
	 * @return string $html style of image.
	 */
	public function get_background() {
		$html = '';

		$urls = $this->get_urls();

		$html .= '<style>';
		$html .= $this->get_mobile_background( $urls );
		$html .= $this->get_desktop_background( $urls );
		$html .= '</style>';

		return $html;
	}

	/**
	 * Output mobile background-image style.
	 *
	 * @param array $urls of image.
	 * @return string $style of background.
	 */
	private function get_mobile_background( $urls ) {
		ob_start();
		if ( $urls['mobile_retina'] ) :
			echo esc_html( $this->get_selector() );
			?>
			{
				background-image:url( <?php echo esc_html( $urls['mobile_retina'] ); ?> );
				background-image: -webkit-image-set(url(<?php echo esc_html( $urls['mobile'] ); ?>) 1x, url(<?php echo esc_html( $urls['mobile_retina'] ); ?>) 2x);
				background-image: image-set(url(<?php echo esc_html( $urls['mobile'] ); ?>) 1x, url(<?php echo esc_html( $urls['mobile_retina'] ); ?> ) 2x);
			}
			<?php
		else :
			echo esc_html( $this->get_selector() );
			?>
			{
				background-image:url( <?php echo esc_html( $urls['mobile'] ); ?> );
			}
			<?php
		endif;

		$style = ob_get_clean();

		return $style;
	}

	/**
	 * Output desktop background-image style.
	 *
	 * @param array $urls of image.
	 * @return string $style of background.
	 */
	private function get_desktop_background( $urls ) {
		ob_start();
		if ( $urls['desktop_retina'] ) :
			?>
			@media only screen and (min-width : <?php echo esc_html( ThemeImages::BREAKPOINT ); ?> ) {
				<?php
				echo esc_html( $this->get_selector() );
				?>
				{
					background-image:url( <?php echo esc_html( $urls['desktop_retina'] ); ?> );
					background-image: -webkit-image-set(url(<?php echo esc_html( $urls['desktop'] ); ?>) 1x, url(<?php echo esc_html( $urls['desktop_retina'] ); ?>) 2x);
					background-image: image-set(url(<?php echo esc_html( $urls['desktop'] ); ?>) 1x, url(<?php echo esc_html( $urls['desktop_retina'] ); ?>) 2x);
				}
			}
			<?php
		else :
			?>
			@media only screen and (min-width : <?php echo esc_html( ThemeImages::BREAKPOINT ); ?>) {
				<?php
				echo esc_html( $this->get_selector() );
				?>
				{
					background-image:url( <?php echo esc_html( $urls['desktop'] ); ?> );
				}
			}
			<?php
		endif;

		$style = ob_get_clean();

		return $style;
	}
}
