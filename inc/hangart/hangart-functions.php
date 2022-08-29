<?php 
/*
 * CPT Functions
 */

function get_hangarts_listing() {

    ob_start();

    $args = [
        'post_type'     =>  'hangart',
        'post_status'   =>  'publish',
        'order'         =>  'asc',
        'orderby'       =>  'title'
    ];

    $hangarts = new WP_Query( $args );

    while ( $hangarts->have_posts() ): $hangarts->the_post();
        
        $hangart = new HangART( get_the_ID() );
        $hangart->output();

    endwhile;

    return ob_get_clean();

}