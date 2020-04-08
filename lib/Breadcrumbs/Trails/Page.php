<?php
/**
 * Page Breadcrumbs
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs\Trails;

use Pixels\Theme\Breadcrumbs\BreadcrumbsTrail;
use Pixels\Theme\Breadcrumbs\Breadcrumb;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Parent page -> [...] -> Page
 */
class Page extends BreadcrumbsTrail {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_parent_post();
	}

	/**
	 * Add parent post.
	 * Calls self recursively if parent of parent exists.
	 *
	 * @param \WP_POST $post_obj object.
	 */
	public function add_parent_post( $post_obj = null ) {

		// Ensure we have post object.
		if ( ! $post_obj ) :
			$post_obj = get_post();
		endif;

		// Check for existance of parent.
		if ( $post_obj->post_parent !== 0 ) :
			$parent = get_post( $post_obj->post_parent );

			// Recursive add.
			$this->add_parent_post( $parent );

			// Create breadcrumb for parent.
			$crumb = new Breadcrumb();
			$label = get_the_title( $parent );
			$url   = get_permalink( $parent );

			$crumb->set_label( $label );
			$crumb->set_url( $url );

			$this->add( $crumb );
		endif;

	}


} // end Page
