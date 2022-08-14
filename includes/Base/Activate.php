<?php
/**
 * Activate
 * Manages plugin activation.
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
 * Activate Class
 * Manages plugin activation.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class Activate {

	/**
	 * Sets default settings during plugin activation
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function activate() {
		self::set_default_parameters();
		self::set_default_packages();
		flush_rewrite_rules();
	}

	/**
	 * Registers default plugin settings in the database
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static function set_default_parameters() {
		if ( get_option( 'oxyprops_lite' ) ) {
			return;
		}
		$default               = array();
		$oxyprops_lite_options = Helpers::get_plugin_default_options();
		foreach ( $oxyprops_lite_options as $key => $parameters ) {
			$default[ $key ] = $parameters['default'];
		}

		update_option( 'oxyprops_lite', $default );
	}

	/**
	 * Registers default packages settings in the database
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static function set_default_packages() {
		if ( get_option( 'oxyprops_lite_packages' ) ) {
			return;
		}
		$default               = array();
		$oxyprops_lite_options = Helpers::get_plugin_packages_options();
		foreach ( $oxyprops_lite_options as $key => $parameters ) {
			$default[ $key ] = $parameters['default'];
		}

		update_option( 'oxyprops_lite_packages', $default );
	}
}
