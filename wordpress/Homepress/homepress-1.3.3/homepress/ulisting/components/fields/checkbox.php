<?php
/**
 * Components fields checkbox
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/checkbox.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.2
 */
?>
<?php if( $model ) : ?>
    <stm-field-checkbox inline-template
                        data-v-bind_key="generateRandomId()"
                        data-v-model='<?php echo esc_attr( $model ) ?>'
                        order_by='<?php echo esc_html( $order_by ) ?>'
                        order='<?php echo esc_html( $order ) ?>'
                        data-v-bind_callback_change='<?php echo esc_attr( $callback_change ) ?>'
                        data-v-bind_items='<?php echo esc_attr( $items ) ?>'
                        data-v-bind_hide_empty='"<?php echo esc_attr( $hide_empty ) ?>"'
                        <?php echo isset($active_tab) ? "data-v-bind_current_tab='". esc_attr(   $active_tab  ) . "'>" : '>' ?>
        <div class="inventory-checkbox-filter drop-size-<?php echo esc_attr( $column ); ?>">
            <div class="container">
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_checkbox_before = apply_filters( "stm-field-default-before", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_checkbox_before ) ) ? $field_checkbox_before : "";
                } ?>
                <div class="stm-row">
                    <div class='homepress-checkbox stm-col-<?php echo 12 / $column; ?> checkbox-inpit'
                         data-v-for='(item, index) in list'>
                        <label>
                            <input data-v-on_change='updateValue' type='checkbox' data-v-bind_value='item.value'
                                   data-v-model='value'>
                            {{parser(item.name)}} <span> ({{typeof item.count === 'object' ? item.count[active_tab] : item.count}})</span>
                            <span class="checkbox-frame"><i class="fa fas fa-check"></i></span>
                        </label>
                    </div>
                </div>
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_checkbox_after = apply_filters( "stm-field-default-after", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_checkbox_after ) ) ? $field_checkbox_after : "";
                } ?>
            </div>
        </div>

    </stm-field-checkbox>
<?php endif; ?>