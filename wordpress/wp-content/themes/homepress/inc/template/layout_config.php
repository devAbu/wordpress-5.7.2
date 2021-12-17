<?php
function homepress_current_layout() {
	return get_option('homepress_layout', 'property');
}

function homepress_layout_plugins() {

	$required = array(
		'homepress-configurations',
		'homepress-elementor',
		'elementor',
        'header-footer-elementor',
		'image-map-pro-wordpress',
		'ulisting',
		'ulisting-wishlist',
		'ulisting-compare',
		'contact-form-7',
	);

	return $required;
}

function homepress_recommended_plugins() {
	return array(
        'breadcrumb-navxt',
        'mailchimp-for-wp',
		'gdpr-compliance-cookie-consent',
		'amp',
        'optima-express',
        'idx-broker-platinum'
	);
}