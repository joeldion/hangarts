<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-NEDFKBE4DY"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NEDFKBE4DY');
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo get_home_url(); ?>/favicon.ico" type="image/x-icon" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class( 'container' ); ?>>

        <?php
            if ( is_IE() ) {
                echo ie_modal();
                exit();
            }
        ?>
    
        <header class="header" role="banner">

            <div class="header__content">

                <h1 class="header__logo">                
                    <a href="<?php echo get_home_url(); ?>" aria-label="Accueil">
                        <img src="<?php echo HP_URL; ?>/img/logos/logo-hangarts-publics.png" alt="<?php echo get_bloginfo( 'title' ); ?>" title="<?php echo get_bloginfo( 'title' ); ?>" height="250" width="300" srcset="<?php echo HP_URL; ?>/img/logos/logo-hangarts-publics-1x.png 1x, <?php echo HP_URL; ?>/img/logos/logo-hangarts-publics.png 2x">
                    </a>                              
                </h1>
                
                <h2 class="header__subtitle">Portes ouvertes sur les ateliers d'artistes et d'artisans de la MRC de Maskinongé</h2>

                <h3 class="header__dates">24 et 25 septembre 2022</h3>

                <div class="header__cta">
                    <a href="#" class="scroll" data-target="#main">En savoir plus</a>
                </div>

                <div class="header__video<?php echo is_mobile() ? ' header__video--mobile' : ''; ?>">
                    <?php if ( !is_mobile() ): ?>
                        <video muted loop preload="none" poster="<?php echo HP_URL; ?>/img/videos/hangarts-intro-frame.jpg">
                            <source src="<?php echo HP_URL; ?>/img/videos/hangarts-intro.mp4" type="video/mp4" />
                            Votre navigateur est désuet.
                        </video>                        
                    <?php endif; ?>
                </div>

            </div>

        </header>
        
        <main id="main" class="main-content">

            <section class="intro">
                <div class="intro__text">
                    <?php echo wpautop( get_option( 'hp_intro_text' ) ); ?>
                    <p><a href="#" class="intro__cta scroll" data-target="#map">Planifiez votre itinéraire</a></p>
                </div>
                <div class="intro__image">
                    <img src="<?php echo wp_get_attachment_image_url( get_option( 'hp_intro_image' ), 'hangart' ); ?>" srcset="<?php echo hp_srcset( get_option( 'hp_intro_image' ) ); ?>" alt="<?php echo bloginfo( 'title' ); ?>" width="700" height="440" loading="lazy">
                </div>
            </section>

            <section class="section hangarts">
                <div class="section__head">
                    <h3 class="section__title"><?php echo get_option( 'hp_hangarts_title' ); ?></h3>                    
                    <div class="section__text">
                        <?php echo wpautop( get_option( 'hp_hangarts_text' ) ); ?>
                    </div>                    
                </div>
                <?php echo get_hangarts_listing(); ?>
            </section>

            <section class="section map">
                <div class="section__head">
                    <h3 class="map__title"><?php echo get_option( 'hp_map_title' ); ?></h3>
                    <div class="map__text">
                        <?php echo wpautop( get_option( 'hp_map_text' ) ); ?>
                    </div>
                </div>                
                <div class="map__container">
                    <div id="map" class="gmap"></div>
                    <div class="filters">                       
                        <div class="filter filter--hp" data-cat="hp">
                            <span class="filter__checkbox filter__checkbox--hp"></span>
                            <span class="filter__label">Artisans et artisans</span>
                        </div>
                        <div class="filter filter--bam" data-cat="bam">
                            <span class="filter__checkbox filter__checkbox--bam"></span>
                            <span class="filter__label">Producteurs</span>
                        </div>                    
                    </div>
                </div>
            </section>

            <section class="contact">
                <h3 class="contact__title">Information</h3>
                <a href="tel:+18772272413" class="contact__item">1 877 227-2413</a>
                <a href="mailto:info@tourismemaskinonge.com" class="contact__item">info@tourismemaskinonge.com</a>
            </section>
            
            <section class="logos">
                <img src="<?php echo HP_URL; ?>/img/logos/logo-entente-developpement-culturel.png" height="100" width="400" srcset="<?php echo HP_URL; ?>/img/logos/logo-entente-developpement-culturel-1x.png 1x, <?php echo HP_URL; ?>/img/logos/logo-entente-developpement-culturel.png 2x" alt="Entente de développement culturel">
            </section>

        </main>

        <footer class="footer">
            <div class="footer__colophon">&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;-&nbsp;Tous droits réservés MRC de Maskinongé</div>
        </footer>

        <?php wp_footer(); ?>

        <a href="#" class="back-to-top" id="back-to-top" aria-label="Retour au haut de la page"></a>

        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo HP_GMAP_API_KEY; ?>&callback=initMap&v=weekly" defer></script>
    </body>
</html>