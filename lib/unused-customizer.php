<?php
/**
 * Customizer setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Theme\Customizer;

/**
 * Theme customizer.
 */
add_action(
	'customize_register',
	function ( \WP_Customize_Manager $wp_customize ) {
		// Add postMessage support.
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			[
				'selector'        => '.brand',
				'render_callback' => function () {
					bloginfo( 'name' );
				},
			]
		);
	}
);

/**
 * Customizer JS.
 */
add_action(
	'customize_preview_init',
	function () {
		wp_enqueue_script( 'pixels/customizer.js', asset_path( 'scripts/customizer.js' ), [ 'customize-preview' ], null, true );
	}
);