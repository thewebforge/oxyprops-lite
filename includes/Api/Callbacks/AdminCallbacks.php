<?php
/**
 * Admin Callbacks
 * Callbacks for admin.
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
 * Admin Callbacks Class
 * Callbacks for plugin administration
 * php version 7.4.29
 *
 * @category Callbacks
 * @package  OxyPropsLite
 * @author   Cédric Bontems <dev@oxyprops.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://lite.oxyprops.com OxyProps Lite Website
 * @since    1.0.0
 */
class AdminCallbacks extends BaseController
{
    /**
     * Stores the Admin Callbacks Singleton.
     *
     * @var object
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    private static $_instance;

    /**
     * Returns the Admin Callbacks Singleton.
     *
     * @return object Instance
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new AdminCallbacks();
        }

        return self::$_instance;
    }

    /**
     * Returns the Admin Dashboard template
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function adminDashboard()
    {
        return include_once "{$this->pluginPath}/templates/dashboard.php";
    }

    /**
     * Renders the Welcome section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function welcomeSection()
    {
        ?>
        <h1>
            <?php
            echo esc_html($this->pluginName);
            ?>
        </h1>
        <div id="welcome-panel" class="welcome-panel opl-welcome-panel">
            <div class="welcome-panel-content">
                <div class="welcome-panel-header">
                    <div class="welcome-panel-header-image">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000">
                            <style>
                                .op-svg-logo__dash,
                                .op-svg-logo__bubble {
                                    fill: var(--o-logo-1);
                                }
                                .op-svg-logo__ring {
                                    fill: var(--o-logo-2);
                                }
                            </style>
                            <path class="op-svg-logo__ring" d="M265.44 359.52C313.22 279.91 400.39 226.63 500 226.63s186.77 53.28 234.56 132.89h118.29C797 219.37 660.07 120.32 500.01 120.32s-297 99.05-352.85 239.2h118.28Zm469.12 280.96C686.78 720.09 599.61 773.37 500 773.37s-186.77-53.28-234.56-132.89H147.16c55.85 140.15 192.78 239.2 352.84 239.2s296.99-99.05 352.84-239.2H734.55Z" />
                            <rect class="op-svg-logo__dash" width="227.26" height="106.79" x="2" y="446.61" rx="53.39" ry="53.39"/>
                            <rect class="op-svg-logo__dash" width="227.26" height="106.79" x="308.31" y="446.94" rx="53.39" ry="53.39"/>
                            <path class="op-svg-logo__bubble" d="M808.76 310.76c-104.51 0-189.24 84.73-189.24 189.24s84.73 189.24 189.24 189.24S998 604.51 998 500s-84.73-189.24-189.24-189.24Zm0 283.86c-52.26 0-94.62-42.36-94.62-94.62s42.36-94.62 94.62-94.62 94.62 42.36 94.62 94.62-42.36 94.62-94.62 94.62Z"/>
                        </svg>
                    </div>
                    <h2>
                        <?php
                        echo esc_html(
                            sprintf(
                                __('Welcome to %s!', $this->textDomain),
                                $this->pluginName
                            )
                        );
                        ?>
                    </h2>
                    <p>
                    <?php
                    esc_html_e('OxyProps Lite is a free and open source WordPress plugin brings Open Props Supercharged CSS Variables to your WordPress environment for styling your website. Follow the instruction below to get started!', $this->textDomain);
                    ?>
                    </p>
                    <p>
                        <?php
                        esc_html_e('Learn more about', $this->textDomain);
                        ?>
                        <a
                        target="_blank"
                        href="https://lite.oxyprops.com?utm_source=WordPress&utm_medium=link&utm_campaign=plugin"
                        >
                        <?php
                        echo esc_html(
                            sprintf(
                                __('OxyProps Lite v%s', $this->textDomain),
                                $this->version
                            )
                        );
                        ?>
                        </a>
                        <?php
                        esc_html_e('and', $this->textDomain);
                        ?>
                        <a
                        target="_blank"
                        rel="noopener noreferer"
                        href="https://open-props.style/"
                        >
                        <?php
                        echo esc_html(
                            sprintf(
                                __('Open Props v%s', $this->textDomain),
                                '1.4'
                            )
                        );
                        ?>
                        </a>
                    </p>
                </div>
                <div class="welcome-panel-column-container">
                    <div class="welcome-panel-column">
                        <div class="welcome-panel-icon-upgrade"></div>
                        <div class="welcome-panel-column-content op-upgrade">
                            <h3>
                            <?php
                            esc_html_e('Upgrade to PRO', $this->textDomain);
                            ?>
                            </h3>
                            <p>
                            <?php
                            esc_html_e('Upgrade to the OxyProps PRO plan and unlock a bunch of awesome features to save time and stremaline your workflow.', $this->textDomain);
                            ?>
                            </p>
                            <a
                            class="button button-primary"
                            target="_blank"
                            href="https://oxyprops.com/shop?utm_source=WordPress&utm_medium=link&utm_campaign=plugin">
                            <?php
                            esc_html_e('Get OxyProps PRO today', $this->textDomain);
                            ?> &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="welcome-panel-column">
                        <div class="welcome-panel-icon-docs"></div>
                        <div class="welcome-panel-column-content">
                            <h3>
                            <?php
                            esc_html_e('OxyProps Documentation', $this->textDomain);
                            ?>
                            </h3>
                            <p>
                            <?php
                            esc_html_e('To learn more about the plugin, the concept of design tokens, the framework or the way to use it, check our documentation!', $this->textDomain);
                            ?>
                            </p>
                            <a
                            class="button"
                            target="_blank"
                            href="https://docs.oxyprops.com?utm_source=WordPress&utm_medium=link&utm_campaign=plugin">
                            <?php
                            esc_html_e('Read Docs', $this->textDomain);
                            ?> &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="welcome-panel-column">
                        <div class="welcome-panel-icon-facebook"></div>
                        <div class="welcome-panel-column-content">
                            <h3>
                            <?php
                            esc_html_e('Facebook Group', $this->textDomain);
                            ?>
                            </h3>
                            <p>
                            <?php
                            esc_html_e('Join the OxyProps Users Community and engage discussion with awesome WordPress Professionals from all over the world.', $this->textDomain);
                            ?>
                            </p>
                            <a
                            class="button"
                            target="_blank"
                            href="https://www.facebook.com/groups/oxyprops">
                            <?php
                            esc_html_e('Join the Community', $this->textDomain);
                            ?> &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="welcome-panel-column">
                        <div class="welcome-panel-icon-youtube"></div>
                        <div class="welcome-panel-column-content">
                            <h3>
                            <?php
                            esc_html_e('Youtube Channel', $this->textDomain);
                            ?>
                            </h3>
                            <p>
                            <?php
                            esc_html_e('Find video tutorials about using OxyProps, CSS tips and tricks & Web Design. And if you like them, don\'t forget to subscribe!', $this->textDomain);
                            ?>
                            </p>
                            <a 
                            class="button"
                            target="_blank"
                            href="https://youtube.com/oxyprops">
                            <?php
                            esc_html_e('Watch Tutorials', $this->textDomain);
                            ?> &rarr;
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the Tabs section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function tabsSection()
    {
        ?>
        <h2 class="nav-tab-wrapper">
            <a
            href="#settings"
            class="nav-tab nav-tab-active"
            >
            <?php
            esc_html_e('Main Settings', $this->textDomain);
            ?>
            </a>
            <?php
            if (!$this->disabled('oxyprops_lite_bundle')) {
                ?>
                <a
                href="#packages"
                class="nav-tab">
                <?php
                esc_html_e('Select Packages', $this->textDomain);
                ?>
                </a>
                <?php
            }
            ?>
            <a
            href="#getting-started"
            class="nav-tab">
            <?php
            esc_html_e('Getting Started', $this->textDomain);
            ?>
            </a>
            <a
            href="#support"
            class="nav-tab">
            <?php
            esc_html_e('Support', $this->textDomain);
            ?>
            </a>
        </h2>
        <?php
    }

    /**
     * Renders the Settings section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function settingsSection()
    {
        ?>
        <div id="settings" class="gt-tab-pane gt-is-active">
            <p class="about-description">
                <?php
                esc_html_e('To keep things simple, OxyProps Lite just works "out of the box". But from here you can customize the way OxyProps Lite loads assets, and remove WordPress default CSS Variables and SVG presets if you want to.', $this->textDomain);
                ?>
            </p>
            <div class="two">
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('Main Settings', $this->textDomain);
                        ?>
                    </h3>
                    <p>
                        <?php
                        esc_html_e(
                            'By default, OxyProps Lite doesn\'t apply Normalize, and loads the full bundle as linked stylesheets.',
                            $this->textDomain
                        );
                        ?>
                    <p>
                    <p>
                        <?php
                        esc_html_e(
                            'You can customize the behavior with the following options:',
                            $this->textDomain
                        );
                        ?>
                    <p>
                    <form method="POST" action="options.php">
                        <?php
                        settings_fields('oxyprops_lite_master_settings');
                        do_settings_sections('oxyprops_lite');
                        submit_button();
                        ?>
                    </form>
                </div>
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('SetUp OxyProps Lite', $this->textDomain);
                        ?>
                    </h3>
                    <p>
                        <?php
                        esc_html_e('Watch this short video to learn everything about the settings:', $this->textDomain);
                        ?>
                    <p>
                    <div class="youtube-video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/WffqhZojpYY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the Packages section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function packagesSection()
    {
        ?>
        <div id="packages" class="gt-tab-pane">
            <p class="about-description">
                <?php
                esc_html_e('You chose to pick individual packages instead of loading the full bundle. Perfect! Just select the PropsPacks that will match your use case. If you select many, you may want to apply "Inline Styles" from the Main Settings for better performances.', $this->textDomain);
                ?>
            </p>
            <div class="three">
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('Main Packages', $this->textDomain);
                        ?>
                    </h3>
                    <form method="POST" action="options.php">
                        <?php
                        submit_button();
                        settings_fields('oxyprops_lite_packages_settings1');
                        do_settings_sections('oxyprops_lite_pkg1');
                        ?>

                </div>
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('Individual Colors', $this->textDomain);
                        ?>
                    </h3>

                        <?php
                        submit_button();
                        settings_fields('oxyprops_lite_packages_settings2');
                        do_settings_sections('oxyprops_lite_pkg2');
                        ?>

                </div>
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('Individual Colors HSL', $this->textDomain);
                        ?>
                    </h3>

                        <?php
                        submit_button();
                        settings_fields('oxyprops_lite_packages_settings3');
                        do_settings_sections('oxyprops_lite_pkg3');
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the Getting Started section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function gettingStartedSection()
    {
        ?>
        <div id="getting-started" class="gt-tab-pane">
            <div class="two">
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e(
                            'Using the Props', $this->textDomain
                        );
                        ?>
                    </h3>
                    <p>
                        <?php
                        esc_html_e(
                            'In this short video, we will have an overview of the available Props and see how to use them with or without a site builder.',
                            $this->textDomain
                        );
                        ?>
                    </p>
                    <div class="youtube-video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/WffqhZojpYY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col">
                <h3>
                        <?php
                        esc_html_e(
                            'What is Normalize?', $this->textDomain
                        );
                        ?>
                    </h3>
                    <p>
                        <?php
                        esc_html_e(
                            'OxyProps Lite includes a Normalize stylesheet adapted from Open Props Normalize to WordPress and Oxygen (Bricks soon) specifics.',
                            $this->textDomain
                        );
                        ?>
                    </p>
                    <div class="youtube-video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/WffqhZojpYY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the Support section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function supportSection()
    {
        ?>
        <div id="support" class="gt-tab-pane">
        <p class="about-description">
                <?php
                $allowedHtml = array(
                    'a' => array(
                        'href' => array(),
                    ),
                );
                echo wp_kses(
                    sprintf(
                        __(
                            'Still need help with OxyProps? We offer excellent support for you. But don\'t forget to check our <a href="%s">documentation</a> first.',
                            $this->textDomain
                        ),
                        'https://docs.oxyprops.com?utm_source=WordPress&utm_medium=link&utm_campaign=plugin'
                    ),
                    $allowedHtml
                );
                ?>
            </p>
            <div class="two">
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('Free Support', $this->textDomain);
                        ?>
                    </h3>
                    <p>
                        <?php
                        esc_html_e(
                            'If you have any question about how to use the plugin, please open a new issue on Github so we get notified. We will try to answer as soon as we can.',
                            $this->textDomain
                        );
                        ?>
                    <p>
                    <p>
                        <a
                        class="button"
                        target="_blank"
                        href="https://github.com/thewebforge/oxyprops-lite/issues"
                        >
                        <?php
                        esc_html_e('Go to Github', $this->textDomain);
                        ?> &rarr;
                        </a>
                    </p>
                </div>
                <div class="col">
                    <h3>
                        <?php
                        esc_html_e('Premium Support', $this->textDomain);
                        ?>
                    </h3>
                    <p>
                        <?php
                        esc_html_e(
                            'For users that have bought OxyProps Pro, the support is provided by email. Use the contact form an make sure to provide your license email. Any question will be answered within 48 business hours.',
                            $this->textDomain
                        );
                        ?>
                    <p>
                    <p>
                        <a
                        class="button"
                        target="_blank"
                        href="https://oxyprops.com/contact?utm_source=WordPress&utm_medium=link&utm_campaign=plugin"
                        >
                        <?php
                        esc_html_e('Open a support request', $this->textDomain);
                        ?> &rarr;
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the Products section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function productsSection()
    {
        ?>
        <div class="postbox">
            <h3 class="hndle">
                <span>
                    <?php
                    esc_html_e('Our WordPress Products', $this->textDomain)
                    ?>
                </span>
            </h3>
            <div class="inside">
                <p>
                    <?php
                    esc_html_e(
                        'Like this plugin? Check out our other WordPress products:',
                        $this->textDomain
                    );
                    ?>
                </p>
                <p>
                    <a
                    href="https://wpslimseo.com?utm_source=WordPress&utm_medium=link&utm_campaign=meta-box"
                    target="_blank"
                    rel="noopenner noreferrer"
                    >
                    Slim SEO
                    </a> - 
                    <?php
                    esc_html_e(
                        'Automated & fast SEO plugin for WordPress',
                        $this->textDomain
                    );
                    ?>
                </p>
                <p>
                    <a
                    href="https://wpslimseo.com?utm_source=WordPress&utm_medium=link&utm_campaign=meta-box"
                    target="_blank"
                    rel="noopenner noreferrer"
                    >
                    Slim SEO
                    </a> - 
                    <?php
                    esc_html_e(
                        'Automated & fast SEO plugin for WordPress',
                        $this->textDomain
                    );
                    ?>
                </p>
            </div>
        </div>
        <?php
    }

    /**
     * Renders the Upgrade section of the dashboard
     *
     * @return void
     *
     * @since  1.0.0
     * @author Cédric Bontems <dev@oxyprops.com>
     */
    public function upgradeSection()
    {
        ?>
        <div class="upgrade">
            <h3>
                <span class="dashicons dashicons-superhero"></span>
                <?php
                esc_html_e('Upgrade to OxyProps PRO', $this->textDomain);
                ?>
            </h3>
            <p>
                <?php
                esc_html_e(
                    'When you upgrade to the PRO version, you unlock these awesome features:',
                    $this->textDomain
                );
                ?>
            </p>
            <ul>
                <li>
                    <svg class="icon">
                        <use xlink:href="#checkmark-outline"></use>
                    </svg>
                    <?php
                    esc_html_e(
                        'Hundreds of exclusive additional props from custom colors to fluid typography and layouts!',
                        $this->textDomain
                    );
                    ?>
                </li>
                <li>
                    <svg class="icon">
                        <use xlink:href="#checkmark-outline"></use>
                    </svg>
                    <?php
                    esc_html_e(
                        'A full utility classes framework (6500+ classes) built with the core CSS Variables.',
                        $this->textDomain
                    );
                    ?>
                </li>
                <li>
                    <svg class="icon">
                        <use xlink:href="#checkmark-outline"></use>
                    </svg>
                    <?php
                    esc_html_e(
                        'Built in color schemes management for easy light/dark modes development.',
                        $this->textDomain
                    );
                    ?>
                </li>
                <li>
                    <svg class="icon">
                        <use xlink:href="#checkmark-outline"></use>
                    </svg>
                    <?php
                    esc_html_e(
                        'OxyProps Builder enhancements (Oxygen, Bricks coming soon) for instant access to the framework.',
                        $this->textDomain
                    );
                    ?>
                </li>
                <li>
                    <svg class="icon">
                        <use xlink:href="#checkmark-outline"></use>
                    </svg>
                    <?php
                    esc_html_e(
                        'Custom elements for damn easy color schemes management (Oxygen, Bricks coming soon).',
                        $this->textDomain
                    );
                    ?>
                </li>
            </ul>
            <a
            class="button button-primary"
            target="_blank"
            href="https://oxyprops.com/shop/?utm_source=WordPress&utm_medium=link&utm_campaign=plugin"
            >
            <?php
            esc_html_e('Get OxyProps PRO today', $this->textDomain);
            ?> &rarr;
            </a>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="checkmark-outline" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
            </symbol>
        </svg>
        <?php
    }
}
