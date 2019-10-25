<?php
/**
 * Taxonomy term controller
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

/**
 * Taconomy Controller class
 *
 * Contains methods for handling taxonomy/term page rendering
 */
class TaxonomyController extends ArchiveController {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Do base setup from parent.
		parent::__construct();

		// Get current term for context.
		$query_obj = get_queried_object();
		$this->add_context( 'term', new \Timber\Term( $query_obj->term_id ) );
	}
}

