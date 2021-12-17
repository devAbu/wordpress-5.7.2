<?php
/**
 * Account my plans list
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/my-plans/list.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.6.2
 */
use uListing\Classes\StmUser;
use uListing\Classes\StmPaginator;
use uListing\Classes\StmListingTemplate;
use uListing\Lib\PricingPlan\Classes\StmUserPlan;
use uListing\Lib\PricingPlan\Classes\StmPricingPlans;

$limit = 5;
$page  = (get_query_var(ulisting_page_endpoint())) ? get_query_var(ulisting_page_endpoint()) : 0;
$active = ulisting_page_endpoint();

if( !($models = StmUserPlan::getList($limit, ($page > 1) ? (($page - 1) * $limit ) : 0, array('user_id' => get_current_user_id() ))) )
	$models = array();
?>

<?php StmListingTemplate::load_template( 'account/navigation', ['user' => $user], true ); ?>

<?php if( !empty( $models ) ) : ?>
<div class="container account-my-plans">
    <?php foreach ( StmUser::get_account_link( 'account-navigation' ) as $item ) : ?>
    <?php if( $active == $item['var'] ) { ?>
    <h2 class="page-title"><?php echo esc_html( $item['title'] ); ?></h2>
    <?php } ?>
    <?php endforeach; ?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><?php esc_html_e( "Plan", "homepress" )?></th>
            <th><?php esc_html_e( "Status", "homepress" )?></th>
            <th><?php esc_html_e( "Type", "homepress" )?></th>
            <th><?php esc_html_e( "Payment Type", "homepress" )?></th>
            <th><?php esc_html_e( "Expired", "homepress" )?></th>
            <th><?php esc_html_e( "Created", "homepress" )?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ( $models as $model ):
            $PricingPlan = $model->getPricingPlan();
            ?>
            <tr>
                <th scope="row" data-title="<?php esc_attr_e( "ID", "homepress" )?>"><?php echo esc_attr( $model->id ); ?></th>
                <td data-title="<?php esc_attr_e( "Name", "homepress" )?>"><?php echo esc_attr(isset($PricingPlan->post_title)) ? esc_attr($PricingPlan->post_title) : esc_html_e("Pricing Plan not found ","homepress") ?></td>
                <td data-title="<?php esc_attr_e( "Status", "homepress" )?>"><?php echo StmUserPlan::getStatus( $model->status ); ?></td>
                <?php if($model->payment_type !== \uListing\Lib\PricingPlan\Classes\StmPricingPlans::PRICING_PLANS_PAYMENT_TYPE_SUBSCRIPTION): ?>
                <td data-title="<?php esc_attr_e( "Type", "homepress" )?>"><?php echo StmPricingPlans::pricingPlansTypeListData( $model->type ); ?></td>
                <?php endif;?>
                <td data-title="<?php esc_attr_e( "Payment type", "homepress" )?>"><?php echo StmPricingPlans::pricingPaymentTypeListData( $model->payment_type ); ?></td>
                <td data-title="<?php esc_attr_e( "Expired", "homepress" )?>"><?php echo ulisting_convert_date_format( $model->expired_date ); ?></td>
                <td data-title="<?php esc_attr_e( "Created", "homepress" )?>"><?php echo ulisting_convert_date_format( $model->updated_date ).' '.ulisting_convert_time_format( $model->updated_date ); ?></td>
                <td data-title="<?php esc_attr_e( "View", "homepress" )?>">
                    <a href="<?php echo StmUser::getUrl( 'my-plans' ).'?id='.$model->id; ?>"><?php esc_html_e( "Detail", "homepress" )?></a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="stm-listing-pagination<?php if( $page == 0 ) {?> first-active<?php } ?>">
<?php
$paginator = new StmPaginator(
	StmUserPlan::getList( $limit, ($page > 1) ? (($page - 1) * $limit ) : 0, array( 'user_id' => get_current_user_id() ), true ),
	$limit,
	$page,
	StmUser::getUrl('my-plans').'/(:num)',
	array(
		'maxPagesToShow' => 8,
		'class' => 'pagination',
		'item_class' => 'nav-item',
		'link_class' => 'nav-link',
	)
);
echo html_entity_decode( $paginator );
?>
</div>

<?php else: ?>
    <div class="account-my-plans_empty">
        <h3><?php esc_html_e( 'You have no plans yet.', 'homepress' ); ?></h3>
        <h3><?php esc_html_e( 'But you can buy them.', 'homepress' ); ?></h3>
        <a class="homepress-button" href="<?php echo ulisting_get_page_link( 'pricing_plan' )?>"><?php _e('Buy plan', "homepress")?> </a>
    </div>
<?php endif; ?>