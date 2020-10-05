<?php
/**
 * BreadcrumbsTrail unit tests.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

use PHPUnit\Framework\TestCase;

// Theme classes.
use Pixels\Theme\Breadcrumbs\Breadcrumb;
use Pixels\Theme\Breadcrumbs\BreadcrumbsTrail;

/**
 * Breadbrumb trail unit tests.
 */
final class BreadcrumbsTrailTest extends TestCase {

	/**
	 * Include doubles for wp functions & constants
	 */
	public static function setUpBeforeClass(): void {
		require_once __DIR__ . '/../TestDoubles/constants.php';
	}

	/**
	 * Instance can be created.
	 */
	public function testCanCreateTrailInstance() {
		$this->assertInstanceOf(
			BreadcrumbsTrail::class,
			new BreadcrumbsTrail()
		);
	}

	/**
	 * Crumbs can be added & returned from trail.
	 */
	public function testCanSetAndGetCrumbsInTrail() {
		$crumb = new Breadcrumb();
		$crumb->set_label( 'Services' );
		$crumb->set_url( '/services/' );

		$crumb2 = new Breadcrumb();
		$crumb2->set_label( 'Applications' );
		$crumb2->set_url( '/applications/' );

		$trail = new BreadcrumbsTrail();
		$trail->add( $crumb );
		$trail->add( $crumb2 );

		$this->assertContains(
			array(
				'label' => 'Services',
				'url'   => '/services/',
			),
			$trail->get_breadcrumbs()
		);

		$this->assertContains(
			array(
				'label' => 'Applications',
				'url'   => '/applications/',
			),
			$trail->get_breadcrumbs()
		);
	}
}
