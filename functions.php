<?php
/**
 * Loads theme function files.
 *
 * NOTE: To add functionality to the theme, create or add to a file in the lib
 * directory and then include the file name (without the extension) it at the
 * end of this file.
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '7.1.0', phpversion(), '>=' ) ) {
	PixelsTheme\Helpers\error_message( __( 'You must be using PHP 7.1.0 or greater.', 'pixels-text-domain' ), __( 'Invalid PHP version', 'pixels-text-domain' ) );
}

/**
 * Ensure compatible version of WordPress is used
 */
if ( version_compare( '4.7.0', get_bloginfo( 'version' ), '>=' ) ) {
	PixelsTheme\Helpers\error_message( __( 'You must be using WordPress 4.7.0 or greater.', 'pixels-text-domain' ), __( 'Invalid WordPress version', 'pixels-text-domain' ) );
}

/**
 * Theme required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(
	function ( $file ) use ( $pixels_error ) {
		$file = "lib/{$file}.php";
		if ( ! locate_template( $file, true, true ) ) {
			/* Translators: Placeholder is the path to the file */
			$pixels_error( sprintf( __( 'Error locating <code>%s</code> for inclusion.', 'pixels-text-domain' ), $file ), 'File not found' );
		}
	},
	[
		'assets',
		'class-pixelssite',
		'design-system',
		'filters',
		'helpers',
		'timber',
		'widget-areas',
	]
);
