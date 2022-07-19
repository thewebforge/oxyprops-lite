<?php
/**
 * Dashboard
 * Creates OxyProps Lite plugin dashboard.
 * php version 7.4.29
 *
 * @category Dashboard
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Dashboard;

use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\FieldsCallbacks;
use Inc\Api\SettingsApi;
use Inc\Base\BaseController;

/**
 * Dashboard Class
 * Creates OxyProps Lite plugin dashboard.
 * php version 7.4.29
 *
 * @category Dashboard
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class Dashboard extends BaseController
{
    public $settings;
    public $pages = [];
    public $callbacks;

    /**
     * Stores the Dashboard Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Dashboard Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new Dashboard();
        }

        return self::$_instance;
    }

    /**
     * Initializes the Dashboard Class
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function register()
    {
        $this->settings = SettingsApi::getInstance();
        $this->callbacks = AdminCallbacks::getInstance();
        $this->callbacksFields = FieldsCallbacks::getInstance();

        $this->setPages();
        $this->setAdminSettings();
        $this->setAdminSections();
        $this->setAdminFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')
            ->registerSetting();

        // Redirect to about page after activation.
        add_action('activated_plugin', [$this, 'redirect'], 10, 2);
        add_action('load-toplevel_page_oxyprops_lite', [$this, 'enqueue'], 10, 2);
    }

    /**
     * Defines plugin dashboard admin pages
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => __('OxyProps Lite', $this->textDomain),
                'menu_title' => __('OxyProps Lite', $this->textDomain),
                'capability' => 'manage_options',
                'menu_slug' => 'oxyprops_lite',
                'callback' => [$this->callbacks, 'adminDashboard'],
                // 'callback' => [$this, 'render'],
                'icon_url' => $this->activeIcon,
                'position' => 110,
            ],
        ];
    }

    /**
     * Defines plugin dashboard admin settings
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function setAdminSettings()
    {
        $args = [
            [
                'option_group' => 'oxyprops_lite_master_settings',
                'option_name' => 'oxyprops_lite',
                'callback' => [$this->callbacksFields, 'sanitizedCheckbox'],
            ],
        ];
        $this->settings->addSettings($args);
    }

    /**
     * Defines plugin dashboard admin sections
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function setAdminSections()
    {
        $args = [
            [
                'id' => 'oxyprops_lite_master_settings_section',
                'title' => null,
                'callback' => '__return_null',
                'page' => 'oxyprops_lite',
            ],
        ];
        $this->settings->addSections($args);
    }

    /**
     * Defines plugin dashboard admin fields
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function setAdminFields()
    {
        $args = [];
        foreach ($this->adminSettings as $key => $parameters) {
            $args[] = [
                'id' => $key,
                'title' => $parameters['description'],
                'callback' => [$this->callbacksFields, 'checkboxField'],
                'page' => 'oxyprops_lite',
                'section' => 'oxyprops_lite_master_settings_section',
                'args' => [
                    'option_name' => 'oxyprops_lite',
                    'label_for' => $key,
                    'class' => 'oxyprops-ui-toggle',
                ],
            ];
        }
        $this->settings->addFields($args);
    }

    /**
     * Functions and Hooks for Dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function loadDashboard()
    {
        $this->enqueue();
    }

    /**
     * Enqueues Dashboard CSS and JS
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function enqueue()
    {
        wp_enqueue_style(
            'oxyprops-props',
            $this->pluginUrl.'assets/css/open-props/open-props.op-lite.min.css',
            [],
            $this->version,
            'all'
        );
        wp_enqueue_style(
            'oxyprops-adminstyle',
            $this->pluginUrl.'assets/css/dashboard.min.css',
            [],
            $this->version,
            'all'
        );

        // enqueue all our scripts
        wp_enqueue_script(
            'oxyprops-adminscript',
            $this->pluginUrl.'assets/js/dashboard.js',
            [],
            $this->version,
            'all'
        );

        add_filter('admin_footer_text', [$this, 'changeFooterText']);
    }

    /**
     * Customize WordPress Footer on the dashboard page
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function changeFooterText()
    {
        // Translators: %1$s - link to review form.
        echo wp_kses_post(
            sprintf(
                __(
                    'Please rate <strong>OxyProps Lite</strong> '.
                    '<a href="%1$s" target="_blank">&#9733;&#9733;&#9733;&#9733;'.
                    '&#9733;</a> on <a href="%1$s" target="_blank">our Facebook Page'.
                    '</a> to help us spread the word. Thank you from the OxyProps'.
                    ' team!',
                    $this->textDomain
                ),
                'https://www.facebook.com/oxyprops/reviews/'
            )
        );
    }

    /**
     * Redirect to dashboard after activation
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function redirect()
    {
        wp_safe_redirect('admin.php?page=oxyprops_lite');
        die;
    }
}
