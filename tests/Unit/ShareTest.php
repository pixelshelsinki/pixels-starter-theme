<?php
/**
 * Share class unit tests.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

use PHPUnit\Framework\TestCase;

// Theme classes.
use Pixels\Theme\Share;

/**
 * Share class unit tests.
 */
final class ShareTest extends TestCase {

	/**
	 * Include doubles for wp functions & constants
	 */
	public static function setUpBeforeClass(): void {
		require_once 'TestDoubles/wp_unslash.php';
	}

	/**
	 * Set up mock $_SERVER before each test.
	 */
	protected function setUp(): void {
		// Set up mock $_SERVER.
		$_SERVER = array(
			'HTTPS'       => 'on',
			'HTTP_HOST'   => 'pixels.fi',
			'REQUEST_URI' => '/',
		);
	}

	/**
	 * Facebook share.
	 */
	public function testGetsFacebookShareLink() {

		// With default url.
		$this->assertEquals(
			'https://www.facebook.com/sharer.php?u=https://pixels.fi/',
			Share::facebook()
		);

		// With given url.
		$this->assertEquals(
			'https://www.facebook.com/sharer.php?u=https://test.fi/',
			Share::facebook( 'https://test.fi/' )
		);

		// Disable HTTPS.
		$_SERVER['HTTPS'] = 'off';

		// With disbled HTTPS.
		$this->assertEquals(
			'https://www.facebook.com/sharer.php?u=http://pixels.fi/',
			Share::facebook()
		);

		// With given url.
		$this->assertEquals(
			'https://www.facebook.com/sharer.php?u=https://test.fi/',
			Share::facebook( 'https://test.fi/' )
		);
	}

	/**
	 * Twitter share.
	 */
	public function testGetsTwitterShareLink() {

		// With default link.
		$this->assertEquals(
			'https://twitter.com/share?url=https://pixels.fi/&text=',
			Share::twitter()
		);

		// With given link.
		$this->assertEquals(
			'https://twitter.com/share?url=https://test.fi/&text=',
			Share::twitter( 'https://test.fi/' )
		);

		// With given text.
		$this->assertEquals(
			'https://twitter.com/share?url=https://test.fi/&text=Take a look',
			Share::twitter( 'https://test.fi/', 'Take a look' )
		);

		// Disable HTTPS.
		$_SERVER['HTTPS'] = 'off';

		// With disabled HTTPS.
		$this->assertEquals(
			'https://twitter.com/share?url=http://pixels.fi/&text=',
			Share::twitter()
		);
	}

	/**
	 * Linkedin share.
	 */
	public function testGetsLinkedinShareLink() {

		// With default link.
		$this->assertEquals(
			'https://linkedin.com/shareArticle?url=https://pixels.fi/&title=Linkedin',
			Share::linkedin()
		);

		// With given link.
		$this->assertEquals(
			'https://linkedin.com/shareArticle?url=https://test.fi/&title=Linkedin',
			Share::linkedin( 'https://test.fi/' )
		);

		// With given text.
		$this->assertEquals(
			'https://linkedin.com/shareArticle?url=https://test.fi/&title=Linkedin',
			Share::linkedin( 'https://test.fi/', 'Take a look' )
		);

		// Disable HTTPS.
		$_SERVER['HTTPS'] = 'off';

		// With disabled HTTPS.
		$this->assertEquals(
			'https://linkedin.com/shareArticle?url=http://pixels.fi/&title=Linkedin',
			Share::linkedin()
		);
	}

}
