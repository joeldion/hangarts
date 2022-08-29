<?php

add_action( 'wp_enqueue_scripts', 'hp_enqueue' );
add_action( 'admin_enqueue_scripts', 'hp_enqueue_admin' );

function hp_enqueue() {

    $version = HP_VERSION;
    $js_file = 'hp-script.min.js';
    if ( current_user_can('administrator') ) {
        $version = time();
        $js_file = 'hp-script.js';
    }

    // Stylesheets
    wp_enqueue_style(
        'hp-style',
        HP_URL . '/style.min.css',
        [],
        $version,
        'all'
    );

    // Scripts
    wp_enqueue_script(
        'hp-script',
        HP_URL . '/assets/js/' . $js_file,
        ['jquery'],
        $version,
        true
    );

    wp_localize_script(
        'hp-script',
        'hpGlobals',
        [
            'baseURL'       =>  get_site_url(),
            'ajaxURL'       =>  admin_url('admin-ajax.php'),
            'bamJsonURL'    =>  HP_URL . '/inc/google-map/json/bam-map-data.json',
            'hpJsonURL'     =>  HP_URL . '/inc/google-map/json/hp-map-data.json',
            'iconURL'       =>  HP_URL . '/img/icons/',
            'nonce'         =>  wp_create_nonce('hp_nonce'),
        ]
    );

}

function hp_enqueue_admin() {

    // Stylesheets
    wp_enqueue_style(
        'hp-style-admin',
        HP_URL . '/assets/css/hp-style-admin.css',
        [],
        time(),
        'all'
    );

    // Media Uploader 
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_media();

    // Scripts
    wp_enqueue_script(
        'google-maps',
        'https://maps.googleapis.com/maps/api/js?key=' . HP_GMAP_API_KEY . '&v=weekly',
        [],
        '1.0',
        true
    );

    wp_enqueue_script(
        'hp-script-admin',
        HP_URL . '/assets/js/hp-script-admin.js',
        ['jquery'],
        time(),
        true
    );

}