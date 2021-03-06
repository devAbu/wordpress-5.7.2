<?php
/**
 * Account custom fields checkbox
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/custom-field/fields/checkbox.php
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<div><?php echo esc_html__( $field['name'], "homepress" ); ?></div>
    <label v-for="item in custom_fields_items['<?php echo esc_attr( $field['slug'] ); ?>']" >
        <input type="checkbox" v-model="<?php echo esc_attr($model)?>" :value="item.id" />
        {{item.text}}
    </label>
<span v-if="errors['<?php echo esc_attr( $field['slug'] ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $field['slug'] ); ?>']}}</span>