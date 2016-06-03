<?php

namespace App;

use Roots\Sage\Asset;

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

\Timber::$dirname = array('components', 'views');

class StarterSite extends \TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'after_setup_theme', array( $this, 'register_navigation_areas') );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_theme_assets' ), 100 );
		// add_action( 'init', array( $this, 'register_post_types' ) );
		// add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	/**
	 * Register the navigation areas.
	 *
	 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	function register_navigation_areas() {
		$nav_menus = [
	    'primary_navigation' => __('Primary Navigation', 'pix-base-theme'),
	    'footer_navigation' => __('Footer Navigation', 'pix-base-theme')
	  ];
		register_nav_menus( $nav_menus );
	}


  function register_theme_assets() {
    wp_enqueue_style('pixels/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('pixels/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
  }

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['nav_main'] = new \TimberMenu('primary_navigation');
		$context['site'] = $this;
		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new \Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new \Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();
