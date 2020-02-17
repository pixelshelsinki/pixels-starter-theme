<?php
/**
 * Theme navigations
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Navigations class
 *
 * Register theme navigations
 * Do any custom navigation handling
 */
class Navigations {

	/**
	 * Stores registered menus
	 *
	 * @var array
	 */
	public $menus;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Setup list of menus to use in theme.
		$this->setup_menus();

		// Actions.
		add_action( 'after_setup_theme', array( $this, 'register_theme_navigations' ) );
	}

	/**
	 * Setup array of menus in theme
	 * --> Used to register menus
	 * --> Used to automatically add menus to Context
	 */
	public function setup_menus() {
		$this->menus = array(
			'desktop' => __( 'Primary Menu', 'pixels-text-domain' ),
			'mobile'  => __( 'Mobile Menu', 'pixels-text-domain' ),
			'footer'  => __( 'Footer Menu', 'pixels-text-domain' ),
		);
	}

	/**
	 * Return array of menus for external use.
	 *
	 * @return array $this->menus of theme.
	 */
	public function get_menus() {
		return $this->menus;
	}

	/**
	 * Register navigation menus.
	 *
	 * @since 1.0
	 */
	public function register_theme_navigations() {
		register_nav_menus(
			$this->get_menus()
		);
	}
}
