<?php
$to = get_option('stmt_to_settings', array());

if (!empty($to['content_max_width'])): ?>
    .elementor-section.elementor-section-boxed>.elementor-container,
    .container {
        max-width: <?php echo sanitize_text_field($to['content_max_width']); ?>;
    }
<?php endif;