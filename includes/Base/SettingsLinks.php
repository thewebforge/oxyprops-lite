<?php
/**
 * Settings Links
 * Defines plugin settings links on the plugin page.
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
 * Settings Links Class
 * Defines plugin settings links on the plugin page.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class SettingsLinks extends BaseController
{
    /**
     * Stores the Settings Links Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Settings Links Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new SettingsLinks();
        }

        return self::$_instance;
    }

    /**
     * Initializes the Settings Links Class
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
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
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function settingsLinks($links)
    {
        $links[] = '<a href="'.esc_url(admin_url('admin.php?page=oxyprops_lite')).
        '">'.esc_html__('Settings', 'oxyprops_lite').'</a>';
        $links[] = '<a target="_blank" href="https://docs.oxyprops.com" >'.
        esc_html__('Docs', 'oxyprops_lite').'</a>';
        $links[] = '<a target="_blank" href="https://oxyprops.com/shop/"'.
        ' style="color: var(--o-green-6); font-weight: bold">'.
        esc_html__('Go Pro', 'oxyprops_lite').'</a>';

        return $links;
    }
}
