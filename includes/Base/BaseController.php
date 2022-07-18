<?php
/**
 * OxyProps Lite Base Controller
 * Defines OxyProps Lite variables.
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
 * OxyProps Lite Base Controller Class
 * Defines OxyProps Lite variables.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class BaseController
{
    public $activeIcon;
    public $adminSettings = [];
    public $name;
    public $plugin;
    public $pluginFile;
    public $pluginPath;
    public $pluginUrl;
    public $slug;
    public $textDomain;
    public $version;

    /**
     * Base Controller Constructor
     *
     * @return void
     *
     * @author Cédric Bontems <dev@oxyprops.com>
     * @since  1.0.0
     */
    public function __construct()
    {
        $this->version = '1.0.0-alpha01';
        $this->textDomain = 'oxyprops_lite';
        $this->pluginPath = plugin_dir_path(dirname(__FILE__, 2));
        $this->pluginUrl = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = self::_pluginBasename(3);
        $this->slug = plugin_basename(dirname(__FILE__, 3));
        $this->name = str_replace('-', '_', $this->slug);
        $this->pluginFile = $this->pluginPath.$this->slug.'.php';
        $this->adminSettings = Helpers::getPluginDefaultOptions();
        $this->packagesSettings = Helpers::getPluginPackagesOptions();
        $this->currentOptions = $this->getPluginCurrentOptions();
        $this->activeIcon = 'data:image/svg+xml;base64,'.
        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMD'.
        'A4IDc2OC41MiI+CiAgICAgIDxwYXRoIGZpbGw9ImJsYWNrIgogICAgICAgIGQ9Ik04MTcuMTEg'.
        'MTkyLjgyQzc1MC40OCA3Ny41OSA2MjUuNiAwIDQ4Mi40NiAwIDMyMC43NCAwIDE4Mi4zMiA5OS'.
        '4wNiAxMjQuODkgMjM5LjUyaDEwNy4zYzUwLjEzLTg1Ljc3IDE0My40LTE0My40NiAyNTAuMjct'.
        'MTQzLjQ2IDk4LjE2IDAgMTg0Ljg1IDQ4LjY2IDIzNy4xOSAxMjMuMDYtNTYuNTcgMzMuMjctOT'.
        'QuNTUgOTQuNzYtOTQuNTUgMTY1LjE0czM3Ljk4IDEzMS44OCA5NC41NiAxNjUuMTRjLTUyLjM0'.
        'IDc0LjM5LTEzOS4wNCAxMjMuMDUtMjM3LjE5IDEyMy4wNS0xMDYuODYgMC0yMDAuMTMtNTcuNj'.
        'ktMjUwLjI3LTE0My40NkgxMjQuODljNTcuNDMgMTQwLjQ3IDE5NS44NSAyMzkuNTIgMzU3LjU3'.
        'IDIzOS41MiAxNDMuMTQgMCAyNjguMDUtNzcuNTkgMzM0LjY5LTE5Mi44MiAxMDUuNDYtLjMyID'.
        'E5MC44NS04NS45MSAxOTAuODUtMTkxLjQ1UzkyMi41OSAxOTMuMSA4MTcuMTEgMTkyLjc5Wm0t'.
        'LjU2IDI4Ny4xN2MtNTIuODcgMC05NS43My00Mi44Ni05NS43My05NS43M3M0Mi44Ni05NS43My'.
        'A5NS43My05NS43MyA5NS43MyA0Mi44NiA5NS43MyA5NS43My00Mi44NiA5NS43My05NS43MyA5'.
        'NS43M1oiIC8+CiAgICAgIDxyZWN0IGZpbGw9ImJsYWNrIiB3aWR0aD0iMjMwIiBoZWlnaHQ9Ij'.
        'EwOC4wNyIgeT0iMzMwLjIyIiBjbGFzcz0iZCIgcng9IjU0LjA0IiByeT0iNTQuMDQiIC8+CiAg'.
        'ICAgIDxyZWN0IGZpbGw9ImJsYWNrIiB3aWR0aD0iMjMwIiBoZWlnaHQ9IjEwOC4wNyIgeD0iMz'.
        'EwIiB5PSIzMzAuNTciIGNsYXNzPSJkIiByeD0iNTQuMDQiIHJ5PSI1NC4wNCIgLz4KPC9zdmc+';
    }

    /**
     * Gets the current plugin settings
     *
     * @return array Current settings
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function getPluginCurrentOptions()
    {
        return get_option($this->name);
    }

    /**
     * Checks if an option item is disabled
     *
     * @param string $option the option element to be checked
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function disabled($option)
    {
        return !(
            isset($this->currentOptions[$option]) &&
            $this->currentOptions[$option]
        );
    }

    /**
     * Gets the plugin base name
     *
     * @param integer $levels depth of file in file structure
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private function _pluginBasename($levels)
    {
        $basename = basename(dirname(__FILE__, $levels)).'.php';
        $files = glob($this->pluginPath.$basename);

        return plugin_basename($files[0]);
    }
}
