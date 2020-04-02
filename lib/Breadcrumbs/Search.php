<?php
/**
 * Search Breadcrumbs
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
 * Search Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Search
 */
class Search extends AbstractBreadcrumbs {

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

		// Create breadcrumb for parent.
		$crumb = new Breadcrumb();
		$label = __( 'Search', 'pixels-text-domain' );
		$url   = '#';

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}


} // end Search
