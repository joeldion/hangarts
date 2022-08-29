<?php
/*
 * Login Logo
*/

function hp_custom_login_logo() {
    ?>
    <style type="text/css">
        body {
            background: #fff !important;
        }
        h1 a {
            background-image:url(<?php echo HP_URL . '/img/logos/hangarts-logo.svg' ?>) !important;
            background-size: 100% !important;
            width: 243px !important;
            height: 188px !important;
        }
    </style>
    <?php
}
add_filter( 'login_head', 'hp_custom_login_logo' );
