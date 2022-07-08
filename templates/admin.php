<div class="wrap">
    <h1 class="op-heading">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1008 768.52">
        <defs>
            <g id="op-svg-logo">
            <path id="op-svg-logo__ring" d="M817.11 192.82C750.48 77.59 625.6 0 482.46 0 320.74 0 182.32 99.06 124.89 239.52h107.3c50.13-85.77 143.4-143.46 250.27-143.46 98.16 0 184.85 48.66 237.19 123.06-56.57 33.27-94.55 94.76-94.55 165.14s37.98 131.88 94.56 165.14c-52.34 74.39-139.04 123.05-237.19 123.05-106.86 0-200.13-57.69-250.27-143.46H124.89c57.43 140.47 195.85 239.52 357.57 239.52 143.14 0 268.05-77.59 334.69-192.82 105.46-.32 190.85-85.91 190.85-191.45S922.59 193.1 817.11 192.79Zm-.56 287.17c-52.87 0-95.73-42.86-95.73-95.73s42.86-95.73 95.73-95.73 95.73 42.86 95.73 95.73-42.86 95.73-95.73 95.73Z"></path>
            <rect id="op-svg-logo__dash1" width="230" height="108.07" y="330.22" class="d" rx="54.04" ry="54.04"></rect>
            <rect id="op-svg-logo__dash2" width="230" height="108.07" x="310" y="330.57" class="d" rx="54.04" ry="54.04"></rect>
            </g>
        </defs>
        <use xlink:href="#op-svg-logo"></use>
    </svg>
        OxyProps Lite
    </h1>
    <?php settings_errors(); ?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1"><?php _e('Manage Settings', 'oxyprops_lite'); ?></a></li>
        <li ><a href="#tab-2"><?php _e('Updates', 'oxyprops_lite'); ?></a></li>
        <li ><a href="#tab-3"><?php _e('About', 'oxyprops_lite'); ?></a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <form method="POST" action="options.php">
                <?php
                    settings_fields('oxyprops_lite_master_settings');
                    do_settings_sections('oxyprops_lite');
                    submit_button();
                ?>
            </form>
        </div>
        <div id="tab-2" class="tab-pane">
            <h3><?php _e('Updates', 'oxyprops_lite'); ?></h3>
        </div>
        <div id="tab-3" class="tab-pane">
            <h3><?php _e('About', 'oxyprops_lite'); ?></h3>
        </div>
    </div>
</div>