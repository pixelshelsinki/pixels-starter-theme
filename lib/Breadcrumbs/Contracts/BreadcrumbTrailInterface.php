<?php
/**
 * Breadcrumb Trail Interface
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs\Contracts;

use Pixels\Theme\Breadcrumbs\Contracts\BreadcrumbInterface;

/**
 * Breadcrumb Trail interface
 */
interface BreadcrumbTrailInterface {

	/**
	 * Add breadcrumb to trail
	 *
	 * @param BreadcrumbInterface $breadcrumb part of trail.
	 */
	public function add( BreadcrumbInterface $breadcrumb );

	/**
	 * Return breadcrumbs array
	 *
	 * @return array $breadcrumbs of page.
	 */
	public function get_breadcrumbs();


}
