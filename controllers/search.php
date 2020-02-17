<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\ArchiveController;

// Set up Controller instance.
$controller = new ArchiveController();

// Templates.
$controller->set_templates( array( 'search/search.twig', 'index/index.twig' ) );

/* Translators: Placeholder is the search term */
$controller->add_context( 'title', sprintf( __( 'Search results for %s', 'pixels-text-domain' ), get_search_query() ) );

// Render Twig.
$controller->render();
