<?php
/**
 * Deactivate
 * Manages plugin deactivation.
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
 * Deactivate Class
 * Manages plugin deactivation.
 * php version 7.4.29
 *
 * @category Base
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class Deactivate
{
    /**
     * Recreate rewrite rules after plugin deactivation
     *
     * @return void
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
