<?php
/**
 * Settings Fields Callbacks
 * Callbacks for Settings Fields.
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
 * Settings Fields Callbacks Class
 * Callbacks for Settings Fields.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class FieldsCallbacks extends BaseController {

	/**
	 * Stores the Settings Fields Callbacks Singleton.
	 *
	 * @var object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static $instance;

	/**
	 * Returns the Settings Fields Callbacks Singleton.
	 *
	 * @return object Instance
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new FieldsCallbacks();
		}

		return self::$instance;
	}

	/**
	 * Sanitizes a checkbox input
	 *
	 * @param string $input Checkbox value.
	 *
	 * @return boolean
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function sanitizedCheckbox( $input ) {
		$output = array();
		foreach ( $this->admin_settings as $key => $value ) {
			$output[ $key ] = ( isset( $input[ $key ] ) && '1' === $input[ $key ] );
		}

		return $output;
	}

	/**
	 * Sanitizes a packages checkbox input
	 *
	 * @param string $input Checkbox value.
	 *
	 * @return boolean
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function sanitizedPackages( $input ) {
		$output = array();
		foreach ( $this->packages_settings as $key => $value ) {
			$output[ $key ] = ( isset( $input[ $key ] ) && '1' === $input[ $key ] );
		}

		return $output;
	}

	/**
	 * Creates a checkbox input field
	 *
	 * @param array $args Checkbox parameters.
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function checkboxField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checkbox    = get_option( $option_name );
		$checked     = '';
		if ( $checkbox && isset( $checkbox[ $name ] ) ) {
			$checked = $checkbox[ $name ] ? 'checked' : '';
		}
		echo '<div class="' . esc_attr( $classes ) . '"><input type="checkbox" id="' .
		esc_attr( $name ) . '" name="' . esc_attr( $option_name ) . '[' . esc_attr( $name ) . ']" value="1" class="" ' .
		esc_attr( $checked ) . '/><label for="' . esc_attr( $name ) . '"><div></div></label></div>';
	}
}
