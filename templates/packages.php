<div class="wrap">
    <h1 class="op-heading">
        <?php include_once 'logo.php'; ?>
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