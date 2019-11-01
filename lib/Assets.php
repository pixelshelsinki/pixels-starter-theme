<?php
/**
 * Theme asset handling
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

// Symfony asset component for versioning.
use Symfony\Component\Asset\UrlPackage;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;

/**
 * Assets class
 *
 * Enque theme scripts
 * Enque theme styles
 * Handle asset related functionalities
 */
class Assets {

	/**
	 * Version number to be used in asset cache busts
	 *
	 * @var string
	 */
	public $version;

	/**
	 * Package for /dist/ assets
	 *
	 * @var PathPackage
	 */
	public $dist_package;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Asset version.
		$this->version = 'v1';

		$version_strategy = new StaticVersionStrategy( $this->version );

		// Versioned packages for assets.
		$this->dist_package = new UrlPackage( get_template_directory_uri() . '/dist', $version_strategy );

		// Actions.
		add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts_styles' ), 100 );
		add_action( 'after_setup_theme', array( $this, 'setup_editor_styles' ), 100 );
	}

	/**
	 * Adds the JS and CSS files to the document head.
	 */
	public function setup_scripts_styles() {
		wp_enqueue_style( 'pixels/main.css', $this->dist_package->getUrl( 'styles/main.css' ), false, null );
		wp_enqueue_script( 'pixels/main.js', $this->dist_package->getUrl( 'scripts/main.js' ), [ 'jquery' ], null, true );
	}

	/**
	 * Sets up the editor styles.
	 */
	public function setup_editor_styles() {
		/**
		 * Use main stylesheet for visual editor
		 *
		 * @see assets/styles/layouts/_tinymce.scss
		 */
		add_editor_style( '/dist/' . $this->dist_package->getUrl( 'styles/main.css' ) );
	}
}

