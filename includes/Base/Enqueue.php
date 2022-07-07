<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Base;

class Enqueue extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Enqueue();
        }

        return self::$instance;
    }

    public function register()
    {
        // Admin
        add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);

        $inlineSelected = isset($this->currentOptions['oxyprops_lite_mode']) ? $this->currentOptions['oxyprops_lite_mode'] : false;
        if ($inlineSelected) {
            // Inline Styles
            add_action('wp_head', [$this, 'inlineFront'], 10000000000);
        } else {
            // Enqueue Stylesheets
            add_action('wp_enqueue_scripts', [$this, 'enqueueFront']);
        }
    }

    public function enqueueFront()
    {
        // enqueue our front-end styles
        if (!$this->currentOptions['oxyprops_lite_bundle']) {
            wp_enqueue_style('oxyprops-props', $this->pluginUrl.'assets/css/open-props/open-props.op-lite.min.css', $this->version);
        } else {
            Helpers::enqueueSelectedPackages($this->pluginUrl, $this->version);
        }

        if ($this->currentOptions['oxyprops_lite_normalize']) {
            wp_enqueue_style('oxyprops-normalize', $this->pluginUrl.'assets/css/open-props/normalize.op-lite.min.css', $this->version);
        }

        // enqueue our front-end scripts
        wp_enqueue_script('oxyprops-frontendscript', $this->pluginUrl.'assets/js/frontend.js', [], $this->version, 'all');
    }

    public function enqueueAdmin()
    {
        // enqueue all our styles
        wp_enqueue_style('oxyprops-adminstyle', $this->pluginUrl.'assets/css/backend.min.css', [], $this->version, 'all');
        wp_enqueue_style('oxyprops-props', $this->pluginUrl.'assets/css/open-props/open-props.op-lite.min.css', [], $this->version, 'all');

        // enqueue all our scripts
        wp_enqueue_script('oxyprops-adminscript', $this->pluginUrl.'assets/js/backend.js', [], $this->version, 'all');
    }

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

    public function settingsLinks($links)
    {
        $settings_links = '<a href="admin.php?page=oxyprops_lite">Settings</a>';
        array_push($links, $settings_links);

        return $links;
    }
}
