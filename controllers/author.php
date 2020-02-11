<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

global $wp_query;

use Pixels\Theme\Controllers\ArchiveController;

// Set up Controller instance.
$controller = new ArchiveController();

// Templates.
$controller->set_templates( array( 'author/author.twig', 'index/index.twig' ) );

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new TimberUser( $wp_query->query_vars['author'] );
	$controller->add_context( 'author', $author );
	$controller->add_context( 'title', 'Author Archives: ' . $author->name() );
}

// Render the twig.
$controller->render();
