<?php wp_enqueue_script( 'ulisting/single/mortgage_calc/calc_link' ); ?>

<a href="#mortgage_calc_popup" class="calc-in-popup">
    <div class="title">Home Loan Calculator</div>
    <div class="mortgage_calc_info">
        <div class="results">
            <span class="calc-info-month"></span><?php esc_html_e( ' / month', 'homepress' ); ?> <em><?php esc_html_e( 'repayment', 'homepress' ); ?></em> <span class="property-icon-info"></span>
        </div>
        <div class="subtitle"><span><?php esc_html_e( 'Calculate', 'homepress' ); ?></span></div>
    </div>
</a>
<div class="mortgage_calc_popup_box">
    <?php echo do_shortcode( "[mortgage_calc price='" . $price . "' settings='". esc_attr( $currency_settings ) ."' ]"); ?>
    <div class="mortgage_calc_popup_close"></div>
</div>