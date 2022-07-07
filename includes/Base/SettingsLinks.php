<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class SettingsLinks extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new SettingsLinks();
        }

        return self::$instance;
    }

    public function register()
    {
        add_filter("plugin_action_links_{$this->plugin}", [$this, 'settingsLinks']);
    }

    public function settingsLinks($links)
    {
        $settings_links = '<a href="admin.php?page=oxyprops_lite">Settings</a>';
        array_push($links, $settings_links);

        return $links;
    }
}
