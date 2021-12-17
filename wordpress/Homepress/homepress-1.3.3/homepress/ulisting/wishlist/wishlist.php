<?php
/**
 * Wishlist
 *
 * Template can be modified by copying it to yourtheme/ulisting/wishlist/wishlist.php
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.1
 */

$view_type = "grid";
?>
<?php foreach ( $listing_types as $listing_type ): ?>
    <?php
    $sections = [];
    $item_class = "ulisting-item-list ";
    $wishlist_item_class = "";
    if( ( $listing_item_card_layout = get_post_meta( $listing_type->ID, 'stm_listing_item_card_' . $view_type ) ) AND isset( $listing_item_card_layout[ 0 ] ) ) {
        $listing_item_card_layout = maybe_unserialize( $listing_item_card_layout[ 0 ] );
        $config = $listing_item_card_layout[ 'config' ];
        $sections = $listing_item_card_layout[ 'sections' ];
        if( isset( $config[ 'template' ] ) )
            $item_class .= $config[ 'template' ];

        if( isset( $config[ 'column' ] ) ) {
            foreach ( $config[ 'column' ] as $key => $val ) {
                if( $key == 'extra_large' )
                    $wishlist_item_class .= " stm-col-xl-" . ( 12 / $val );
                if( $key == 'large' )
                    $wishlist_item_class .= " stm-col-lg-" . ( 12 / $val );
                if( $key == 'medium' )
                    $wishlist_item_class .= " stm-col-md-" . ( 12 / $val );
                if( $key == 'small' )
                    $wishlist_item_class .= " stm-col-sm-" . ( 12 / $val );
                if( $key == 'extra_small' )
                    $wishlist_item_class .= " stm-col-" . ( 12 / $val );
            }
        } else
            $wishlist_item_class .= " stm-col-12";
    }
    ?>
    <div class="container wishlist_box">
        <h6><?php echo esc_attr( $listing_type->post_title ); ?></h6>
        <div class="stm-row">
            <?php foreach ( $listing_type->listings as $listing ): ?>
                <div id="ulisting-wishlist-item-<?php echo esc_attr( $listing->ID ) ?>" data-hidden-class="hidden"
                     class="<?php echo esc_attr( $wishlist_item_class ) ?>">
                    <?php
                    \uListing\Classes\StmListingTemplate::load_template( 'loop/loop', [
                        'model' => $listing,
                        'view_type' => $view_type,
                        'listingType' => $listing_type,
                        'item_class' => $item_class,
                        'listing_item_card_layout' => $sections
                    ], true );
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<?php if( empty( $listing_types ) ) : ?>
    <div class="container account-payment_history_empty"><h3><?php esc_html_e( "You don't have any item in wishlist.", "homepress" ) ?></h3></div>
<?php endif; ?>