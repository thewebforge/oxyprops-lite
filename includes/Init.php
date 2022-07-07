<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc;

final class Init
{
    /**
     * Store all the classes inside an array.
     *
     * @return array full list of classes
     */
    public static function getServices()
    {
        return [
            Base\Helpers::class,
            Pages\Dashboard::class,
            Pages\IndividualPackages::class,
            Api\Callbacks\AdminCallbacks::class,
            Api\Callbacks\FieldsCallbacks::class,
            // Api\SettingsApi::class,
            Base\Enqueue::class,
            Base\Gutenberg::class,
            Base\SettingsLinks::class,
        ];
    }

    /**
     * Loop through the classes, initialize them, and
     * call the register() method if it exists.
     *
     * @return
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
