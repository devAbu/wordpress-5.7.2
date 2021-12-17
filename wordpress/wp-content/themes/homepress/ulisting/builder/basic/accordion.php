<?php
if ( ! defined( 'ABSPATH' ) ) exit;
wp_enqueue_script( 'ulisting/single/item-meta/floor_plans' );
/**
 * Builder basic accordion
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/basic/accordion.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.9
 */

if( $items = get_post_meta( $args[ 'model' ]->ID, $element[ 'params' ][ 'attribute' ], true ) )
    $items = json_decode( $items, true );

$id = "accordion_".rand(10, 99999);
$element['params']['class'] .= " inventory-accordion inventory-accordion";
$template = isset( $element['params']['template']) ?  $element['params']['template']: '';
$element['params']['class'] .= " inventory-accordion_" .$template;

?>
<?php if( is_array( $items ) ): ?>
    <div id="<?php echo esc_attr($id)?>" <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute( $element ) ?>>
        <?php foreach ( $items as $key => $item ): ?>
            <?php if(!empty($item['content'])): ?>
            <div class="accordion-box">
                <div class="accordion-box_header" id="<?php echo esc_attr( $element[ 'params' ][ 'type' ] . '_' . $id . $key ) ?>">
                    <div class="mb-0 <?php if( 0 != $key ) { echo 'collapsed'; } ?>" data-toggle="collapse"
                         data-target="#collapse_<?php echo esc_attr( $element[ 'params' ][ 'type' ] . '_' . $id . $key ) ?>"
                         aria-expanded="true"
                         aria-controls="collapse_<?php echo esc_attr( $element[ 'params' ][ 'type' ] . '_' . $id . $key ) ?>">
                        <div class="stm-row">
                            <div class="stm-col-4">
                                <div class="accordion-box_title"><?php echo esc_attr( $item[ 'title' ] ) ?></div>
                            </div>
                            <div class="stm-col-8 accordion-box_attributes">
                                <?php foreach ( $item[ 'options' ] as $_item ): ?>
                                    <div class="accordion-box_attribute_item"><strong><?php echo esc_attr( $_item[ 'val' ] ) ?></strong> <?php echo esc_attr( $_item[ 'key' ] ) ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapse_<?php echo esc_attr( $element[ 'params' ][ 'type' ] . '_' . $id . $key ) ?>"
                     class="collapse <?php if( 0 == $key ) { echo 'show'; } ?>"
                     aria-labelledby="<?php echo esc_attr( $element[ 'params' ][ 'type' ] . '_' . $id . $key ) ?>"
                     data-parent="#<?php echo esc_attr($id)?>">
                    <div class="card-body">
                        <?php if (!empty($item['shortcode'])):
                            echo do_shortcode($item['shortcode']);
                        endif;?>
                        <?php echo homepress_esc_html( $item[ 'content' ] ); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>