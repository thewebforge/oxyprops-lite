<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new AdminCallbacks();
        }

        return self::$instance;
    }

    public function adminDashboard()
    {
        return require_once "{$this->pluginPath}/templates/dashboard.php";
    }

    public function cptDashboard()
    {
        return require_once "{$this->pluginPath}/templates/cpt.php";
    }

    public function packagesDashboard()
    {
        return require_once "{$this->pluginPath}/templates/packages.php";
    }

    public function taxonomiesDashboard()
    {
        return require_once "{$this->pluginPath}/templates/taxonomies.php";
    }

    public function widgetsDashboard()
    {
        return require_once "{$this->pluginPath}/templates/widgets.php";
    }

    public function oxypropsLiteMasterSection()
    {
        _e('Choose which assets you want OxyProps Lite to load, and how you want them loaded', 'oxyprops_lite');
    }

    public function oxypropsLiteFieldTextExample()
    {
        $value = esc_attr(get_option('text-example'));
        echo '<input type="text" class="regular-text" name="text_example" value="'.$value.'" placeholder="'._e('Your text here', 'oxyprops_lite').'"/>';
    }

    public function oxypropsLiteFieldFirstName()
    {
        $value = esc_attr(get_option('first-name'));
        echo '<input type="text" class="regular-text" name="first_name" value="'.$value.'" placeholder="First Name"/>';
    }
}
