<?php
$stmt_inc_path = get_template_directory() . '/inc';

require_once $stmt_inc_path . "/template/functions.php";
require_once $stmt_inc_path . "/template/layout_config.php";
require_once $stmt_inc_path . "/template/setup.php";
require_once $stmt_inc_path . "/template/enqueue.php";
require_once $stmt_inc_path . "/template/post_views.php";
require_once $stmt_inc_path . "/template/comments.php";

if (defined('ELEMENTOR_VERSION')) {
    require_once $stmt_inc_path . "/template/elementor-hooks.php";
}

if (defined('ULISTING_VERSION')) {
    require_once $stmt_inc_path . "/template/ulisting-hooks.php";
}

if (is_admin()) {
    require_once $stmt_inc_path . "/admin/css/css-php.php";
    require_once $stmt_inc_path . "/admin/tgm/registration.php";
    require_once $stmt_inc_path . "/admin/product_registration/admin.php";
}

require_once $stmt_inc_path . "/classes/StmAjaxAction.php";
require_once $stmt_inc_path . "/classes/HomepressDemoImport.php";

\homepress\classes\HomepressDemoImport::init();
\homepress\classes\StmAjaxAction::init();