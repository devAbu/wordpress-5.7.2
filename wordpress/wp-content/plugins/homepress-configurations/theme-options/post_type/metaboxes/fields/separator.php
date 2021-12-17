<?php
/**
 * @var $field_name
 * @var $section_name
 *
 */

$field_key = "data['{$section_name}']['fields']['{$field_name}']";

?>

<div class="stmt-to-admin-select with_separator">
    <label v-html="<?php echo esc_attr($field_key); ?>['label']"></label>
</div>