<?php
$to = get_option( 'stmt_to_settings', array() );

/*Headings*/
$headings_selector = array();
$headings = array();

for ( $i = 1; $i < 7; $i++ ) {
	$variable = "h{$i}, .h{$i}";
	$headings_selector[] = $variable;
	if ( !empty( $to[$variable] ) ) {
		$styles = json_decode( $to[$variable], true );
		$headings[$variable] = '';
		foreach ( $styles as $style_name => $style ):
            if( !empty($style) ) $headings[$variable] .= homepress_element_styles( $style_name, $style ) . ';';
		endforeach;
	}
}

if ( !empty( $to['default_header_font_family'] ) or !empty( $to['default_header_font_color'] ) ) { ?>
	<?php echo implode(',', $headings_selector ); ?> {
	<?php if ( !empty( $to['default_header_font_family'] ) ): ?>
        font-family: "<?php echo sanitize_text_field($to['default_header_font_family']); ?>";
	<?php endif; ?>
	<?php if ( !empty( $to['default_header_font_color'] ) ): ?>
        color: <?php echo sanitize_text_field( $to['default_header_font_color'] ); ?>;
	<?php endif; ?>
    }
<?php }

foreach ( $headings as $selector_name => $styles ): ?>
	<?php echo sanitize_text_field( $selector_name ) ?> {
	<?php echo sanitize_text_field( $styles ) ?>
    }
<?php endforeach;

/*Body Font*/
if( !empty( $to['body'] ) ) {
	$styles = json_decode( $to['body'], true );
	if( !empty( $styles['selectors']) ) unset($styles['selectors'] );
	?>
	body {
	    <?php foreach( $styles as $style_name => $style ): ?>
            <?php echo homepress_element_styles( $style_name, $style ) ?>;
        <?php endforeach; ?>
    }
<?php } ?>