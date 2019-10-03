<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\ArchiveController;

// Set up Controller instance.
$controller = new ArchiveController();

// Set templates.
$controller->set_templates( [ 'archive/archive-' . $post->post_type . '.twig', 'archive/archive.twig', 'index/index.twig' ] );

// If home add the home twig template to the front of the array.
if ( is_home() ) {
	$templates = $controller->get_templates();
	array_unshift( $templates, 'home/home.twig' );
	$controller->set_templates( $templates );
}

// Render the twig.
$controller->render();
