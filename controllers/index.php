<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
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
$controller->set_templates( array( 'index/index.twig' ) );

// If home add the home twig template to the front of the array.
if ( is_home() ) {
	$controller->set_templates( array_unshift( $controller->get_templates(), 'home/home.twig' ) );
}

// Render the twig.
$controller->render();
