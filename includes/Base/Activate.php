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
        flush_rewrite_rules();
        self::setDefaultParameters();
    }

    private static function setDefaultParameters()
    {
        if (get_option('oxyprops_lite')) {
            return;
        }
        $default = [];
        $oxyprops_light_options = Helpers::getPluginDefaultOptions();
        foreach ($oxyprops_light_options as $key => $parameters) {
            $default[$key] = $parameters['default'];
        }

        update_option('oxyprops_lite', $default);
    }
}
