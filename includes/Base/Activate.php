<?php
/**
 * Activate
 * Manages plugin activation.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Base;

/**
 * Activate Class
 * Manages plugin activation.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class Activate
{
    /**
     * Sets default settings during plugin activation
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function activate()
    {
        self::_setDefaultParameters();
        self::_setDefaultPackages();
        flush_rewrite_rules();
    }

    /**
     * Registers default plugin settings in the database
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static function _setDefaultParameters()
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

    /**
     * Registers default packages settings in the database
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static function _setDefaultPackages()
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
