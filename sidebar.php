<?php
/**
 * The Template for displaying a sidebar.
 *
 * @package  WordPress
 * @subpackage  Timber
 */

// Templates
$templates = ['sidebar/sidebar.twig'];

// Render with Timber
Timber::render( $templates, $data );
