<?php
/**
 * Settings Fields Callbacks
 * Callbacks for Settings Fields.
 * php version 7.4.29
 *
 * @category Callbacks
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

/**
 * Settings Fields Callbacks Class
 * Callbacks for Settings Fields.
 * php version 7.4.29
 *
 * @category Callbacks
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class FieldsCallbacks extends BaseController
{
    /**
     * Stores the Settings Fields Callbacks Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Settings Fields Callbacks Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new FieldsCallbacks();
        }

        return self::$_instance;
    }

    /**
     * Sanitizes a checkbox input
     *
     * @param string $input Checkbox value
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function sanitizedCheckbox($input)
    {
        $output = [];
        foreach ($this->adminSettings as $key => $value) {
            $output[$key] = (isset($input[$key]) && $input[$key]==='1');
        }

        return $output;
    }

    /**
     * Sanitizes a packages checkbox input
     *
     * @param string $input Checkbox value
     *
     * @return boolean
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function sanitizedPackages($input)
    {
        $output = [];
        foreach ($this->packagesSettings as $key => $value) {
            $output[$key] = (isset($input[$key]) && $input[$key]==='1');
        }

        return $output;
    }

    /**
     * Creates a checkbox input field
     *
     * @param array $args Checkbox parameters
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function checkboxField($args)
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $optionName = $args['option_name'];
        $checkbox = get_option($optionName);
        $checked = '';
        if ($checkbox && isset($checkbox[$name])) {
            $checked = $checkbox[$name] ? 'checked' : '';
        }
        echo '<div class="'.$classes.'"><input type="checkbox" id="'.
        $name.'" name="'.$optionName.'['.$name.']" value="1" class="" '.
        $checked.'/><label for="'.$name.'"><div></div></label></div>';
    }
}
