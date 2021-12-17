<?php
//Post views counter
function stm_single_post_counter()
{
	if ( is_singular('post') || is_singular('listing') ) {

		$cookies = '';

		if ( empty( $_COOKIE['stm_post_watched'] ) ) {
			$cookies = get_the_ID();
			setcookie( 'stm_post_watched', $cookies, time() + (86400 * 30), '/' );
			stm_increase_views( get_the_ID() );
		}

		if ( !empty( $_COOKIE['stm_post_watched'] ) ) {
			$cookies = $_COOKIE['stm_post_watched'];
			$cookies = explode( ',', $cookies );

			if ( !in_array( get_the_ID(), $cookies ) ) {
				$cookies[] = get_the_ID();

				$cookies = implode( ',', $cookies) ;

				stm_increase_views( get_the_ID() );
				setcookie( 'stm_post_watched', $cookies, time() + (86400 * 30), '/' );
			}
		}

		if ( !empty( $_COOKIE['stm_post_watched'] ) ) {
			$watched = explode( ',', $_COOKIE['stm_post_watched'] );
		}
	}
}

function stm_increase_views( $post_id )
{

	$keys = array(
		'stm_post_views',
		'stm_day_' . date( 'j' ),
		'stm_month_' . date( 'm' )
	);

	foreach ( $keys as $key ) {

		$current_views = intval( get_post_meta( $post_id, $key, true ) );

		$new_views = ( !empty( $current_views ) ) ? $current_views + 1 : 1;

		update_post_meta( $post_id, $key, $new_views );
	}

}

add_action('wp', 'stm_single_post_counter', 100, 1);

