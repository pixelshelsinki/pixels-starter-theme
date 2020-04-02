<?php
/**
 * Author Breadcrumbs
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs\Trails;

use Pixels\Theme\Breadcrumbs\BreadcrumbsTrail;
use Pixels\Theme\Breadcrumbs\Breadcrumb;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Author Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Author -> Authorname
 */
class Author extends BreadcrumbsTrail {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_author();
		$this->add_author_name();
	}

	/**
	 * Add author title.
	 */
	public function add_author() {

		$crumb = new Breadcrumb();
		$label = __( 'Author', 'pixels-text-domain' );
		$url   = '#';

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}

	/**
	 * Add author name.
	 */
	public function add_author_name() {
		global $wp_query;

		$author_id  = $wp_query->query_vars['author'];
		$first_name = get_the_author_meta( 'first_name', $author_id );
		$last_name  = get_the_author_meta( 'last_name', $author_id );

		$crumb = new Breadcrumb();
		$label = $first_name . ' ' . $last_name;
		$url   = '#';

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );

	}


} // end Author
