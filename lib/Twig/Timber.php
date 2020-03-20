<?php
/**
 * Timber Site setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Twig;

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
	 * Functions class instance
	 *
	 * @var Functions
	 */
	private $functions;

	/**
	 * Class constructor
	 *
	 * @param Navigations $navigations of theme.
	 */
	public function __construct( $navigations ) {

		// Class instances.
		$this->context   = new Context( $navigations );
		$this->functions = new Functions();

		// Timber setuo.
		add_action( 'init', array( $this, 'setup_timber_settings' ) );

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
		\Timber::$dirname = array( 'views/layouts', 'views/components' );
	}
}
