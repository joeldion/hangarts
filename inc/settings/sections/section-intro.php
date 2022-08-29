<?php 
/*
 * Setting: Intro Text
 */

add_settings_section(
    'hp-settings-intro-section',
    'Introduction',
    'home_intro_settings_section_callback',
    'hp-settings-page'
);

add_settings_field(
    'hp_intro_text',
    'Texte d\'introduction',
    'hp_intro_text_markup',
    'hp-settings-page',
    'hp-settings-intro-section'
);

add_settings_field(
    'hp_intro_image',
    'Image d\'introduction',
    'hp_intro_image_markup',
    'hp-settings-page',
    'hp-settings-intro-section'
);

register_setting( 'hp-settings', 'hp_intro_text' );
register_setting( 'hp-settings', 'hp_intro_image' );

function home_intro_settings_section_callback() {}

function hp_intro_text_markup() {

    wp_editor(
        get_option( 'hp_intro_text' ),
        'hp_intro_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 10
        ]
    );

}

function hp_intro_image_markup() {

    wp_nonce_field( 'hp_intro_image', 'hp_intro_image_nonce' );

    global $post;
    $intro_image_id = intval( get_option( 'hp_intro_image' ) );
    if ( $intro_image_id > 0 ) $has_image = true;
    $image_preview = $has_image ? wp_get_attachment_image_url( $intro_image_id, 'large' ) : '';
    ?>
    <table class="form-table hp-meta-box">
        <tbody>
            <tr valign="top">                
                <td>
                    <a href="#" class="hp-media-upload button button-secondary" data-target="hp-intro-image">
                        <?php esc_html_e( 'Upload' ); ?>
                    </a>
                    <a href="#" class="hp-media-remove button button-secondary<?php echo $has_image ? ' visible' : ''; ?>" id="hp-intro-image-remove">
                        <?php esc_html_e( 'Remove' ); ?>
                    </a>
                    <br /><br />                    
                    <div class="hp-media-upload__preview<?php echo $has_image ? ' visible' : ''; ?>" id="hp-intro-image-preview" style="background-image: url(<?php echo $image_preview; ?>);">
                    </div>
                    <input type="hidden" name="hp_intro_image" id="hp-intro-image" value="<?php echo $has_image ? $intro_image_id : ''; ?>">
                </td>
            </tr>
        </tbody>
    </table>    
    <?php
}