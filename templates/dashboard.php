<div class="wrap">
    <h1 class="op-heading">
        <?php include_once 'logo.php'; ?>
        OxyProps Lite
    </h1>
    <?php settings_errors(); ?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1"><?php _e('Manage Settings', 'oxyprops_lite'); ?></a></li>
        <li ><a href="#tab-2"><?php _e('About', 'oxyprops_lite'); ?></a></li>
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
            <h3><?php _e('About', 'oxyprops_lite'); ?></h3>
            <ul>
                <li>WebSite: <a href="https://oxyprops.com" target="_blank">oxyprops.com</a></li>
                <li>Documentation: <a href="https://docs.oxyprops.com" target="_blank">docs.oxyprops.com</a></li>
                <li>Roadmap: <a href="https://feedback.oxyprops.com" target="_blank">feedback.oxyprops.com</a></li>
                <li>Tutorials: <a href="https://youtube.com/oxyprops" target="_blank">OxyProps Youtube Channel</a></li>
                <li>Community: <a href="https://www.facebook.com/groups/oxyprops" target="_blank">OxyProps Facebook Group</a></li>
            </ul>
            <a href="https://oxyprops.com/shop" target="_blank">Get OxyProps Pro</a>
        </div>
    </div>
</div>