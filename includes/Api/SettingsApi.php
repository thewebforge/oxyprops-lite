<?php
/**
 * Settings API
 * Manages interactions with WordPress Settings API.
 * php version 7.4.29
 *
 * @category API
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Api;

/**
 * Settings API Class
 * Manages interactions with WordPress Settings API.
 * php version 7.4.29
 *
 * @category API
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class SettingsApi
{
    public $adminPages = [];
    public $adminSubPages = [];
    public $adminSettings = [];
    public $adminSections = [];
    public $adminFields = [];

    /**
     * Stores the Settings API Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Settings API Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new SettingsApi();
        }

        return self::$_instance;
    }

    /**
     * Registers OxyProps Lite admin pages and settings
     * with WordPress.
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function registerSetting()
    {
        if (!empty($this->adminPages) || !empty($this->adminSubPages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }

        if (!empty($this->adminSettings)) {
            add_action('admin_init', [$this, 'registerCustomFields']);
        }
    }

    /**
     * Adds pages to the admin pages to be registered.
     *
     * @param array $pages List of pages to add
     *
     * @return object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function addPages(array $pages)
    {
        $this->adminPages = $pages;

        return $this;
    }

    /**
     * Manages the first element of subpages menu
     *
     * @param string|null $title The menu title

     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
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

    /**
     * Adds sub-pages to the admin pages to be registered.
     *
     * @param array $pages List of subpages to be registered
     *
     * @return object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function addSubPages(array $pages)
    {
        $this->adminSubPages = array_merge($this->adminSubPages, $pages);

        return $this;
    }

    /**
     * Adds menus and sub-menus to the admin menus to be registered.
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     *
     * @return void
     */
    public function addAdminMenu()
    {
        foreach ($this->adminPages as $page) {
            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
                $page['icon_url'],
                $page['position']
            );
        }

        foreach ($this->adminSubPages as $subPage) {
            add_submenu_page(
                $subPage['parent_slug'],
                $subPage['page_title'],
                $subPage['menu_title'],
                $subPage['capability'],
                $subPage['menu_slug'],
                $subPage['callback']
            );
        }
    }

    /**
     * Adds settings to the admin settings to be registered.
     *
     * @param array $settings List of settings to be registered
     *
     * @return object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function addSettings(array $settings)
    {
        $this->adminSettings = array_merge($this->adminSettings, $settings);

        return $this;
    }

    /**
     * Adds settings sections to the list
     *
     * @param array $sections List of sections to be registered
     *
     * @return object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function addSections(array $sections)
    {
        $this->adminSections = array_merge($this->adminSections, $sections);

        return $this;
    }

    /**
     * Adds settings fields to the list
     *
     * @param array $fields List of fields to be registered
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function addFields(array $fields)
    {
        // $this->adminFields = $fields;
        $this->adminFields = array_merge($this->adminFields, $fields);

        return $this;
    }

    /**
     * Registers the settigns Groups, Sections, Fields
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function registerCustomFields()
    {
        // register setting
        foreach ($this->adminSettings as $setting) {
            register_setting(
                $setting['option_group'],
                $setting['option_name'],
                isset($setting['callback']) ?
                $setting['callback'] :
                ''
            );
        }

        // add settings section
        foreach ($this->adminSections as $section) {
            add_settings_section(
                $section['id'],
                $section['title'],
                isset($section['callback']) ?
                $section['callback'] :
                '',
                $section['page']
            );
        }

        // add setting field
        foreach ($this->adminFields as $field) {
            add_settings_field(
                $field['id'],
                $field['title'],
                isset($field['callback']) ?
                $field['callback'] :
                '',
                $field['page'],
                $field['section'],
                isset($field['args']) ?
                $field['args'] :
                ''
            );
        }
    }
}
