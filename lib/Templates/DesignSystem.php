<?php
/**
 * Set up theme design system.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

namespace Pixels\Theme\Templates;

/**
 * DesignSystem class
 *
 * Handle Design System related functionalities
 */
class DesignSystem {

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Actions.
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
	}

	/**
	 * Add the `component` query variable so WordPress won't mangle them.
	 *
	 * @param array $vars The query vars.
	 */
	public function add_query_vars( $vars ) {
		$vars[] = 'component';

		return $vars;
	}

	/**
	 * Gets the component manifest for the design system.
	 *
	 * @return array Array of all components.
	 */
	public static function get_component_manifest() {
		$component_manifest = array();

		// Get a list of all top level directories in the components folder.
		$component_directories = glob( get_template_directory() . '/views/components/*' );

		foreach ( $component_directories as $key => $component_directory_path ) {
			$component_slug = basename( $component_directory_path );

			$component_manifest[ $component_slug ] = array(
				'slug'  => $component_slug,
				'label' => ucwords( str_replace( '-', ' ', $component_slug ) ),
				'path'  => $component_directory_path,
			);
		}

		return $component_manifest;
	}

	/**
	 * Gets the navigation for the design system.
	 *
	 * @param  string $current_component The active component.
	 * @return array                  The navigation items.
	 */
	public static function get_navigation( $current_component = '' ) {
		$nav_menu_items = array();

		$component_manifest = self::get_component_manifest();

		foreach ( $component_manifest as $key => $component ) {
			$nav_menu_items[] = array(
				'label'  => $component['label'],
				'slug'   => $component['slug'],
				'link'   => self::get_navigation_link( $component['slug'] ),
				'active' => ( $current_component === $component['slug'] ),
			);
		}

		return $nav_menu_items;
	}

	/**
	 * Gets the navigation link for the component.
	 *
	 * @param  string $component_slug The component slug.
	 * @return string                 The url to the component in the design system.
	 */
	public static function get_navigation_link( $component_slug ) {
		return get_the_permalink() . '?component=' . $component_slug;
	}

	/**
	 * Gets the component data.
	 *
	 * @param  string $component_slug The component slug.
	 * @return array                  The component data.
	 */
	public static function get_component( $component_slug ) {
		$component_manifest = self::get_component_manifest();

		// Get the component we need from the manifest.
		$component = isset( $component_manifest[ $component_slug ] ) ? $component_manifest[ $component_slug ] : false;

		if ( ! $component ) {
			return array();
		}

		$component['description'] = self::get_component_description( $component_slug );
		$component['variations']  = self::get_component_variations( $component_slug );

		return $component;
	}

	/**
	 * Gets the component description.
	 *
	 * @param  string $component_slug The component slug.
	 * @return string                 The component description.
	 */
	public static function get_component_description( $component_slug ) {
		if ( ! class_exists( 'ParseDown' ) ) {
			return false;
		}

		// Load the description text, if it exists.
		$component_description_path = get_template_directory() . "/views/components/{$component_slug}/{$component_slug}-description.md";

		if ( ! file_exists( $component_description_path ) ) {
			return false;
		}

		// Get the markdown file as a string.
		$component_description_content = file_get_contents( $component_description_path );

		// Parse the markdown to html.
		$parsedown             = new \ParseDown();
		$component_description = $parsedown->text( $component_description_content );

		return $component_description;
	}

	/**
	 * Gets the variations for a component, based on files.
	 *
	 * @param  string $component_slug The component slug.
	 * @return array                  The variations of the component.
	 */
	public static function get_component_variations( $component_slug ) {
		$component_variations = array();

		$component_variation_paths = glob( get_template_directory() . "/views/components/{$component_slug}/*.twig" );

		foreach ( $component_variation_paths as $key => $component_variation_path ) {
			$component_variation_filename = basename( $component_variation_path );

			$component_variations[ $component_variation_filename ] = array(
				'filename' => $component_variation_filename,
				'filepath' => "{$component_slug}/{$component_variation_filename}",
				'data'     => self::get_variation_data( $component_slug, $component_variation_filename ),
			);
		}

		return $component_variations;
	}

	/**
	 * Gets the variation data.
	 *
	 * @param  string $component_slug               The component slug.
	 * @param  string $component_variation_filename The component variation filename.
	 * @return array                                The component variation data.
	 */
	public static function get_variation_data( $component_slug, $component_variation_filename ) {
		$variation_data_filename = str_replace( '.twig', '-data.json', $component_variation_filename );
		$path_to_data_file       = get_template_directory() . "/views/components/{$component_slug}/$variation_data_filename";

		if ( ! file_exists( $path_to_data_file ) ) {
			return false;
		}

		$variation_contents = file_get_contents( $path_to_data_file );
		$variation_data     = json_decode( $variation_contents, true );

		return $variation_data;
	}
}
