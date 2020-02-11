<?php
/**
 * The Template for displaying a sidebar.
 *
 * @package  WordPress
 * @subpackage  PixelsTheme
 */

// Templates.
$templates = array( 'sidebar/sidebar.twig' );

// Render with Timber.
Timber::render( $templates, $data );
