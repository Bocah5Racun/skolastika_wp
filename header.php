<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(''); ?></title>
    <?php wp_head(); ?>
</head>

<body>

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