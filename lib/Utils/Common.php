<?php
/**
 * Common utils
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme\Utils;

// Breadcrumbs.
use Pixels\Theme\Breadcrumbs\Trails\Archive;
use Pixels\Theme\Breadcrumbs\Trails\Author;
use Pixels\Theme\Breadcrumbs\Trails\Error404;
use Pixels\Theme\Breadcrumbs\Trails\Page;
use Pixels\Theme\Breadcrumbs\Trails\Post;
use Pixels\Theme\Breadcrumbs\Trails\Search;
use Pixels\Theme\Breadcrumbs\Trails\Taxonomy;

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

	/**
	 * Return data array for breadcrumbs.
	 *
	 * @return array $breadcrumbs of page.
	 */
	public static function get_breadcrumbs() {

		$breadcrumbs = array();

		// Define breadcrumb type.
		if ( is_singular() ) :

			// Pages & singular posts.
			if ( is_page() ) :
				$handler = new Page();
			else :
				$handler = new Post();
			endif;

		else :

			// Post type archives.
			if ( is_archive() ) :
				$handler = new Archive();
			endif;

			// Taxonomy terms.
			if ( is_tax() ) :
				$handler = new Taxonomy();
			endif;

			// Search.
			if ( is_search() ) :
				$handler = new Search();
			endif;

			// Author.
			if ( is_author() ) :
				$handler = new Author();
			endif;

			// 404.
			if ( is_404() ) :
				$handler = new Error404();
			endif;

		endif;

		$breadcrumbs = $handler->get_breadcrumbs();

		// Allow filtering.
		$breadcrumbs = apply_filters( 'pixels_breadcrumbs', $breadcrumbs );

		return $breadcrumbs;

	}
}
