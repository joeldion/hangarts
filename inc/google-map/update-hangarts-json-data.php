<?php 

/*
 * Save data as JSON
 */

function hp_save_locations_json() {

    $args = [
        'post_type'     =>  'hangart',
        'post_status'   =>  'publish',
        'order'         =>  'asc',
        'orderby'       =>  'title'
    ];

    $hangart = new WP_Query( $args );
    $json_file = HP_INC . 'google-map/json/hp-map-data.json';
    $json_data = [];    

    while ( $hangart->have_posts() ): $hangart->the_post();

        $id = get_the_ID();
        $coord = esc_html( get_post_meta( $id, '_hp_hangart_coord', true ) );
        $address = esc_html( get_post_meta( $id, '_hp_hangart_address', true ) );
        $city = esc_html( get_post_meta( $id, '_hp_hangart_city', true ) );
        $fulladdress = $address . ', ' . $city;
        $data = [
            'id'          =>  $id,
            'title'       =>  get_the_title(),
            'address'     =>  $fulladdress,
            'gmap'        =>  esc_url( get_post_meta( $id, '_hp_hangart_gmap_url', true ) ),
            'phone'       =>  esc_html( get_post_meta( $id, '_hp_hangart_phone', true ) ),
            'website'     =>  esc_url( get_post_meta( $id, '_hp_hangart_external_link', true ) ),            
            'lat'         =>  floatval( explode( ',', $coord )[0] ),
            'lng'         =>  floatval( explode( ',', $coord )[1] )
        ];

        $data = json_encode( $data );
        array_push( $json_data, $data );

    endwhile;

    $json_file = HP_INC . 'google-map/json/hp-map-data.json';
    file_put_contents( $json_file, '[' . implode( ',', $json_data ) . ']' );

}
