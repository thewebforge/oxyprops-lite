<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class Helpers extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Helpers();
        }

        return self::$instance;
    }

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
        $targetFile = plugin_dir_path(dirname(__FILE__, 2)).'open-props/open-props.op-lite.min.css';

        return self::readFile($targetFile);
    }

    public static function getNormalizeStyles()
    {
        $targetFile = plugin_dir_path(dirname(__FILE__, 2)).'open-props/normalize.op-lite.min.css';

        return self::readFile($targetFile);
    }

    public static function getSelectedPackages($path)
    {
        $packagesList = self::getPluginPackagesOptions();
        $str = '';
        foreach ($packagesList as $key => $value) {
            if (get_option('oxyprops_lite_packages')[$key] && isset($value['file'])) {
                $packageFile = $path.'open-props/'.$value['file'].'.op-lite.min.css';
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
                wp_enqueue_style('oxyprops-'.$value['file'], $url.'open-props/'.$value['file'].'.op-lite.min.css', [], $version, 'all');
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
