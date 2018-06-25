<?php
/**
 * Setup of Timber-specific things.
 */

use Theme\Assets;

/**
 * Checks that the Timber plugin is activated.
 */
if ( ! class_exists( 'Timber' ) ) {
	/**
	 * Output an admin notice warning about Timber plugin not activated.
	 * @return [type] [description]
	 */
	function missing_timber_admin_notice() {
		echo '<div class="error"><p>' . sprintf(__('Timber not activated. Make sure you activate the plugin in <a href="%1$s">%2$s</a>' ), esc_url( admin_url( 'plugins.php#timber' ) ), esc_url( admin_url( 'plugins.php') ) ) . '</p></div>';
	}
	add_action( 'admin_notices', 'missing_timber_admin_notice' );

	/**
	 * Output a page on the frontend warning about Timber plugin not activated.
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	function missing_timber_frontend_notice($template) {
		return get_stylesheet_directory() . '/static/no-timber.html'; // TODO: replace this with something better.
	}
	add_filter('template_include', 'missing_timber_frontend_notice' );

	return;
}

/**
 * Directories where Twig files live.
 *
 * Saves us explicitly writing all directories.
 *
 * @var array
 */
Timber::$dirname = ['components', 'design-system', 'views'];

/**
 * Sets up the Timber site for this project.
 */
class PixelsSite extends TimberSite {

	function __construct() {
		/**
		 * Enable features from Soil when plugin is activated
		 * @link https://roots.io/plugins/soil/
		 */
		add_theme_support('soil-clean-up');
		add_theme_support('soil-jquery-cdn');
		add_theme_support('soil-nice-search');

		/**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

		/**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     * @link http://codex.wordpress.org/Post_Thumbnails
     * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
     * @link http://codex.wordpress.org/Function_Reference/add_image_size
     */
    add_theme_support('post-thumbnails');

		/**
		 * Enable HTML5 markup support
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support( 'html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption'] );

		/**
		 * Enable selective refresh for widgets in customizer
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
		 */
		// add_theme_support('customize-selective-refresh-widgets');

		/**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'pixels-text-domain')
    ]);

    add_action( 'after_setup_theme', [$this, 'setup_editor_styles'], 100 );
		add_action( 'wp_enqueue_scripts', [$this, 'setup_scripts_styles'], 100 );
		add_filter( 'timber_context', [$this, 'add_to_context'] );
		add_filter( 'get_twig', [$this, 'add_to_twig'] );
		parent::__construct();
	}

	/**
	 * Adds the JS and CSS files to the document head.
	 */
	function setup_scripts_styles() {
		wp_enqueue_style( 'pixels/main.css', Assets\get_asset_uri( 'styles/main.css' ), false, null );
    wp_enqueue_script( 'pixels/main.js', Assets\get_asset_uri( 'scripts/main.js' ), ['jquery'], null, true );
	}
  
  function setup_editor_styles() {
		/**
		 * Use main stylesheet for visual editor
		 * @see assets/styles/layouts/_tinymce.scss
		 */
		add_editor_style( '/dist/' . Assets\get_asset_uri('styles/main.css') );
	}

	function add_to_context( $context ) {
		// Site information
		$context['site'] = $this;
		$context['site']->site_url = get_site_url(); // Since timber only returns home URL as 'link'

		// Navigation
		$context['primary_navigation'] = new TimberMenu( 'primary_navigation' );

		// Multilingual
		if (function_exists('pll_the_languages')) {
			$context['polylang']['current'] = pll_current_language( 'slug' );
			$context['polylang']['languages'] = pll_the_languages( ['raw' => 1] );
      $context['polylang']['home'] = pll_home_url();
		}
    
    // Privacy policy
		$context['privacy'] = get_the_privacy_policy_link();


		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		// $twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new PixelsSite();
