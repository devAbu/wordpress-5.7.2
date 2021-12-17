<?php
/*Require TGM CLASS*/
require_once $stmt_inc_path . '/admin/tgm/class-tgm-plugin-activation.php';

/*Register plugins to activate*/
add_action('tgmpa_register', 'homepress_require_plugins');

function homepress_require_plugins($return = false)
{
    $plugins = array(
        'homepress-demo-import' => array(
            'name' => 'HomePress Demo Import',
            'slug' => 'homepress-demo-import',
            'source' => get_package( 'homepress-demo-import', 'zip' ),
            'required' => true,
            'version' => '1.2.8',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'homepress-configurations' => array(
            'name' => 'HomePress Configurations',
            'slug' => 'homepress-configurations',
            'source' => get_package( 'homepress-configurations', 'zip' ),
            'required' => true,
            'version' => '1.2.6',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'homepress-elementor' => array(
            'name' => 'HomePress Elementor',
            'slug' => 'homepress-elementor',
            'source' => get_package( 'homepress-elementor', 'zip' ),
            'required' => true,
            'version' => '1.2.4',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'ulisting-wishlist' => array(
            'name' => 'uListing Wishlist',
            'slug' => 'ulisting-wishlist',
            'source' => get_package( 'ulisting-wishlist', 'zip' ),
            'required' => true,
            'version' => '1.1.3',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'ulisting-compare' => array(
            'name' => 'uListing Compare',
            'slug' => 'ulisting-compare',
            'source' => get_package( 'ulisting-compare', 'zip' ),
            'required' => true,
            'version' => '1.1.6',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'revslider' => array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => get_package('revslider', 'zip'),
            'version' => '6.4.11',
            'external_url' => 'http://www.themepunch.com/revolution/'
        ),
        'elementor' => array(
            'name' => 'Elementor',
            'slug' => 'elementor',
            'required' => true,
        ),
        'header-footer-elementor' => array(
            'name' => 'Elementor – Header, Footer & Blocks',
            'slug' => 'header-footer-elementor',
            'required' => true,
        ),
        'image-map-pro-wordpress' => array(
            'name' => 'Image Map Pro WP',
            'slug' => 'image-map-pro-wordpress',
            'source' => get_package('image-map-pro-wordpress', 'zip'),
            'required' => true,
        ),
        'ulisting' => array(
	        'name' => 'uListing',
	        'slug' => 'ulisting',
            'required' => true,
        ),
		'contact-form-7' => array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => true,
		),
        'breadcrumb-navxt' => array(
            'name' => 'Breadcrumb NavXT',
            'slug' => 'breadcrumb-navxt',
            'required' => false
        ),
        'mailchimp-for-wp' => array(
            'name' => 'MailChimp for WordPress Lite',
            'slug' => 'mailchimp-for-wp',
            'required' => false
        ),
        'amp' => array(
            'name' => 'AMP',
            'slug' => 'amp',
            'required' => false
        ),
        'optima-express' => array(
            'name' => 'Optima Express + MarketBoost IDX Plugin',
            'slug' => 'optima-express',
            'required' => false
        ),
        'idx-broker-platinum' => array(
            'name' => 'IMPress for IDX Broker',
            'slug' => 'idx-broker-platinum',
            'required' => false
        ),
		'gdpr-compliance-cookie-consent' => array(
			'name' => 'GDPR Compliance & Cookie Consent',
			'slug' => 'gdpr-compliance-cookie-consent',
			'required' => false,
		),
    );

    if ($return) {
        return $plugins;
    } else {
        $config = array(
            'id' => 'homepress',
            'is_automatic' => false
        );

        $layout_plugins = homepress_layout_plugins( homepress_current_layout() );
        $recommended_plugins = homepress_recommended_plugins();
        $layout_plugins = array_merge( $layout_plugins, $recommended_plugins) ;

        $tgm_layout_plugins = array();
        foreach( $layout_plugins as $layout_plugin ) {
        	$tgm_layout_plugins[$layout_plugin] = $plugins[$layout_plugin];
		}

        tgmpa($tgm_layout_plugins, $config);
    }
}
