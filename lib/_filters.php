<?php

namespace Theme\Filters;

/**
 * Add <body> classes
 */
// add_filter('body_class', function (array $classes) {
//     /** Add page slug if it doesn't exist */
//     if (is_single() || is_page() && !is_front_page()) {
//         if (!in_array(basename(get_permalink()), $classes)) {
//             $classes[] = basename(get_permalink());
//         }
//     }
//
//     /** Add class if sidebar is active */
//     if (display_sidebar()) {
//         $classes[] = 'sidebar-primary';
//     }
//

//
//     return array_filter($classes);
// });

/**
 * Add "… Continued" to the excerpt
 */
// add_filter('excerpt_more', function () {
//     return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'pixels-text-domain') . '</a>';
// });
