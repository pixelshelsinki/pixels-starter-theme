<?php
/**
 * Timber Site setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

use Pixels\Theme\Timber\Context as Context;

/**
 * Timber class
 *
 * Sets up directories for Timber
 * Handle Timber related additional functionalities
 */
class Timber {

	/**
	 * Context class instance
	 *
	 * @var Context
	 */
	private $context;

	/**
	 * Class constructor
	 */
	public function __construct() {

		$this->context = new Context();

		// Check that Timber is enabled.
		if ( ! class_exists( 'Timber' ) ) {
			add_action( 'admin_notices', array( $this, 'missing_timber_admin_notice' ) );
			add_filter( 'template_include', array( $this, 'missing_timber_frontend_notice' ) );
		} else {
			add_action( 'init', array( $this, 'setup_timber_settings' ) );
		}
	}

	/**
	 * Add Timber related settings
	 */
	public function setup_timber_settings() {

		/**
		* Directories where Twig files live.
		*
		* Saves us explicitly writing all directories.
		*
		* @var array
		 */
		\Timber::$dirname = [ 'views/layouts', 'views/components' ];

		/**
		 * Sets up the Timber site for this project.
		 */
		new \PixelsSite();
	}

	/**
	 * Output an admin notice warning about Timber plugin not activated.
	 */
	public function missing_timber_admin_notice() {
		/* Translators: placeholders are URL to the plugin page. */
		echo '<div class="error"><p>' . sprintf( esc_attr( __( 'Timber not activated. Make sure you activate the plugin in <a href="%1$s">%2$s</a>', 'pixels-text-domain' ) ), esc_url( admin_url( 'plugins.php#timber' ) ), esc_url( admin_url( 'plugins.php' ) ) ) . '</p></div>';
	}

	/**
	 * Output a page on the frontend warning about Timber plugin not activated.
	 *
	 * @param string $template the path to the template.
	 */
	public function missing_timber_frontend_notice( $template ) {
		wp_die( esc_attr( __( 'Oh no! You need to activate the Timber plugin before you can use this theme.', 'pixels-text-domain' ) ) );
	}
}

new Timber();
