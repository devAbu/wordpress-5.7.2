<?php
/**
 * Account my agents
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/my-agents.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.4
 */

use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmUser;

$args = array(
	'number' => -1,
	'meta_key' => 'agency_id',
	'meta_value' => $user->ID,
	'order' => 'DESC'
);

$user_query = new WP_User_Query( $args );
?>
<?php StmListingTemplate::load_template( 'account/navigation', ['user' => $user], true );?>

<?php StmListingTemplate::load_template( 'account/my-agents/add', ['user' => $user], true );?>

<?php if ( !empty( $user_query->results ) ) { ?>
<div class="user_box-grid agent_grid container">
    <h3><?php echo esc_html__('My Agents', "homepress"); ?></h3>
	<div class="row">

        <?php foreach ( $user_query->results as $user ) : $user = $user->ID; $user = new StmUser( $user ); ?>

            <div class="col-lg-4 col-md-6 col-sm-12 col-sm">
                <div class="users_box">

                    <?php if (!empty( $user->getAvatarUrl() ) ) : ?>
                        <a href="<?php echo get_author_posts_url( $user->ID ); ?>" class="avatar">
                            <img src="<?php echo esc_url( $user->getAvatarUrl() ); ?>" alt="<?php echo esc_attr( $user->user_login ); ?>" />
                        </a>
                    <?php else : ?>
                    <div class="avatar">
                        <img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-ulisting.png" ?>" alt="<?php echo esc_attr( $user->user_login ); ?>" />
                    </div>
                    <?php endif; ?>
                    <div class="users_box_info">
                        <?php if( !empty( $user->nickname ) ) { ?>
                            <h6 class="user_title"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_attr( $user->nickname ); ?></a></h6>
                        <?php } ?>
                        <?php if( !empty( $user->address ) ) { ?>
                        <div class="user_address"><?php echo esc_attr( $user->address ); ?></div>
                        <?php } ?>
                        <?php if( !empty( $user->user_email ) ) { ?>
                            <div class="user_email"><span class="property-icon-envelope user_field_icon"></span> <?php esc_html_e( 'Email:', 'homepress' ); ?> <a href="mailto:--><?php echo esc_attr( $user->user_email ); ?>"><?php echo esc_attr( $user->user_email ); ?></a></div>
                        <?php } ?>
                        <?php if( !empty( $user->phone_mobile ) || !empty( $user->phone_office ) || !empty( $user->fax ) ) { ?>
                        <div class="users_phone_box">
                            <span class="users_phone_box_icon property-icon-phone-small"></span>
                            <?php if( !empty( $user->phone_mobile ) ) { ?>
                                <div class="users_phone_box_field">
                                    <span class="users_phone_box_label"><?php esc_html_e( 'Mobile:', 'homepress' ); ?></span>
                                    <span class="users_phone_box_value"><?php echo esc_attr( $user->phone_mobile ); ?></span>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $user->phone_office ) ) { ?>
                                <div class="users_phone_box_field">
                                    <span class="users_phone_box_label"><?php esc_html_e( 'Office:', 'homepress' ); ?></span>
                                    <span class="users_phone_box_value"><?php echo esc_attr( $user->phone_office ); ?></span>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $user->fax ) ) { ?>
                                <div class="users_phone_box_field">
                                    <span class="users_phone_box_label"><?php esc_html_e( 'Fax:', 'homepress' ); ?></span>
                                    <span class="users_phone_box_value"><?php echo esc_attr( $user->fax ); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <ul class="users-socials-box">
                            <?php if( !empty( $user->facebook ) ) { ?>
                                <li><a href="<?php echo esc_attr( $user->facebook ); ?>" target="_blank" rel="nofollow"><span class="property-icon-facebook-f"></span></a></li>
                            <?php } ?>
                            <?php if( !empty( $user->twitter ) ) { ?>
                                <li><a href="<?php echo esc_attr( $user->twitter ); ?>" target="_blank" rel="nofollow"><span class="property-icon-twitter"></span></a></li>
                            <?php } ?>
                            <?php if( !empty( $user->google_plus ) ) { ?>
                                <li><a href="<?php echo esc_attr( $user->google_plus ); ?>" target="_blank" rel="nofollow"><span class="property-icon-google-plus-g"></span></a></li>
                            <?php } ?>
                            <?php if( !empty( $user->youtube_play ) ) { ?>
                                <li><a href="<?php echo esc_attr( $user->youtube_play ); ?>" target="_blank" rel="nofollow"><span class="property-icon-youtube"></span></a></li>
                            <?php } ?>
                            <?php if( !empty( $user->linkedin ) ) { ?>
                                <li><a href="<?php echo esc_attr( $user->linkedin ); ?>" target="_blank" rel="nofollow"><span class="property-icon-linkedin-in"></span></a></li>
                            <?php } ?>
                            <?php if( !empty( $user->instagram ) ) { ?>
                                <li><a href="<?php echo esc_attr( $user->instagram ); ?>" target="_blank" rel="nofollow"><span class="property-icon-instagram"></span></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

	</div>
</div>
<?php } ?>