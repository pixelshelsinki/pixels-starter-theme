<?php
/**
 * Post Breadcrumbs
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs\Trails;

use Pixels\Theme\Breadcrumbs\Trails\Page;
use Pixels\Theme\Breadcrumbs\Breadcrumb;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Post Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> Archive -> Parent post -> [...] -> Post
 */
class Post extends Page {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_archive();
		$this->add_parent_post();
	}

	/**
	 * Add archive breadcrumb.
	 */
	public function add_archive() {

		$post_obj      = get_post();
		$post_type     = get_post_type( $post_obj );
		$post_type_obj = get_post_type_object( $post_type );

		$crumb = new Breadcrumb();
		$label = apply_filters( 'pixels_breadcrumbs_' . $post_type . '_archive_label', $post_type_obj->labels->menu_name );
		$url   = apply_filters( 'pixels_breadcrumbs_' . $post_type . '_archive_url', get_post_type_archive_link( $post_type ) );

		$crumb->set_label( $label );
		$crumb->set_url( $url );

		$this->add( $crumb );
	}


} // end Post
