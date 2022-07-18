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
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class Enqueue extends BaseController
{
    /**
     * Stores the Enqueue Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Enqueue Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new Enqueue();
        }

        return self::$_instance;
    }

    /**
     * Initializes the Enqueue Class
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function register()
    {
        // Admin
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);

        $inlineSelected = isset($this->currentOptions['oxyprops_lite_mode']) ?
        $this->currentOptions['oxyprops_lite_mode'] :
        false;

        if ($inlineSelected) {
            // Inline Styles
            add_action('wp_head', [$this, 'inlineFront'], 10000000000);
        } else {
            // Enqueue Stylesheets
            add_action('wp_enqueue_scripts', [$this, 'enqueueFront']);
        }
    }

    /**
     * Enqueues FrontEnd scripts
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function enqueueFront()
    {
        // enqueue our front-end styles
        if (!$this->currentOptions['oxyprops_lite_bundle']) {
            wp_enqueue_style(
                'oxyprops-props',
                $this->pluginUrl.'assets/css/open-props/open-props.op-lite.min.css',
                $this->version
            );
            wp_enqueue_style(
                'oxyprops-hsl-props',
                $this->pluginUrl.'assets/css/open-props/colors-hsl.op-lite.min.css',
                $this->version
            );
        } else {
            Helpers::enqueueSelectedPackages($this->pluginUrl, $this->version);
        }

        if ($this->currentOptions['oxyprops_lite_normalize']) {
            wp_enqueue_style(
                'oxyprops-normalize',
                $this->pluginUrl.'assets/css/normalize.min.css',
                $this->version
            );
        }

        // enqueue our front-end scripts
        wp_enqueue_script(
            'oxyprops-frontendscript',
            $this->pluginUrl.'assets/js/frontend.js',
            [],
            $this->version,
            'all'
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
    public function enqueueAdmin()
    {
        // enqueue all our styles
        wp_enqueue_style(
            'oxyprops-adminstyle',
            $this->pluginUrl.'assets/css/backend.min.css',
            [],
            $this->version,
            'all'
        );
        wp_enqueue_style(
            'oxyprops-props',
            $this->pluginUrl.'assets/css/open-props/open-props.op-lite.min.css',
            [],
            $this->version,
            'all'
        );

        // enqueue all our scripts
        wp_enqueue_script(
            'oxyprops-adminscript',
            $this->pluginUrl.'assets/js/backend.js',
            [],
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
    public function inlineFront()
    {
        $stylesToInject = '';

        if (!$this->currentOptions['oxyprops_lite_bundle']) {
            $stylesToInject .= Helpers::getFullBundle();
        } else {
            $stylesToInject .= Helpers::getSelectedPackages($this->pluginPath);
        }

        if ($this->currentOptions['oxyprops_lite_normalize']) {
            $stylesToInject .= Helpers::getNormalizeStyles();
        }

        echo '<style>'.$stylesToInject.'</style>';
    }
}
