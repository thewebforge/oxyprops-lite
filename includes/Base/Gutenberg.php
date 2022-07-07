<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class Gutenberg extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Gutenberg();
        }

        return self::$instance;
    }

    public function register()
    {
        if (isset(get_option('oxyprops_lite')['oxyprops_lite_gutenberg_fix'])) {
            if (get_option('oxyprops_lite')['oxyprops_lite_gutenberg_fix']) {
                self::dequeueGutenbergGloablStyles();
            }
        }
    }

    public function dequeueGutenbergGloablStyles()
    {
        // Remove WP CSS variables
        remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
        remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

        // Remove WP SVG definitions
        remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
    }
}
