<?php
//Post style settings
$post_single_style = homepress_get_option('post_single_style');

get_template_part("partials/single/post/styles/{$post_single_style}");