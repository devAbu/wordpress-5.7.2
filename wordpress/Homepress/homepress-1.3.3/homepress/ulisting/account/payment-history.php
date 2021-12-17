<?php
/**
 * Account payment history
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/payment-history.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.3.7
 */
use uListing\Classes\StmUser;
use uListing\Classes\StmPaginator;
use uListing\Classes\StmListingTemplate;
use uListing\Lib\PricingPlan\Classes\StmPayment;

$limit = 5;
$page  = (get_query_var(ulisting_page_endpoint())) ? get_query_var(ulisting_page_endpoint()) : 0;
$active = ulisting_page_endpoint();

if( !($payments = StmPayment::getPayments($limit, ($page > 1) ? (($page - 1) * $limit ) : 0, array('user_id' => get_current_user_id() ))) )
	$payments = array();
?>

<?php StmListingTemplate::load_template( 'account/navigation', ['user' => $user], true );?>

<?php if( !empty( $payments ) ) : ?>
<div class="container account-payment_history">
    <?php foreach ( StmUser::get_account_link( 'account-navigation' ) as $item ) : ?>
        <?php if( $active == $item['var'] ) { ?>
            <h2 class="page-title">
                <?php echo esc_html( $item['title'] ); ?>
            </h2>
        <?php } ?>
    <?php endforeach; ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th><?php esc_html_e( "Payment method", "homepress" ); ?></th>
                <th><?php esc_html_e( "Status", "homepress" ); ?></th>
                <th><?php esc_html_e( "Transaction", "homepress" ); ?></th>
                <th><?php esc_html_e( "Amount", "homepress" ); ?></th>
                <th><?php esc_html_e( "Created", "homepress" ); ?></th>
                <th><?php esc_html_e( "Updated", "homepress" ); ?></th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ( $payments as $payment ):
            $transaction = ulisting_is_empty($payment->transaction);
            ?>
            <tr>
                <th data-title="ID"><?php echo esc_attr( $payment->id ); ?></th>
                <td data-title="<?php esc_attr_e( "Payment method", "homepress" ); ?>"><?php echo StmPayment::getPaymentMethodList( $payment->payment_method ); ?></td>
                <td data-title="<?php esc_attr_e( "Status", "homepress" ); ?>"><?php  echo StmPayment::getStatus( $payment->status ) ?></td>
                <td data-title="<?php esc_attr_e( "Transaction", "homepress" ); ?>"><?php echo esc_attr( $transaction ); ?></td>
                <td data-title="<?php esc_attr_e( "Amount", "homepress" ); ?>"><span style="text-transform: uppercase"><?php echo esc_attr( $payment->amount.' '.$payment->getDate( 'currency' ) ); ?></span></td>
                <td data-title="<?php esc_attr_e( "Created", "homepress" ); ?>"><?php echo ulisting_convert_date_format( $payment->created_date ).' '.ulisting_convert_time_format( $payment->created_date ); ?></td>
                <td data-title="<?php esc_attr_e( "Updated", "homepress" ); ?>"><?php echo ulisting_convert_date_format( $payment->updated_date ).' '.ulisting_convert_time_format( $payment->updated_date ); ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <div class="stm-listing-pagination<?php if( $page == 0 ) {?> first-active<?php } ?>">
    <?php
        $paginator = new StmPaginator(
            StmPayment::getPayments(null, null, array( 'user_id' => get_current_user_id() ), true ),
            $limit,
            $page,
            StmUser::getUrl( 'payment-history' ).'/(:num)',
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
</div>
<?php else: ?>
    <div class="account-payment_history_empty">
        <h3><?php esc_html_e( "You don't have any invoices.", 'homepress' ); ?></h3>
    </div>
<?php endif; ?>