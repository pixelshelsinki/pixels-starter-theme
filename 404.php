<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

// Templates.
$templates = [ '404/404.twig' ];

// Context.
$context          = Timber::get_context();
$context['title'] = __( 'Not found', 'pixels-text-domain' );

// Render with Timber.
Timber::render( $templates, $context );
