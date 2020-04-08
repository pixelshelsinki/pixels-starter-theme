<?php
/**
 * Breadcrumb Interface
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs\Contracts;

/**
 * Breadcrumb interface
 */
interface BreadcrumbInterface {

	/**
	 * Set breadcrumb label
	 *
	 * @param string $label of breadcrumb.
	 */
	public function set_label( $label );

	/**
	 * Get breadcrumb label
	 *
	 * @return string $label of breadcrumb.
	 */
	public function get_label();

	/**
	 * Set breadcrumb url
	 *
	 * @param string $url of breadcrumb.
	 */
	public function set_url( $url );

	/**
	 * Get breadcrumb url
	 *
	 * @return string $url of breadcrumb.
	 */
	public function get_url();


}
