<?php
/**
 * Aaved searches
 *
 * Template can be modified by copying it to yourtheme/ulisting/saved-searches/saved-searches.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */

$searches = \uListing\Classes\UlistingSearch::get_user_searches( get_current_user_id() );
?>

<?php if( !empty( $searches ) ) : ?>

    <div class="save_search_box">

        <div class="container">
            <?php foreach ( $searches as $search ): ?>
                <div class="save_search_box_row_wrap ulisting-search-item-<?php echo esc_attr( $search->id ) ?>">
                    <a target="_blank" class="save_search_view_results"
                       href="<?php echo esc_url( $search->get_url() ) ?>"><span class="property-icon-search"></span></a>
                    <div class="save_search_box_row">
                        <div class="save_search_box_column">
                            <div class="save_search_attribute_title"><?php esc_html_e( 'Type', 'homepress' ); ?></div>
                            <div class="save_search_attribute"><?php echo esc_attr( $search->get_listing_type()->post_title ) ?></div>
                        </div>
                        <?php foreach ( $search->get_params() as $attribute ): ?>
                            <div class="save_search_box_column">
                                <div class="save_search_attribute_title"><?php echo esc_attr( $attribute[ 'title' ] ) ?></div>
                                <div class="save_search_attribute"><?php echo ( is_array( $attribute[ 'value' ] ) ) ? implode( ', ', $attribute[ 'value' ] ) : $attribute[ 'value' ] ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <span onclick="delete_search(this, <?php echo esc_attr( $search->id ) ?>)"
                          class="save_search_box_remove property-icon-close-small"></span>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

<?php else : ?>
    <div class="account-payment_history_empty">
        <h3><?php esc_html_e( "You don't have any save searches.", 'homepress' ); ?></h3>
    </div>
<?php endif; ?>

