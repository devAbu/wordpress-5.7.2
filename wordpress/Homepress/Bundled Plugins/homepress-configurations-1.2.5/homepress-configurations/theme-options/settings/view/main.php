<?php

if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly

?>

<?php
$id = $metabox['id'];
$sections = $metabox['args'][$id];

$data_vue = "data-vue='" . json_encode($sections) . "'";
?>

<div class="stmt-to-settings" <?php echo ($data_vue); ?>>
    <h1><?php esc_html_e('Theme Options', 'homepress-configurations'); ?></h1>

    <?php require_once(STMT_TO_DIR . '/post_type/metaboxes/metabox-display.php'); ?>

    <div class="stmt_metaboxes_grid">
        <div class="stmt_metaboxes_grid__inner">
            <a href="#"
               @click.prevent="saveSettings('<?php echo esc_attr($id); ?>')"
               v-bind:class="{'loading': loading}"
               class="button load_button">
                <span><?php esc_html_e('Save Settings', 'homepress-configurations'); ?></span>
                <i class="lnr lnr-sync"></i>
            </a>
        </div>
    </div>
</div>

<?php if(!empty($_GET['export'])): ?>
    <a href="<?php echo esc_url(admin_url('admin-ajax.php') . "?action=stmt_get_settings&option_name={$id}"); ?>" target="_blank" download>Export</a>
<?php endif; ?>
