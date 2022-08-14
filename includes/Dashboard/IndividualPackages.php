<?php
/**
 * Individual Packages
 * Creates OxyProps Lite split individual packages.
 * php version 7.4.29
 *
 * @category Dashboard
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Dashboard;

use Inc\Api\Callbacks\FieldsCallbacks;
use Inc\Api\Callbacks\PackagesCallbacks;
use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Base\Options;

/**
 * IndividualPackages Class
 * Creates OxyProps Lite split individual packages.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class IndividualPackages extends BaseController {

	/**
	 * Admin settings API instance
	 *
	 * @var object
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $settings;

	/**
	 * Admin subpages
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $sub_pages = array();

	/**
	 * Admin callbacks instance
	 *
	 * @var object
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $callbacks;

	/**
	 * Option name
	 *
	 * @var string
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $option_name = 'oxyprops_lite_bundle';

	/**
	 * Stores the IndividualPackages Singleton.
	 *
	 * @var object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static $instance;

	/**
	 * Returns the IndividualPackages Singleton.
	 *
	 * @return object Instance
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new IndividualPackages();
		}

		return self::$instance;
	}

	/**
	 * IndividualPackages registration
	 *
	 * @return void
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public function register() {
		if ( $this->disabled( $this->option_name ) ) {
			return;
		}

		$this->settings         = SettingsApi::get_instance();
		$this->callbacks        = PackagesCallbacks::get_instance();
		$this->callbacks_fields = FieldsCallbacks::get_instance();

		$this->set_packages_settings();
		$this->set_packages_sections();

		// Wait for translations to be loaded.
		add_action( 'init', array( $this, 'set_packages_fields' ), 10, 2 );

		$this->settings->add_sub_pages( $this->sub_pages )->register_setting();
	}

	/**
	 * IndividualPackages settings registration
	 *
	 * @return void
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public function set_packages_settings() {
		$args = array(
			array(
				'option_group' => 'oxyprops_lite_packages_settings1',
				'option_name'  => 'oxyprops_lite_packages',
				'callback'     => array( $this->callbacks_fields, 'sanitizedPackages' ),
			),
			array(
				'option_group' => 'oxyprops_lite_packages_settings2',
				'option_name'  => 'oxyprops_lite_packages',
				'callback'     => array( $this->callbacks_fields, 'sanitizedPackages' ),
			),
			array(
				'option_group' => 'oxyprops_lite_packages_settings3',
				'option_name'  => 'oxyprops_lite_packages',
				'callback'     => array( $this->callbacks_fields, 'sanitizedPackages' ),
			),
		);
		$this->settings->add_settings( $args );
	}

	/**
	 * IndividualPackages sections registration
	 *
	 * @return void
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public function set_packages_sections() {
		$args = array(
			array(
				'id'       => 'oxyprops_lite_main_packages_section',
				'title'    => null,
				'callback' => '__return_null',
				'page'     => 'oxyprops_lite_pkg1',
			),
			array(
				'id'       => 'oxyprops_lite_individual_colors_section',
				'title'    => null,
				'callback' => '__return_null',
				'page'     => 'oxyprops_lite_pkg2',
			),
			array(
				'id'       => 'oxyprops_lite_individual_colors_hsl_section',
				'title'    => null,
				'callback' => '__return_null',
				'page'     => 'oxyprops_lite_pkg3',
			),
		);
		$this->settings->add_sections( $args );
	}

	/**
	 * IndividualPackages fields registration
	 *
	 * @return void
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public function set_packages_fields() {
		$args             = array();
		$default_settings = Options::packages_options();
		foreach ( $default_settings as $key => $parameters ) {
			$column = '';
			switch ( $parameters['section'] ) {
				case 'main_packages':
					$column = '1';
					break;
				case 'individual_colors':
					$column = '2';
					break;
				case 'individual_colors_hsl':
					$column = '3';
					break;
			}
			$args[] = array(
				'id'       => $key,
				'title'    => $parameters['description'],
				'callback' => array( $this->callbacks_fields, 'checkboxField' ),
				'page'     => 'oxyprops_lite_pkg' . $column,
				'section'  => 'oxyprops_lite_' . $parameters['section'] . '_section',
				'args'     => array(
					'option_name' => 'oxyprops_lite_packages',
					'label_for'   => $key,
					'class'       => 'oxyprops-ui-toggle',
				),
			);
		}
		$this->settings->add_fields( $args );
	}
}
