<?php
/**
 * Abstract Breadcrumbs
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs\Contracts;

// Contracts.
use Pixels\Theme\Breadcrumbs\Contracts\BreadcrumbInterface;

// Classes.
use Pixels\Theme\Breadcrumbs\Breadcrumb;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Abstract Breadcrumb class
 * Offers implementation for trail.
 */
class AbstractBreadcrumbs implements BreadcrumbTrailInterface {

	/**
	 * Breadcrumb trail.
	 *
	 * @var array;
	 */
	protected $trail = array();

	/**
	 * Add breadcrumb to trail
	 *
	 * @param BreadcrumbInterface $breadcrumb part of trail.
	 */
	public function add( BreadcrumbInterface $breadcrumb ) {

		if ( ! is_array( $this->trail ) ) :
			$this->trail = array();
		endif;

		$this->trail[] = array(
			'label' => $breadcrumb->get_label(),
			'url'   => $breadcrumb->get_url(),
		);
	}

	/**
	 * Return breadcrumbs array
	 *
	 * @return array $breadcrumbs of page.
	 */
	public function get_breadcrumbs() {
		return $this->trail;
	}

	/**
	 * Adds "Home" breadcrumb.
	 */
	public function add_home() {
		$crumb = new Breadcrumb();
		$label = 'Home'; // TODO: FILTERABLE & BETER
		$url   = get_home_url(); // TODO: FILTERABLE & BETER

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );
	}


} // end AbstractBreadcrumbs
