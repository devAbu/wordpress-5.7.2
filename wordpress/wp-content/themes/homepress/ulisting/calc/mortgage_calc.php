<?php
/**
 * Listing single single
 *
 * Template can be modified by copying it to yourtheme/ulisting/listing-single/single.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
wp_enqueue_script( 'ulisting/single/mortgage_calc/mortgage_calc' );
$price = ( isset( $params['price'] ) ) ?  $params['price'] : 0;
$settings = ( isset( $params['settings'] ) ) ?  $params['settings'] : '';
$currency = ( isset( $params['currency'] ) ) ?  $params['currency'] : '$';
$style = ( isset( $params['style'] ) ) ?  $params['style'] : 'style_1';

$data = [
    "settings" => $settings,
    "price" => (float) $price,
    "period" => [
                    'Monthly' =>  __('Monthly', 'homepress'),
                    'Semi-Monthly' =>  __('Semi-Monthly', 'homepress'),
                    'Bi-Weekly' =>  __('Bi-Weekly', 'homepress'),
                    'Weekly' =>  __('Weekly', 'homepress'),
                ]
    ];


wp_add_inline_script('ulisting/single/mortgage_calc/mortgage_calc', "var mortgage_calc_data = json_parse('". ulisting_convert_content(json_encode($data)) ."');", 'before');
?>

<div id="mortgage_calc" class="<?php echo esc_attr( $style ); ?>">

    <div class="mortgage_calc_box">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label>
                    <label><?php esc_html_e( 'Total Amount', 'homepress' ); ?></label>
                    <calc_field  v-model="homeValue" :settings="settings" :step="1000" currency="<?php echo esc_attr( $currency ); ?>"/>
                </label>
                <label>
                    <label><?php esc_html_e( 'Down Payment', 'homepress' ); ?></label>
                    <calc_field v-model="downpayment" :settings="settings" :step="1000" currency="<?php echo esc_attr( $currency ); ?>"/>
                </label>
                <label>
                    <label><?php esc_html_e( 'Interest Rate', 'homepress' ); ?></label>
                    <calc_field v-model="interestRate" :settings="settings" :step="0.001" type="percent" decimals="3" />
                </label>
                <label>
                    <label><?php esc_html_e( 'Amortization Period', 'homepress' ); ?></label>
                    <calc_field v-model="amortization" :settings="settings" :step="1" type="years" />
                </label>
                <label>
                    <label><?php esc_html_e( 'Payment Period', 'homepress' ); ?></label>
                    <ulisting-select2 class="form-control" v-model="paymentSelection">
                        <option v-for="payment, key in paymentPeriod" :value="key">{{key}}</option>
                    </ulisting-select2>
                </label>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="payment-result">
                    <label>
                        <?php esc_html_e( 'Payments:', 'homepress' ); ?> <span class="payments-of-month">{{formatAsCurrency(payment, 2, '<?php echo esc_attr( $currency ); ?>', <?php echo esc_attr($settings)?>)}}</span>
                        <a href="javascript:void(0);" title="Estimated, not including taxes and insurance." class="calc-payment-info-box">
                            <span class="property-icon-info"></span>
                            <div class="calc-payment-info">
                                <?php esc_html_e( 'Estimated, not including taxes and insurance.', 'homepress' ); ?>
                            </div>
                        </a>
                    </label>
                </div>
                <div class="calc-results">
                    <div class="calc-result">
                        <div class="calc-result-name"><?php esc_html_e( 'Total cost of loan', 'homepress' ); ?></div>
                        <div class="calc-result-value">{{formatAsCurrency(totalCostOfMortgage, 0, '<?php echo esc_attr( $currency ); ?>', <?php echo esc_attr($settings)?>)}}</div>
                    </div>

                    <div class="calc-result">
                        <div class="calc-result-name"><?php esc_html_e( 'Total Interest Paid', 'homepress' ); ?></div>
                        <div class="calc-result-value">{{formatAsCurrency(interestPayed, 0, '<?php echo esc_attr( $currency ); ?>', <?php echo esc_attr($settings)?>)}}</div>
                    </div>

                    <div class="calc-result">
                        <div class="calc-result-name"><?php esc_html_e( 'Payment', 'homepress' ); ?></div>
                        <div class="calc-result-value">{{paymentSelection}}</div>
                    </div>

                    <div class="calc-result">
                        <div class="calc-result-name"><?php esc_html_e( 'Mortgage Payment', 'homepress' ); ?></div>
                        <div class="calc-result-value">{{formatAsCurrency(payment, 2, '<?php echo esc_attr( $currency ); ?>', <?php echo esc_attr($settings)?>)}}</div>
                    </div>

                    <?php if( $style != 'style_2' ) : ?>
                    <div class="calc-schedule">
                        <svg viewBox="0 0 560 300">

                            <g class="dates">
                                <line x1="0" y1="1" x2="500" y2="1"/>
                                <g v-for="index in amortization">
                                    <line y1="0" :y2="index % 5 === 0 ? 10 : 5" v-bind="{ 'x1':index*500/(amortization), 'x2':index*500/(amortization) }"/>
                                    <text v-if="index % (amortization < 55 ? 5 : 10) === 0" v-bind="{ 'x':(index-0.4)*500/(amortization), 'y':30 }">{{ index }}</text>
                                </g>
                            </g>

                            <g class="schedule">
                                <rect v-for="p in amortizationGraphBars(500,250)" v-bind="p" @mouseMove="setHover(p, $event)" @mouseOut="graphSelection.visible = false"></rect>
                            </g>

                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <span class="calc-close-button"></span>

    <div class="calc-schedule-detaile" v-if="graphSelection !== null" v-show="graphSelection.visible === true" :style="graphSelection.style">
        <?php esc_html_e( 'Year:', 'homepress' ); ?> {{ graphSelection.year }}<br/>
        <?php esc_html_e( 'Principal:', 'homepress' ); ?> {{ graphSelection.principal }} <br/>
        <?php esc_html_e( 'Remaining:', 'homepress' ); ?> {{ graphSelection.principalPercent }} <br/>
    </div>

</div>

<template id="calc_field">
    <input type="text" class="form-control" @keydown.up.prevent="increment" @keydown.down.prevent="decrement" :value="active?val:formatted" @blur="update" @keyup.enter.stop="update" @focus="active = true">
</template>