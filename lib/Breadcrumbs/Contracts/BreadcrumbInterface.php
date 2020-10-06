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
	public function set_label( string $label );

	/**
	 * Get breadcrumb label
	 *
	 * @return string $label of breadcrumb.
	 */
	public function get_label() : string;

	/**
	 * Set breadcrumb url
	 *
	 * @param string $url of breadcrumb.
	 */
	public function set_url( string $url );

	/**
	 * Get breadcrumb url
	 *
	 * @return string $url of breadcrumb.
	 */
	public function get_url() : string;


}
