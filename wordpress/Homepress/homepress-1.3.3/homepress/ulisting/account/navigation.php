<?php
/**
 * Account navigation
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/navigation.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.3.0
 */
use uListing\Classes\StmUser;
?>

<div class="account-nav-box">
    <div class="container">
        <ul class="nav nav-tabs">
            <li>
                <a class="nav-link <?php echo ( ulisting_page_endpoint() == $item['var'] ) ? 'active' : null; ?>" href="<?php echo StmUser::getProfileUrl()?>"><?php esc_html_e( 'My profile', "homepress" ); ?></a>
            </li>
            <?php foreach ( StmUser::get_account_link( 'account-navigation' ) as $item ) : ?>
            <li>
                <a class="nav-link <?php echo ( ulisting_page_endpoint() == $item['var'] ) ? 'active' : null; ?>" href="<?php echo StmUser::getUrl( $item['var'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>