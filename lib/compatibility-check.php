<?php
/**
 * Checks that the theme is compatible with the install environment.
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme\Compatibility;

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '7.1.0', phpversion(), '>=' ) ) {
	wp_die( esc_attr( __( 'You must be using PHP 7.1.0 or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );
}

/**
 * Ensure compatible version of WordPress is used
 */
if ( version_compare( '4.7.0', get_bloginfo( 'version' ), '>=' ) ) {
	wp_die( esc_attr( __( 'You must be using WordPress 4.7.0 or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );
}
