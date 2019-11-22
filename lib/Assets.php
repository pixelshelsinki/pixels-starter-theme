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
	 * Link to Manifest JSON file of assets
	 *
	 * @var string
	 */
	public $manifest_link;

	/**
	 * Array of Manifest JSON of assets
	 *
	 * @var array
	 */
	public $manifest;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Asset manifest strategy.
		$this->manifest_link = get_template_directory() . '/dist/manifest.json';
		$this->manifest      = $this->get_manifest( $this->manifest_link );

		// Actions.
		add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts_styles' ), 100 );
		add_action( 'after_setup_theme', array( $this, 'setup_editor_styles' ), 100 );
	}

	/**
	 * Adds the JS and CSS files to the document head.
	 */
	public function setup_scripts_styles() {

		// Enqueue vendor / split chunk styles.
		$this->setup_vendors_scripts();

		// Enqueue main scripts / styles.
		wp_enqueue_style( 'pixels/main.css', $this->get_asset_path( 'styles/main.scss' ), false, null );
		wp_enqueue_script( 'pixels/main.js', $this->get_asset_path( 'scripts/main.js' ), [ 'jquery' ], null, true );
	}

	/**
	 * Enqueue vendor scripts
	 * Webpack splits node modules from main bundle.
	 */
	public function setup_vendors_scripts() {

		// Enqueue Webpack runtime before vendors bundles.
		wp_enqueue_script( 'runtime.js', $this->get_asset_path( 'runtime.js' ), array(), null, true );

		// Add count to vendor inputs.
		$count = 1;

		// Include "vendor" assets that were split.
		foreach ( $this->manifest as $name => $path ) :
			if ( strpos( $name, 'vendor' ) !== false ) :
				wp_enqueue_script( 'pixels/vendor-' . $count, $this->get_asset_path( $name ), [ 'jquery' ], null, true );
				$count++;
			endif;
		endforeach;

	}

	/**
	 * Gets manifest array from JSON
	 *
	 * @param string $manifest_link to manifest.json.
	 */
	public function get_manifest( $manifest_link ) {

		// Open manifest json.
		$manifest = file_get_contents( $manifest_link );

		// Make into array.
		$manifest = json_decode( $manifest, true );

		return $manifest;
	}

	/**
	 * Get hashed asset version from Asset Manifest
	 * Append URL to embed it WP Style
	 *
	 * @param string $asset key in manifest.
	 */
	public function get_asset_path( $asset ) {
		$path = get_template_directory_uri() . '/dist/';

		$manifest_asset = $this->manifest[ $asset ];

		return $path . '' . $manifest_asset;
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
		add_editor_style( '/dist/' . $this->get_asset_path( 'styles/main.scss' ) );
	}
}
