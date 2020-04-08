<?php
/**
 * Search Breadcrumbs
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
 * Search Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Search
 */
class Search extends BreadcrumbsTrail {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_search();
	}

	/**
	 * Add search.
	 */
	public function add_search() {

		// Create breadcrumb for search.
		$crumb = new Breadcrumb();
		$label = apply_filters( 'pixels_breadcrumbs_search_label', __( 'Search', 'pixels-text-domain' ) );
		$url   = apply_filters( 'pixels_breadcrumbs_search_url', '#' );

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}


} // end Search
