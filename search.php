<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

// Templates.
$templates = [ 'search/search.twig', 'archive/archive.twig', 'index/index.twig' ];

// Context.
$context = Timber::get_context();
/* Translators: Placeholder is the search term */
$context['title'] = sprintf( __( 'Search results for %s', 'pixels-text-domain' ), get_search_query() );
$context['posts'] = Timber::get_posts();

// Render with Timber.
Timber::render( $templates, $context );
