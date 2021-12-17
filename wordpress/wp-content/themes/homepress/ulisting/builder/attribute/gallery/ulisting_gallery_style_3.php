<?php
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'ulisting/single/gallery/style_3' );

foreach ( $model->getAttributeValue( $element[ 'params' ][ 'attribute' ] ) as $val ) {
    $full = wp_get_attachment_image_src( $val->value, 'full' );
    $single = wp_get_attachment_image_src( $val->value, 'homepress-image-ulisting-gallery_style_3' );
    $thumbnail = wp_get_attachment_image_src( $val->value, 'homepress-image-ulisting-gallery_thumb_style_3' );

    if( !empty($gallery_items[ 0 ]) && $gallery_items[ 0 ] ) {
        $gallery_items[] = [
            'value' => $val->value,
            'sort' => $val->sort,
            'full' => ( $full ) ? $full : [ ulisting_get_placeholder_image_url() ],
            'single' => ( $single ) ? $single : [ ulisting_get_placeholder_image_url() ],
            'thumbnail' => ( $single ) ? $single : [ ulisting_get_placeholder_image_url() ],
        ];
    } else {
        $gallery_items[] = [
            'value' => $val->value,
            'sort' => $val->sort,
            'full' => ( $full ) ? $full : [ ulisting_get_placeholder_image_url() ],
            'single' => ( $single ) ? $single : [ ulisting_get_placeholder_image_url() ],
            'thumbnail' => ( $thumbnail ) ? $thumbnail : [ ulisting_get_placeholder_image_url() ],
        ];
    }
}
\uListing\Classes\Vendor\ArrayHelper::multisort( $gallery_items, "sort" );

$new_array = [];
if( !empty( $gallery_items[ 0 ] ) ) {
    $new_array[] = array( $gallery_items[ 0 ] );
    array_shift( $gallery_items );
}

$gallery_items = array_merge( $new_array, array_chunk( $gallery_items, 9 ) );
?>
<?php if( !empty( $gallery_items ) ) : ?>
    <div class="listing-gallery_<?php echo esc_attr( $element['id'] ); ?> listing-gallery_style_3">
        <div class="listing-gallery-thumbnail-box">
            <div class="listing-gallery-thumbnail owl-carousel owl-theme">

                <?php foreach ( $gallery_items as $group_gallery_item ) : ?>
                    <div class="gallery-group">
                        <?php foreach ( $group_gallery_item as $gallery_item ) : ?>
                            <div class="item">
                                <a target="_blank" href="<?php echo esc_url( $gallery_item[ 'full' ][ 0 ] ); ?>" data-elementor-lightbox-slideshow="listing-gallery-thumbnail-<?php echo esc_attr( $element['id'] ); ?>">
                                    <img src="<?php echo esc_url( $gallery_item[ 'thumbnail' ][ 0 ] ); ?>"
                                         alt="<?php echo esc_attr( get_post_meta( $gallery_item[ 'value' ], '_wp_attachment_image_alt', true ) ); ?>"/>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php endif; ?>