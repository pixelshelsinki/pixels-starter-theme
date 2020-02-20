<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

use Pixels\Theme\Controllers\Controller;

// Set up Controller instance.
$controller = new Controller();

// Templates.
$controller->set_templates( array( '404/404.twig' ) );

$controller->add_context( 'title', __( 'Not found', 'pixels-text-domain' ) );

// Render the twig.
$controller->render();
