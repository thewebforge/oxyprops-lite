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
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
final class Init {

	/**
	 * Stores all the classes to initialize in an array.
	 *
	 * @return array full list of classes
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_services() {
		return array(
			Base\Enqueue::class,
			Dashboard\Dashboard::class,
			Dashboard\IndividualPackages::class,
			Api\Callbacks\AdminCallbacks::class,
			Api\Callbacks\FieldsCallbacks::class,
			Base\Gutenberg::class,
			Base\SettingsLinks::class,
		);
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
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = $class::get_instance();
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}
}
