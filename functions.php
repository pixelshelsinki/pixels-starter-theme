<?php
/**
 * Loads theme lib
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme;

// Composer autoload.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Main Application class
 *
 * Bootstrap app lib
 */
final class App {

	/**
	 * Assets instance
	 *
	 * @var Assets
	 */
	private $assets;

	/**
	 * Config instance
	 *
	 * @var Config
	 */
	private $config;

	/**
	 * DesignSystem instance
	 *
	 * @var DesignSystem
	 */
	private $design_system;

	/**
	 * Hooks instance
	 *
	 * @var Hooks
	 */
	private $hooks;

	/**
	 * Images instance
	 *
	 * @var Images
	 */
	private $images;

	/**
	 * Navigations instance
	 *
	 * @var Navigations
	 */
	private $navigations;

	/**
	 * Routing instance
	 *
	 * @var Routing
	 */
	private $routing;

	/**
	 * Timber instance
	 *
	 * @var Timber
	 */
	private $timber;

	/**
	 * Widgets instance
	 *
	 * @var Widgets
	 */
	private $widgets;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Check if environment matches requirements.
		Utils\Compatibility::run_checks();

		/**
		 * Instantiate class instances
		 */

		$this->config      = new Config();
		$this->assets      = new Assets();
		$this->navigations = new Navigations();
		$this->images      = new Images();
		$this->hooks       = new Hooks();
		$this->widgets     = new Widgets();

		// Templating.

		$this->timber        = new Twig\Timber();
		$this->routing       = new Templates\Routing();
		$this->design_system = new Templates\DesignSystem();
	}
}

// Start the theme app.
new App();
