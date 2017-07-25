<?php
/**
 * Functions to handle assets.
 *
 * @version 2.0.0
 */

namespace Theme\Assets;

/**
 * Get the JSON manifest.
 *
 * If no JSON manifest returns an empty array.
 *
 * @return array
 */
function get_json_manifest() {
  $manifest_path = get_template_directory() . '/dist/assets.json';
  return file_exists($manifest_path) ? json_decode(file_get_contents($manifest_path), true) : [];
}

/**
 * Get the cache-busted filename.
 *
 * If the manifest does not have an entry for $asset, then return $asset.
 *
 * @param string $asset The original name of the file before cache-busting
 * @return string
 */
function get_asset($asset) {
  $manifest = get_json_manifest();
  return isset($manifest[$asset]) ? $manifest[$asset] : $asset;
}

/**
 * Get the URI for the given asset.
 *
 * Checks for cache-busting filenames and returns the appropriate assets, then
 * returns the URI for whatever is found.
 *
 * @param string $asset An asset.
 * @return string
 */
function get_asset_uri($asset) {
  return get_template_directory_uri() . '/dist\/' . get_asset($asset);
}
