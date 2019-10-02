<?php
/**
 * Base controller
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

/**
 * Controller class
 *
 * Base for controllers that render Twig through Timber
 */
class Controller implements ControllerInterface {

	/**
	 * Context array
	 *
	 * @var array.
	 */
	private $context;

	/**
	 * Templates array/string
	 *
	 * @var array.
	 */
	private $templates;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Set up global context.
		$this->context = \Timber::get_context();

		// Set up default post.
		$this->add_context( 'post', \Timber::query_post() );
	}

	/**
	 * Add key & value pair to context
	 *
	 * @param string $key to be used in context.
	 * @param mixed $value to be used in context.
	 */
	public function add_context( $key, $value ) {
		$this->context[$key] = $value;
	}

	/**
	 * Remove key from context
	 *
	 * @param string $key of context array.
	 */
	public function remove_context( $key ) {
		unset( $this->context[$key] );
	}

	/**
	 * Set templates of controller
	 *
	 * @param mixed $templates, string or array of Twigs.
	 */
	public function set_templates( $templates ) {
		$this->templates = $templates;
	}

	/**
	 * Return templates of controller
	 *
	 * @return mixed $templates, string or array of Twigs.
	 */
	public function get_templates() {
		return $this->templates;
	}

	/**
	 * Render twig templates
	 * Uses templates & context
	 */
	public function render() {
		\Timber::render( $this->templates, $this->context );
	}

}

