<?php

/*
 *  Meta Box: Hangart
*/

add_action( 'add_meta_boxes', 'hp_hangart_details_meta_box' );
add_action( 'save_post', 'hp_hangart_details_meta_box_save' );

function hp_hangart_details_meta_box() {

    add_meta_box(
        'hp_hangart_details',
        'Information',
        'hp_hangart_details_callback',
        'hangart',
        'normal',
        'high'
    );

}

function hp_hangart_details_callback() {

    wp_nonce_field( 'hp_hangart_details', 'hp_hangart_details_nonce' );

    global $post;
    $id = $post->ID;
    $desc           = esc_html( get_post_meta( $id, '_hp_hangart_desc', true ) );
    $long_desc      = esc_html( get_post_meta( $id, '_hp_hangart_long_desc', true ) );
    $address        = esc_html( get_post_meta( $id, '_hp_hangart_address', true ) );
    $city           = esc_html( get_post_meta( $id, '_hp_hangart_city', true ) );
    $postal_code    = esc_html( get_post_meta( $id, '_hp_hangart_postal_code', true ) );
    $gmap_url       = esc_url( get_post_meta( $id, '_hp_hangart_gmap_url', true ) );
    $phone          = esc_html( get_post_meta( $id, '_hp_hangart_phone', true ) );
    $email          = esc_html( get_post_meta( $id, '_hp_hangart_email', true ) );
    $external_link  = esc_url( get_post_meta( $id, '_hp_hangart_external_link', true ) );
    $coord          = esc_html( get_post_meta( $id, '_hp_hangart_coord', true ) );
    $lat            = intval( explode( ',', $coord )[0] );
    $lng            = intval( explode( ',', $coord )[1] );
    ?>
    <table class="form-table hp-meta-box">
        <tbody>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-desc">
                        <span class="option-title">Description courte</span>
                    </label>
                </th>
                <td>                    
                    <input type="text" id="hp-hangart-desc" name="hp-hangart-desc" value="<?php echo $desc; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-long-desc">
                        <span class="option-title">Description longue</span>
                    </label>
                </th>
                <td>                    
                    <textarea id="hp-hangart-long-desc" name="hp-hangart-long-desc" rows="5"><?php echo $long_desc; ?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-address">
                        <span class="option-title">Adresse</span>
                    </label>
                </th>
                <td>
                    <input type="text" id="hp-hangart-address" name="hp-hangart-address" value="<?php echo $address; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-city">
                        <span class="option-title">Municipalité</span>
                    </label>
                </th>
                <td>
                    <select name="hp-hangart-city" id="hp-hangart-city">
                    <?php foreach ( HP_MUNI as $muni ): ?>
                        <option value="<?php esc_html_e( $muni ); ?>" <?php selected($city, $muni); ?>>
                            <?php esc_html_e( $muni ); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-postal-code">
                        <span class="option-title">Code postal</span>
                    </label>
                </th>
                <td>
                    <input type="text" id="hp-hangart-postal-code" name="hp-hangart-postal-code" value="<?php echo $postal_code; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-gmap-url">
                        <span class="option-title">URL Google Maps</span>
                    </label>
                </th>
                <td>
                    <input type="text" id="hp-hangart-gmap-url" name="hp-hangart-gmap-url" value="<?php echo $gmap_url; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-phone">
                        <span class="option-title">Téléphone</span>
                    </label>
                </th>
                <td>
                    <input type="text" id="hp-hangart-phone" name="hp-hangart-phone" value="<?php echo $phone; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-email">
                        <span class="option-title">Courriel</span>
                    </label>
                </th>
                <td>
                    <input type="text" id="hp-hangart-email" name="hp-hangart-email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="hp-hangart-ext-link">
                        <span class="option-title">Lien externe</span>
                    </label>
                </th>
                <td>
                    <input type="text" id="hp-hangart-ext-link" name="hp-hangart-ext-link" value="<?php echo $external_link; ?>">
                </td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" id="hp-hangart-coord" name="hp-hangart-coord" value="<?php echo $coord; ?>">
    <?php

}

function hp_hangart_details_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'hp_hangart_details_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'hp_hangart_details_nonce' ];
    if (! wp_verify_nonce( $nonce, 'hp_hangart_details' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_desc = sanitize_text_field( $_POST[ 'hp-hangart-desc' ] );
    $data_long_desc = sanitize_textarea_field( $_POST[ 'hp-hangart-long-desc' ] );
    $data_address = sanitize_text_field( $_POST[ 'hp-hangart-address' ] );
    $data_city = sanitize_text_field( $_POST[ 'hp-hangart-city' ] );
    $data_postal_code = sanitize_text_field( $_POST[ 'hp-hangart-postal-code' ] );
    $data_gmap_url = sanitize_text_field( $_POST[ 'hp-hangart-gmap-url' ] );
    $data_phone = sanitize_text_field( $_POST[ 'hp-hangart-phone' ] );
    $data_email = sanitize_email( $_POST[ 'hp-hangart-email' ] );
    $data_ext_link = sanitize_text_field( $_POST[ 'hp-hangart-ext-link' ] );
    $data_coord = sanitize_text_field( $_POST[ 'hp-hangart-coord' ] );

    update_post_meta( $post_id, '_hp_hangart_desc', $data_desc );
    update_post_meta( $post_id, '_hp_hangart_long_desc', $data_long_desc );
    update_post_meta( $post_id, '_hp_hangart_address', $data_address );
    update_post_meta( $post_id, '_hp_hangart_city', $data_city );
    update_post_meta( $post_id, '_hp_hangart_postal_code', $data_postal_code );
    update_post_meta( $post_id, '_hp_hangart_gmap_url', $data_gmap_url );
    update_post_meta( $post_id, '_hp_hangart_phone', $data_phone );
    update_post_meta( $post_id, '_hp_hangart_email', $data_email );
    update_post_meta( $post_id, '_hp_hangart_external_link', $data_ext_link );
    update_post_meta( $post_id, '_hp_hangart_coord', $data_coord );    

    // Save data as a json file for Google map
    hp_save_locations_json();

}