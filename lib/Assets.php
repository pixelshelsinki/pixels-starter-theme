<?php
/**
 * Theme asset handling
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Assets class
 *
 * Enque theme scripts
 * Enque theme styles
 * Handle asset related functionalities
 */
class Assets {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts_styles' ), 100 );
		add_action( 'after_setup_theme', array( $this, 'setup_editor_styles' ), 100 );
	}

	/**
	 * Adds the JS and CSS files to the document head.
	 */
	public function setup_scripts_styles() {
		wp_enqueue_style( 'pixels/main.css', $this->get_asset_uri( 'styles/main.css' ), false, null );
		wp_enqueue_script( 'pixels/main.js', $this->get_asset_uri( 'scripts/main.js' ), [ 'jquery' ], null, true );
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
		add_editor_style( '/dist/' . $this->get_asset_uri( 'styles/main.css' ) );
	}

	/**
	 * Get the URI for the given asset.
	 *
	 * @param string $asset An asset.
	 * @return string
	 */
	public function get_asset_uri( $asset ) {
		return get_template_directory_uri() . '/dist\/' . $asset;
	}
}

