<?php
/**
 * Taxonomy Breadcrumbs
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
 * Taxonomu Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Parent Term -> [...] -> Term
 */
class Taxonomy extends BreadcrumbsTrail {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_parent_term();
		$this->add_term();
	}

	/**
	 * Add parent term.
	 * Calls self recursively if parent of parent exists.
	 *
	 * @param \WP_Term $term_obj object.
	 */
	public function add_parent_term( $term_obj = null ) {

		// Ensure we have post object.
		if ( ! $term_obj ) :
			$term_obj = get_queried_object();
		endif;

		// Check for existance of parent.
		if ( $term_obj->parent !== 0 ) :
			$parent = get_term( $term_obj->parent );

			// Recursive add.
			$this->add_parent_term( $parent );

			// Create breadcrumb for parent.
			$crumb = new Breadcrumb();
			$label = $parent->name;
			$url   = get_term_link( $parent );

			$crumb->set_label( $label );
			$crumb->set_url( $url );

			$this->add( $crumb );
		endif;

	}

	/**
	 * Add term.
	 */
	public function add_term() {

		$term_obj = get_queried_object();

		// Create breadcrumb for parent.
		$crumb = new Breadcrumb();
		$label = $term_obj->name;
		$url   = get_term_link( $term_obj );

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}


} // end Taxonomy
