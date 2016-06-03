<?php
/**
 * Add theme functionality here.
 *
 * Any functionality to do with adding content should be added to the project plugin.
 */

$function_includes = [
  'src/helpers.php',    // Scripts and stylesheets
  // 'lib/extras.php',    // Custom functions
  // 'src/setup.php',     // Theme setup
  // 'lib/titles.php',    // Page titles
  // // 'lib/wrapper.php',   // Theme wrapper class
  // 'lib/customizer.php', // Theme customizer
	'src/timber.php' 			// Timber basics
];

foreach ($function_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'px-base-theme'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 * Require Composer autoloader if installed on it's own
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}
