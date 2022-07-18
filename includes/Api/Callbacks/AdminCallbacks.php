<?php
/**
 * Admin Callbacks
 * Callbacks for admin.
 * php version 7.4.29
 *
 * @category Callbacks
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

/**
 * Admin Callbacks Class
 * Callbacks for plugin administration
 * php version 7.4.29
 *
 * @category Callbacks
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class AdminCallbacks extends BaseController
{
    /**
     * Stores the Admin Callbacks Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Admin Callbacks Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new AdminCallbacks();
        }

        return self::$_instance;
    }

    /**
     * Returns the Admin Dashboard template
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function adminDashboard()
    {
        return include_once "{$this->pluginPath}/templates/dashboard.php";
    }

    /**
     * Echoes the Settings Master Section
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function oxypropsLiteMasterSection()
    {
        _e(
            'Choose which assets you want OxyProps Lite to load,'.
            ' and how you want them loaded',
            'oxyprops_lite'
        );
    }
}
