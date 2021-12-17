<?php
$menu_args = array(
	'depth' => 3,
	'container' => false,
	'items_wrap' => '%3$s',
	'fallback_cb' => false,
	'theme_location' => 'menu-header'
);

?>

<div class="stm_nav_menu">
    <ul class="stmt-theme-header_menu menu">
        <?php wp_nav_menu( $menu_args ); ?>
    </ul>

    <div class="stm_mobile_switcher">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="stm_nav_menu_overlay"></div>
</div>