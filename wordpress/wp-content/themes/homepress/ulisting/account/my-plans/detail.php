<?php
/**
 * Account my plans detail
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/my-plans/detail.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.6.2
 */
\uListing\Lib\PricingPlan\Classes\StmUserPlan::updateStatusPlanForExpired();
use uListing\Classes\StmListingTemplate;

$plan = $user_plan->getPricingPlan();
$data = array(
	'user_plan_id' => $user_plan->id,
	'cancel_url'   => get_site_url(null, "/api/pricing-plan/user-plan/cancel"),
	'user_id'      => $user->ID
);
wp_add_inline_script('user-plan-detail', "var user_plan_detail_data = json_parse('". ulisting_convert_content(json_encode($data)) ."');", 'before');
?>

<?php StmListingTemplate::load_template( 'account/navigation', ['user' => $user], true );?>

<div id="user-plan-detail">
    <div class="container">
        <h2><?php echo isset($plan->post_title) ? esc_attr( $plan->post_title ) : esc_attr('Plan not found'); ?></h2>

        <div class="stm-row">
            <div class="stm-col-3"><label><?php esc_html_e( 'Plan:', 'homepress' ); ?></label></div>
            <div class="stm-col-4"><?php echo isset($plan->post_title) ? esc_attr( $plan->post_title ) : esc_attr('Plan not found'); ?></div>
        </div>

        <div class="stm-row">
            <div class="stm-col-3"><label><?php esc_html_e( 'Status', 'homepress' ); ?></label></div>
            <div class="stm-col-4"><?php echo \uListing\Lib\PricingPlan\Classes\StmUserPlan::getStatus($user_plan->status)?></div>
        </div>

        <?php if($user_plan->payment_type !== \uListing\Lib\PricingPlan\Classes\StmPricingPlans::PRICING_PLANS_PAYMENT_TYPE_SUBSCRIPTION): ?>
        <div class="stm-row">
            <div class="stm-col-3"><label><?php esc_html_e( 'Type', 'homepress' ); ?></label></div>
            <div class="stm-col-4"><?php echo \uListing\Lib\PricingPlan\Classes\StmPricingPlans::pricingPlansTypeListData($user_plan->type)?></div>
        </div>
        <?php endif;?>

        <div class="stm-row">
            <div class="stm-col-3"><label><?php esc_html_e( 'Payment type', 'homepress' ); ?></label></div>
            <div class="stm-col-4"><?php echo \uListing\Lib\PricingPlan\Classes\StmPricingPlans::pricingPaymentTypeListData($user_plan->payment_type)?></div>
        </div>

        <div class="stm-row">
            <div class="stm-col-3"><label><?php esc_html_e( 'Expired date', 'homepress' ); ?></label></div>
            <div class="stm-col-4">
                <?php echo  date_i18n( get_option( 'date_format' ), strtotime( $user_plan->expired_date ) );?>
                <?php echo  date_i18n( get_option( 'time_format' ), strtotime( $user_plan->expired_date ) );?>
            </div>
        </div>

        <div class="stm-row">
            <div class="stm-col-3"><label><?php esc_html_e( 'Created date', 'homepress' ); ?></label></div>
            <div class="stm-col-4">
                <?php echo  date_i18n( get_option( 'date_format' ), strtotime( $user_plan->created_date ) );?>
                <?php echo  date_i18n( get_option( 'time_format' ), strtotime( $user_plan->created_date ) );?>
            </div>
        </div>

        <hr>

        <p v-if="message"> {{message}}</p>

        <?php if( (
                   $user_plan->status == \uListing\Lib\PricingPlan\Classes\StmUserPlan::STATUS_ACTIVE ||
                   $user_plan->status == \uListing\Lib\PricingPlan\Classes\StmUserPlan::STATUS_PENDING ||
                   $user_plan->status == \uListing\Lib\PricingPlan\Classes\StmUserPlan::STATUS_INACTIVE
                  ) AND !$user_plan->getMeta('canceled') ):?>
        <div>
            <div v-if="loading" class="text-center">
                <div class="stm-spinner"> <div></div> <div></div> <div></div> <div></div> <div></div> </div>
            </div>

            <button v-if="!loading" @click="user_plan_cancel" class="homepress-button"><?php esc_html_e( 'Cancel', 'homepress' ); ?></button>
        </div>
        <?php elseif( $user_plan->getMeta('canceled') ) : ?>
            <?php echo esc_attr( $user_plan->getMeta('canceled')->meta_key ); ?>
        <?php endif;?>

    </div>
</div>
