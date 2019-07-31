<?php
/**
 * Template Loading.
 *
 * This file modifies how templates are found and loaded.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace PixelsTheme\Templates;

/**
 * Intercepts the template hierarchy and moves the expected location to the
 * `data/` directory.
 *
 * @param  array $templates The templates for the requested type.
 * @return array            The modified templates.
 */
function intercept_template_hierarchy( $templates ) {
	if ( file_exists( get_theme_file_path() . '/data/' ) ) {
		$templates = preg_filter( '/^/', 'data/', $templates );
	}

	return $templates;
}

$wp_types = [
	'index',
	'404',
	'archive',
	'author',
	'category',
	'tag',
	'taxonomy',
	'date',
	'home',
	'frontpage',
	'page',
	'paged',
	'search',
	'single',
	'singular',
	'attachment',
];

foreach ( $wp_types as $wp_type ) {
	add_filter( "{$wp_type}_template_hierarchy", __NAMESPACE__ . '\\intercept_template_hierarchy' );
}
