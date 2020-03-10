<?php
/**
 * Changes made to WP Admin only
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Admin;

/**
 * Admin configs
 */
class Config {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Filters & Actions.
		add_action( 'admin_menu', array( $this, 'disable_admin_menus' ) );
		add_filter( 'admin_footer_text', array( $this, 'change_admin_footer' ), 999, 1 );
	}

	/**
	 * Remove menus from WP Admin
	 * For example: most themes don't have comments section
	 * Uncomment a line to disable that menu item
	 */
	public function disable_admin_menus() {
		// phpcs:ignore
		// remove_menu_page( 'index.php' );                  // Dashboard.
		// remove_menu_page( 'jetpack' );                    // Jetpack.
		// remove_menu_page( 'edit.php' );                   // Posts.
		// remove_menu_page( 'upload.php' );                 // Media.
		// remove_menu_page( 'edit.php?post_type=page' );    // Pages.
		// remove_menu_page( 'edit-comments.php' );          // Comments.
		// remove_menu_page( 'themes.php' );                 // Appearance.
		// remove_menu_page( 'plugins.php' );                // Plugins.
		// remove_menu_page( 'users.php' );                  // Users.
		// remove_menu_page( 'tools.php' );                  // Tools.
		// remove_menu_page( 'options-general.php' );        // Settings.
	}

	/**
	 * Change "Powered by WordPress" to "Crafted by Pixels"
	 *
	 * @param string $footer_text current admin panel footer text.
	 */
	public function change_admin_footer( $footer_text ) {
		$footer_text = '<p>Crafted by <a href="https://pixels.fi" rel="nofollow" target="_blank">Pixels</a></p>';
		return $footer_text;
	}
}
