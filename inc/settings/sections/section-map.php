<?php 
/*
 * Setting: section Map
 */

add_settings_section(
    'hp-settings-map-section',
    'Carte',
    'home_resto_settings_section_callback',
    'hp-settings-page'
);

add_settings_field(
    'hp_map_title',
    'Titre de la section',
    'hp_map_title_markup',
    'hp-settings-page',
    'hp-settings-map-section'
);

add_settings_field(
    'hp_map_text',
    'Texte d\'introduction',
    'hp_map_text_markup',
    'hp-settings-page',
    'hp-settings-map-section'
);

register_setting( 
    'hp-settings', 
    'hp_map_title',
    [
        'type'              =>  'string',
        'sanitize_callback' =>  'sanitize_text_field'
    ]
);
register_setting( 'hp-settings', 'hp_map_text' );

function hp_map_settings_section_callback() {}

function hp_map_title_markup() {
    ?>
    <input type="text" name="hp_map_title" id="hp-contact-title" size="80" maxlength="100" value="<?php echo get_option( 'hp_map_title' ); ?>">
    <?php
}

function hp_map_text_markup() {

    wp_editor(
        get_option( 'hp_map_text' ),
        'hp_map_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 5
        ]
    );

}