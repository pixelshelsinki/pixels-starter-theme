<?php
/**
 * Theme Filters.
 *
 * Add any filters used in this theme here..
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace PixelsTheme\Filters;

// Filters.
add_filter( 'body_class', __NAMESPACE__ . '\\add_body_classes' );

/**
 * Add <body> classes.
 *
 * @param array $classes list of <body> classes.
 */
function add_body_classes( array $classes ) {
	/** Add page slug if it doesn't exist */
	if ( is_single() || is_page() && ! is_front_page() ) {
		if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
			$classes[] = basename( get_permalink() );
		}
	}

	return array_filter( $classes );
}
