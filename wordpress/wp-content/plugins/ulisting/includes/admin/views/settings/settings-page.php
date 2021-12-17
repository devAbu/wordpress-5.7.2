<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'settings-page';
wp_enqueue_script('cloudflare', ULISTING_URL . '/assets/js/autocomplete.min.js', array(), ULISTING_VERSION);
$data = [
    'activePage' => $page,
];

uListing_load_admin_scripts($data, ['cloudflare']);
?>

<div id="uListing-main">
    <settings-page></settings-page>
</div>