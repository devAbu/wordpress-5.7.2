<?php
/**
 * Account custom field view number
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/custom-field/view/number.php
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */

$value = get_user_meta( $user->ID, $field['slug'] );
?>

<p><?php echo esc_attr( $field['name'] ); ?> : <?php echo ( isset( $value[0] ) ) ? esc_attr( $value[0] ) : null ?></p>