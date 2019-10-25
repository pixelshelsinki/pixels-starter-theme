<?php
/**
 * Template Name: Design System
 *
 * Outputs the Design System.
 *
 * Loops through all component twig files and outputs them in a design system.
 * In the future it will be possible to specify groupings for components to show
 * them in a better organised fashion.
 *
 * @package WordPress
 * @subpackage Pixels\Theme
 */

use Pixels\Theme\DesignSystem;

if ( file_exists( get_template_directory() . '/vendor/erusev/parsedown/Parsedown.php' ) ) {
	include_once get_template_directory() . '/vendor/erusev/parsedown/Parsedown.php';
}

$context         = Timber::get_context();
$context['post'] = Timber::query_post(); // not needed probably.

$context['current_component'] = get_query_var( 'component', false );

/**
 * Gets the navigation for the Design System.
 */
$context['navigation'] = DesignSystem::get_navigation( $context['current_component'] );

/**
 * Gets the section/component data for the currently viewed section.
 */
$context['component'] = DesignSystem::get_component( $context['current_component'] );

Timber::render( 'design-system/design-system.twig', $context );
