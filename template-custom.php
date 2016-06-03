<?php
/**
 * Template Name: Custom Template
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['pagination'] = $context['post'];

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'views/Singular/SingularPassword.twig', $context );
} else {
	Timber::render( array( 'views/PageTemplate/PageTemplate-custom.twig', 'views/Singular/Singular-' . $post->post_type . '.twig', 'views/Singular/Singular.twig' ), $context );
}
