<?php
/**
 * Components fields search
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/search.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0.4
 */
?>
<?php if( $model ) : ?>
    <stm-field-search inline-template
        v-model='<?php echo esc_attr($model)?>'
        placeholder="<?php echo esc_html($placeholder)?>"
        data-v-bind_callback_change='<?php echo esc_attr($callback_change)?>' >
        <div class="inventory-serach-filter">
            <div class="container">
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_serach_before = apply_filters( "stm-field-search-before", [ 'model' => $model, 'field' => $field ] );
                    echo ( !is_array( $field_serach_before ) ) ? $field_serach_before : "";
                } ?>
                <input id="unical-id-for-search-box" class="inventory-text-field" type="text" data-v-model="value" data-v-on_input="updateValue($event.target.value)" data-v-bind_name="name" data-v-bind_placeholder="placeholder" />
                <label for="unical-id-for-search-box" class="label-for-search-box" style="display: none"><span class="property-icon-home-search search-box-icon" style="display: none;"></span></label>
                <?php if( isset( $field[ 'label' ] ) ) {
                    $field_serach_after = apply_filters( "stm-field-search-after", [ 'model' => $model, 'field' => $field ]
                    );
                    echo ( !is_array( $field_serach_after ) ) ? $field_serach_after : "";
                } ?>
            </div>
        </div>
    </stm-field-search>
<?php endif; ?>

