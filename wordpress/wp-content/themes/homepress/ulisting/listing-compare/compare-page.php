<div class="compare_box">
    <div class="container">
        <?php if( $listing_types ): ?>

            <div class="title_tabs">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2><?php echo esc_html_e( "Compare", "homepress" ); ?></h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="links_switch_box">
                            <?php $i = 0;
                            foreach ( $listing_types as $listing_type ): ?>
                                <?php
                                $active = "";
                                if( ( $i == 0 AND !$listing_type_id ) OR ( $listing_type_id == $listing_type->ID ) )
                                    $active = "active";
                                ?>
                                <a class="nav-link <?php echo esc_attr( $active ); ?>"
                                   href="<?php echo esc_url( $page_url . "?listing_type_id=" . $listing_type->ID ) ?>">
                                    <span class="title-link"><?php echo esc_html( $listing_type->post_title ); ?></span>
                                    <span class="count-link">
                                        <?php echo esc_attr($listing_type->lisitng_total_count); ?>
                                    </span>
                                </a>
                                <?php $i++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="compare_table_columns homepress_loading_preloader preloader_show">
                <div class="preloader_text"><?php esc_html_e( 'Loading', 'homepress' ); ?></div>
                <div class="compare_left_columns">
                    <div class="compare_title" data-index="title">
                        <?php esc_html_e( 'Attributes', 'homepress' ); ?>
                    </div>
                    <div class="compare_thumbnail compare_thumbnail_empty" data-index="image">

                    </div>
                    <div class="compare_attributes">
                        <?php foreach ( $listing_type_attributes as $listing_type_attribute ): ?>
                            <div class="compare_attribute_title"
                                 data-index="<?php echo sanitize_title( $listing_type_attribute->title ); ?>">
                                <?php echo esc_attr( $listing_type_attribute->title ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="compare_right_columns">
                    <div class="row">
                        <?php foreach ( $listings as $listing ): ?>
                            <div class="compare_right_column">
                                <div class="compare_title" data-index="title">
                                    <a href="<?php echo esc_url( get_permalink( $listing->ID ) ); ?>"><?php echo esc_attr( $listing->post_title ); ?></a>
                                </div>
                                <div class="compare_thumbnail" data-index="image">
                                    <?php foreach ( $listing->getCategory() as $category ) : ?>
                                        <div class="inventory_category inventory_category_style_1"><?php echo esc_attr( $category->name ); ?></div>
                                    <?php endforeach; ?>

	                                <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $listing->ID ), [ '300', "200" ] );?>

	                                <?php  if(!empty($thumb)) : ?>
		                                <img src="<?php echo esc_url( $thumb[ 0 ] ); ?>" alt="<?php echo esc_attr( $listing->post_title ); ?>"/>
	                                <?php  else : ?>
		                                <img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-ulisting.png" ?>" alt="<?php echo esc_attr( $listing->post_title ); ?>" />
	                                <?php  endif; ?>

                                    <a href="javascript:void(0);" class="homepress-button"
                                       onclick="remove_listing_compare(<?php echo esc_attr( $listing->ID ); ?>)"><?php esc_html_e( "Remove", "homepress" ) ?></a>
                                </div>
                                <div class="compare_attributes">
                                    <?php foreach ( $listing_type_attributes as $listing_type_attribute ): ?>
                                        <div class="compare_attribute_title"
                                             data-index="<?php echo sanitize_title( $listing_type_attribute->title ); ?>">
                                            <?php echo esc_attr( $listing_type_attribute->title ); ?>
                                        </div>
                                        <div class="compare_attribute"
                                             data-index="<?php echo sanitize_title( $listing_type_attribute->title ); ?>">
                                            <?php echo \uListing\ListingCompare\Classes\UlistingListingCompare::render_attribute_value( $listing, $listing_type_attribute ); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if( empty( $listing_types ) ) : ?>
            <h2><?php echo esc_html_e( "Compare", "homepress" ); ?></h2>
            <div class="container account-payment_history_empty"><h3><?php esc_html_e( "You don't have any item in compare.", "homepress" ) ?></h3></div>
        <?php endif; ?>
    </div>
</div>