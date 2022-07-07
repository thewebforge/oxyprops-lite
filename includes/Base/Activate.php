<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        self::setDefaultParameters();
        self::setDefaultPackages();
        flush_rewrite_rules();
    }

    private static function setDefaultParameters()
    {
        if (get_option('oxyprops_lite')) {
            return;
        }
        $default = [];
        $oxyprops_lite_options = Helpers::getPluginDefaultOptions();
        foreach ($oxyprops_lite_options as $key => $parameters) {
            $default[$key] = $parameters['default'];
        }

        update_option('oxyprops_lite', $default);
    }

    private static function setDefaultPackages()
    {
        if (get_option('oxyprops_lite_packages')) {
            return;
        }
        $default = [];
        $oxyprops_lite_options = Helpers::getPluginPackagesOptions();
        foreach ($oxyprops_lite_options as $key => $parameters) {
            $default[$key] = $parameters['default'];
        }

        update_option('oxyprops_lite_packages', $default);
    }
}
