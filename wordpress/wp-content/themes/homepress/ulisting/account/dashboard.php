<?php
/**
 * Account dashboard
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/dashboard.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmUser;

$user = new StmUser( $user );
?>

<?php StmListingTemplate::load_template( 'account/navigation', ['user' => $user], true );?>

<div class="account-user-box">
    <div class="container">
        <div class="user-personal-info-top">
            <?php if( !empty( $user->nickname ) ) { ?><h2 class="page-title"><?php echo esc_attr( $user->nickname ); ?></h2><?php } ?>
            <?php if( !empty( $user->address ) ) { ?><p><?php echo esc_attr( $user->address ); ?></p><?php } ?>
        </div>
        <div class="user-personal-info-middle">
            <?php if( !empty( $user->getAvatarUrl() ) ) : ?>
                <div class="avatar"><img src="<?php echo esc_url( $user->getAvatarUrl() ); ?>" alt="<?php echo esc_attr( $user->user_login ); ?>" /></div>
            <?php else: ?>
                <div class="avatar"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-ulisting.png" ?>" alt="<?php echo esc_attr( $user->user_login ); ?>" /></div>
            <?php endif;?>
            <div class="info">
                <?php if( !empty( $user->phone_mobile ) || !empty( $user->phone_office ) || !empty( $user->fax ) ) { ?>
                    <div class="stm-col-12 stm-col-md-12">
                        <div class="user_phone_box">
                            <span class="user_phone_box_icon property-icon-phone-small"></span>
                            <?php if( !empty( $user->phone_mobile ) ) { ?>
                                <div class="user_phone_box_field">
                                    <span class="user_phone_box_label"><?php esc_html_e( 'Mobile:', 'homepress' ); ?></span>
                                    <span class="user_phone_box_value"><?php echo esc_attr( $user->phone_mobile ); ?></span>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $user->phone_office ) ) { ?>
                                <div class="user_phone_box_field">
                                    <span class="user_phone_box_label"><?php esc_html_e( 'Office:', 'homepress' ); ?></span>
                                    <span class="user_phone_box_value"><?php echo esc_attr( $user->phone_office ); ?></span>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $user->fax ) ) { ?>
                                <div class="user_phone_box_field">
                                    <span class="user_phone_box_label"><?php esc_html_e( 'Fax:', 'homepress' ); ?></span>
                                    <span class="user_phone_box_value"><?php echo esc_attr( $user->fax ); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if( !empty( $user->url ) ) { ?>
                    <div class="stm-col-12 stm-col-md-12">
                        <p><span class="property-icon-globe user_field_icon"></span> <?php esc_html_e( 'Website:', 'homepress' ); ?> <a href="<?php echo esc_url( $user->url ); ?>" target="_blank"><?php echo esc_attr( $user->url ); ?></a></p>
                    </div>
                <?php } ?>
                <?php if( !empty( $user->license ) ) { ?>
                    <div class="stm-col-12 stm-col-md-12">
                        <p><span class="property-icon-certificate user_field_icon"></span> <?php esc_html_e( 'License:', 'homepress' ); ?> <?php echo esc_attr( $user->license ); ?></p>
                    </div>
                <?php } ?>
                <?php if( !empty( $user->tax_number ) ) { ?>
                    <div class="stm-col-12 stm-col-md-12">
                        <p><span class="property-icon-tag user_field_icon"></span> <?php esc_html_e( 'Tax number:', 'homepress' ); ?> <?php echo esc_attr( $user->tax_number ); ?></p>
                    </div>
                <?php } ?>

                <?php do_action('ulisting-account-dashboard-top', [ 'user' => $user] ); ?>
                <?php do_action('ulisting-account-dashboard-center', [ 'user' => $user ]); ?>
                <?php do_action('ulisting-account-dashboard-bottom', [ 'user' => $user ]); ?>

                <ul class="user-personal-socials-box">
                    <?php if( !empty( $user->facebook ) ) { ?>
                        <li><a href="<?php echo esc_url( $user->facebook ); ?>" target="_blank" rel="nofollow"><span class="property-icon-facebook-f"></span></a></li>
                    <?php } ?>
                    <?php if( !empty( $user->twitter ) ) { ?>
                        <li><a href="<?php echo esc_url( $user->twitter ); ?>" target="_blank" rel="nofollow"><span class="property-icon-twitter"></span></a></li>
                    <?php } ?>
                    <?php if( !empty( $user->google_plus ) ) { ?>
                        <li><a href="<?php echo esc_url( $user->google_plus ); ?>" target="_blank" rel="nofollow"><span class="property-icon-google-plus-g"></span></a></li>
                    <?php } ?>
                    <?php if( !empty( $user->youtube_play ) ) { ?>
                        <li><a href="<?php echo esc_url( $user->youtube_play ); ?>" target="_blank" rel="nofollow"><span class="property-icon-youtube"></span></a></li>
                    <?php } ?>
                    <?php if( !empty( $user->linkedin ) ) { ?>
                        <li><a href="<?php echo esc_url( $user->linkedin ); ?>" target="_blank" rel="nofollow"><span class="property-icon-linkedin-in"></span></a></li>
                    <?php } ?>
                    <?php if( !empty( $user->instagram ) ) { ?>
                        <li><a href="<?php echo esc_url( $user->instagram ); ?>" target="_blank" rel="nofollow"><span class="property-icon-instagram"></span></a></li>
                    <?php } ?>

                </ul>

            </div>

            <div class="edit-account-button">
                <a class="homepress-button" href="<?php echo StmUser::getUrl("edit-profile"); ?>"><?php esc_html_e( 'Edit account', 'homepress' ); ?></a>
            </div>
        </div>
    </div>
</div>
