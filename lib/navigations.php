<?php
/**
 * Theme navigation menus.
 *
 * Register nav menus you need
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace PixelsTheme\Navigations;

// Actions.
add_action( 'after_setup_theme', __NAMESPACE__ . '\\add_theme_navigations' );

/**
 * Register navigation menus.
 *
 * @since 1.0
 */
function add_theme_navigations() {
	register_nav_menus(
		[
			'primary_nav' => __( 'Primary Menu', 'pixels-text-domain' ),
		]
	);
}
