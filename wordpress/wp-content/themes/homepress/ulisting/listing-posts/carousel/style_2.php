<?php

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'ulisting/ulisting_posts_carousel/style_2' );

$view = $settings['listing_posts_view'];

$data = [
    'listing_type_id'   => $type_id,
    'limit'             => $settings[ 'listing_posts_per_page' ],
    'category'          => $settings[ 'listing_category_list' ],
    'sort_type'         => $settings[ 'listing_posts_sort_by' ],
    'attributes'        => $carousel_settings[ 'item_count_attributes' ],
];

$listings = \uListing\Classes\StmListing::uListing_posts_view_get_listings( $data );
$listings = \uListing\Classes\StmListing::uListing_get_listing_attributes( $data, $listings );

?>
<div class="row">
<?php echo '<div class="listing-elementor-gallery style_2 '. $view.' " data-stage="'. $carousel_settings['carousel_stage'] .'" data-desktop="'. $carousel_settings['items_count_desktop'] .'" data-landscape="'. $carousel_settings['items_count_landscape'] .'" data-tablet="'. $carousel_settings['items_count_tablet'] .'" data-mobile_landscape="'. $carousel_settings['items_count_mobile_landscape'] .'" data-mobile="'. $carousel_settings['items_count_mobile'] .'" data-nav="'. $carousel_settings['carousel_nav'] .'" data-dots="'. $carousel_settings['carousel_dots'] .'" data-loop="'. $carousel_settings['carousel_loop'] .'">' ?>

<?php foreach ( $listings as $listing ) :
    //Listing args
    $post_title = isset( $listing-> post_title ) ? $listing-> post_title : '';
    $location_address = isset( $listing-> location_address ) ? $listing-> location_address : '';
    $price = isset( $listing-> price ) ? ulisting_currency_format( $listing-> price ) : '';
    $old_price = isset( $listing-> old_price ) ? ulisting_currency_format( $listing-> old_price ) : '';
    $user_id = isset( $listing-> post_author ) ? $listing-> post_author : '';
    $image = isset( $listing-> background_image ) ? $listing-> background_image : '';
    $user_info = $listing->getUser();

    ?>
    <div class="item">
        <div class="listing-gallery-content">
            <div class="listing-gallery-title"><?php echo homepress_minimize_word( $post_title, 33, '...' );  ?></div>
            <?php if( $location_address ) : ?>
            <div class="listing-gallery-location"><?php echo homepress_minimize_word( $location_address, 58, '...' );  ?></div>
            <?php endif; ?>

            <div class="listing-gallery-attribute-list row">
                <?php
                    $attributes = isset( $listing -> attribute_elements ) ? $listing -> attribute_elements : [];
                    if(count( $attributes ) > 0 )
                    foreach ( $attributes as $attribute ) :
                        //Listing attributes args
                        $attribute_icon = isset( $attribute['attribute_icon'] ) ? $attribute['attribute_icon'] : '';
                        $attribute_title = isset( $attribute['attribute_title'] ) ? $attribute['attribute_title'] : '';
                        $attribute_value = isset( $attribute['attribute_value'] ) ? $attribute['attribute_value'] : '';
                        $attribute_option_name = isset( $attribute['attribute_option_name'] ) ? $attribute['attribute_option_name'] : '';

                ?>
                <div class="listing-gallery-attribute-list-item col-lg-4 col-md-4 col-sm-12">
                    <?php if( $attribute_icon ) : ?>
                        <div class="listing-gallery-attribute-icon"><i class="<?php echo esc_attr( $attribute_icon ); ?>"></i></div>
                    <?php endif; ?>

                    <?php if( $attribute_title || $attribute_option_name || $attribute_value ) : ?>
                        <div class="listing-gallery-attribute-options">
                            <?php if( $attribute_title ) : ?>
                                <div class="listing-gallery-attribute-title"><?php echo esc_attr( $attribute_title ); ?></div>
                            <?php endif; ?>

                            <?php if( $attribute_option_name ) : ?>
                                <div class="listing-gallery-attribute-option"><?php echo esc_attr( $attribute_option_name ); ?></div>
                            <?php elseif( $attribute_value ) : ?>
                                <div class="listing-gallery-attribute-value"><?php echo esc_attr( $attribute_value ); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <?php

            $user = get_user_meta( $user_id );
            $user_nickname = isset( $user_info->nickname ) ? $user_info->nickname : '';
            $user_phone = isset( $user_info->phone_mobile ) ? $user_info->phone_mobile : '';

            $temp = isset($user['ulisting_wishlist'][0]) ? $user['ulisting_wishlist'][0] : [];
            $user_wishList = is_string($temp) ? json_decode($temp) : [];
            $user_wishList = json_decode(json_encode($user_wishList), True);

            if( $user_phone || $user_nickname ) : ?>

                <div class="row listing-gallery-user-box">
                    <?php if( $user_phone ) : ?>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <span class="listing-gallery-user-phone">
                                <strong><?php esc_html_e( 'Call:', 'homepress' ); ?></strong>
                                <?php echo esc_attr( $user_phone ); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    <?php if( $user_nickname ) : ?>
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <span class="listing-gallery-user-nickname">
                                <strong><?php esc_html_e( 'Agent:', 'homepress' ); ?></strong>
                                <?php echo esc_attr( $user_nickname ); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

            <div class="listing-gallery-bottom-box">
                <?php if( $price || $old_price ) : ?>
                    <div class="listing-gallery-attribute-price-box<?php if( $old_price ) : ?> has-sale-price<?php endif; ?>">
                        <?php if( $price ) : ?>
                            <span class="listing-gallery-attribute-price">
                                <?php if( $old_price ) : ?><span><?php esc_html_e( 'For Sale', 'homepress' ); ?></span><?php endif; ?>
                                <?php echo esc_attr( $price ); ?>
                            </span>
                        <?php endif; ?>

                        <?php if( $old_price ) : ?>
                            <span class="listing-gallery-attribute-old-price"><?php echo esc_attr( $old_price ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="ulisting-listing-compare-wishlist">
                    <div data-compare_id="<?php echo esc_attr( $listing->ID ); ?>" id="ulisting_listing_compare_<?php echo esc_attr( $listing->ID ); ?>"
                         class='ulisting-listing-compare inventory_compare ulisting_listing_compare_<?php echo esc_attr( $listing->ID ); ?>'
                         onclick='add_listing_compare_via_class(<?php echo esc_attr( $listing->ID ); ?>)'>
                        <span class='simple-icon property-icon-home-plus'></span>
                    </div>
                    <?php
                        $active = in_array($listing->ID, $user_wishList) ?  'active' : '';
                    ?>
                    <?php echo '<span data-wishlist_id="'. $listing->ID .'" onclick="ulisting_wishlist('. $listing->ID .')"  class="ulisting-listing-wishlist stm-cursor-pointer ulisting_wishlist_'. $listing->ID .' ulisting_wishlist_check '. $active .'"> <span class="property-icon-heart-outline simple-icon"></span><span class="property-icon-heart-solid active_wishlist"></span></span> <span class="ulisting-listing-wishlist ulisting_wishlist_load_'.$listing->ID.' hidden"><span class="property-icon-heart-solid simple-icon"></span></span>';?>
                </div>

            </div>

            <a class="listing-gallery-link" href="<?php echo esc_url( $listing -> guid ); ?>"></a>
        </div>

        <div class="listing-gallery-thumbnail">
            <a class="listing-gallery-link" href="<?php echo esc_url( $listing -> guid ); ?>"><img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" /></a>
        </div>
    </div>
<?php endforeach; ?>
</div>
</div>
