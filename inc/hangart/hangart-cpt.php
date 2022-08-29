<?php 
/*
 * CPT Hangart
 */

function hp_hangart_cpt() {

    $args = [
        'labels'        =>  [
            'name'                  =>  'Participants',
            'singular_name'         =>  'Participant',
            'add_new_item'          =>  'Ajouter un participant',
            'edit_item'             =>  'Modifier le participant',
            'new_item'              =>  'Nouveau participant',
            'all_items'             =>  'Tous les participants',
            'view_item'             =>  'Voir le participant',
            'search_items'          =>  'Rechercher parmi les participants',
            'not_found'             =>  'Aucun participant trouvé',
            'not_found_in_trash'    =>  'Aucun participant trouvé dans la corbeille',
            'menu_item'             =>  'Participants'
        ],
        'public'        =>  false,
        'supports'      =>  [ 'title', 'thumbnail' ],
        'show_ui'       =>  true,
        'menu_position' =>  5,
        'menu_icon'     =>  'dashicons-admin-customizer'
    ];

    register_post_type( 'hangart', $args );

}
add_action( 'init', 'hp_hangart_cpt', 9 );