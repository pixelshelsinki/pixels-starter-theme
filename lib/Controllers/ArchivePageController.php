<?php
/**
 * Archive Page controller
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Controllers;

/**
 * Archive Page Controller class
 *
 * Version of archive that has a ID / page in the WP-Admin.
 */
class ArchivePageController extends ArchiveController {

	/**
	 * Class constructor
	 *
	 * @param mixed $template id or string of template name.
	 */
	public function __construct( $template ) {

		// Do base setup from parent.
		parent::__construct();

		// Handle archive id.
		$this->define_archive_id( $template );

	}

	/**
	 * Define ID of page to be used a s archive
	 * --> Can be ID (int)
	 * --> Or template name string, eg. "controllers/archive-event.php"
	 *
	 * @param mixed $template id or string of template name.
	 */
	public function define_archive_id( $template ) {

		// Check if we were served ID or template string.
		if ( is_int( $template ) ) :
			$page = new \Timber\Post( $template );
		else :
			// String, use template getter.
			$page = new \Timber\Post( $this->get_template_id( $template ) );
		endif;

		$this->add_context( 'page', $page );
	}

	/**
	 * Return first page with given template
	 *
	 * @param string $template name of template.
	 */
	private function get_template_id( $template ) {

		// Get pages with the given id.
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'meta_key'       => '_wp_page_template',
			'meta_value'     => $template,
		);

		$template = get_posts( $args );

		return $template[0]->ID;

	}

	/**
	 * Returns page id.
	 *
	 * @return int $id of archive page.
	 */
	public function get_id() {
		return $this->get_context( 'page' )->id;
	}
}
