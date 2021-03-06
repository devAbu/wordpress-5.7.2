<?php
/**
 * @var $field_name
 * @var $section_name
 *
 */

$field_key = "data['{$section_name}']['fields']['{$field_name}']";
$measure = "data['{$section_name}']['fields']['duration_measure']['value']";

?>

<label v-html="<?php echo esc_attr($field_key); ?>['label']"></label>
<div class="row">
    <div class="column column-20">
        <input type="number"
               placeholder="<?php esc_html_e('Enter quiz duration', 'homepress-configurations'); ?>"
               name="<?php echo esc_attr($field_name); ?>"
               v-bind:id="'<?php echo esc_attr($section_name . '-' . $field_name); ?>'"
               v-model="<?php echo esc_attr($field_key); ?>['value']" />
    </div>
    <div class="column column-25">
        <select name="<?php echo esc_attr($field_name); ?>_measure" v-model="<?php echo esc_attr($measure); ?>">
            <option value=""><?php esc_html_e('Minutes', 'homepress-configurations'); ?></option>
            <option value="hours"><?php esc_html_e('Hours', 'homepress-configurations'); ?></option>
            <option value="days"><?php esc_html_e('Days', 'homepress-configurations'); ?></option>
        </select>
    </div>
</div>