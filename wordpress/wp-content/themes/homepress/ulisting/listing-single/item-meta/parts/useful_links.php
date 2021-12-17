<?php wp_enqueue_script( 'ulisting/single/item-meta/style_1' ); ?>
<ul class="listing-useful_links">
    <li><a href="mailto:?subject=<?php the_permalink(); ?>"><span class="property-icon-envelope2 listing-useful_icons"></span><?php esc_html_e( 'Email', 'homepress' ); ?></a></li>
    <li><a href="javascript:window.print()"><span class="property-icon-print listing-useful_icons"></span><?php esc_html_e( 'Print', 'homepress' ); ?></a></li>
    <?php if( ulisting_wishlist_active() ) : ?>
    <li>
        <span class="single_wishlist">
        <?php echo \uListing\UlistingWishlist\Classes\UlistingWishlist::render_add_button('template_1', $args['model']) ?>
        <?php esc_html_e( 'Save', 'homepress' ); ?>
        </span>
    </li>
    <?php endif;?>
    <li class="listing-share">
        <a href="javascript:void(0)" class="listing-share-link"><span class="property-icon-share2 listing-useful_icons"></span><?php esc_html_e( 'Share', 'homepress' ); ?></a>
        <ul>
            <li><?php if( function_exists( 'stm_get_shares' ) ) { stm_get_shares(); }?></li>
        </ul>
    </li>
</ul>
