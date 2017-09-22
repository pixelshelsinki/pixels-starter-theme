<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber TODO: chnnge?
 * @since    Timber 0.1
 */
global $wp_query;

// Templates
$templates = ['author/author.twig', 'archive/archive.twig'];

// Context
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new TimberUser( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title'] = 'Author Archives: ' . $author->name();
}

// Render with Timber
Timber::render( $templates, $context );
