<div class="wrap">
    <h1 class="op-heading">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" viewBox="0 0 200 159.29">
            <path class="op-logo" d="M60 79.65c0-6.19-5.04-11.2-11.25-11.2h-37.5C5.04 68.45 0 73.46 0 79.65s5.04 11.2 11.25 11.2h37.5c6.21 0 11.25-5.01 11.25-11.2Zm58.75 11.2c6.21 0 11.25-5.01 11.25-11.2s-5.04-11.2-11.25-11.2h-37.5c-6.21 0-11.25 5.01-11.25 11.2s5.04 11.2 11.25 11.2h37.5Z" />
            <path class="op-logo" d="M174.46 50.51C162.78 20.94 133.85 0 100 0S37.79 20.53 25.89 49.65h22.24C58.52 31.87 77.85 19.92 100 19.92c24.12 0 44.89 14.17 54.43 34.6C145.78 59.76 140 69.24 140 80.05s5.65 20.08 14.14 25.35c-9.66 20.1-30.27 33.99-54.14 33.99-22.15 0-41.48-11.96-51.87-29.73H25.89c11.9 29.11 40.59 49.65 74.11 49.65s62.24-20.54 74.14-49.67C188.75 107.63 200 95.16 200 80.06s-11.09-27.39-25.54-29.54ZM170 96.13c-8.91 0-16.15-7.21-16.15-16.08S161.1 63.97 170 63.97s16.15 7.21 16.15 16.08S178.9 96.13 170 96.13Z" />
        </svg>
        OxyProps Lite
    </h1>
    <?php settings_errors(); ?>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <form method="POST" action="options.php">
                <?php
                settings_fields('oxyprops_lite_packages_settings');
                ?>
                <div class="columns">
                    <?php
                do_settings_sections('oxyprops_lite_pkg');
                ?>
                </div>
                <?php
                submit_button();
                ?>
            </form>
        </div>
    </div>
</div>