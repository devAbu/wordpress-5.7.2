<?php
/**
 * Add listing field checkbox
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/field/checkbox.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
?>
<label class="add-listing-attribute-box-title"><?php echo esc_attr( $attribute->title ); ?></label>
<div class="add-listing-attribute-checkbox-box">
    <div class="homepress-checkbox" v-for="(val, key) in attributes.<?php echo esc_attr( $attribute->name ); ?>.options">
        <label>
            <input type="checkbox" v-bind:value="val.id" v-model="attributes.<?php echo esc_attr( $attribute->name ); ?>.value">
            {{val.text}}
            <span class="checkbox-frame"><i class="fa fas fa-check"></i></span>
        </label>
    </div>
    <span v-if="errors['<?php echo esc_attr( $attribute->name ); ?>']" class="form-valid-error">{{errors['<?php echo esc_attr( $attribute->name ); ?>']}}</span>
</div>