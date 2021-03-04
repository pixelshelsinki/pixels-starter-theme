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
		$this->assertEquals(
			$method_exists,
			false
		);
	}

	/**
	 * Test cases for wp_version_applies(), what are passed directly to version_compare()
	 */
	public function testWpVersionAppliesNormalTestCases() {
		$result_1 = Compatibility::wp_version_applies( '5.5', '5.4' );
		$this->assertEquals(
			$result_1,
			false
		);

		$result_2 = Compatibility::wp_version_applies( '5.5', '5.5' );
		$this->assertEquals(
			$result_2,
			true
		);

		$result_3 = Compatibility::wp_version_applies( '5.5', '5.6' );
		$this->assertEquals(
			$result_3,
			true
		);
	}

	/**
	 * Edge test cases for wp_version_applies(), when parameters are different lengths in terms of subversioning
	 */
	public function testWpVersionAppliesEdgeTestCases() {

		$result_1 = Compatibility::wp_version_applies( '5.5.0', '5.5' );
		$this->assertEquals(
			$result_1,
			true
		);

		$result_2 = Compatibility::wp_version_applies( '5.5', '5.5.0' );
		$this->assertEquals(
			$result_2,
			true
		);
	}
}
