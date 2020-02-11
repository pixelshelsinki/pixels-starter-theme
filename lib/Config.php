<?php
/**
 * Common theme Configs.
 *
 * Extends the TimberSite clas
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Common theme configs.
 */
class Config extends \TimberSite {

	/**
	 * Instance of admin settings
	 *
	 * @var Admin\Config
	 */
	private $admin_config;

	/**
	 * Constructs the initial class.
	 */
	public function __construct() {

		// Actions.
		add_action( 'init', array( $this, 'add_theme_supports' ) );
		add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ), 100 );

		// Only load admin settings in WP Admin.
		if ( is_admin() ) {
			$this->admin_config = new Admin\Config();
		}

		parent::__construct();
	}

	/**
	 * Declare theme supports
	 */
	public function add_theme_supports() {

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
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		/**
		 * Enable selective refresh for widgets in customizer.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
	}

	/**
	 * Load translation for the theme.
	 */
	public function load_theme_textdomain() {
		load_theme_textdomain( 'pixels-text-domain', get_template_directory() . '/assets/languages' );
	}
}
