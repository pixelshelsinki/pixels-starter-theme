<?php
/**
 * 404 Breadcrumbs
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
 * 404 Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> 404
 */
class Error404 extends AbstractBreadcrumbs {

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
		$label = __( 'Not found', 'pixels-text-domain' );
		$url   = '#';

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}


} // end Error404
