<?php
/**
 * Packages Callbacks
 * Callbacks for Packages.
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
 * Packages Callbacks Class
 * Callbacks for Packages.
 * php version 7.4.29
 *
 * @category Callbacks
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class PackagesCallbacks extends BaseController
{
    /**
     * Stores the Packages Callbacks Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Packages Callbacks Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new PackagesCallbacks();
        }

        return self::$_instance;
    }

    /**
     * Returns the Packages Dashboard template
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function packagesDashboard()
    {
        return require_once "{$this->pluginPath}/templates/packages.php";
    }

    /**
     * Echoes the Main Packages Sections
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function oxypropsLiteMainPackagesSection()
    {
        ?>
        <p>
        <?php
        _e('Main', 'oxyprops_lite'); ?>
        </p>
        <?php
    }

    /**
     * Echoes the Colors Packages Sections
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function oxypropsLiteColorPackagesSection()
    {
        ?>
        <p>
        <?php
        _e('Main', 'oxyprops_lite'); ?>
        </p>
        <?php
    }

    /**
     * Echoes the HSL Colors Packages Sections
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function oxypropsLiteColorHslPackagesSection()
    {
        ?>
        <p>
        <?php
        _e('Main', 'oxyprops_lite'); ?>
        </p>
        <?php
    }
}
