<?php
/**
 * OxyProps Lite WordPress Plugin
 * Brings Open Props to your WordPress Site.
 * php version 7.4.29
 *
 * @category PluginMain
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       OxyProps Lite
 * Plugin URI:        https://lite.oxyprops.com
 * Description:       Open Props CSS Custom properties for WordPress users.
 * Version:           0.9.1
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            The Web Forge
 * Author URI:        https://thewebforge.dev
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       oxyprops_lite
 * Domain Path:       /languages
 *
 * Copyright (c) 2022 Cédric Bontems - The Web Forge
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Simplify our lives with Composer Autoload
if (file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
    include_once dirname(__FILE__).'/vendor/autoload.php';
}

/**
 * Run necessary stuff during plugin activation
 *
 * @return void
 *
 * @since  1.0.0
 * @author Cédric Bontems <dev@oxyprops.com>
 */
function activateOxyPropsLite()
{
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activateOxyPropsLite');

/**
 * Run necessary stuff during plugin deactivation
 *
 * @return void
 *
 * @since  1.0.0
 * @author Cédric Bontems <dev@oxyprops.com>
 */
function deactivateOxyPropsLite()
{
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivateOxyPropsLite');

// Initatialize the plugin
if (class_exists('Inc\\Init')) {
    Inc\Init::registerServices();
}

if (file_exists(
    dirname(__FILE__).
    '/vendor/plugin-update-checker/plugin-update-checker.php'
)
) {
    include_once dirname(__FILE__).
    '/vendor/plugin-update-checker/plugin-update-checker.php';
}

$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://lite.oxyprops.com/wp-content/uploads/update/'.
    '?action=get_metadata&slug=oxyprops-lite',
    __FILE__,
    'oxyprops-lite'
);
