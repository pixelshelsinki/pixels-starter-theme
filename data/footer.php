<?php
/**
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the single/single-page-plugin.twig template.
 *
 * If you're not using a plugin that requries this behavior (ones that do include Events Calendar Pro and
 * WooCommerce) you can delete this file and header.php
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

// Templates.
$templates = [ 'single/single-page-plugin.twig' ];

// Context.
$timber_context = $GLOBALS['timberContext'];
if ( ! isset( $timber_context ) ) {
	throw new \Exception( 'Timber context not set in footer.' );
}
$timber_context['content'] = ob_get_contents();
ob_end_clean();

// Render with Timber.
Timber::render( $templates, $timber_context );
