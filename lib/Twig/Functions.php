<?php
/**
 * Timber/Twig functions setup.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Twig;

// Image functions.
use Pixels\Components\Images\Factory;
use Pixels\Components\SocialShare\Share;

// Timber deps.
use \Timber\Twig_Function;

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
		$twig->addFunction( new Twig_Function( 'responsive_image', '\\Pixels\\Components\\Images\\Factory::responsive_image' ) );
		$twig->addFunction( new Twig_Function( 'responsive_background', '\\Pixels\\Components\\Images\\Factory::responsive_background' ) );

		// Social share functions.
		$twig->addFunction( new Twig_Function( 'facebook_share', '\\Pixels\\Components\\SocialShare\\Share::facebook' ) );
		$twig->addFunction( new Twig_Function( 'twitter_share', '\\Pixels\\Components\\SocialShare\\Share::twitter' ) );
		$twig->addFunction( new Twig_Function( 'linkedin_share', '\\Pixels\\Components\\SocialShare\\Share::linkedin' ) );
		$twig->addFunction( new Twig_Function( 'whatsapp_share', '\\Pixels\\Components\\SocialShare\\Share::whatsapp' ) );

		return $twig;
	}
}
