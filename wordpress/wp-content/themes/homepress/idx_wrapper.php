<?php

/*
 Template Name: IDX-Wrapper
 */

$content_area = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
?>

<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'title'); ?>

<section class="container page-template-idx_broker">
    <div class="row">
        <div class="<?php echo esc_attr($content_area); ?>">
                <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
        </div>
    </div>

</section>

<?php get_footer(); ?>