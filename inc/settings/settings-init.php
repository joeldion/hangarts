<?php 
/*
 * Settings
 */

add_action( 'admin_menu', 'hp_settings_admin_menu' );
add_action( 'admin_init', 'hp_settings_init' );

function hp_settings_admin_menu() {

    add_menu_page(
        'Paramètres',
        'Paramètres',
        'manage_options',
        'hp-settings-page',
        'hp_settings',
        'dashicons-admin-generic',
        5
    );

}

function hp_settings() {
    ?>
    <h1>Paramètres</h1>
    <hr>
    <div id="hp-settings">
        <form action="options.php" method="post">
            <?php
                submit_button();
                do_settings_sections( 'hp-settings-page' );
                settings_fields( 'hp-settings' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

function hp_settings_init() {
    require_once( HP_INC . 'settings/sections/section-intro.php' );
    require_once( HP_INC . 'settings/sections/section-hangarts.php' );
    require_once( HP_INC . 'settings/sections/section-map.php' );
    require_once( HP_INC . 'settings/sections/section-contact.php' );
}