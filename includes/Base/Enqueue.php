<?php
/**
 * Enqueue
 * Enqueues styles and script to back and front.
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
 * Enqueue Class
 * Enqueues styles and script to back and front.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class Enqueue extends BaseController {

	/**
	 * Stores the Enqueue Singleton.
	 *
	 * @var object
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	private static $instance;

	/**
	 * Returns the Enqueue Singleton.
	 *
	 * @return object Instance
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Enqueue();
		}

		return self::$instance;
	}

	/**
	 * Initializes the Enqueue Class
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function register() {
		// Admin.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin' ) );

		$inline_selected = isset( $this->current_options['oxyprops_lite_mode'] ) ?
		$this->current_options['oxyprops_lite_mode'] :
		false;

		if ( $inline_selected ) {
			// Inline Styles.
			add_action( 'wp_head', array( $this, 'inline_front' ), 10000000000 );
		} else {
			// Enqueue Stylesheets.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front' ) );
		}

		add_action( 'init', array( $this, 'oxyprops_lite_load_textdomain' ) );

	}

	/**
	 * Registers Text  Domains for plugin translations
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function oxyprops_lite_load_textdomain() {
		load_plugin_textdomain( 'oxyprops_lite', false, $this->slug . '/languages' );
	}

	/**
	 * Enqueues FrontEnd scripts
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function enqueue_front() {
		// enqueue our front-end styles.
		if ( ! $this->current_options['oxyprops_lite_bundle'] ) {
			wp_enqueue_style(
				'oxyprops-props',
				$this->plugin_url . 'assets/css/open-props/open-props.op-lite.min.css',
				array(),
				$this->version,
				'all'
			);
			wp_enqueue_style(
				'oxyprops-hsl-props',
				$this->plugin_url . 'assets/css/open-props/colors-hsl.op-lite.min.css',
				array(),
				$this->version,
				'all'
			);
		} else {
			Helpers::enqueue_selected_packages( $this->plugin_url, $this->version );
		}

		if ( $this->current_options['oxyprops_lite_normalize'] ) {
			wp_enqueue_style(
				'oxyprops-normalize',
				$this->plugin_url . 'assets/css/normalize.min.css',
				array(),
				$this->version,
				'all'
			);
		}

		// enqueue our front-end scripts.
		wp_enqueue_script(
			'oxyprops-frontendscript',
			$this->plugin_url . 'assets/js/frontend.js',
			array(),
			$this->version,
			true
		);
	}

	/**
	 * Enqueues BackEnd scripts
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function enqueue_admin() {
		// enqueue all our styles.
		wp_enqueue_style(
			'oxyprops-adminstyle',
			$this->plugin_url . 'assets/css/backend.min.css',
			array(),
			$this->version,
			'all'
		);
		wp_enqueue_style(
			'oxyprops-props',
			$this->plugin_url . 'assets/css/open-props/open-props.op-lite.min.css',
			array(),
			$this->version,
			'all'
		);
		wp_enqueue_style(
			'oxyprops-hsl-props',
			$this->plugin_url . 'assets/css/open-props/colors-hsl.op-lite.min.css',
			array(),
			$this->version,
			'all'
		);

		// enqueue all our scripts.
		wp_enqueue_script(
			'oxyprops-adminscript',
			$this->plugin_url . 'assets/js/backend.js',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Inlines FrontEnd scripts
	 *
	 * @return void
	 *
	 * @since  1.0.0
	 * @author Cédric Bontems <dev@oxyprops.com>
	 */
	public function inline_front() {
		$styles_to_inject = '';

		if ( ! $this->current_options['oxyprops_lite_bundle'] ) {
			$styles_to_inject .= Helpers::get_full_bundle();
		} else {
			$styles_to_inject .= Helpers::get_selected_packages( $this->plugin_path );
		}

		if ( $this->current_options['oxyprops_lite_normalize'] ) {
			$styles_to_inject .= Helpers::get_normalize_styles();
		}

		echo '<style>' . esc_html( $styles_to_inject ) . '</style>';
	}
}
