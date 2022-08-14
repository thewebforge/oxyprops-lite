<?php
/**
 * OxyProps Lite Base Controller
 * Defines OxyProps Lite variables.
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
 * OxyProps Lite Base Controller Class
 * Defines OxyProps Lite variables.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class BaseController {

	/**
	 * The plugin admin icon in SVG format and base64 encoding
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $active_icon;

	/**
	 * Stores the current admin settings pulled from the DB
	 *
	 * @var array
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $admin_settings = array();

	/**
	 * Stores the current options pulled from the DB
	 *
	 * @var array
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $current_options = array();

	/**
	 * The name of the detected active site builder
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $builder;

	/**
	 * A boolean indicating if the active site builder is supported
	 *
	 * @var boolean
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $supported_builder;

	/**
	 * The plugin short name adjusted to the active site builder
	 * For use in the admin menu if too standard is too long
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $short_adapted_name;

	/**
	 * The plugin name adjusted to the active site builder
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $adapted_name;

	/**
	 * The plugin name with underscore separator
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $name;

	/**
	 * The plugin Basename
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $plugin;

	/**
	 * The plugin data parsed from the plugin Header.
	 *
	 * @var array
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $plugin_data;

	/**
	 * The plugin file.
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $plugin_file;

	/**
	 * The plugin name with hyphen separator.
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $plugin_name;

	/**
	 * The path to the plugin directory
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $plugin_path;

	/**
	 * The URL to the plugin directory
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $plugin_url;

	/**
	 * The plugin slug
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $slug;

	/**
	 * The plugin Text Domain
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $text_domain;

	/**
	 * The plugin current version in the semantic versioning format
	 *
	 * @var string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public $version;

	/**
	 * Base Controller Constructor
	 *
	 * @return void
	 *
	 * @author Cédric Bontems <dev@oxyprops.com>
	 * @since  1.0.0
	 */
	public function __construct() {
		$this->plugin_path       = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url        = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin            = self::get_plugin_basename( 3 );
		$this->slug              = plugin_basename( dirname( __FILE__, 3 ) );
		$this->name              = str_replace( '-', '_', $this->slug );
		$this->plugin_file       = $this->plugin_path . $this->slug . '.php';
		$this->admin_settings    = Helpers::get_plugin_default_options();
		$this->packages_settings = Helpers::get_plugin_packages_options();
		$this->current_options   = $this->get_plugin_current_options();
		$this->active_icon       = 'data:image/svg+xml;base64,' .
		'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMD' .
		'A4IDc2OC41MiI+CiAgICAgIDxwYXRoIGZpbGw9ImJsYWNrIgogICAgICAgIGQ9Ik04MTcuMTEg' .
		'MTkyLjgyQzc1MC40OCA3Ny41OSA2MjUuNiAwIDQ4Mi40NiAwIDMyMC43NCAwIDE4Mi4zMiA5OS' .
		'4wNiAxMjQuODkgMjM5LjUyaDEwNy4zYzUwLjEzLTg1Ljc3IDE0My40LTE0My40NiAyNTAuMjct' .
		'MTQzLjQ2IDk4LjE2IDAgMTg0Ljg1IDQ4LjY2IDIzNy4xOSAxMjMuMDYtNTYuNTcgMzMuMjctOT' .
		'QuNTUgOTQuNzYtOTQuNTUgMTY1LjE0czM3Ljk4IDEzMS44OCA5NC41NiAxNjUuMTRjLTUyLjM0' .
		'IDc0LjM5LTEzOS4wNCAxMjMuMDUtMjM3LjE5IDEyMy4wNS0xMDYuODYgMC0yMDAuMTMtNTcuNj' .
		'ktMjUwLjI3LTE0My40NkgxMjQuODljNTcuNDMgMTQwLjQ3IDE5NS44NSAyMzkuNTIgMzU3LjU3' .
		'IDIzOS41MiAxNDMuMTQgMCAyNjguMDUtNzcuNTkgMzM0LjY5LTE5Mi44MiAxMDUuNDYtLjMyID' .
		'E5MC44NS04NS45MSAxOTAuODUtMTkxLjQ1UzkyMi41OSAxOTMuMSA4MTcuMTEgMTkyLjc5Wm0t' .
		'LjU2IDI4Ny4xN2MtNTIuODcgMC05NS43My00Mi44Ni05NS43My05NS43M3M0Mi44Ni05NS43My' .
		'A5NS43My05NS43MyA5NS43MyA0Mi44NiA5NS43MyA5NS43My00Mi44NiA5NS43My05NS43MyA5' .
		'NS43M1oiIC8+CiAgICAgIDxyZWN0IGZpbGw9ImJsYWNrIiB3aWR0aD0iMjMwIiBoZWlnaHQ9Ij' .
		'EwOC4wNyIgeT0iMzMwLjIyIiBjbGFzcz0iZCIgcng9IjU0LjA0IiByeT0iNTQuMDQiIC8+CiAg' .
		'ICAgIDxyZWN0IGZpbGw9ImJsYWNrIiB3aWR0aD0iMjMwIiBoZWlnaHQ9IjEwOC4wNyIgeD0iMz' .
		'EwIiB5PSIzMzAuNTciIGNsYXNzPSJkIiByeD0iNTQuMDQiIHJ5PSI1NC4wNCIgLz4KPC9zdmc+';

		if ( ! function_exists( 'get_plugin_data' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$this->plugin_data = get_plugin_data(
			$this->plugin_file,
			false,
			false
		);
		$this->plugin_name = $this->plugin_data['Name'];
		$this->version     = $this->plugin_data['Version'];
		$this->text_domain = $this->plugin_data['TextDomain'];

		$this->builder = $this->get_builder();
	}

	/**
	 * Gets the current plugin settings
	 *
	 * @return array Current settings
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function get_plugin_current_options() {
		return get_option( $this->name );
	}

	/**
	 * Checks if an option item is disabled
	 *
	 * @param string $option the option element to be checked.
	 *
	 * @return boolean
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function disabled( $option ) {
		return ! (
			isset( $this->current_options[ $option ] ) &&
			$this->current_options[ $option ]
		);
	}

	/**
	 * Gets the plugin base name
	 *
	 * @param integer $levels depth of file in file structure.
	 *
	 * @return string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private function get_plugin_basename( $levels ) {
		$basename = basename( dirname( __FILE__, $levels ) ) . '.php';
		$files    = glob( $this->plugin_path . $basename );

		return plugin_basename( $files[0] );
	}

	/**
	 * Gets the builder
	 *
	 * @return string
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private function get_builder() {
		$this->supported_builder  = true;
		$this->adapted_name       = 'OxyProps Lite';
		$this->short_adapted_name = 'OxyProps Lite';
		$theme                    = wp_get_theme();

		if ( defined( 'CT_VERSION' ) ) {
			return 'Oxygen';
		}
		if ( 'Bricks' === $theme->name || 'Bricks' === $theme->parent_theme ) {
			$this->adapted_name       = 'BricksProps Lite';
			$this->short_adapted_name = 'BricksProps Lite';
			return 'Bricks';
		}
		if ( defined( '__BREAKDANCE_VERSION' ) ) {
			$this->adapted_name       = 'BreakdanceProps Lite';
			$this->short_adapted_name = 'BDProps Lite';
			return 'Breakdance';
		}
		$this->supported_builder = false;
		return 'Unsupported Site Buidler';
	}
}
