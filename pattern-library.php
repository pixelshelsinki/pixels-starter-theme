<?php
/**
 * Template Name: Pattern library
 *
 * Outputs the pattern library. // TODO make this somehow a permanent thing.
 *
 * Loops through all component twig files and outputs them in a pattern library.
 * In the future it will be possible to specify groupings for components to show
 * them in a better organised fashion.
 *
 * @version 2.0.0-beta
 * @since 2.0.0
 */


// Templates
$context = Timber::get_context();
$post = Timber::query_post(); // not needed probably
$context['post'] = $post; // not needed probably

$components = glob(get_template_directory() . "/components/**/*.twig");

foreach ($components as $key => $component) {
  var_dump($component);
  Timber::render( $component, $context );
}

var_dump($components);
// 1. get all files in components dir
// 2. Extract available variables
// 3. extract example vars from doc block
// 4. render twig file with given vars.
//
//
// Output possible vars?
