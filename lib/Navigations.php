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
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_action( 'after_setup_theme', array( $this, 'add_theme_navigations' ) );
	}

	/**
	 * Register navigation menus.
	 *
	 * @since 1.0
	 */
	public function add_theme_navigations() {
		register_nav_menus(
			[
				'primary_nav' => __( 'Primary Menu', 'pixels-text-domain' ),
			]
		);
	}
}
