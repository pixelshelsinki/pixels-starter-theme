<?php
/**
 * The Template for displaying all single items of content.
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

// Templates.
$templates = [ 'single/single-' . $post->ID . '.twig', 'single/single-' . $post->post_type . '.twig', 'single/single.twig' ];

// Context.
$context         = Timber::get_context();
$context['post'] = Timber::query_post();

// If this is a password protected page we render the single password template.
if ( post_password_required( $post->ID ) ) {
	$templates = [ 'single/single-password.twig' ];
}

// Render with Timber.
Timber::render( $templates, $context );
