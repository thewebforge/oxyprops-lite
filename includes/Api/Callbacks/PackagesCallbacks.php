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
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class PackagesCallbacks extends BaseController {

	/**
	 * Stores the Packages Callbacks Singleton.
	 *
	 * @var object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static $instance;

	/**
	 * Returns the Packages Callbacks Singleton.
	 *
	 * @return object Instance
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new PackagesCallbacks();
		}

		return self::$instance;
	}

	/**
	 * Returns the Packages Dashboard template
	 *
	 * @return string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function packagesDashboard() {
		return require_once "{$this->plugin_path}/templates/packages.php";
	}

}
