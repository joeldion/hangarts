<?php
/*
 * Custom Image Sizes
 */
function hp_image_sizes() {
    add_image_size( 'hangart', 700, 440 );
    add_image_size( 'hangart-2x', 1400, 880 );
    add_filter('big_image_size_threshold', '__return_false');
}
add_action( 'after_setup_theme', 'hp_image_sizes' );

function hp_srcset( $image_id ) {

    $url_1x = wp_get_attachment_image_url( $image_id, 'hangart' );
    $url_2x = wp_get_attachment_image_url( $image_id, 'hangart-2x' );
    $srcset = $url_1x . ' 1x,' . $url_2x . ' 2x';
    return $srcset;

}