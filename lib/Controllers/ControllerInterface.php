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
	
	// Required methods
	public function add_context( $key, $value );
	public function set_templates( $templates );
	public function get_templates();
	public function render();
}
