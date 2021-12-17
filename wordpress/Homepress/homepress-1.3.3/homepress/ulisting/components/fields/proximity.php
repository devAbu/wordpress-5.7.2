<?php
/**
 * Components fields proximity
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/proximity.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.3
 */
?>
<?php if( $model ) : ?>
    <stm-field-proximity inline-template
                         data-v-bind_key="generateRandomId()"
                         v-model='<?php echo esc_attr( $model ); ?>'
                         data-v-bind_callback_change='<?php echo esc_attr( $callback_change ); ?>'
                         units='<?php echo esc_attr( $units === 'miles' ? 'mi' : 'km' ); ?>'
                         min='<?php echo esc_attr( $min ); ?>'
                         max='<?php echo esc_attr( $max ); ?>'>
        <div class="inventory-proximity-filter">
            <div class="container">
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_range_before = apply_filters( "stm-field-proximity-before", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_range_before ) ) ? $field_range_before : "";
                } ?>

                <vue-range-slider data-v-bind_key="generateRandomId()" data-v-bind_min="min" data-v-bind_max="max"
                                  data-v-bind_postfix="' '+units" data-v-bind_from="value"
                                  data-v-on_callback='updateValue'></vue-range-slider>
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_range_after = apply_filters( "stm-field-proximity-after", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_range_after ) ) ? $field_range_after : "";
                } ?>
            </div>
        </div>
    </stm-field-proximity>
<?php endif; ?>