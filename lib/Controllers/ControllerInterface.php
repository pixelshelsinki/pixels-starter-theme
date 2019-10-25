<?php
/**
 * Controller Interface
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

/**
 * Controller interface
 */
interface ControllerInterface {

	// Required methods.
	/**
	 * Add key/value pair to context
	 *
	 * @param string $key of context.
	 * @param mixed  $value of context.
	 */
	public function add_context( $key, $value );

	/**
	 * Set templates of controller
	 *
	 * @param mixed $templates string or array.
	 */
	public function set_templates( $templates );

	/**
	 * Returns templates of controller
	 */
	public function get_templates();

	/**
	 * Render twig
	 */
	public function render();
}
