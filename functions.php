<?php
/**
 * Add theme functionality here.
 *
 * Any functionality to do with adding content should be added to the project plugin.
 */

$function_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  // 'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  // 'lib/titles.php',    // Page titles
  // // 'lib/wrapper.php',   // Theme wrapper class
  // 'lib/customizer.php', // Theme customizer
	'lib/timber.php' 			// Timber basics
];

foreach ($function_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'px-base-theme'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
