<?php
/**
 * Components fields date
 *
 * Template can be modified by copying it to yourtheme/ulisting/components/fields/date.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.7
 */
$lang = explode("_", get_locale());
$lang = $lang[0];
?>
<?php if( $model ) : ?>
<stm-field-date inline-template
                data-v-bind_key="generateRandomId()"
                data-v-model='<?php echo esc_attr( $model ); ?>'
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				date_type='<?php echo esc_attr( $date_type ); ?>'
				name='<?php echo esc_attr( $name ); ?>'
                data-v-bind_callback_change='<?php echo esc_attr( $callback_change ); ?>' >
    <div class="inventory-location-filter">
        <div class="container">
            <?php if( isset( $field['label'] ) ) {
                $field_location_before = apply_filters("stm-field-default-before", ['model' => $model, 'field' => $field]);
                echo (!is_array($field_location_before)) ? $field_location_before : "";
            } ?>
            <date-picker data-v-if="date_type=='exact'" clearable=false  confirm data-v-model=value input-class=form-control width=100% class=stm-date-picker  data-v-on_confirm=setValue format=DD/MM/YYYY lang=<?php echo esc_attr($lang)?>></date-picker>
            <date-picker  data-v-if="date_type=='range'" clearable=false range confirm data-v-model=value input-class=form-control width=100% class=stm-date-picker data-v-on_confirm=setValue format=DD/MM/YYYY lang=<?php echo esc_attr($lang)?>></date-picker>
            <?php if( isset( $field['label'] ) ) {
                $field_dropdown_after = apply_filters("stm-field-default-after", ['model' => $model, 'field' => $field]);
                echo (!is_array($field_dropdown_after)) ? $field_dropdown_after : "";
            } ?>
        </div>
	</div>
</stm-field-date>
<?php endif;?>
