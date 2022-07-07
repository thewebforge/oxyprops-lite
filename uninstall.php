<?php
/**
 * OxyProps Lite.
 *
 * @see              https://oxyprops.com
 * @since             1.0.0
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
