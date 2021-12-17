<?php
/**
 * Account
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/account.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmUser;

$user = null;
$view = 'account/profile';

if( is_user_logged_in() )
	$user = new StmUser( get_current_user_id() );

if(isset( $_GET['action']) AND $_GET['action'] == 'profile_edit' )
	$view = 'account/profile_edit';
?>

<?php if( !is_user_logged_in() ) : ?>
    <div class="container">
        <div class="stm-row">
            <div class="stm-col-12 stm-col-md-6">
                <?php get_template_part('ulisting/account/login_register' ); ?>
            </div>
            <div class="stm-col-12 stm-col-md-6">
                <?php  StmListingTemplate::load_template( 'account/register', null, true );?>
            </div>
        </div>
    </div>
<?php else:?>
	<?php echo StmListingTemplate::load_template( $view, array( 'user' => $user ), true ); ?>
<?php endif;?>














