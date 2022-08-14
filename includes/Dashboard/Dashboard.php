<?php
/**
 * Dashboard
 * Creates OxyProps Lite plugin dashboard.
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

use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\FieldsCallbacks;
use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Base\Options;

/**
 * Dashboard Class
 * Creates OxyProps Lite plugin dashboard.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class Dashboard extends BaseController {

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
	 * Admin pages
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $pages = array();

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
	 * Stores the Dashboard Singleton.
	 *
	 * @var object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static $instance;

	/**
	 * Returns the Dashboard Singleton.
	 *
	 * @return object Instance
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Dashboard();
		}

		return self::$instance;
	}

	/**
	 * Initializes the Dashboard Class
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function register() {
		$this->settings         = SettingsApi::get_instance();
		$this->callbacks        = AdminCallbacks::get_instance();
		$this->callbacks_fields = FieldsCallbacks::get_instance();

		$this->setPages();
		$this->setadmin_settings();
		$this->setAdminSections();

		// Wait for translations to be loaded.
		add_action( 'init', array( $this, 'setAdminFields' ), 10, 2 );

		$this->settings->add_pages( $this->pages )->with_sub_page( 'Dashboard' )
			->register_setting();

		// Redirect to about page after activation.
		add_action( 'activated_plugin', array( $this, 'redirect' ), 10, 2 );
		add_action( 'load-toplevel_page_oxyprops_lite', array( $this, 'enqueue' ), 10, 2 );
	}

	/**
	 * Defines plugin dashboard admin pages
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function setPages() {
		$this->pages = array(
			array(
				'page_title' => $this->adapted_name,
				'menu_title' => $this->adapted_name,
				'capability' => 'manage_options',
				'menu_slug'  => 'oxyprops_lite',
				'callback'   => array( $this->callbacks, 'admin_dashboard' ),
				'icon_url'   => $this->active_icon,
				'position'   => 110,
			),
		);
	}

	/**
	 * Defines plugin dashboard admin settings
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function setadmin_settings() {
		$args = array(
			array(
				'option_group' => 'oxyprops_lite_master_settings',
				'option_name'  => 'oxyprops_lite',
				'callback'     => array( $this->callbacks_fields, 'sanitizedCheckbox' ),
			),
		);
		$this->settings->add_settings( $args );
	}

	/**
	 * Defines plugin dashboard admin sections
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function setAdminSections() {
		$args = array(
			array(
				'id'       => 'oxyprops_lite_master_settings_section',
				'title'    => null,
				'callback' => '__return_null',
				'page'     => 'oxyprops_lite',
			),
		);
		$this->settings->add_sections( $args );
	}

	/**
	 * Defines plugin dashboard admin fields
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function setAdminFields() {
		$args             = array();
		$default_settings = Options::plugin_options();
		foreach ( $default_settings as $key => $parameters ) {
			$args[] = array(
				'id'       => $key,
				'title'    => $parameters['description'],
				'callback' => array( $this->callbacks_fields, 'checkboxField' ),
				'page'     => 'oxyprops_lite',
				'section'  => 'oxyprops_lite_master_settings_section',
				'args'     => array(
					'option_name' => 'oxyprops_lite',
					'label_for'   => $key,
					'class'       => 'oxyprops-ui-toggle',
				),
			);
		}
		$this->settings->add_fields( $args );
	}

	/**
	 * Functions and Hooks for Dashboard
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function loadDashboard() {
		$this->enqueue();
	}

	/**
	 * Enqueues Dashboard CSS and JS
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function enqueue() {
		wp_enqueue_style(
			'oxyprops-props',
			$this->plugin_url . 'assets/css/open-props/open-props.op-lite.min.css',
			array(),
			$this->version,
			'all'
		);
		wp_enqueue_style(
			'oxyprops-adminstyle',
			$this->plugin_url . 'assets/css/dashboard.min.css',
			array(),
			$this->version,
			'all'
		);

		// enqueue all our scripts.
		wp_enqueue_script(
			'oxyprops-adminscript',
			$this->plugin_url . 'assets/js/dashboard.js',
			array(),
			$this->version,
			'all'
		);

		add_filter( 'admin_footer_text', array( $this, 'changeFooterText' ) );
	}

	/**
	 * Customize WordPress Footer on the dashboard page
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function changeFooterText() {
		echo wp_kses_post(
			sprintf(
				// Translators: %1$s - link to review form.
				__(
					'Please rate <strong>%2$s</strong> <a href="%1$s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%1$s" target="_blank">our Facebook Page</a> to help us spread the word. Thank you from the OxyProps team!',
					'oxyprops_lite'
				),
				'https://www.facebook.com/oxyprops/reviews/',
				$this->adapted_name
			)
		);
	}

	/**
	 * Redirect to dashboard after activation
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function redirect() {
		wp_safe_redirect( 'admin.php?page=oxyprops_lite' );
		die;
	}
}
