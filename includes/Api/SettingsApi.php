<?php
/**
 * Settings API
 * Manages interactions with WordPress Settings API.
 * php version 7.4.29
 *
 * @category API
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Api;

/**
 * Settings API Class
 * Manages interactions with WordPress Settings API.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class SettingsApi {

	/**
	 * Admin pages to be registered
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $admin_pages = array();

	/**
	 * Admin subpages to be registered
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $admin_sub_pages = array();

	/**
	 * Admin settings
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $admin_settings = array();

	/**
	 * Admin sections to be registered
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $admin_sections = array();

	/**
	 * Admin fields to be registered
	 *
	 * @var array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public $admin_fields = array();

	/**
	 * Stores the Settings API Singleton.
	 *
	 * @var object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static $instance;

	/**
	 * Returns the Settings API Singleton.
	 *
	 * @return object Instance
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new SettingsApi();
		}

		return self::$instance;
	}

	/**
	 * Registers OxyProps Lite admin pages and settings
	 * with WordPress.
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function register_setting() {
		if ( ! empty( $this->admin_pages ) || ! empty( $this->admin_sub_pages ) ) {
			add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		}

		if ( ! empty( $this->admin_settings ) ) {
			add_action( 'admin_init', array( $this, 'register_custom_fields' ) );
		}
	}

	/**
	 * Adds pages to the admin pages to be registered.
	 *
	 * @param array $pages List of pages to add.
	 *
	 * @return object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function add_pages( array $pages ) {
		$this->admin_pages = $pages;

		return $this;
	}

	/**
	 * Manages the first element of subpages menu
	 *
	 * @param string|null $title The menu title.

	 * @return array
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function with_sub_page( string $title = null ) {
		if ( empty( $this->admin_pages ) ) {
			return $this;
		}

		$admin_page = $this->admin_pages[0];

		$sub_pages             = array(
			array(
				'parent_slug' => $admin_page['menu_slug'],
				'page_title'  => $admin_page['page_title'],
				'menu_title'  => ( $title ) ? $title : $admin_page['menu_title'],
				'capability'  => $admin_page['capability'],
				'menu_slug'   => $admin_page['menu_slug'],
				'callback'    => $admin_page['callback'],
			),
		);
		$this->admin_sub_pages = $sub_pages;

		return $this;
	}

	/**
	 * Adds sub-pages to the admin pages to be registered.
	 *
	 * @param array $pages List of subpages to be registered.
	 *
	 * @return object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function add_sub_pages( array $pages ) {
		$this->admin_sub_pages = array_merge( $this->admin_sub_pages, $pages );

		return $this;
	}

	/**
	 * Adds menus and sub-menus to the admin menus to be registered.
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		foreach ( $this->admin_pages as $page ) {
			add_menu_page(
				$page['page_title'],
				$page['menu_title'],
				$page['capability'],
				$page['menu_slug'],
				$page['callback'],
				$page['icon_url'],
				$page['position']
			);
		}

		foreach ( $this->admin_sub_pages as $sub_page ) {
			add_submenu_page(
				$sub_page['parent_slug'],
				$sub_page['page_title'],
				$sub_page['menu_title'],
				$sub_page['capability'],
				$sub_page['menu_slug'],
				$sub_page['callback']
			);
		}
	}

	/**
	 * Adds settings to the admin settings to be registered.
	 *
	 * @param array $settings List of settings to be registered.
	 *
	 * @return object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function add_settings( array $settings ) {
		$this->admin_settings = array_merge( $this->admin_settings, $settings );

		return $this;
	}

	/**
	 * Adds settings sections to the list
	 *
	 * @param array $sections List of sections to be registered.
	 *
	 * @return object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function add_sections( array $sections ) {
		$this->admin_sections = array_merge( $this->admin_sections, $sections );

		return $this;
	}

	/**
	 * Adds settings fields to the list
	 *
	 * @param array $fields List of fields to be registered.
	 *
	 * @return array
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function add_fields( array $fields ) {
		$this->admin_fields = array_merge( $this->admin_fields, $fields );

		return $this;
	}

	/**
	 * Registers the settigns Groups, Sections, Fields
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function register_custom_fields() {
		// register setting.
		foreach ( $this->admin_settings as $setting ) {
			register_setting(
				$setting['option_group'],
				$setting['option_name'],
				isset( $setting['callback'] ) ?
				$setting['callback'] :
				''
			);
		}

		// add settings section.
		foreach ( $this->admin_sections as $section ) {
			add_settings_section(
				$section['id'],
				$section['title'],
				isset( $section['callback'] ) ?
				$section['callback'] :
				'',
				$section['page']
			);
		}

		// add setting field.
		foreach ( $this->admin_fields as $field ) {
			add_settings_field(
				$field['id'],
				$field['title'],
				isset( $field['callback'] ) ?
				$field['callback'] :
				'',
				$field['page'],
				$field['section'],
				isset( $field['args'] ) ?
				$field['args'] :
				''
			);
		}
	}
}
