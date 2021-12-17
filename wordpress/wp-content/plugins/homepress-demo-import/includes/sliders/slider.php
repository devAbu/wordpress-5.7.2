<?php

function stm_theme_import_sliders()
{
    if( class_exists( 'RevSlider' ) ) {
        $slider_url = HOMEPRESS_DEMO_IMPORT_PATH . '/includes/sliders/home-slider.zip';

        if( file_exists( $slider_url ) ) {
            $slider = new RevSlider();
            $slider->importSliderFromPost( true, true, $slider_url );
        }
    }
}