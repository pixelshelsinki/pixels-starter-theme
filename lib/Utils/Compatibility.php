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
	const PHP_VERSION = '7.3.0';

	/**
	 * WP version to compare to
	 *
	 * @var string
	 */
	const WP_VERSION = '5.5.0';

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
	public static function check_php_version() : bool {

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
	public static function check_wordpress_version() : bool {

		$compatible = true;

		if ( self::wp_version_applies( self::WP_VERSION, get_bloginfo( 'version' ) ) ) {
			return $compatible;
		} else {
			// phpcs:ignore
			wp_die( esc_attr( __( 'You must be using WordPress ' . self::WP_VERSION . ' or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );

			$compatible = false;
		}
	}

	/**
	 * Checks if version number in first parameter is equal to less than second parameter's version number.
	 *
	 * @param string $wp_version
	 * @param string $curr_wp_version
	 * @return bool $compatible status;
	 */
	public static function wp_version_applies( string $wp_version, string $curr_wp_version ) : bool {

		$wp_version_arr   = explode( '.', $wp_version );
		$curr_version_arr = explode( '.', $curr_wp_version );

		$wp_version_arr_count   = count( $wp_version_arr );
		$curr_version_arr_count = count( $curr_version_arr );

		// first check that version numbers have same length in subversioning
		// version_compare() seems to work only if they are the same
		if ( $wp_version_arr_count !== $curr_version_arr_count ) {
			// add ".0" subversion numbers to one that is shorter, until subversions match
			if ( $wp_version_arr_count > $curr_version_arr_count ) {
				$diff = $wp_version_arr_count - $curr_version_arr_count;
				for ( $i = 0; $i < $diff; $i++ ) {
					$curr_version_arr[] = '0';
				}
				$curr_wp_version = implode( '.', $curr_version_arr );
			} else {
				$diff = $curr_version_arr_count - $wp_version_arr_count;
				for ( $i = 0; $i < $diff; $i++ ) {
					$wp_version_arr[] = '0';
				}
				$wp_version = implode( '.', $wp_version_arr );
			}
		}

		return version_compare( $wp_version, $curr_wp_version, '<=' );
	}

}
