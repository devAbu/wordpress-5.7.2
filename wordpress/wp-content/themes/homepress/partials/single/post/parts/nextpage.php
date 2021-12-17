<?php
$args = array(
    'before'           => '<ul class="pagination"><li>',
    'after'            => '</li></ul>',
    'link_before'      => '<span>',
    'link_after'       => '</span>',
    'next_or_number'   => 'number',
    'separator'        => '</li><li>',
    'nextpagelink'     => esc_html__( 'Next', 'homepress' ),
    'previouspagelink' => esc_html__( 'Previous', 'homepress' ),
    'pagelink'         => '%',
    'echo'             => 1
);

wp_link_pages( $args );