<?php
/**
 * Wishlist link
 *
 * Template can be modified by copying it to yourtheme/ulisting/wishlist/link.php
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
$wishlist_page = \uListing\Classes\StmListingSettings::getPages( "wishlist_page" );
?>
<a href="<?php echo esc_url( get_page_link( $wishlist_page ) ); ?>" id="ulisting-wishlist-link" class="wishlist-page-link">
	<span class="property-icon-heart-outline simple-icon"></span>
    <span class="wishlist-total ulisting-wishlist-total-count-all"><?php echo esc_attr( $total ); ?></span>
</a>
<ul class="ulisting-account-panel-dropdown-menu">
    <li>
        <a class="nav-link " href="<?php echo esc_url(get_page_link($wishlist_page))?>/wishlist-list">
            <?php esc_html_e( 'Wishlist', 'homepress' ); ?>
            <span class="badge badge-secondary ulisting-wishlist-total-count">0</span>
        </a>
    </li>
    <li>
        <a class="nav-link " href="<?php echo esc_url(get_page_link($wishlist_page))?>/saved-searches-list">
            <?php esc_html_e( 'Saved Searches', 'homepress' ); ?>
            <span class="badge badge-secondary ulisting-saved-searches-total-count">0</span>
        </a>
    </li>
</ul>