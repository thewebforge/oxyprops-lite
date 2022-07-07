<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class PackagesCallbacks extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new PackagesCallbacks();
        }

        return self::$instance;
    }

    public function packagesDashboard()
    {
        return require_once "{$this->pluginPath}/templates/packages.php";
    }

    public function oxypropsLiteMainPackagesSection()
    {
        ?>
        <p>
        <?php
        _e('Main', 'oxyprops_lite'); ?>
        </p>
        <?php
    }

    public function oxypropsLiteColorPackagesSection()
    {
        ?>
        <p>
        <?php
        _e('Main', 'oxyprops_lite'); ?>
        </p>
        <?php
    }

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
