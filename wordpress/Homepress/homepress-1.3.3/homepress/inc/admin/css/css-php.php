<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly

add_action('configurations_styles', 'homepress_generate_styles');

function homepress_generate_styles()
{

    global $wp_filesystem;

    if (empty($wp_filesystem)) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }

    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/stm_configurations_styles';
    if (!$wp_filesystem->is_dir($upload_dir)) {
        wp_mkdir_p($upload_dir);
    }

    ob_start();
    require_once get_template_directory() . '/inc/admin/css/theme_options/global.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/typography.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/header.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/footer.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/layout.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/post.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/services.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/widgets.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/testimonials.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/title-box.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/404.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/elementor/elementor.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/single-page.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/inventory.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/search.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/account.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/attributes/base.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/attributes/gallery.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/attributes/locations.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/add-listing.php';
    require_once get_template_directory() . '/inc/admin/css/theme_options/ulisting/pricing-plans.php';
    $css = ob_get_clean();

    $wp_filesystem->put_contents("{$upload_dir}/styles.css", (stm_theme_remove_spaces($css)), FS_CHMOD_FILE);
    homepress_update_styles_version();

}

function homepress_update_styles_version()
{
    $version = intval(get_option('stm_theme_styles_v', 1));
    update_option('stm_theme_styles_v', $version += 1);
}

function stm_theme_remove_spaces($text)
{
    $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
    $text = preg_replace('/([\s])\1+/', ' ', $text);
    $text = trim($text);
    return $text;
}

function homepress_element_styles($style_name, $style)
{
    switch ($style_name) {
        case 'font-family':
            $style = "'{$style}'";
            break;
        case 'margin_bottom':
            $style_name = 'margin-bottom';
            break;
        case 'margin_top':
            $style_name = 'margin-top';
            break;
    }
    return "{$style_name} : {$style}";
}