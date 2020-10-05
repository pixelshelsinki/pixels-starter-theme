<?php
/**
 * Test double.
 *
 * @package WordPress
 * @subpackage PixelsTheme
 */

/**
 * Mock for apply_filters.
 *
 * @param mixed $filter to apply.
 * @param mixed $content to filter.
 * @return mixed $content that "was filtered".
 */
function apply_filters( $filter, $content ) {
	return $content;
}
