<?php

/**
 * Helper function for prettying up errors TODO: clean up.
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$pixels_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Theme &rsaquo; Error', 'pixels-text-domain');
    $footer = __('You can report this error to <a href="mailto:support@pixels.fi">support@pixels.fi</a>', 'pixels-text-domain');
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('5.6.4', phpversion(), '>=')) {
    $pixels_error(__('You must be using PHP 5.6.4 or greater.', 'pixels-text-domain'), __('Invalid PHP version', 'pixels-text-domain'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $pixels_error(__('You must be using WordPress 4.7.0 or greater.', 'pixels-text-domain'), __('Invalid WordPress version', 'pixels-text-domain'));
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($pixels_error) {
    $file = "lib/{$file}.php";
    if (!locate_template($file, true, true)) {
        $pixels_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'pixels-text-domain'), $file), 'File not found');
    }
}, ['assets', 'timber', 'widget-areas']);
