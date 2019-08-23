<?php
/**
 * Timber Site setup.
 *
 * This file includes code to handle when Timber doesn't exist, sets the timber
 * directories, and the extension class to Timber for this theme.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace PixelsTheme\Timber;

use PixelsTheme\Assets;

/**
 * Checks that the Timber plugin is activated.
 */
if ( ! class_exists( 'Timber' ) ) {
	/**
	 * Output an admin notice warning about Timber plugin not activated.
	 */
	function missing_timber_admin_notice() {
		/* Translators: placeholders are URL to the plugin page. */
		echo '<div class="error"><p>' . sprintf( esc_attr( __( 'Timber not activated. Make sure you activate the plugin in <a href="%1$s">%2$s</a>', 'pixels-text-domain' ) ), esc_url( admin_url( 'plugins.php#timber' ) ), esc_url( admin_url( 'plugins.php' ) ) ) . '</p></div>';
	}
	add_action( 'admin_notices', __NAMESPACE__ . '\\missing_timber_admin_notice' );

	/**
	 * Output a page on the frontend warning about Timber plugin not activated.
	 *
	 * @param string $template the path to the template.
	 */
	function missing_timber_frontend_notice( $template ) {
		wp_die( esc_attr( __( 'Oh no! You need to activate the Timber plugin before you can use this theme.', 'pixels-text-domain' ) ) );
	}
	add_filter( 'template_include', __NAMESPACE__ . '\\missing_timber_frontend_notice' );

	return;
}

/**
* Directories where Twig files live.
*
* Saves us explicitly writing all directories.
*
* @var array
*/
\Timber::$dirname = [ 'templates/views', 'templates/components' ];

/**
 * Sets up the Timber site for this project.
 */
new \PixelsSite();
