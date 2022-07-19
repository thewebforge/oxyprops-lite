<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Dashboard;

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

        // $this->setSubPages();
        $this->setPackagesSettings();
        $this->setPackagesSections();
        $this->setPackagesFields();

        $this->settings->addSubPages($this->subPages)->registerSetting();
    }

    // public function setSubPages()
    // {
    //     $this->subPages = [
    //         [
    //             'parent_slug' => 'oxyprops_lite',
    //             'page_title' => 'Individual Packages',
    //             'menu_title' => 'Packages',
    //             'capability' => 'manage_options',
    //             'menu_slug' => 'oxyprops_lite_pkg',
    //             'callback' => [$this->callbacks, 'packagesDashboard'],
    //         ],
    //     ];
    // }

    public function setPackagesSettings()
    {
        $args = [
            [
                'option_group' => 'oxyprops_lite_packages_settings1',
                'option_name' => 'oxyprops_lite_packages',
                'callback' => [$this->callbacksFields, 'sanitizedPackages'],
            ],
            [
                'option_group' => 'oxyprops_lite_packages_settings2',
                'option_name' => 'oxyprops_lite_packages',
                'callback' => [$this->callbacksFields, 'sanitizedPackages'],
            ],
            [
                'option_group' => 'oxyprops_lite_packages_settings3',
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
                'title' => null,
                'callback' => '__return_null',
                'page' => 'oxyprops_lite_pkg1',
            ],
            [
                'id' => 'oxyprops_lite_individual_colors_section',
                'title' => null,
                'callback' => '__return_null',
                'page' => 'oxyprops_lite_pkg2',
            ],
            [
                'id' => 'oxyprops_lite_individual_colors_hsl_section',
                'title' => null,
                'callback' => '__return_null',
                'page' => 'oxyprops_lite_pkg3',
            ],
        ];
        $this->settings->addSections($args);
    }

    public function setPackagesFields()
    {
        $args = [];
        foreach ($this->packagesSettings as $key => $parameters) {
            $column = '';
            switch ($parameters['section']) {
            case 'main_packages':
                $column = '1';
                break;
            case 'individual_colors':
                $column = '2';
                break;
            case 'individual_colors_hsl':
                $column = '3';
                break;
            }
            $args[] = [
                'id' => $key,
                'title' => $parameters['description'],
                'callback' => [$this->callbacksFields, 'checkboxField'],
                'page' => 'oxyprops_lite_pkg'.$column,
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
