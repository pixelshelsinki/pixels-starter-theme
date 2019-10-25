<?php
/**
 * Common utils
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme\Utils;

/**
 * Common Utils class
 *
 * Handle miscellaneous theme functionalities
 */
class Common {	

	/**
	 * Return array of custom post types
	 * --> Cases were we need to loop all post types
	 * --> Like adding all archive links to Twig context
	 *
	 * @return array $types of WP_Post_Type
	 */
	public static function get_post_types() {

		$args = array(
			'_builtin' => false,
		);

		$types = get_post_types( $args, 'object' );

		return $types;
	}
}
