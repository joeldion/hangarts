<?php 
/*
 * Class: HangART
 */

class HangART {

    private $id;

    public function __construct( $id ) {

        $this->id = intval( $id );
        $this->img_id = get_post_thumbnail_id( $this->id );
        $this->img_src = wp_get_attachment_image_url( $this->img_id, 'hangart' );        
        $this->img_srcset = hp_srcset( $this->img_id );

        if ( empty( $this->img_id ) ) {
            $this->img_src = 'https://dummyimage.com/700x440/000/fff';
            $this->img_srcset = $this->img_src . ' 1x, '. $this->img_src . ' 2x';
        }

        $this->title = get_the_title( $this->id );
        $this->desc = esc_html( get_post_meta( $this->id, '_hp_hangart_desc', true ) );
        $this->long_desc = wpautop( get_post_meta( $this->id, '_hp_hangart_long_desc', true ) );
        $this->address = esc_html( get_post_meta( $this->id, '_hp_hangart_address', true ) );
        $this->city = esc_html( get_post_meta( $this->id, '_hp_hangart_city', true ) );
        $this->postal_code = esc_html( get_post_meta( $this->id, '_hp_hangart_postal_code', true ) );
        $this->full_address = $this->address . ', ' . $this->city . ' ' . $this->postal_code;
        $this->gmap_url = esc_url( get_post_meta( $this->id, '_hp_hangart_gmap_url', true ) );
        $this->phone = esc_html( get_post_meta( $this->id, '_hp_hangart_phone', true ) );
        $this->email = esc_html( get_post_meta( $this->id, '_hp_hangart_email', true ) );
        $this->ext_link = esc_url( get_post_meta( $this->id, '_hp_hangart_external_link', true ) );

    }

    public function address_href( $address ) {

        if ( !empty( $this->gmap_url ) ) return $this->gmap_url;
        $find = [ '/,/', '/\s/' ];
        $replace = [ '', '+' ];
        return 'https://www.google.com/maps?q=' . preg_replace( $find, $replace, $address );

    }

    public function phone_href( $phone ) {

        $find = '/\s| |\-|,/';
        $replace = '';
        return 'tel:+1' . preg_replace( $find, $replace, $phone );

    }

    public function output() {
        ?>
        <div class="hangart">
            <?php /*
            <img class="hangart__img" 
                 src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
                 data-src="<?php echo $this->img_src; ?>" 
                 data-srcset="<?php echo $this->img_srcset; ?>" 
                 alt="<?php echo $this->title; ?>"
                 width="700" height="440">
            */ ?>
            <img class="hangart__img" src="<?php echo $this->img_src; ?>" srcset="<?php echo $this->img_srcset; ?>" alt="<?php echo $this->title; ?>" width="700" height="440" loading="lazy">
            <div class="hangart__info">
                <h3 class="hangart__title"><?php echo $this->title; ?></h3>   
                <p class="hangart__desc"><?php echo $this->desc; ?></p>                
                <div class="hangart__longdesc"><?php echo $this->long_desc; ?></div>                                          
                <a href="<?php echo $this->address_href( $this->full_address ); ?>" class="hangart__contact hangart__contact--address" target="_blank" rel="noopener">
                    <?php echo $this->address . ', ' . $this->city; ?>
                </a>
                <?php if ( $this->phone !== '' ): ?>
                    <a href="<?php echo $this->phone_href( $this->phone ); ?>" class="hangart__contact hangart__contact--phone">
                        <?php echo $this->phone; ?>
                    </a>
                <?php endif; ?>
                <?php if ( $this->email !== '' ): ?>
                    <a href="mailto:<?php echo $this->email; ?>" class="hangart__contact hangart__contact--email">
                        Courriel
                    </a> 
                <?php endif; ?>              
                <a href="<?php echo $this->ext_link; ?>" class="hangart__cta" target="_blank" rel="noopener">En savoir plus</a>
            </div>
        </div>
        <?php      

    }

}