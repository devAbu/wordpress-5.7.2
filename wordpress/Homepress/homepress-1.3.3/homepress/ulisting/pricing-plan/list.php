<?php
/**
 * Pricing plan list
 *
 * Template can be modified by copying it to yourtheme/ulisting/pricing-plan/list.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.6.2
 */
use uListing\Lib\PricingPlan\Classes\StmPricingPlans;
?>

<?php if ( $plans ) : ?>
    <div class="pricing-plans_list">
        <h2 class="text-center"><?php esc_html_e( 'One time payment', 'homepress' ); ?></h2>
        <ul>
            <?php foreach ( $plans as $plan ) : ?>
                <?php $meta = $plan->getData();
                empty($meta['price']) && $meta['price'] = "0.00";
                ?>

                <?php if(!empty($meta['status']) && !empty($meta['duration']) && !empty($meta['duration_type']) && (!empty($meta['listing_limit']) || !empty($meta['feature_limit']))):?>
                    <li>
                        <div class="pricing-plan-box">
                            <div class="pricing-plan-title"><?php echo esc_attr( $plan->post_title ); ?></div>
                            <div class="pricing-plan-price"><?php echo ulisting_currency_format( $meta['price'] ); ?></div>
                            <div class="pricing-plan-description">
                                <?php echo html_entity_decode( $plan->post_content ); ?>
                            </div>
                            <div class="pricing-plan-info">
                                <p><?php echo esc_attr( $meta['feature_limit'] ); ?> <?php echo esc_attr( $meta['listing_limit'] ); ?> <?php esc_html_e( 'Listings', 'homepress' ); ?></p>
                                <p><?php echo esc_attr( $meta['duration'] ); ?> <?php echo esc_attr( $meta['duration_type'] ); ?> <?php esc_html_e( 'Duration', 'homepress' ); ?></p>
                                <p><?php esc_html_e( 'Status:', 'homepress' ); ?> <?php echo esc_attr( $meta['status'] ); ?></p>
                            </div>
                            <div class="pricing-plan-button">
                                <a href="<?php echo StmPricingPlans::get_page_url(); ?>?buy=<?php echo esc_attr( $plan->ID ); ?>" class="homepress-button homepress-button-full"><?php esc_html_e( 'Buy Now', 'homepress' ); ?></a>
                            </div>
                        </div>
                    </li>
                <?php endif;?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;?>
<?php if ( $subscription_plans ) : ?>
    <hr />

    <div class="pricing-plans_list">
        <h2 class="text-center"><?php esc_html_e( 'Subscription', 'homepress' ); ?></h2>
        <ul>
            <?php foreach ( $subscription_plans as $plan ) : ?>
                <?php $meta = $plan->getData();
                empty($meta['price']) && $meta['price'] = "0.00";
                ?>
                <li>
                    <div class="pricing-plan-box">
                        <div class="pricing-plan-title"><?php echo esc_attr( $plan->post_title ); ?></div>
                        <div class="pricing-plan-price"><?php echo ulisting_currency_format( $meta['price'] ); ?></div>
                        <div class="pricing-plan-description">
                            <?php echo html_entity_decode( $plan->post_content ); ?>
                        </div>
                        <div class="pricing-plan-info">
                            <p><?php echo esc_attr( $meta['listing_limit'] ); ?> <?php esc_html_e( 'Listings', 'homepress' ); ?></p>
                            <p><?php echo esc_attr( $meta['feature_limit'] ); ?> <?php esc_html_e( 'Features', 'homepress' ); ?></p>
                            <p><?php echo esc_attr( $meta['duration'] ); ?> <?php echo esc_attr( $meta['duration_type'] ); ?> <?php esc_html_e( 'Duration', 'homepress' ); ?></p>
                            <p><?php esc_html_e( 'Status:', 'homepress' ); ?> <?php echo esc_attr( $meta['status'] ); ?></p>
                        </div>
                        <div class="pricing-plan-button">
                            <a href="<?php echo StmPricingPlans::get_page_url(); ?>?buy=<?php echo esc_attr( $plan->ID ); ?>" class="homepress-button homepress-button-full"><?php esc_html_e( 'Buy Now', 'homepress' ); ?></a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;?>
<?php if ( empty($plans) && empty($subscription_plans) ):?>
<div style="width: 65%; text-align: center; margin: 20px auto;">
    <h3><?php esc_html_e( 'Pricing plans are currently under development. Please contact the site administrator for details.', 'homepress' ); ?></h3>
</div>
<?php endif;?>


