<?php
/**
 * Account account panel
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/account-panel.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.3.0
 */
use uListing\Classes\StmUser;

$active = ulisting_page_endpoint();

?>

<?php if( is_user_logged_in() ) : ?>
	<div class="ulisting-account-panel-wrap ulisting-account_<?php echo  esc_attr( $params['style'] ); ?>">
        <div class="ulisting-account-panel">
            <div class="ulisting-account-panel-avatar">
                <?php if( $user->getAvatarUrl() ) { ?>
                    <img src="<?php echo esc_url( $user->getAvatarUrl() ); ?>" alt="<?php echo esc_attr( $user->get('first_name') ); ?> <?php echo esc_attr( $user->get('last_name') ); ?>" />
                <?php } else { ?>
                    <span class="property-icon-user-2"></span>
                <?php } ?>
            </div>
            <div class="ulisting-account-panel-main">
                <?php echo esc_attr( $user->get('first_name') ); ?> <?php echo esc_attr( $user->get('last_name') ); ?>
            </div>

            <ul class="ulisting-account-panel-dropdown-menu position-right">
                <li>
                    <a class="nav-link" href="<?php echo StmUser::getProfileUrl()?>"><?php esc_html_e( 'My profile', "homepress" ); ?></a>
                </li>
                <?php foreach ( StmUser::get_account_link( 'account-navigation' ) as $item ) : ?>
                    <li>
                        <a class="nav-link <?php echo ( ulisting_page_endpoint() == $item['var'] ) ? 'active' : null; ?>" href="<?php echo StmUser::getUrl( $item['var'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                    </li>
                <?php endforeach; ?>
                <?php foreach (StmUser::get_account_link('account-panel') as $item):?>
                    <li>
                        <a class="nav-link <?php echo esc_attr($active == $item['var']) ? 'active':null?>" href="<?php echo StmUser::getUrl($item['var'])?>"><?php echo esc_html($item['title'])?></a>
                    </li>
                <?php endforeach;?>
                <li>
                    <a class="nav-link" href="<?php echo wp_logout_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Logout', 'homepress' ); ?></a>
                </li>
            </ul>
        </div>
	</div>
<?php else:?>
    <div class="ulisting-account-panel-wrap ulisting-account_<?php echo esc_attr( $params['style'] ); ?>">
        <div class="ulisting-account-panel">
            <div class="ulisting-account-panel-avatar">
                <span class="property-icon-user-2"></span>
            </div>
            <div class="ulisting-account-panel-main">
                <?php esc_html_e( "Login", "homepress" ); ?> / <?php esc_html_e( "Sign Up", "homepress" ); ?>
            </div>
            <div class="ulisting-account-panel-dropdown-menu login-box">
                <?php  get_template_part( 'ulisting/account/login' );?>
            </div>
        </div>
	</div>
<?php endif; ?>