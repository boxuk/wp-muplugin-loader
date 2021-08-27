<?php
/**
 * MU-Plugin Autoloader
 *
 * The nice thing about this file, this is really nothing to test. It's purely
 * a loader file, stitching things together.
 *
 * @license MIT
 * @copyright Luke Woodward
 * @package WP_MUPlugin_Loader
 */

namespace LkWdwrd\MuPluginLoader;

use function LkWdwrd\MuPluginLoader\Util\mu_loader;

/**
 * Disallow direct access, this should only load through WordPress.
 */
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Require utilities.
 */
require_once __DIR__ . '/Util/loader.php';
require_once __DIR__ . '/Util/util.php';
require_once __DIR__ . '/Util/list-table.php';
require_once __DIR__ . '/Util/assets.php';

/**
 * If we are not installing, run the `mu_loader()`
 */
if (! defined('WP_INSTALLING') || ! WP_INSTALLING) {
    // Run the loader unless installing
    mu_loader();
}

/**
 * Pretty print the plugins into the mu-plugins list-table.
 */
add_action(
    'after_plugin_row_mu-require.php',
    'LkWdwrd\MuPluginLoader\Util\list_table',
    10,
    0
);

/**
 * Filter URLs created by `plugins_url` to support symlinked content.
 */
add_filter(
    'plugins_url',
    'LkWdwrd\MuPluginLoader\Util\plugins_url',
    10,
    3
);
