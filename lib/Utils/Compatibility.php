<?php
/**
 * Checks that the theme is compatible with the install environment.
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme\Utils;

/**
 * Compatibility class
 *
 * Check PHP version
 * Check WP version
 * Do any other requirement checks
 */
class Compatibility {

	/**
	 * PHP version to compare to
	 *
	 * @var string
	 */
	const PHP_VERSION = '7.1.0';

	/**
	 * WP version to compare to
	 *
	 * @var string
	 */
	const WP_VERSION = '4.7.0';

	/**
	 * Run all checks on theme start
	 *
	 * @return bool $compatible status.
	 */
	public static function run_checks() {
		$compatible =
		self::check_php_version()
		&& self::check_wordpress_version();

		return $compatible;
	}

	/**
	 * Ensure compatible version of PHP is used
	 *
	 * @return bool $compatible status;
	 * @since 1.0
	 */
	public static function check_php_version() {

		$compatible = true;

		if ( version_compare( self::PHP_VERSION, phpversion(), '>=' ) ) {
			// phpcs:ignore
			wp_die( esc_attr( __( 'You must be using PHP ' . self::PHP_VERSION . ' or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );

			$compatible = false;
		}

		return $compatible;
	}

	/**
	 * Ensure compatible version of WordPress is used
	 *
	 * @return bool $compatible status;
	 * @since 1.0
	 */
	public static function check_wordpress_version() {

		$compatible = true;

		if ( version_compare( self::WP_VERSION, get_bloginfo( 'version' ), '>=' ) ) {
			// phpcs:ignore
			wp_die( esc_attr( __( 'You must be using WordPress ' . self::WP_VERSION . ' or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );

			$compatible = false;
		}

		return $compatible;
	}
}
