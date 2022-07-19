<?php
/**
 * Uninstall
 * Cleans everything on plugin uninstall.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

$oxypropsLiteOptions = [
    'oxyprops_lite',
    'oxyprops_lite_packages',
];

// Clean up after us
foreach ($oxypropsLiteOptions as $option) {
    delete_option($option);
}
