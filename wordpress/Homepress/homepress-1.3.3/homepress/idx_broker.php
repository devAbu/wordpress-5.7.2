<?php

/*
 Template Name: IDX-Broker
 */

$page_style_idxBroker = homepress_get_option('page_style_idxbroker');

if ($page_style_idxBroker == 'full_width') {
    $content_area = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
} else if ($page_style_idxBroker == 'right_sidebar') {
    $content_area = 'col-lg-9 col-md-12 col-sm-12 col-sm single-post__content order-0';
} else {
    $content_area = 'col-lg-9 col-md-12 col-sm-12 col-sm single-post__content order-1';
}

?>

<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'title'); ?>

<section class="container">

    <div class="row">
        <div class="<?php echo esc_attr($content_area); ?>">
            <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            ?>
        </div>

        <?php if ($page_style_idxBroker !== 'full_width') { ?>
            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-box page__sidebar">
                <aside id="sidebar" class="sidebar-white">
                    <?php
                    if (is_active_sidebar('IDXBroker sidebar')) {
                        dynamic_sidebar('IDXBroker sidebar');
                    }
                    ?>
                </aside>
            </div>
        <?php } ?>

    </div>

</section>

<?php get_footer(); ?>