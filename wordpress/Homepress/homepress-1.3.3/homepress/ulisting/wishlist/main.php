<?php
if( empty( $endpoint ) )
    $endpoint = 'wishlist-list'
?>

<div class="title_tabs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <?php
            switch ( $endpoint ) {
                case "wishlist-list":
                    echo '<h2>';
                    echo esc_html_e( "Wishlist", "homepress" );
                    echo '</h2>';
                    break;
                case "saved-searches-list":
                    echo '<h2>';
                    echo esc_html_e( "Saved searches", "homepress" );
                    echo '</h2>';
                    break;
            }
            ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="links_switch_box">
                    <a href="<?php echo esc_url( $wishlist_page_url ) ?>/wishlist-list"
                       class="nav-link <?php echo ( 'wishlist-list' == $endpoint ) ? 'active' : null ?>">
                        <span class="title-link"><?php esc_html_e( "Wishlist", "homepress" ) ?></span>
                        <span class="count-link ulisting-wishlist-total-count">0</span>
                    </a>

                    <a href="<?php echo esc_url( $wishlist_page_url ) ?>/saved-searches-list"
                       class="nav-link <?php echo ( 'saved-searches-list' == $endpoint ) ? 'active' : null ?>">
                        <span class="title-link"><?php esc_html_e( "Saved searches", "homepress" ) ?></span>
                        <span class="count-link ulisting-saved-searches-total-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-content">
    <div class="tab-pane fade show active">
        <?php
        switch ( $endpoint ) {
            case "wishlist-list":
                do_action( 'ulisting-wishlist-render-page' );
                break;
            case "saved-searches-list":
                do_action( 'ulisting-saved-searches-render-page' );
                break;
        }
        ?>
    </div>
</div>


