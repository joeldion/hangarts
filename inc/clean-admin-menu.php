<?php 
/*
 * Clean Admin Menu
 */

add_action( 'admin_menu', 'hp_clean_admin_menu' );

function hp_clean_admin_menu() {

        remove_menu_page( 'edit.php' );
        remove_menu_page( 'edit.php?post_type=page' );        
        remove_menu_page( 'themes.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'tools.php' );
        //remove_menu_page( 'users.php' );
        //remove_menu_page( 'plugins.php' );
        //remove_menu_page( 'options-general.php' );

}