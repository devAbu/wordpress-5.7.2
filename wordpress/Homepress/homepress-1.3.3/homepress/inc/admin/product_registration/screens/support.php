<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$theme = homepress_get_theme_info();
$theme_name = $theme['name'];
?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-support-screen">
    <?php homepress_get_admin_tabs('support'); ?>
    <div class="stm-admin-important-notice">

        <p class="about-description"><?php printf(wp_kses_post(__('%s comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via ThemeForest.', 'homepress')), $theme_name); ?></p>
        <p><a href="<?php echo esc_url(homepress_theme_support_url() . 'support/'); ?>"
              class="button button-large button-primary stm-admin-button stm-admin-large-button" target="_blank"
              rel="noopener noreferrer"><?php esc_attr_e('Create A Support Account', 'homepress'); ?></a></p>
    </div>

    <div class="stm-admin-row">
        <div class="stm-admin-two-third">

            <div class="stm-admin-row">

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(homepress_get_admin_images_url('ticket.svg')); ?>" alt="<?php esc_html_e('Ticket System', 'homepress'); ?>" />
							</span>
                            <?php esc_html_e('Ticket System', 'homepress'); ?>
                        </h3>
                        <p>
                            <?php esc_html_e('We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.', 'homepress'); ?>
                        </p>
                        <a href="<?php echo esc_url(homepress_theme_support_url() . 'support/'); ?>" target="_blank">
                            <?php esc_html_e('Submit a ticket', 'homepress'); ?>
                        </a>
                    </div>
                </div>

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(homepress_get_admin_images_url('docs.svg')); ?>" alt="<?php esc_html_e('Documentation', 'homepress'); ?>" />
							</span>
                            <?php esc_html_e('Documentation', 'homepress'); ?>
                        </h3>
                        <p>
                            <?php printf(wp_kses_post(__('Our online documentation is a useful resource for learning the every aspect and features of %s.', 'homepress')), $theme_name); ?>
                        </p>
                        <a href="https://docs.stylemixthemes.com/homepress-theme-documentation/" target="_blank">
                            <?php esc_html_e('Learn more', 'homepress'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="stm-admin-row">

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(homepress_get_admin_images_url('tutorials.svg')); ?>" alt="<?php esc_html_e('Video Tutorials', 'homepress'); ?>"/>
							</span>
                            <?php esc_html_e('Video Tutorials', 'homepress'); ?>
                        </h3>
                        <p>
                            <?php printf(wp_kses_post(__('We recommend you to watch video tutorials before you start the theme customization. Our video tutorials can teach you the different aspects of using %s.', 'homepress')), $theme_name); ?>
                        </p>
                        <a href="https://support.stylemixthemes.com/theme-manuals" target="_blank">
                            <?php esc_html_e('Watch Videos', 'homepress'); ?>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>