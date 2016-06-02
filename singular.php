<?php
/**
 * The Template for displaying all single content items
 *
 * Methods for TimberHelper can be found in the /lib sub-directory. If a content
 * type requires its own logic a custom `single-{post_type}.php` should be
 * created with the post-type-specific logic there.
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'views/Singular/SingularPassword.twig', $context );
} else {
	Timber::render( array( 'views/Singular/Singular-' . $post->ID . '.twig', 'views/Singular/Singular-' . $post->post_type . '.twig', 'views/Singular/Singular.twig' ), $context );
}
