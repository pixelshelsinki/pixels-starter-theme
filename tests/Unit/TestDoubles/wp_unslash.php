<?php
/**
 * Test double.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

/**
 * Mock for wp_unslash.
 * The real function calls long chain of wp filtering functions.
 *
 * @param mixed $content to "unslash".
 * @return mixes $content that was totally "unslashed".
 */
function wp_unslash( $content ) {
	return $content;
}
