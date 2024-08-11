<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(''); ?></title>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KTPSBQJH');</script>
    <!-- End Google Tag Manager -->
    <?php wp_head(); ?>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KTPSBQJH"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="mobile-menu">
    <div id="mobile-menu-closer"></div>
    <?php wp_nav_menu( array( 'theme_location' => 'top-bar-menu', 'container' => 'ul',)); ?>
</div>

<header>
    <section id="top-bar" class="container--full">
        <?php wp_nav_menu( array( 'theme_location' => 'top-bar-menu', 'container' => 'ul', 'menu_class' => 'top-bar-menu container')); ?>
    </section>
    <section id="middle-bar">
        <div id="middle-bar-inner" class="container">
            <?php the_custom_logo(); ?>
            <div id="search-container">
                Search
            </div>
            <div id="burger-menu">
                <img src="<?= get_template_directory_uri() . '/includes/images/sort.png'; ?>" alt="">
            </div>
        </div>
    </section>
    <section id="header-menu-container" class="container--full">
        <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'ul', 'menu_class' => 'header-menu container' ) ); ?>
    </section>
    <?php if( !is_front_page() ): ?>
    <section id="header-breadcrumbs-container" class="container--full py-1">
        <div class="header-breadcrumbs-inner container">
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
        ?>
        </div>
    </section>
    <?php endif; ?>
</header>