<?php
/**
 * Breadcrumb unit tests.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

use PHPUnit\Framework\TestCase;

// Theme classes.
use Pixels\Theme\Breadcrumbs\Breadcrumb;

/**
 * Breadbrumb unit tests.
 */
final class BreadcrumbTest extends TestCase {

	/**
	 * Instance can be created.
	 */
	public function testCanCreateInstance() {

		$this->assertInstanceOf(
			Breadcrumb::class,
			new Breadcrumb()
		);
	}

	/**
	 * Labels work.
	 */
	public function testCanGetAndSetLabel() {
		$crumb = new Breadcrumb();
		$crumb->set_label( 'Crumb label' );

		$this->assertEquals(
			'Crumb label',
			$crumb->get_label()
		);
	}

	/**
	 * Urls work.
	 */
	public function testCanGetAndSetUrl() {
		$crumb = new Breadcrumb();
		$crumb->set_url( 'https:://pixels.fi' );

		$this->assertEquals(
			'https:://pixels.fi',
			$crumb->get_url()
		);
	}

}
