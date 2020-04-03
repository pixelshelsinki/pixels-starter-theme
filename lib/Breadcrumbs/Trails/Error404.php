<?php
/**
 * 404 Breadcrumbs
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
 * 404 Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> 404
 */
class Error404 extends BreadcrumbsTrail {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_404();
	}

	/**
	 * Add 04.
	 */
	public function add_404() {

		$crumb = new Breadcrumb();
		$label = apply_filters( 'pixels_breadcrumbs_404_label', __( 'Not found', 'pixels-text-domain' ) );
		$url   = apply_filters( 'pixels_breadcrumbs_404_url', '#' );

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}


} // end Error404
