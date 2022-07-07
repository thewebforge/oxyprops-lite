<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Api;

class SettingsApi
{
    public $adminPages = [];
    public $adminSubPages = [];
    public $adminSettings = [];
    public $adminSections = [];
    public $adminFields = [];

    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new SettingsApi();
        }

        return self::$instance;
    }

    public function registerSetting()
    {
        if (!empty($this->adminPages) || !empty($this->adminSubPages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }

        if (!empty($this->adminSettings)) {
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }

    public function addPages(array $pages)
    {
        $this->adminPages = $pages;

        return $this;
    }

    public function withSubPage(string $title = null)
    {
        if (empty($this->adminPages)) {
            return $this;
        }

        $adminPage = $this->adminPages[0];

        $subPages = [
            [
                'parent_slug' => $adminPage['menu_slug'],
                'page_title' => $adminPage['page_title'],
                'menu_title' => ($title) ? $title : $adminPage['menu_title'],
                'capability' => $adminPage['capability'],
                'menu_slug' => $adminPage['menu_slug'],
                'callback' => $adminPage['callback'],
            ],
        ];
        $this->adminSubPages = $subPages;

        return $this;
    }

    public function addSubPages(array $pages)
    {
        $this->adminSubPages = array_merge($this->adminSubPages, $pages);

        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }
        foreach ($this->adminSubPages as $subPage) {
            add_submenu_page($subPage['parent_slug'], $subPage['page_title'], $subPage['menu_title'], $subPage['capability'], $subPage['menu_slug'], $subPage['callback']);
        }
    }

    public function addSettings(array $settings)
    {
        // $this->adminSettings = $settings;
        $this->adminSettings = array_merge($this->adminSettings, $settings);

        return $this;
    }

    public function addSections(array $sections)
    {
        // $this->adminSections = $sections;
        $this->adminSections = array_merge($this->adminSections, $sections);

        return $this;
    }

    public function addFields(array $fields)
    {
        // $this->adminFields = $fields;
        $this->adminFields = array_merge($this->adminFields, $fields);

        return $this;
    }

    public function registerCustomFields()
    {
        // register setting
        foreach ($this->adminSettings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], (isset($setting['callback']) ? $setting['callback'] : ''));
        }

        // add settings section
        foreach ($this->adminSections as $section) {
            add_settings_section($section['id'], $section['title'], (isset($section['callback']) ? $section['callback'] : ''), $section['page']);
        }

        // add setting field
        foreach ($this->adminFields as $field) {
            add_settings_field($field['id'], $field['title'], (isset($field['callback']) ? $field['callback'] : ''), $field['page'], $field['section'], (isset($field['args']) ? $field['args'] : ''));
        }
    }
}
