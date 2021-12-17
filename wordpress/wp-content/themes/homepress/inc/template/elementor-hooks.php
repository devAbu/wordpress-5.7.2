<?php
add_filter( 'elementor/editor/localize_settings', function ( $config ) {
    $config['default_schemes']['color']['items'] = [
        '1' => '#303441',
        '2' => '#a6936b',
        '3' => '#222222',
        '4' => '#234dd4'
    ];

    $config['default_schemes']['typography']['items'] = [
        '1' => [
            'font_family' => 'Open Sans',
            'font_weight' => 'inherit',
        ],
        '2' => [
            'font_family' => 'Open Sans',
            'font_weight' => 'inherit',
        ],
        '3' => [
            'font_family' => 'Open Sans',
            'font_weight' => 'inherit',
        ],
        '4' => [
            'font_family' => 'Open Sans',
            'font_weight' => 'inherit',
        ]
    ];



    return $config;
} );