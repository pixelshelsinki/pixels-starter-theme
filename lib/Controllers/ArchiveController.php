<?php
/**
 * Archive controller
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

/**
 * Archive Controller class
 *
 * Contains methods for handling archive page rendering
 */
class ArchiveController extends Controller {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Do base setup from parent.
		parent::__construct();

		// Add post from default query to context.
		$this->set_posts( \Timber::get_posts() );

		// Add pagination.
		$this->set_pagination( \Timber::get_pagination() );

	}

	/**
	 * Shorthand for setting up posts context data
	 *
	 * @param array $posts to be displayed in archive.
	 */
	public function set_posts( array $posts ) {
		$this->add_context( 'posts', $posts );
	}

	/**
	 * Shorthand for setting up pagination context data
	 *
	 * @param array $pagination of posts in archive.
	 */
	public function set_pagination( array $pagination ) {
		$this->add_context( 'pagination', $pagination );
	}
}

