<div class="archive-services_content">

    <div class="services-thumbnail">
        <?php if( has_post_thumbnail() ) : ?>

            <?php get_template_part( 'partials/custom-posts/services/parts/featured_image' ); ?>

        <?php endif; ?>
    </div>

    <?php get_template_part( 'partials/custom-posts/services/parts/title' ); ?>

</div>