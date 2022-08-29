<?php 

setlocale(LC_ALL, 'fr_CA');

/*
 * CONSTANTS
 */
// Theme Directory Path
defined( 'HP_DOMAIN' ) or define( 'HP_DOMAIN', 'hangartspublics' );

// Theme Directory Path
defined( 'HP_DIR' ) or define( 'HP_DIR', get_template_directory() );

// Theme Inc Path
defined( 'HP_INC' ) or define( 'HP_INC', get_template_directory() . '/inc/' );

// Theme Directory URL
defined( 'HP_URL' ) or define( 'HP_URL', get_template_directory_uri() );

// Theme Version
defined( 'HP_VERSION' ) or define( 'HP_VERSION', '1.2.0' );

// Google Maps API Key
defined( 'HP_GMAP_API_KEY' ) or define( 'HP_GMAP_API_KEY', 'AIzaSyDstOhGvliYV88yU24zUUNxDDA0sKzV6ng' ); // DEV

// Municipalités
defined( 'HP_MUNI' ) or define( 'HP_MUNI', 
    [
        'Charette',
        'Louiseville',
        'Maskinongé',
        'Saint-Alexis-des-Monts',
        'Saint-Barnabé',
        'Saint-Boniface',
        'Sainte-Angèle-de-Prémont',
        'Saint-Édouard-de-Maskinongé',
        'Saint-Élie-de-Caxton',
        'Saint-Étienne-des-Grès',
        'Sainte-Ursule',
        'Saint-Justin',
        'Saint-Léon-le-Grand',
        'Saint-Mathieu-du-Parc',
        'Saint-Paulin',
        'Saint-Sévère',
        'Yamachiche'
    ]
);

// Theme Support
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', [ 'search-form' ] );
add_theme_support( 'menus' );

/*
 * INCLUDES
 */
require_once( HP_INC . 'enqueue.php' );
require_once( HP_INC . 'login.php' );
require_once( HP_INC . 'image-sizes.php' );
require_once( HP_INC . 'clean-admin-menu.php' );
require_once( HP_INC . 'detect-mobile.php' );
require_once( HP_INC . 'detect-ie.php' );
require_once( HP_INC . 'settings/settings-init.php' );
require_once( HP_INC . 'hangart/hangart-init.php' );
require_once( HP_INC . 'google-map/google-map-init.php' );

/*
 * Temporary redirect
 */
function is_login_page() {
    return in_array( $GLOBALS['pagenow'], ['wp-login.php', 'wp-admin.php'] );
}

function redirect_if_user_not_logged_in() {

    if ( !is_user_logged_in() && !is_login_page() ) {
        wp_redirect( 'https://www.maski.quebec/hangarts-publics/' ); 
        exit;
    }

}
// add_action( 'init', 'redirect_if_user_not_logged_in' );

