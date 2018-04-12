<?php
/**
 * Template Name: Design System
 *
 * Outputs the Design System.
 *
 * Loops through all component twig files and outputs them in a design system.
 * In the future it will be possible to specify groupings for components to show
 * them in a better organised fashion.
 *
 * @version 1.0.0
 * @since 1.1.0
 */

if ( file_exists( get_template_directory() . '/vendor/erusev/parsedown/Parsedown.php' ) ) {
  include_once 'vendor/erusev/parsedown/Parsedown.php';
}

$context = Timber::get_context();
$post = Timber::query_post(); // not needed probably
$context['post'] = $post; // not needed probably

// Get design system-specific items.
$ds_directories = glob( get_template_directory() . "/design-system/*", GLOB_ONLYDIR );
// Get a list of all top level directories in the components folder.
$component_directories = glob( get_template_directory() . "/components/*" );
// Merge the two together.
$component_directories = array_merge( $ds_directories, $component_directories );

// Our array of components we will feed to the Design System Template.
$components = [];

foreach ( $component_directories as $key => $component_directory_path ) {
  // Setup this component
  $component = [];

  // Extract the component name
  $component_name = basename( $component_directory_path );
  $component['slug'] = $component_name; // The slug of the folder.
  $component['label'] = ucwords( str_replace( "-", " ", $component_name ) );

  // Load the variations, if the variations file exists.
  $component_variations_path = $component_directory_path . "/{$component_name}-variations.json";

  // If there is no config file we skip the component.
  if ( ! file_exists( $component_variations_path ) ) {
    continue;
  }

  // // Load the description text, if it exists.
  $component_description_path = $component_directory_path . "/{$component_name}-description.md";
  if ( file_exists( $component_description_path ) ) {
    // Get the markdown file as a string.
    $component_description_content = file_get_contents( $component_description_path );

    // Parse the markdown to html.
    $parsedown = new ParseDown();
    $component['description'] = $parsedown->text( $component_description_content );
  }

  if ( file_exists( $component_variations_path ) ) {
    $component_variations_content = file_get_contents( $component_variations_path );
    $component_variations = json_decode( $component_variations_content, true );
    $component['variations'] = $component_variations;
  }


  $components[] = $component;
}

$context['components'] = $components;

Timber::render( 'design-system/design-system.twig', $context );
