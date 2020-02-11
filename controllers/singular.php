<?php
/**
 * The Template for displaying all single items of content.
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\PostController;

// Set up Controller instance.
$controller = new PostController();

// Set templates.
$controller->set_templates( array( 'single/single-' . $post->ID . '.twig', 'single/single-' . $post->post_type . '.twig', 'single/single.twig' ) );

// If this is a password protected page we render the single password template.
if ( post_password_required( $post->ID ) ) {
	$controller->set_templates( array( 'single/single-password.twig' ) );
}

// Render the twig.
$controller->render();
