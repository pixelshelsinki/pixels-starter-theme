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
	private $config;	
	private $design_system;
	private $hooks;
	private $images;
	private $navigations;
	private $routing;
	private $timber;
	private $widgets;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Check if environment matches requirements.
		Compatibility::run_checks();

		/**
		 * Instantiate class instances
		 */

		$this->config 			= new Config();
		$this->assets 			= new Assets();
		$this->navigations 		= new Navigations();
		$this->images 			= new Images();
		$this->hooks 			= new Hooks();
		$this->widgets 			= new Widgets();

		// Templating

		$this->routing 			= new Templates\Routing();
		$this->timber 			= new Templates\Timber();
		$this->design_system 	= new Templates\DesignSystem();		
	}	
}

// Start the theme app
new App();

