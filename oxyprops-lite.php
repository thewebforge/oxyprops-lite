<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       OxyProps Lite
 * Plugin URI:        https://lite.oxyprops.com
 * Description:       Open Props CSS Custom properties for WordPress users.
 * Version:           1.0.0-alpha01
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
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

// Run stuff necessary for plugin activation
function activateOxyPropsLite()
{
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activateOxyPropsLite');

// Run stuff necessary for plugin deactivation
function deactivateOxyPropsLite()
{
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivateOxyPropsLite');

// Initatialize the plugin
if (class_exists('Inc\\Init')) {
    Inc\Init::registerServices();
}
