<?php
/**
 * OxyProps Lite Options
 * Defines OxyProps Lite default options.
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
 * OxyProps Lite Options Class
 * Gives  default plugin options.
 *
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @since    1.0.0
 */
class Options {

	/**
	 * The  plugin default options
	 *
	 * @return array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public static function plugin_options() {
		return array(
			'oxyprops_lite_normalize'     => array(
				'description' => __( 'Apply Normalize', 'oxyprops_lite' ),
				'default'     => '0',
			),
			'oxyprops_lite_bundle'        => array(
				'description' => __( 'Select Individual PropsPacks', 'oxyprops_lite' ),
				'default'     => '0',
			),
			'oxyprops_lite_mode'          => array(
				'description' => __( 'Inline Styles (no http req.)', 'oxyprops_lite' ),
				'default'     => '0',
			),
			'oxyprops_lite_gutenberg_fix' => array(
				'description' => __( 'Remove default WP props', 'oxyprops_lite' ),
				'default'     => '0',
			),
		);
	}

	/**
	 * The  plugin packages options
	 *
	 * @return array
	 *
	 * @author   Cédric Bontems <dev@oxyprops.com>
	 * @since    1.0.0
	 */
	public static function packages_options() {
		return array(
			'oxyprops_lite_animations' => array(
				'description' => __( 'Animations', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'animations',
			),
			'oxyprops_lite_aspects'    => array(
				'description' => __( 'Aspect Ratios', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'aspects',
			),
			'oxyprops_lite_borders'    => array(
				'description' => __( 'Borders', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'borders',
			),
			'oxyprops_lite_easings'    => array(
				'description' => __( 'Easings', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'easings',
			),
			'oxyprops_lite_fonts'      => array(
				'description' => __( 'Fonts', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'fonts',
			),
			'oxyprops_lite_gradients'  => array(
				'description' => __( 'Gradients', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'gradients',
			),
			'oxyprops_lite_shadows'    => array(
				'description' => __( 'Shadows', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'shadows',
			),
			'oxyprops_lite_sizes'      => array(
				'description' => __( 'Sizes', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'sizes',
			),
			'oxyprops_lite_zindex'     => array(
				'description' => __( 'Z-index', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'zindex',
			),
			'oxyprops_lite_colors'     => array(
				'description' => __( 'All Colors', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'colors',
			),
			'oxyprops_lite_colors_hsl' => array(
				'description' => __( 'All Colors hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'main_packages',
				'file'        => 'colors-hsl',
			),
			'oxyprops_lite_blue'       => array(
				'description' => __( 'Blue', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'blue',
			),
			'oxyprops_lite_blue_hsl'   => array(
				'description' => __( 'Blue hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'blue-hsl',
			),
			'oxyprops_lite_cyan'       => array(
				'description' => __( 'Cyan', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'cyan',
			),
			'oxyprops_lite_cyan_hsl'   => array(
				'description' => __( 'Cyan hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'cyan-hsl',
			),
			'oxyprops_lite_grape'      => array(
				'description' => __( 'Grape', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'grape',
			),
			'oxyprops_lite_grape_hsl'  => array(
				'description' => __( 'Grape hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'grape-hsl',
			),
			'oxyprops_lite_gray'       => array(
				'description' => __( 'Gray', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'gray',
			),
			'oxyprops_lite_gray_hsl'   => array(
				'description' => __( 'Gray hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'gray-hsl',
			),
			'oxyprops_lite_green'      => array(
				'description' => __( 'Green', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'green',
			),
			'oxyprops_lite_green_hsl'  => array(
				'description' => __( 'Green hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'green-hsl',
			),
			'oxyprops_lite_indigo'     => array(
				'description' => __( 'Indigo', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'indigo',
			),
			'oxyprops_lite_indigo_hsl' => array(
				'description' => __( 'Indigo hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'indigo-hsl',
			),
			'oxyprops_lite_lime'       => array(
				'description' => __( 'Lime', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'lime',
			),
			'oxyprops_lite_lime_hsl'   => array(
				'description' => __( 'Lime hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'lime-hsl',
			),
			'oxyprops_lite_orange'     => array(
				'description' => __( 'Orange', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'orange',
			),
			'oxyprops_lite_orange_hsl' => array(
				'description' => __( 'Orange hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'orange-hsl',
			),
			'oxyprops_lite_pink'       => array(
				'description' => __( 'Pink', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'pink',
			),
			'oxyprops_lite_pink_hsl'   => array(
				'description' => __( 'Pink hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'pink-hsl',
			),
			'oxyprops_lite_red'        => array(
				'description' => __( 'Red', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'red',
			),
			'oxyprops_lite_red_hsl'    => array(
				'description' => __( 'Red hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'red-hsl',
			),
			'oxyprops_lite_teal'       => array(
				'description' => __( 'Teal', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'teal',
			),
			'oxyprops_lite_teal_hsl'   => array(
				'description' => __( 'Teal hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'teal-hsl',
			),
			'oxyprops_lite_violet'     => array(
				'description' => __( 'Violet', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'violet',
			),
			'oxyprops_lite_violet_hsl' => array(
				'description' => __( 'Violet hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'violet-hsl',
			),
			'oxyprops_lite_yellow'     => array(
				'description' => __( 'Yellow', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors',
				'file'        => 'yellow',
			),
			'oxyprops_lite_yellow_hsl' => array(
				'description' => __( 'Yellow hsl', 'oxyprops_lite' ),
				'default'     => '0',
				'section'     => 'individual_colors_hsl',
				'file'        => 'yellow-hsl',
			),
		);
	}
}
