<?php
/**
 * Timber/Twig functions setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Twig;

/**
 * Functions class
 *
 * Add custom functions to Twig templates
 * Add custom extensions to TWig templates
 */
class Functions {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_filter( 'get_twig', array( $this, 'add_extensions' ) );
		add_filter( 'get_twig', array( $this, 'add_functions' ) );
	}

	/**
	 * Adds custom extensions to Twig templates
	 *
	 * @param @object $twig The instance of twig.
	 */
	public function add_extensions( $twig ) {

		$twig->addExtension( new \Twig_Extension_StringLoader() );

		return $twig;
	}

	/**
	 * Adds custom functions to Twig templates
	 *
	 * @param @object $twig The instance of twig.
	 */
	public function add_functions( $twig ) {

		// Responsive mage helper functions.
		$twig->addFunction( new \Timber\Twig_Function( 'responsive_image', '\\Pixels\\Theme\\Images::responsive_image' ) );
		$twig->addFunction( new \Timber\Twig_Function( 'responsive_background', '\\Pixels\\Theme\\Images::responsive_background' ) );

		// Social share functions.
		$twig->addFunction( new \Timber\Twig_Function( 'facebook_share', '\\Pixels\\Theme\\Share::facebook' ) );
		$twig->addFunction( new \Timber\Twig_Function( 'twitter_share', '\\Pixels\\Theme\\Share::twitter' ) );
		$twig->addFunction( new \Timber\Twig_Function( 'linkedin_share', '\\Pixels\\Theme\\Share::linkedin' ) );

		return $twig;
	}
}
