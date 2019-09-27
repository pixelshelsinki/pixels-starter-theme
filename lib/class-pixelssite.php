<?php
/**
 * The Pixels Site class for this project.
 *
 * Extends the TimberSite class with configuration specifically for this site.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

/**
 * Sets up the Timber site for this project.
 */
class PixelsSite extends \TimberSite {
	/**
	 * Constructs the initial class.
	 */
	public function __construct() {
		/**
		 * Enable features from Soil.
		 *
		 * @link https://roots.io/plugins/soil/
		 */
		add_theme_support( 'soil-clean-up' );
		add_theme_support( 'soil-nice-search' );

		/**
		 * Enable plugins to manage the document title.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable HTML5 markup support
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );

		/**
		 * Enable selective refresh for widgets in customizer.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_action( 'after_setup_theme', [ $this, 'load_theme_textdomain' ], 100 );

		parent::__construct();
	}

	/**
	 * Load translation for the theme.
	 */
	public function load_theme_textdomain() {
		load_theme_textdomain( 'pixels-text-domain', get_template_directory() . '/languages' );
	}
}
