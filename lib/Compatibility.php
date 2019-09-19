<?php
/**
 * Checks that the theme is compatible with the install environment.
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme;

/**
 * Compatibility class
 *
 * Check PHP version
 * Check WP version
 * Do any other requirement checks
 */
class Compatibility {

	protected $php_version 	= '7.1.0';
	protected $wp_version 	= '4.7.0';

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_action( 'init', array( $this, 'check_php_version' ) );
		add_action( 'init', array( $this, 'check_wordpress_version' ) );
	}

	/**
	 * Ensure compatible version of PHP is used
	 *
	 * @since 1.0
	 */
	public function check_php_version() {
		if ( version_compare( $this->php_version, phpversion(), '>=' ) ) {
			wp_die( esc_attr( __( 'You must be using PHP '.$this->php_version.' or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );
		}
	}

	/**
	 * Ensure compatible version of WordPress is used
	 *
	 * @since 1.0
	 */
	public function check_wordpress_version() {
		if ( version_compare( $this->wp_version, get_bloginfo( 'version' ), '>=' ) ) {
			wp_die( esc_attr( __( 'You must be using WordPress '.$this->wp_version.' or greater.', 'pixels-text-domain' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'pixels-text-domain' ) ) );
		}
	}
}

new Compatibility();
