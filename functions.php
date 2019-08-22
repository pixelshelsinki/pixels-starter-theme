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
 * Load translation for the theme.
 */
function starter_theme_load_theme_textdomain() {
	load_theme_textdomain( 'pixels-text-domain', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'starter_theme_load_theme_textdomain' );

/**
 * Helper function for prettying up errors
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$pixels_error = function ( $message, $subtitle = '', $title = '' ) {
	$title   = $title ?: __( 'Theme &rsaquo; Error', 'pixels-text-domain' );
	$footer  = __( 'You can report this error to <a href="mailto:support@pixels.fi">support@pixels.fi</a>', 'pixels-text-domain' );
	$message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
	wp_die( esc_attr( $message ), esc_attr( $title ) );
};

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '5.6.4', phpversion(), '>=' ) ) {
	$pixels_error( __( 'You must be using PHP 5.6.4 or greater.', 'pixels-text-domain' ), __( 'Invalid PHP version', 'pixels-text-domain' ) );
}

/**
 * Ensure compatible version of WordPress is used
 */
if ( version_compare( '4.7.0', get_bloginfo( 'version' ), '>=' ) ) {
	$pixels_error( __( 'You must be using WordPress 4.7.0 or greater.', 'pixels-text-domain' ), __( 'Invalid WordPress version', 'pixels-text-domain' ) );
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
	[ 'assets', 'class-pixelssite', 'design-system', 'timber', 'widget-areas', 'filters' ]
);
