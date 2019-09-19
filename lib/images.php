<?php
/**
 * Theme image sizes
 *
 * Register image sizes
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace PixelsTheme\Images;

// Actions.
add_action( 'init', __NAMESPACE__ . '\\add_img_sizes' );

/**
 * Register theme image sizes.
 *
 * @since 1.0
 */
function add_img_sizes() {
	add_theme_support( 'post-thumbnails' );
	// phpcs:ignore
	// add_image_size( 'image-name', 350, 200, true );
}

/**
 * Output <picture> tag with two image sizes
 *
 * @param string $mobile url to mobile size.
 * @param string $desktop url to desktop size.
 * @return string.
 */
function responsive_image( $mobile, $desktop ) {
	ob_start();
	?>
	<picture>
		<source media="(max-width: 576px)" srcset="<?php echo esc_html( $mobile ); ?>">
		<source media="(min-width: 576px)" srcset="<?php echo esc_html( $desktop ); ?>">
		<img src="<?php echo esc_html( $desktop ); ?>">
	</picture>
	<?php
	return ob_get_clean();
}
/**
 * Output background image with two sizes in <style> tag
 *
 * @param string $mobile url to mobile size.
 * @param string $desktop url to desktop size.
 * @param string $selector css selector of background. Like #my_background.
 * @return string.
 */
function responsive_background( $mobile, $desktop, $selector ) {
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
