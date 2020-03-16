<?php
/**
 * Theme image handling.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

use Pixels\Theme\Images\ResponsiveImage;

/**
 * Theme image sizes
 *
 * Register image sizes
 * Do custom image handling
 */
class Images {

	/**
	 * Image sizes array
	 * Pattern:
	 *
	 * NAME, WIDTH, HEIGHT, CROP, RETINA TRUE/FALSE
	 *
	 * @var array
	 */
	const SIZES = array(
		'page-hero'        => array( 1100, 500, true, true ),
		'page-hero-mobile' => array( 375, 500, true, true ),
	);

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_action( 'init', array( $this, 'add_img_sizes' ) );
	}

	/**
	 * Register theme image sizes.
	 * --> Loop through sizes array
	 * --> If retina, create double version too.
	 *
	 * @since 1.0
	 */
	public function add_img_sizes() {
		add_theme_support( 'post-thumbnails' );

		foreach ( self::SIZES as $name => $details ) :

			// Register standard size.
			add_image_size( $name, $details[0], $details[1], $details[2] );

			// Check for retina enable.
			if ( $details[3] ) :
				add_image_size( $name . '-retina', $details[0] * 2, $details[1] * 2, $details[2] );
			endif;
		endforeach;
	}

	/**
	 * Output <picture> tag with two image sizes
	 *
	 * @param int    $image_id of image / attachment.
	 * @param string $mobile_size name.
	 * @param string $desktop_size name.
	 * @param string $alt tag of image, optional.
	 * @return string.
	 */
	public static function responsive_image( $image_id, $mobile_size, $desktop_size, $alt = '' ) {

		// Create responsive image instance.
		$image = new ResponsiveImage( $image_id );

		// Add img sizes.
		$image->set_mobile_size( $mobile_size );
		$image->set_desktop_size( $desktop_size );
		$image->set_alt_tag( $alt );

		return $image->get_picture();
	}

	/**
	 * Output background image with two sizes in <style> tag
	 *
	 * @param string $mobile url to mobile size.
	 * @param string $desktop url to desktop size.
	 * @param string $selector css selector of background. Like #my_background.
	 * @return string.
	 */
	public static function responsive_background( $mobile, $desktop, $selector ) {
		ob_start();
		?>
		<style>
			<?php echo esc_html( $selector ); ?> {
				background-image:url('<?php echo esc_html( $mobile ); ?>');	
			}

			@media only screen and (min-width : 576px) {
				<?php echo esc_html( $selector ); ?> {
					background-image:url('<?php echo esc_html( $desktop ); ?>');
				}
			}
		</style>
		<?php
		return ob_get_clean();
	}
}
