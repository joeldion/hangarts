<?php 
/*
 * Setting: Contact
 */

add_settings_section(
    'hp-settings-contact-section',
    'Informations de contact',
    'hp_contact_settings_section_callback',
    'hp-settings-page'
);

add_settings_field(
    'hp_contact_title',
    'Titre de la section',
    'hp_contact_title_markup',
    'hp-settings-page',
    'hp-settings-contact-section'
);

add_settings_field(
    'hp_contact_phone',
    'Téléphone',
    'hp_contact_phone_markup',
    'hp-settings-page',
    'hp-settings-contact-section'
);

add_settings_field(
    'hp_contact_email',
    'Courriel',
    'hp_contact_email_markup',
    'hp-settings-page',
    'hp-settings-contact-section'
);

register_setting( 'hp-settings', 'hp_contact_title' );
register_setting( 'hp-settings', 'hp_contact_phone' );
register_setting( 'hp-settings', 'hp_contact_email' );

function hp_contact_settings_section_callback() {}

function hp_contact_title_markup() {
    ?>
    <input type="text" name="hp_contact_title" id="hp-contact-title" size="40" maxlength="30" value="<?php echo get_option( 'hp_contact_title' ); ?>">
    <?php
}

function hp_contact_phone_markup() {
    ?>
    <input type="tel" name="hp_contact_phone" id="hp-contact-phone" size="40" value="<?php echo get_option( 'hp_contact_phone' ); ?>">
    <?php
}

function hp_contact_email_markup() {
    ?>
    <input type="email" name="hp_contact_email" id="hp-contact-email" size="40" value="<?php echo get_option( 'hp_contact_email' ); ?>">
    <?php
}