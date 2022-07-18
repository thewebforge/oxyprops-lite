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

    /**
     * Adds links to the plugins page.
     *
     * @param array $links array of plugin links
     *
     * @return array
     */
    public function settingsLinks($links)
    {
        $links[] = '<a href="'.esc_url(admin_url('admin.php?page=oxyprops_lite')).'">'.esc_html__('Settings', 'oxyprops_lite').'</a>';
        $links[] = '<a target="_blank" href="https://docs.oxyprops.com" >'.esc_html__('Docs', 'oxyprops_lite').'</a>';
        $links[] = '<a target="_blank" href="https://oxyprops.com/shop/" style="color: var(--o-green-6); font-weight: bold">'.esc_html__('Go Pro', 'oxyprops_lite').'</a>';

        return $links;
    }
}
