<?php
/**
 * Page Breadcrumbs
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs;

use Pixels\Theme\Breadcrumbs\Contracts\AbstractBreadcrumbs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Page Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Parent page -> [...] -> Page
 */
class Page extends AbstractBreadcrumbs {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_parent_page();
	}

	/**
	 * Add parent page.
	 * Calls self recursively if parent of parent exists.
	 *
	 * @param \WP_POST $post_obj object.
	 */
	public function add_parent_page( $post_obj = null ) {

		// Ensure we have post object.
		if ( ! $post_obj ) :
			$post_obj = get_post();
		endif;

		// Check for existance of parent.
		if ( $post_obj->post_parent != 0 ) :
			$parent = get_post( $post_obj->post_parent );

			// Recursive add.
			$this->add_parent_page( $parent );

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
