<?php
/**
 * Register widget areas.
 *
 * Additional areas can be added by using register_sidebar().
 */

namespace Theme\WidgetAreas;

function setup_widget_areas() {
  $config = [
      'before_widget' => '<section class="widget %1$s %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h3>',
      'after_title'   => '</h3>'
  ];
  register_sidebar([
      'name'          => __('Footer', 'pixels-text-domain'),
      'id'            => 'site-footer-widgets'
  ] + $config);
}
add_action('widgets_init', __NAMESPACE__ . '\\setup_widget_areas');
