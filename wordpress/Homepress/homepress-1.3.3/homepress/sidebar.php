<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package homepress
 */

if ( ! is_active_sidebar( 'posts-sidebar' ) ) {
	return;
}
?>

<aside id="posts-sidebar" class="widget-area">
	<?php dynamic_sidebar( 'posts-sidebar' ); ?>
</aside>
