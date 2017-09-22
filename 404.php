<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

// Templates
$templates = ['404/404.twig'];

// Context
$context = Timber::get_context();
$context['title'] = __('Not found', 'pixels-starter-theme');

// Render with Timber
Timber::render( $templates, $context );
