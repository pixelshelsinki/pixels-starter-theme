<?php
/**
 * Theme Filters & Actions.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Hooks class
 *
 * Add custom filters
 * Add custom actions
 */
class Hooks {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.

		// Filters.
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	/**
	 * Add <body> classes.
	 *
	 * @param array $classes list of <body> classes.
	 */
	public function add_body_classes( array $classes ) {
		/** Add page slug if it doesn't exist */
		if ( is_single() || is_page() && ! is_front_page() ) {
			if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
				$classes[] = basename( get_permalink() );
			}
		}

		return array_filter( $classes );
	}
}
