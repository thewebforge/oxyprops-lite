<?php
/**
 * Create the dashboard page for OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Dashboard;

use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\FieldsCallbacks;
use Inc\Api\SettingsApi;
use Inc\Base\BaseController;

/**
 * The OxyProps Lite Dashboard Class.
 */
class Dashboard extends BaseController
{
    public $settings;
    public $pages = [];
    public $callbacks;

    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Dashboard();
        }

        return self::$instance;
    }

    public function register()
    {
        $this->settings = SettingsApi::getInstance();
        $this->callbacks = AdminCallbacks::getInstance();
        $this->callbacksFields = FieldsCallbacks::getInstance();

        $this->setPages();
        $this->setAdminSettings();
        $this->setAdminSections();
        $this->setAdminFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->registerSetting();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => __('OxyProps Lite', $this->textDomain),
                'menu_title' => __('OxyProps Lite', $this->textDomain),
                'capability' => 'manage_options',
                'menu_slug' => 'oxyprops_lite',
                'callback' => [$this->callbacks, 'adminDashboard'],
                'icon_url' => $this->activeIcon,
                'position' => 110,
            ],
        ];
    }

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

    public function setAdminSections()
    {
        $args = [
            [
                'id' => 'oxyprops_lite_master_settings_section',
                'title' => 'Master Settings',
                'callback' => [$this->callbacks, 'oxypropsLiteMasterSection'],
                'page' => 'oxyprops_lite',
            ],
        ];
        $this->settings->addSections($args);
    }

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
}
