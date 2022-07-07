<?php

/**
 * OxyProps Lite.
 *
 * @see              https://lite.oxyprops.com
 * @since             1.0.0
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class FieldsCallbacks extends BaseController
{
    private static $instance;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new FieldsCallbacks();
        }

        return self::$instance;
    }

    public function sanitizedCheckbox($input)
    {
        $output = [];
        foreach ($this->adminSettings as $key => $value) {
            $output[$key] = (isset($input[$key]) && $input[$key]);
        }

        return $output;
    }

    public function sanitizedPackages($input)
    {
        $output = [];
        foreach ($this->packagesSettings as $key => $value) {
            $output[$key] = (isset($input[$key]) && $input[$key]);
        }

        return $output;
    }

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
        echo '<div class="'.$classes.'"><input type="checkbox" id="'.$name.'" name="'.$optionName.'['.$name.']" value="1" class="" '.$checked.'/><label for="'.$name.'"><div></div></label></div>';
    }
}
