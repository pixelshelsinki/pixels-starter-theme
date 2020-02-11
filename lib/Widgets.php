<?php
/**
 * Theme widgets & areas
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme;

/**
 * Widgets class
 *
 * Register theme widget areas
 * Add any custom widgets
 */
class Widgets {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_action( 'widgets_init', array( $this, 'setup_widget_areas' ) );
	}

	/**
	 * Sets up widget areas for use in the theme.
	 */
	public function setup_widget_areas() {
		$config = array(
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		);
		register_sidebar(
			array(
				'name' => __( 'Footer', 'pixels-text-domain' ),
				'id'   => 'site-footer-widgets',
			) + $config
		);
	}


}
