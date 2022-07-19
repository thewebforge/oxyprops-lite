<?php
/**
 * Init
 * Initializes the plugin.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc;

/**
 * Init Class
 * Initializes the plugin.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
final class Init
{
    /**
     * Stores all the classes to initialize in an array.
     *
     * @return array full list of classes
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getServices()
    {
        return [
            Base\Enqueue::class,
            Dashboard\Dashboard::class,
            Dashboard\IndividualPackages::class,
            Api\Callbacks\AdminCallbacks::class,
            Api\Callbacks\FieldsCallbacks::class,
            Base\Gutenberg::class,
            Base\SettingsLinks::class,
        ];
    }

    /**
     * Loop through the classes, initialize them, and
     * call the register() method if it exists.
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function registerServices()
    {
        foreach (self::getServices() as $class) {
            $service = $class::getInstance();
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}
