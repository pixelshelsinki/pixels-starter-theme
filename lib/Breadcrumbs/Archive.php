<?php
/**
 * Archive Breadcrumbs
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Breadcrumbs;

use Pixels\Theme\Breadcrumbs\Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Arcgive Breadcrumb class
 * Gets breadcrumb with pattern:
 * Home -> PostTypeName 
 */
class Archive extends Post {

	/**
	 * Class constructor.
	 */
	public function __construct() {

		$this->add_home();
		$this->add_archive();
	}	

} // end Archive
