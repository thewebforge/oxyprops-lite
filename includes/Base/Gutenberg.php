<?php
/**
 * Gutenberg
 * Manages interactions with Gutenberg.
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
 * Gutenberg Class
 * Manages interactions with Gutenberg.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class Gutenberg extends BaseController
{
    /**
     * Stores the Gutenberg Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Gutenberg Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new Gutenberg();
        }

        return self::$_instance;
    }

    /**
     * Initializes the Gutenberg Class
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function register()
    {
        if (isset(get_option('oxyprops_lite')['oxyprops_lite_gutenberg_fix'])) {
            if (get_option('oxyprops_lite')['oxyprops_lite_gutenberg_fix']) {
                self::dequeueGutenbergGloablStyles();
            }
        }
    }

    /**
     * Removes Gutenberg default styles and SVG presets
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function dequeueGutenbergGloablStyles()
    {
        // Remove WP CSS variables
        remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
        remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

        // Remove WP SVG definitions
        remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
    }
}
