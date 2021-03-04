<?php
/**
 * Compatibility unit tests.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

use PHPUnit\Framework\TestCase;

// Theme classes.
use Pixels\Theme\Utils\Compatibility;

/**
 * Compatibility unit tests.
 */
final class CompatibilityTest extends TestCase {

	/**
	 * Instance can be created.
	 */
	public function testCanCreateInstance() {

		$this->assertInstanceOf(
			Compatibility::class,
			new Compatibility()
		);
	}

	/**
	 * Static method wp_version_applies exists
	 */
	public function testWpVersionAppliesMethodExists() {
		$method_exists = method_exists( 'Compatibility', 'wp_version_applies' );
		$this->assertFalse( $method_exists );
	}

	/**
	 * Test cases for wp_version_applies(), what are passed directly to version_compare()
	 */
	public function testWpVersionAppliesNormalTestCases() {
		$result_1 = Compatibility::wp_version_applies( '5.5', '5.4' );
		$this->assertFalse( $result_1 );

		$result_2 = Compatibility::wp_version_applies( '5.5', '5.5' );
		$this->assertTrue( $result_2 );

		$result_3 = Compatibility::wp_version_applies( '5.5', '5.6' );
		$this->assertTrue( $result_3 );
	}

	/**
	 * Edge test cases for wp_version_applies(), when parameters are different lengths in terms of subversioning
	 */
	public function testWpVersionAppliesEdgeTestCases() {

		$result_1 = Compatibility::wp_version_applies( '5.5.0', '5.5' );
		$this->assertTrue( $result_1 );

		$result_2 = Compatibility::wp_version_applies( '5.5', '5.5.0' );
		$this->assertTrue( $result_2 );
	}
}
