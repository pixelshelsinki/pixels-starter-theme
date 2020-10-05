<?php
/**
 * Breadcrumbs trail.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs;

// Contracts.
use Pixels\Theme\Breadcrumbs\Contracts\BreadcrumbTrailInterface;
use Pixels\Theme\Breadcrumbs\Contracts\BreadcrumbInterface;

// Classes.
use Pixels\Theme\Breadcrumbs\Breadcrumb;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Breadcrumbs class
 * Offers implementation for trail.
 */
class BreadcrumbsTrail implements BreadcrumbTrailInterface {

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
	public function get_breadcrumbs() : array {
		return $this->trail;
	}

	/**
	 * Adds "Home" breadcrumb.
	 */
	public function add_home() {

		$show_home = apply_filters( 'pixels_breadcrumbs_home_enabled', true );

		if ( $show_home ) :

			$crumb = new Breadcrumb();
			$label = apply_filters( 'pixels_breadcrumbs_home_label', __( 'Home', 'pixels-text-domain' ) );
			$url   = apply_filters( 'pixels_breadcrumbs_home_url', get_home_url() );

			$crumb->set_label( $label );
			$crumb->set_url( $url );

			$this->add( $crumb );

		endif;
	}


} // end AbstractBreadcrumbs
