<?php
/**
 * mods templates
 */

namespace PixelsTheme\Templates;

function intercept_template_hierarchy( $templates ) {
  if ( file_exists( get_theme_file_path() . '/data/' ) ) {
    $templates = preg_filter('/^/', 'data/', $templates);
  }

  return $templates;
}

$wp_types = [
  'index',
  '404',
  'archive',
  'author',
  'category',
  'tag',
  'taxonomy',
  'date',
  'home',
  'frontpage',
  'page',
  'paged',
  'search',
  'single',
  'singular',
  'attachment',
];

foreach ( $wp_types as $type ) {
  add_filter( "{$type}_template_hierarchy", __NAMESPACE__ . '\\intercept_template_hierarchy' );
}
