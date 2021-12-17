<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('STMT_TO_DIR', STM_CONFIGURATIONS_DIR . '/theme-options');
define('STMT_TO_URL', STM_CONFIGURATIONS_URL . '/theme-options');

require_once STMT_TO_DIR . '/post_type/posts.php';
require_once STMT_TO_DIR . '/post_type/metaboxes/metabox.php';
require_once STMT_TO_DIR . '/settings/google-fonts.php';
require_once STMT_TO_DIR . '/settings/settings.php';

function stmt_to_wp_head()
{
    ?>
    <script type="text/javascript">
        var stmt_to_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
    </script>
    <?php
}

add_action('wp_head', 'stmt_to_wp_head');
add_action('admin_head', 'stmt_to_wp_head');