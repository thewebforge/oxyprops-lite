<?php
/**
 * Helpers for OxyProps Lite
 * Provides helper functions.
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
 * Helpers Class
 * Provides helper functions
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class Helpers {

	/**
	 * Path to Open Props
	 *
	 * @var string
	 */
	private static $open_props = 'assets/css/open-props/';

	/**
	 * Reads default settings
	 *
	 * @return array OxyProps Lite default settings
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_plugin_default_options() {
		return Options::plugin_options();
	}

	/**
	 * Reads default Packages options
	 *
	 * @return array OxyProps Lite default packages informations and settings
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_plugin_packages_options() {
		return Options::packages_options();
	}

	/**
	 * Reads Open Props full bundle
	 *
	 * @return string all styles
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_full_bundle() {
		$str       = '';
		$main_file = plugin_dir_path( dirname( __FILE__, 2 ) ) .
		self::$open_props . 'open-props.op-lite.min.css';
		$hsl_file  = plugin_dir_path( dirname( __FILE__, 2 ) ) .
		self::$open_props . 'colors-hsl.op-lite.min.css';

		$str .= self::read_file( $main_file );
		$str .= self::read_file( $hsl_file );

		return $str;
	}

	/**
	 * Reads Normalize
	 *
	 * @return string OxyProps Lite Normalize styles
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_normalize_styles() {
		$target_file = plugin_dir_path( dirname( __FILE__, 2 ) )
		. self::$open_props . '../normalize.min.css';

		return self::read_file( $target_file );
	}

	/**
	 * Reads selected packages styles
	 *
	 * @param string $path path to the package file.
	 *
	 * @return string all selected packages styles.
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_selected_packages( $path ) {
		$packages_list = self::get_plugin_packages_options();
		$str           = '';
		foreach ( $packages_list as $key => $value ) {
			if ( get_option( 'oxyprops_lite_packages' )[ $key ]
				&& isset( $value['file'] )
			) {
				$package_file = $path .
				self::$open_props . $value['file'] . '.op-lite.min.css';
				$str         .= self::read_file( $package_file );
			}
		}

		return $str;
	}

	/**
	 * Enqueues user selected packages to Front End
	 *
	 * @param string $url     Package Url.
	 * @param string $version Plugin version.
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function enqueue_selected_packages( $url, $version ) {
		$packages_list = self::get_plugin_packages_options();
		foreach ( $packages_list as $key => $value ) {
			if ( get_option( 'oxyprops_lite_packages' )[ $key ]
				&& isset( $value['file'] )
			) {
				wp_enqueue_style(
					'oxyprops-' . $value['file'],
					$url . self::$open_props . $value['file'] . '.op-lite.min.css',
					array(),
					$version,
					'all'
				);
			}
		}
	}

	/**
	 * Reads a file and returns its content
	 *
	 * @param string $target File path.
	 *
	 * @return string File content
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function read_file( $target ) {
		if ( ! file_exists( $target ) ) {
			return '';
		}
		return file_get_contents( $target );
	}
}
