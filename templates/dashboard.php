<?php
/**
 * Dashboard Template
 * The template for rendering OxyProps Lite plugin dashboard.
 * php version 7.4.29
 *
 * @category Template
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */

use Inc\Api\Callbacks\AdminCallbacks;

$callbacks = AdminCallbacks::get_instance();
?>
<div class="wrap">
<?php
$callbacks->welcome_section();
?>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="about-wrap">
					<?php
					$callbacks->tabs_section();
					$callbacks->settings_section();
					$callbacks->packages_section();
					$callbacks->getting_started_section();
					$callbacks->support_section();
					?>
				</div>
			</div>
			<div id="postbox-container-1" class="postbox-container">
				<?php
				$callbacks->products_section();
				$callbacks->upgrade_section();
				?>
			</div>
		</div>
	</div>
</div>
