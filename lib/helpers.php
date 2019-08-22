<?php
/**
 * Helper functions for this theme.
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

namespace PixelsTheme\Helpers;

/**
 * Helper function for prettying up errors
 *
 * @param string $message   The message to display.
 * @param string $subtitle  The subtitle of the error message.
 * @param string $title     The title of the error message.
 */
function error_message( $message, $subtitle = '', $title = '' ) {
	$title   = $title ?: __( 'Theme &rsaquo; Error', 'pixels-text-domain' );
	$footer  = __( 'You can report this error to <a href="mailto:support@pixels.fi">support@pixels.fi</a>', 'pixels-text-domain' );
	$message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";

	wp_die( esc_attr( $message ), esc_attr( $title ) );
}
