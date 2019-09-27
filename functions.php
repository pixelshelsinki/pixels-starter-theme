<?php
/**
 * Loads theme lib
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme;

// Composer autoload.
require_once 'vendor/autoload.php';

/**
 * Main Application class
 *
 * Bootstrap app lib
 */
final class App {

	// Class properties
	private $assets;
	private $compatibility;
	private $config;	
	private $design_system;
	private $hooks;
	private $images;
	private $navigations;
	private $templates;
	private $timber;
	private $widgets;

	/**
	 * Class constructor
	 */
	public function __construct() {

		/**
		 * Instantiate class instances
		 */

		// Common WordPress configs.
		$this->compatibility 	= new Compatibility();
		$this->config 			= new Config();
		$this->assets 			= new Assets();
		$this->navigations 		= new Navigations();
		$this->images 			= new Images();
		$this->hooks 			= new Hooks();
		$this->widgets 			= new Widgets();

		// Templating
		$this->timber 			= new Timber();
		$this->templates 		= new Templates();
		$this->design_system 	= new DesignSystem();		
	}

	
}

// Start the theme app
new App();

