<?php
/**
 * Components fields range
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/range.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.3
 */
if( $min == $max )
    $min = 0;

?>
<?php if( $model ): ?>
    <stm-field-range inline-template
                     data-v-bind_key="generateRandomId()"
                     data-v-model='<?php echo esc_attr( $model ); ?>'
                     data-v-bind_callback_change='<?php echo esc_attr( $callback_change ); ?>'
                     prefix='<?php echo esc_attr( $prefix ); ?>'
                     suffix='<?php echo esc_attr( $suffix ); ?>'
                     min='<?php echo esc_attr( $min ); ?>'
                     max='<?php echo esc_attr( $max ); ?>'>
        <div class="inventory-range-filter">
            <div class="container">
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_range_before = apply_filters( "stm-field-range-before", [ 'model' => $model, 'prefix' => $prefix, 'field' => $field ] );
                    echo ( !is_array( $field_range_before ) ) ? $field_range_before : "";
                } ?>

                <div class="filter-range-fields">
                    <input type="text" data-v-model="from" data-v-on_change="setValue(from+';'+to)"
                           data-v-on_keyup="setValue(from+';'+to)">
                    <input type="text" data-v-model="to" data-v-on_change="setValue(from+';'+to)"
                           data-v-on_keyup="setValue(from+';'+to)">
                </div>

                <vue-range-slider data-v-bind_min="min"
                                  data-v-bind_max="max"
                                  data-v-bind_from="cloneFrom"
                                  data-v-bind_to="cloneTo"
                                  type="double"
                                  data-v-bind_prefix="prefix"
                                  data-v-bind_postfix="suffix"
                                  data-v-on_callback='updateValue'
                                  data-v-bind_key="generateRandomId()">
                </vue-range-slider>

                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_range_after = apply_filters( "stm-field-range-after", [ 'model' => $model, 'prefix' => $prefix, 'field' => $field ] );
                    echo ( !is_array( $field_range_after ) ) ? $field_range_after : "";
                } ?>
            </div>
        </div>
    </stm-field-range>
<?php endif; ?>
