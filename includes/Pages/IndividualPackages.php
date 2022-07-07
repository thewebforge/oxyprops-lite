<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Pages;

use Inc\Api\Callbacks\FieldsCallbacks;
use Inc\Api\Callbacks\PackagesCallbacks;
use Inc\Api\SettingsApi;
use Inc\Base\BaseController;

class IndividualPackages extends BaseController
{
    public $settings;
    public $subPages = [];
    public $callbacks;
    public $optionName = 'oxyprops_lite_bundle';

    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new IndividualPackages();
        }

        return self::$instance;
    }

    public function register()
    {
        if ($this->disabled($this->optionName)) {
            return;
        }

        $this->settings = SettingsApi::getInstance();
        // $this->settings = new SettingsApi();
        $this->callbacks = PackagesCallbacks::getInstance();
        $this->callbacksFields = FieldsCallbacks::getInstance();

        $this->setSubPages();
        $this->setPackagesSettings();
        $this->setPackagesSections();
        $this->setPackagesFields();

        $this->settings->addSubPages($this->subPages)->registerSetting();
    }

    public function setSubPages()
    {
        $this->subPages = [
            [
                'parent_slug' => 'oxyprops_lite',
                'page_title' => 'Individual Packages',
                'menu_title' => 'Packages',
                'capability' => 'manage_options',
                'menu_slug' => 'oxyprops_lite_pkg',
                'callback' => [$this->callbacks, 'packagesDashboard'],
            ],
        ];
    }

    public function setPackagesSettings()
    {
        $args = [
            [
                'option_group' => 'oxyprops_lite_packages_settings',
                'option_name' => 'oxyprops_lite_packages',
                'callback' => [$this->callbacksFields, 'sanitizedPackages'],
            ],
        ];
        $this->settings->addSettings($args);
    }

    public function setPackagesSections()
    {
        $args = [
            [
                'id' => 'oxyprops_lite_main_packages_section',
                'title' => 'Main',
                'callback' => [$this->callbacks, 'oxypropsLiteMainPackagesSection'],
                'page' => 'oxyprops_lite_pkg',
            ],
            [
                'id' => 'oxyprops_lite_individual_colors_section',
                'title' => 'Colors',
                'callback' => [$this->callbacks, 'oxypropsLiteColorPackagesSection'],
                'page' => 'oxyprops_lite_pkg',
            ],
            [
                'id' => 'oxyprops_lite_individual_colors_hsl_section',
                'title' => 'Colors Hsl',
                'callback' => [$this->callbacks, 'oxypropsLiteColorHslPackagesSection'],
                'page' => 'oxyprops_lite_pkg',
            ],
        ];
        $this->settings->addSections($args);
    }

    public function setPackagesFields()
    {
        $args = [];
        foreach ($this->packagesSettings as $key => $parameters) {
            $args[] = [
                'id' => $key,
                'title' => $parameters['description'],
                'callback' => [$this->callbacksFields, 'checkboxField'],
                'page' => 'oxyprops_lite_pkg',
                'section' => 'oxyprops_lite_'.$parameters['section'].'_section',
                'args' => [
                    'option_name' => 'oxyprops_lite_packages',
                    'label_for' => $key,
                    'class' => 'oxyprops-ui-toggle',
                ],
            ];
        }
        $this->settings->addFields($args);
    }
}
