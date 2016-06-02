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
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	_e('Timber is not activated. You need to activate the Timber plugin for this site to use this template.', 'px-base-theme');
	return;
}

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = array( 'views/Index/Index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'views/Home/Home.twig' );
}
Timber::render( $templates, $context );
?>
