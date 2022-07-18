<?php
/**
 * Helpers for OxyProps Lite
 * Provides helper functions.
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
 * Helpers Class
 * Provides helper functions.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class Helpers
{
    /**
     * Path to Open Props
     *
     * @var string
     */
    private static $_open_props = 'assets/css/open-props/';

    /**
     * Reads a JSON file and return it in a manageable way
     *
     * @param string $target Path to the JSON file
     *
     * @return mixed the value encoded in json in appropriate PHP type.
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getJson($target)
    {
        $strJsonOptionsFileContent = file_get_contents($target);

        return json_decode($strJsonOptionsFileContent, true);
    }

    /**
     * Reads default settings from the JSON file
     *
     * @return array OxyProps Lite default settings
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getPluginDefaultOptions()
    {
        $optionsFile = plugin_dir_path(dirname(__FILE__, 2)).
        'config/plugin_options.json';

        return self::getJson($optionsFile);
    }

    /**
     * Reads default Packages from the JSON file
     *
     * @return array OxyProps Lite default packages informations and settings
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getPluginPackagesOptions()
    {
        $optionsFile = plugin_dir_path(dirname(__FILE__, 2)).'config/packages.json';

        return self::getJson($optionsFile);
    }

    /**
     * Reads Open Props full bundle
     *
     * @return string all styles
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getFullBundle()
    {
        $str = '';
        $mainFile = plugin_dir_path(dirname(__FILE__, 2)).
        self::$_open_props.'open-props.op-lite.min.css';
        $hslFile = plugin_dir_path(dirname(__FILE__, 2)).
        self::$_open_props.'colors-hsl.op-lite.min.css';

        $str .= self::readFile($mainFile);
        $str .= self::readFile($hslFile);

        return $str;
    }

    /**
     * Reads Normalize
     *
     * @return string OxyProps Lite Normalize styles
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getNormalizeStyles()
    {
        $targetFile = plugin_dir_path(dirname(__FILE__, 2))
        .self::$_open_props.'../normalize.min.css';

        return self::readFile($targetFile);
    }

    /**
     * Reads selected packages styles
     *
     * @param string $path path to the package file
     *
     * @return string all selected packages styles
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getSelectedPackages($path)
    {
        $packagesList = self::getPluginPackagesOptions();
        $str = '';
        foreach ($packagesList as $key => $value) {
            if (get_option('oxyprops_lite_packages')[$key]
                && isset($value['file'])
            ) {
                $packageFile = $path.
                self::$_open_props.$value['file'].'.op-lite.min.css';
                $str .= self::readFile($packageFile);
            }
        }

        return $str;
    }

    /**
     * Enqueues user selected packages to Front End
     *
     * @param string $url     Package Url
     * @param string $version Plugin version
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function enqueueSelectedPackages($url, $version)
    {
        $packagesList = self::getPluginPackagesOptions();
        foreach ($packagesList as $key => $value) {
            if (get_option('oxyprops_lite_packages')[$key]
                && isset($value['file'])
            ) {
                wp_enqueue_style(
                    'oxyprops-'.$value['file'],
                    $url.self::$_open_props.$value['file'].'.op-lite.min.css',
                    [],
                    $version,
                    'all'
                );
            }
        }
    }

    /**
     * Reads a file and returns its content
     *
     * @param string $target File path
     *
     * @return string File content
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function readFile($target)
    {
        if (!file_exists($target)) {
            return '';
        }
        return file_get_contents($target);
    }
}
