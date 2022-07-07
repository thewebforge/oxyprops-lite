<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class BaseController
{
    public $pluginPath;
    public $pluginUrl;
    public $pluginFile;
    public $plugin;
    public $slug;
    public $name;
    public $activeIcon;
    public $version;
    public $adminSettings = [];

    public function __construct()
    {
        $this->version = '1.0.0-alpha01';
        $this->pluginPath = plugin_dir_path(dirname(__FILE__, 2));
        $this->pluginUrl = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = self::pluginBasename(3);
        $this->slug = plugin_basename(dirname(__FILE__, 3));
        $this->name = str_replace('-', '_', $this->slug);
        $this->pluginFile = $this->pluginPath.$this->slug.'.php';
        $this->activeIcon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDA4IDc2OC41MiI+CiAgICAgIDxwYXRoIGZpbGw9ImJsYWNrIgogICAgICAgIGQ9Ik04MTcuMTEgMTkyLjgyQzc1MC40OCA3Ny41OSA2MjUuNiAwIDQ4Mi40NiAwIDMyMC43NCAwIDE4Mi4zMiA5OS4wNiAxMjQuODkgMjM5LjUyaDEwNy4zYzUwLjEzLTg1Ljc3IDE0My40LTE0My40NiAyNTAuMjctMTQzLjQ2IDk4LjE2IDAgMTg0Ljg1IDQ4LjY2IDIzNy4xOSAxMjMuMDYtNTYuNTcgMzMuMjctOTQuNTUgOTQuNzYtOTQuNTUgMTY1LjE0czM3Ljk4IDEzMS44OCA5NC41NiAxNjUuMTRjLTUyLjM0IDc0LjM5LTEzOS4wNCAxMjMuMDUtMjM3LjE5IDEyMy4wNS0xMDYuODYgMC0yMDAuMTMtNTcuNjktMjUwLjI3LTE0My40NkgxMjQuODljNTcuNDMgMTQwLjQ3IDE5NS44NSAyMzkuNTIgMzU3LjU3IDIzOS41MiAxNDMuMTQgMCAyNjguMDUtNzcuNTkgMzM0LjY5LTE5Mi44MiAxMDUuNDYtLjMyIDE5MC44NS04NS45MSAxOTAuODUtMTkxLjQ1UzkyMi41OSAxOTMuMSA4MTcuMTEgMTkyLjc5Wm0tLjU2IDI4Ny4xN2MtNTIuODcgMC05NS43My00Mi44Ni05NS43My05NS43M3M0Mi44Ni05NS43MyA5NS43My05NS43MyA5NS43MyA0Mi44NiA5NS43MyA5NS43My00Mi44NiA5NS43My05NS43MyA5NS43M1oiIC8+CiAgICAgIDxyZWN0IGZpbGw9ImJsYWNrIiB3aWR0aD0iMjMwIiBoZWlnaHQ9IjEwOC4wNyIgeT0iMzMwLjIyIiBjbGFzcz0iZCIgcng9IjU0LjA0IiByeT0iNTQuMDQiIC8+CiAgICAgIDxyZWN0IGZpbGw9ImJsYWNrIiB3aWR0aD0iMjMwIiBoZWlnaHQ9IjEwOC4wNyIgeD0iMzEwIiB5PSIzMzAuNTciIGNsYXNzPSJkIiByeD0iNTQuMDQiIHJ5PSI1NC4wNCIgLz4KPC9zdmc+';
        $this->adminSettings = Helpers::getPluginDefaultOptions();
        $this->packagesSettings = Helpers::getPluginPackagesOptions();
        $this->currentOptions = $this->getPluginCurrentOptions();
    }

    public function getPluginCurrentOptions()
    {
        return get_option($this->name);
    }

    public function disabled($option)
    {
        return !(isset($this->currentOptions[$option]) && $this->currentOptions[$option]);
    }

    private function pluginBasename($levels)
    {
        $basename = basename(dirname(__FILE__, $levels)).'.php';
        $files = glob($this->pluginPath.$basename);

        return plugin_basename($files[0]);
    }
}
