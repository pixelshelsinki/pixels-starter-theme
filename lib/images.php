<?php
/**
 * Theme image sizes
 *
 * Register image sizes
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace PixelsTheme\Images;

// Actions.
add_action( 'init', __NAMESPACE__ . '\\add_img_sizes' );

/**
 * Register theme image sizes.
 *
 * @since 1.0
 */
function add_img_sizes() {
	add_theme_support( 'post-thumbnails' );
	// add_image_size( 'image-name', 350, 200, true );
}
