<?php 
/*
 * Setting: section Hangarts
 */

add_settings_section(
    'hp-settings-hangarts-section',
    'Liste des participants',
    'home_resto_settings_section_callback',
    'hp-settings-page'
);

add_settings_field(
    'hp_hangarts_title',
    'Titre de la section',
    'hp_hangarts_title_markup',
    'hp-settings-page',
    'hp-settings-hangarts-section'
);

add_settings_field(
    'hp_hangarts_text',
    'Texte d\'introduction',
    'hp_hangarts_text_markup',
    'hp-settings-page',
    'hp-settings-hangarts-section'
);

register_setting( 
    'hp-settings', 
    'hp_hangarts_title',
    [
        'type'              =>  'string',
        'sanitize_callback' =>  'sanitize_text_field'
    ]
);
register_setting( 'hp-settings', 'hp_hangarts_text' );

function hp_hangarts_settings_section_callback() {}

function hp_hangarts_title_markup() {
    ?>
    <input type="text" name="hp_hangarts_title" id="hp-contact-title" size="40" maxlength="30" value="<?php echo get_option( 'hp_hangarts_title' ); ?>">
    <?php
}

function hp_hangarts_text_markup() {

    wp_editor(
        get_option( 'hp_hangarts_text' ),
        'hp_hangarts_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 5
        ]
    );

}