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
	 * Context array
	 *
	 * @var array
	 */
	private $context;

	/**
	 * Templates array/string
	 *
	 * @var array
	 */
	private $templates;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Do base setup from parent.
		parent::__construct();

		// Remove "post" inherited from parent.
		$this->remove_context( 'post' );

		// Add post from default query to context.
		$this->add_context( 'posts', \Timber::get_posts() );

		// Add pagination.
		$this->add_context( 'pagination', \Timber::get_pagination() );

	}

	/**
	 * Shorthand for setting up posts context data
	 *
	 * @param array $posts to be displayed in archive.
	 */
	public function add_posts( array $posts ) {
		$this->add_context( 'posts', $posts );
	}

	/**
	 * Shorthand for setting up pagination context data
	 *
	 * @param array $pagination of posts in archive.
	 */
	public function add_pagination( array $pagination ) {
		$this->add_context( 'pagination', $pagination );
	}
}

