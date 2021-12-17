<?php
function yelp_nearby( $homepress_post_id, $is_cache, $token, array $categories, $latitude, $longitude, $sort_by, $limit ) {

    if ( !$is_cache ) {
        delete_transient( 'yelp_post_id_'.$homepress_post_id );
    }

    $transient_name_categories = implode('_', $categories);
    $transient_name = "yelp_{$homepress_post_id}_{$transient_name_categories}_{$sort_by}_{$limit}";
    $yelp_cache = get_transient( $transient_name );

    if ( !$yelp_cache ) {
        $result = [];
        foreach ( $categories as $key => $category ) {
            $ch = curl_init( 'https://api.yelp.com/v3/businesses/search' . '?term=' . $category . '&latitude=' . $latitude . '&longitude=' . $longitude . '&sort_by=' . $sort_by . '&limit=' . $limit );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ));
            $data = curl_exec( $ch ) ;
            curl_close( $ch );
            array_push( $result, array(
                'category' => $category,
                'resources' => ( json_decode( json_encode( json_decode( $data )->businesses ), true ))
            ));
        }
        set_transient( $transient_name, $result, 60 * 60 * 24 );
        return $result;
    } else {
        return $yelp_cache;
    }
}