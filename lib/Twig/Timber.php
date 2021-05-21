<?php
/**
 * Timber Site setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Twig;

// Main Timber library.
use \Timber\Timber as TimberLibrary;

/**
 * Timber class
 *
 * Sets up directories for Timber
 * Handle Timber related additional functionalities
 */
class Timber {

	/**
	 * Timber library class instance.
	 *
	 * @var TimberLibrary
	 */
	private $timber;

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
		$this->timber    = new TimberLibrary();
		$this->context   = new Context( $navigations );
		$this->functions = new Functions();

		// Timber setup.
		add_action( 'init', array( $this, 'setup_timber_settings' ) );

		// Register Twig namespaces.
		add_filter( 'timber/loader/loader', array( $this, 'register_namespaces' ) );

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

	/**
	 * Register additional namespaces to Twig loader.
	 *
	 * @param \Twig\Loader\FilesystemLoader $loader of twig.
	 * @return \Twig\Loader\FilesystemLoader $loader with added params.
	 */
	public function register_namespaces( $loader ) {
		$loader->addPath( __DIR__ . '/../../views/components', 'components' );
		$loader->addPath( __DIR__ . '/../../views/layouts', 'layouts' );
		$loader->addPath( __DIR__ . '/../../assets/images', 'icons' );

		return $loader;
	}
}
