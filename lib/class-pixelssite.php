<?php
/**
 * The Pixels Site class for this project.
 *
 * Extends the TimberSite class with configuration specifically for this site.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

/**
 * Sets up the Timber site for this project.
 */
class PixelsSite extends \TimberSite {
	/**
	 * Constructs the initial class.
	 */
	public function __construct() {
		/**
		 * Enable features from Soil.
		 *
		 * @link https://roots.io/plugins/soil/
		 */
		add_theme_support( 'soil-clean-up' );
		add_theme_support( 'soil-nice-search' );

		/**
		 * Enable plugins to manage the document title.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable HTML5 markup support
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );

		/**
		 * Enable selective refresh for widgets in customizer.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_action( 'after_setup_theme', [ $this, 'load_theme_textdomain' ], 100 );
		add_filter( 'timber_context', [ $this, 'add_to_context' ] );
		add_filter( 'get_twig', [ $this, 'add_to_twig' ] );

		parent::__construct();
	}

	/**
	 * Load translation for the theme.
	 */
	public function load_theme_textdomain() {
		load_theme_textdomain( 'pixels-text-domain', get_template_directory() . '/languages' );
	}

	/**
	 * Sets up data in the Timber global context.
	 *
	 * @param array $context The Timber global context.
	 */
	public function add_to_context( $context ) {
		/**
		 * Setup site-wide information.
		 *
		 * @var [type]
		 */
		$context['site']           = $this;
		$context['site']->site_url = get_site_url(); // Since timber only returns home URL as 'link'.

		/**
		 * Setup site Navigation.
		 */
		$context['primary_navigation'] = new \TimberMenu( 'primary_navigation' );

		/**
		 * Setup Polylang Add polylang content to context.
		 */
		if ( function_exists( 'pll_the_languages' ) ) {
			$context['polylang']['current']   = pll_current_language( 'slug' );
			$context['polylang']['languages'] = pll_the_languages( [ 'raw' => 1 ] );
			$context['polylang']['home']      = pll_home_url();
		}

		/**
		 * Sets the privacy policy page, if it exists.
		 */
		if ( function_exists( 'get_privacy_policy_url' ) ) {
			$context['privacy'] = get_privacy_policy_url();
		}

		return $context;
	}

	/**
	 * An example function.
	 *
	 * @param  string $text String.
	 * @return string       String.
	 */
	public function example( $text ) {
		$text .= ' bar!';

		return $text;
	}

	/**
	 * Adds custom extensions or filters to twig.
	 *
	 * @param @object $twig The instance of twig.
	 */
	public function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new \Twig_Extension_StringLoader() );
		$twig->addFilter( 'example', new Twig_SimpleFilter( 'example', array( $this, 'example' ) ) );

		// Add image helper functions.
		$twig->addFunction( new Timber\Twig_Function( 'responsive_image', '\\Pixels\\Theme\\Images::responsive_image' ) );
		$twig->addFunction( new Timber\Twig_Function( 'responsive_background', '\\Pixels\\Theme\\Images::responsive_background' ) );

		return $twig;
	}
}
