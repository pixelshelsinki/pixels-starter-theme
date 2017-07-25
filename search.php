<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory TODO: change
 *
 * @package  WordPress
 * @subpackage  Timber TODO: change?
 * @since   Timber 0.1
 */

$templates = array( 'search/search.twig', 'archive/archive.twig', 'index/index.twig' );
$context = Timber::get_context();

$context['title'] = sprintf(__('Search results for %s', 'pixels'), get_search_query());
$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );
