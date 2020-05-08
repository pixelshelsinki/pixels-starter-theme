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
		wp_enqueue_style( 'pixels/main.css', $this->get_asset_uri( 'styles/main.scss' ), false, null );
		wp_enqueue_script( 'pixels/main.js', $this->get_asset_uri( 'scripts/main.js' ), array( 'jquery' ), null, true );

		// Add variables to enqueued script.
		$this->localize_variables();
	}

	/**
	 * Enqueue vendor scripts
	 * Webpack splits node modules from main bundle.
	 */
	public function setup_vendors_scripts() {

		// Enqueue Webpack runtime before vendors bundles.
		wp_enqueue_script( 'runtime.js', $this->get_asset_uri( 'runtime.js' ), array(), null, true );

		// Add count to vendor inputs.
		$count = 1;

		// Include "vendor" assets that were split.
		foreach ( $this->manifest as $name => $path ) :
			if ( strpos( $name, 'vendor' ) !== false ) :
				wp_enqueue_script( 'pixels/vendor-' . $count, $this->get_asset_uri( $name ), array( 'jquery' ), null, true );
				$count++;
			endif;
		endforeach;

	}

	/**
	 * Localize variables for script files.
	 * --> Nonces & urls for REST and/or AJAX.
	 * --> Current language
	 */
	public function localize_variables() {

		// Array of WPAPI vars to localize.
		$localized_vars = array(
			'rest_nonce' => wp_create_nonce( 'wp_rest' ),
			'rest_url'   => get_rest_url(),
			'ajax_url'   => admin_url( 'admin-ajax.php' ),
		);

		// If using polylang, append current language.
		if ( function_exists( 'pll_the_languages' ) ) :
			$localized_vars['current_lang'] = pll_current_language( 'slug' );
		endif;

		// Associate with pixels/main.js.
		wp_localize_script(
			'pixels/main.js',
			'WPAPI',
			$localized_vars
		);
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
	public function get_asset_uri( $asset ) {
		$path = get_template_directory_uri() . '/dist/';

		$manifest_asset = $this->manifest[ $asset ];

		return $path . '' . $manifest_asset;
	}

	/**
	 * Sets up the editor styles.
	 *
	 * Dont forget to add CSS fonts from external sources. Pass the URI minus the `https:` to `add_editor_style`.
	 */
	public function setup_editor_styles() {
		/**
		 * Use main stylesheet for visual editor
		 *
		 * @see assets/styles/layouts/_tinymce.scss
		 */
		add_editor_style( $this->get_asset_uri( 'styles/main.scss' ) );
	}
}
