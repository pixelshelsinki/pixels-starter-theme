<?php
/**
 * Loads theme function files.
 *
 * NOTE: To add functionality to the theme, create or add to a file in the lib
 * directory and then include the file name (without the extension) it at the
 * end of this file.
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme;

/**
 * Theme required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(
	function ( $file ) {
		$file = "lib/{$file}.php";
		if ( ! locate_template( $file, true, true ) ) {
			/* Translators: Placeholder is the path to the file */
			wp_die( esc_attr( sprintf( __( 'Error locating <code>%s</code> for inclusion.', 'pixels-text-domain' ), $file ) ), 'File not found' );
		}
	},
	[
		'Assets',
		'class-pixelssite',
		'Compatibility',
		'design-system',
		'Hooks',
		'Images',
		'Navigations',
		'Templates',
		'timber',
		'Widgets',
	]
);
