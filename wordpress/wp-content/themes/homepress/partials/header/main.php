<?php

$header_type = ( defined( 'HFE_VER' ) ) ? 'elementor' : 'default';

get_template_part('partials/header/header', $header_type);