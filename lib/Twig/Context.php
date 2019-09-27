<?php
/**
 * Timber Context setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Twig;

/**
 * Context class
 *
 * Add custom Timber context variables
 */
class Context {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_filter( 'timber_context', array( $this, 'add_general_context' ) );

		if ( function_exists( 'pll_the_languages' ) ) :
			add_filter( 'timber_context', array( $this, 'add_polylang_context' ) );
		endif;
	}

	/**
	 * Sets up general site settings in the Timber global context.
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_general_context( $context ) {

		/**
		 * Site-wide information.
		 *
		 * @var [type]
		 */
		$context['site']           = $this;
		$context['site']->site_url = get_site_url(); // Since timber only returns home URL as 'link'.

		/**
		 * Menus.
		 */
		$context['primary_navigation'] = new \TimberMenu( 'primary_navigation' );

		/**
		 * Privacy policy page, if it exists.
		 */
		if ( function_exists( 'get_privacy_policy_url' ) ) {
			$context['privacy'] = get_privacy_policy_url();
		}

		return $context;
	}

	/**
	 * Sets up data languages/polylang Timber global context.
	 *
	 * @param array $context The Timber global context.
	 * @return array $context that has been updated.
	 */
	public function add_polylang_context( $context ) {

		$context['polylang']['current']   = pll_current_language( 'slug' );
		$context['polylang']['languages'] = pll_the_languages( [ 'raw' => 1 ] );
		$context['polylang']['home']      = pll_home_url();

		return $context;
	}
}
