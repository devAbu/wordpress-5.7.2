<?php
//Register scripts and styles for admin pages
function homepress_startup_styles()
{
    wp_enqueue_style('stm-startup_css', get_template_directory_uri() . '/inc/admin/product_registration/assets/css/style.css', null, 1.6, 'all');
}

add_action('admin_enqueue_scripts', 'homepress_startup_styles');

//Register Startup page in admin menu
function homepress_register_startup_screen()
{
    $theme = homepress_get_theme_info();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'homepress';

    /*Item Registration*/
    add_menu_page(
        $theme_name,
        esc_html__('HomePress', 'homepress'),
        'manage_options',
        $theme_name_sanitized,
        'homepress_theme_admin_page_functions',
        get_template_directory_uri() . '/inc/admin/product_registration/assets/img/icon.png',
        '2.1111111111'
    );


    /*Demo Import*/
    add_submenu_page(
        $theme_name_sanitized,
        esc_html__('Demo import', 'homepress'),
        esc_html__('Demo import', 'homepress'),
        'manage_options',
        $theme_name_sanitized . '-demos',
        'homepress_theme_admin_install_demo_page'
    );

    /*System status*/
    add_submenu_page(
        $theme_name_sanitized,
        esc_html__('System status', 'homepress'),
        esc_html__('System status', 'homepress'),
        'manage_options',
        $theme_name_sanitized . '-system-status',
        'homepress_theme_admin_system_status_page'
    );

    /*Support page*/
    add_submenu_page(
        $theme_name_sanitized,
        esc_html__('Support', 'homepress'),
        esc_html__('Support', 'homepress'),
        'manage_options',
        $theme_name_sanitized . '-support',
        'homepress_theme_admin_support_page'
    );
}

add_action('admin_menu', 'homepress_register_startup_screen', 20);

function homepress_startup_templates($path)
{
    $path = 'inc/admin/product_registration/screens/' . $path . '.php';

    $located = locate_template($path);

    if ($located) {
        load_template($located);
    }
}

//Startup screen menu page welcome
function homepress_theme_admin_page_functions()
{
    homepress_startup_templates('startup');
}

/*Support Screen*/
function homepress_theme_admin_support_page()
{
    homepress_startup_templates('support');
}

/*Install Plugins*/
function homepress_theme_admin_plugins_page()
{
    homepress_startup_templates('plugins');
}

/*Install Demo*/
function homepress_theme_admin_install_demo_page()
{
    homepress_startup_templates('install_demo');
}

/*System status*/
function homepress_theme_admin_system_status_page()
{
    homepress_startup_templates('system_status');
}

//Admin tabs
function homepress_get_admin_tabs($screen = 'welcome')
{
    $theme = homepress_get_theme_info();
    $creds = stm_get_creds();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'stm-admin';
    if (empty($screen)) {
        $screen = $theme_name_sanitized;
    }
    ?>
    <div class="clearfix">
        <div class="stm_theme_info">
            <div class="stm_theme_version"><?php echo substr($theme['v'], 0, 3); ?></div>
        </div>
        <div class="stm-about-text-wrap">
            <h1><?php printf(esc_html__('Welcome to %s', 'homepress'), $theme_name); ?></h1>
        </div>
    </div>
    <?php $notice = get_site_transient('stm_auth_notice');
    if (!empty($creds['t']) && !empty($notice)): ?>
        <div class="stm-admin-message"><strong>Theme Registration Error:</strong> <?php echo esc_attr($notice); ?></div>
    <?php endif; ?>
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo esc_url_raw(admin_url('admin.php?page=homepress')); ?>"
           class="<?php echo ('welcome' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Product Registration', 'homepress'); ?></a>

        <a href="<?php echo esc_url_raw(admin_url('admin.php?page=homepress-demos')); ?>"
           class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'homepress'); ?></a>

        <a href="<?php echo esc_url_raw(admin_url('admin.php?page=tgmpa-install-plugins')); ?>"
           class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'homepress'); ?></a>

        <a href="<?php echo esc_url_raw(admin_url('admin.php?page=homepress-support')); ?>"
           class="<?php echo ('support' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Support', 'homepress'); ?></a>

        <a href="<?php echo esc_url_raw(admin_url('admin.php?page=homepress-system-status')); ?>"
           class="<?php echo ('system-status' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('System Status', 'homepress'); ?></a>

    </h2>
    <?php
}