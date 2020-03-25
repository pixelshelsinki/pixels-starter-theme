<?php
/**
 * Post controller
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

/**
 * Post Controller class
 *
 * Used for pages & posts, generally anything with singular id
 */
class PostController extends Controller {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Do base setup from parent.
		parent::__construct();

		// Set up default post.
		$this->set_post( \Timber::query_post() );

	}

	/**
	 * Shorthand for setting up post context data
	 *
	 * @param TimberPost $post of page.
	 */
	public function set_post( $post ) {
		$this->add_context( 'post', $post );
	}

	/**
	 * Returns post id.
	 *
	 * @return int $id of post.
	 */
	public function get_id() {
		return $this->get_context( 'post' )->id;
	}
}
