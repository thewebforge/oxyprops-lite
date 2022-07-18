<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class Helpers
{
    private static $open_props = 'assets/css/open-props/';

    public static function getJson($target)
    {
        $strJsonOptionsFileContent = file_get_contents($target);

        return json_decode($strJsonOptionsFileContent, true);
    }

    public static function getPluginDefaultOptions()
    {
        $optionsFile = plugin_dir_path(dirname(__FILE__, 2)).'config/plugin_options.json';

        return self::getJson($optionsFile);
    }

    public static function getPluginPackagesOptions()
    {
        $optionsFile = plugin_dir_path(dirname(__FILE__, 2)).'config/packages.json';

        return self::getJson($optionsFile);
    }

    public static function getFullBundle()
    {
        $str = '';
        $mainFile = plugin_dir_path(dirname(__FILE__, 2)).self::$open_props.'open-props.op-lite.min.css';
        $hslFile = plugin_dir_path(dirname(__FILE__, 2)).self::$open_props.'colors-hsl.op-lite.min.css';

        $str .= self::readFile($mainFile);
        $str .= self::readFile($hslFile);

        return $str;
    }

    public static function getNormalizeStyles()
    {
        $targetFile = plugin_dir_path(dirname(__FILE__, 2)).self::$open_props.'../normalize.min.css';

        return self::readFile($targetFile);
    }

    public static function getSelectedPackages($path)
    {
        $packagesList = self::getPluginPackagesOptions();
        $str = '';
        foreach ($packagesList as $key => $value) {
            if (get_option('oxyprops_lite_packages')[$key] && isset($value['file'])) {
                $packageFile = $path.self::$open_props.$value['file'].'.op-lite.min.css';
                $str .= self::readFile($packageFile);
            }
        }

        return $str;
    }

    public static function enqueueSelectedPackages($url, $version)
    {
        $packagesList = self::getPluginPackagesOptions();
        foreach ($packagesList as $key => $value) {
            if (get_option('oxyprops_lite_packages')[$key] && isset($value['file'])) {
                wp_enqueue_style('oxyprops-'.$value['file'], $url.self::$open_props.$value['file'].'.op-lite.min.css', [], $version, 'all');
            }
        }
    }

    public static function readFile($target)
    {
        if (!file_exists($target)) {
            return '';
        }
        // read the entire string
        return file_get_contents($target);
    }
}
