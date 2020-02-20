<?php
/**
 * Template Loading.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Templates;

/**
 * Template routing class
 * Handle custom template routing
 * Handle any custom template functionalities
 */
class Routing {

	/**
	 * Types in WP template hierarchy
	 *
	 * @var array
	 */
	protected $wp_types = array(
		'index',
		'404',
		'archive',
		'author',
		'category',
		'tag',
		'taxonomy',
		'date',
		'home',
		'frontpage',
		'page',
		'paged',
		'search',
		'single',
		'singular',
		'attachment',
	);

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Filter every default WP Template load path.
		foreach ( $this->wp_types as $wp_type ) {
			add_filter( "{$wp_type}_template_hierarchy", array( $this, 'intercept_template_hierarchy' ) );
		}
	}

	/**
	 * Intercepts the template hierarchy and moves the expected location to the
	 * `controllers/` directory.
	 *
	 * @param  array $templates The templates for the requested type.
	 * @return array            The modified templates.
	 */
	public function intercept_template_hierarchy( $templates ) {
		if ( file_exists( get_theme_file_path() . '/controllers/' ) ) {
			$templates = preg_replace( '/^(?!controllers\/)/', 'controllers/', $templates );
		}

		return $templates;
	}
}

