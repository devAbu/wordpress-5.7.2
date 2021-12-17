<?php
/**
 * Components fields dropdown
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/dropdown.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.5
 */

if( $model ) : ?>
    <?php if( isset( $field[ 'label' ] ) ) {
        $field_serach_before = apply_filters( "stm-field-dropdown-default-before", [ 'model' => $model, 'field' => $field ] );
        echo ( !is_array( $field_serach_before ) ) ? $field_serach_before : "";
    } ?>

    <stm-field-dropdown inline-template
                        data-v-bind_key="generateRandomId()"
                        v-model='<?php echo esc_attr( $model ); ?>'
                        placeholder="<?php echo esc_attr( $placeholder ); ?>"
                        order_by='<?php echo esc_html( $order_by ); ?>'
                        order='<?php echo esc_html( $order ); ?>'
                        data-v-bind_callback_change='<?php echo esc_attr( $callback_change ); ?>'
                        data-v-bind_items='<?php echo esc_attr( $items ); ?>'
                        hide_empty='<?php echo esc_attr( $hide_empty ); ?>'
                        attribute_name='<?php echo esc_attr( $attribute_name ); ?>'>
        <div class="inventory-dropdown-filter">
            <div class="container">
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_dropdown_before = apply_filters( "stm-field-dropdown-before", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_dropdown_before ) ) ? $field_dropdown_before : "";
                } ?>
                <ulisting-select2 data-v-bind_key="generateRandomId()" data-v-bind_options='list'
                                  data-v-bind_placeholder="placeholder" data-v-model='value'
                                  theme='bootstrap4'></ulisting-select2>
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_dropdown_after = apply_filters( "stm-field-dropdown-after", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_dropdown_after ) ) ? $field_dropdown_after : "";
                } ?>
            </div>
        </div>
    </stm-field-dropdown>


    <?php if( isset( $field[ 'label' ] ) ) {
        $field_serach_after = apply_filters( "stm-field-dropdown-default-after", [ 'model' => $model, 'field' => $field ] );
        echo ( !is_array( $field_serach_after ) ) ? $field_serach_after : "";
    }?>
<?php endif; ?>


