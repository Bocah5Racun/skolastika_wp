<?php

function skolastika_theme_styles() {
    wp_enqueue_style( 'main', get_stylesheet_uri(), array(), true, 'all' );
    wp_enqueue_style( 'header', get_template_directory_uri() . '/includes/styles/header.css', array(), true, 'all' );
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/includes/styles/footer.css', array(), true, 'all' );

    if( is_front_page() ) wp_enqueue_style( 'front-page', get_template_directory_uri() . '/includes/styles/front-page.css', array(), true, 'all' );
    if( is_single() || is_page() ) wp_enqueue_style( 'single-page', get_template_directory_uri() . '/includes/styles/single-page.css', array(), true, 'all' );
    if( is_singular( 'study-program-about' ) ) wp_enqueue_style( 'single-study-program-about', get_template_directory_uri() . '/includes/styles/single-study-program-about.css', array(), true, 'all' );
    if( is_singular( 'staff' ) ) wp_enqueue_style( 'single-staff', get_template_directory_uri() . '/includes/styles/single-staff.css', array(), true, 'all' );
    if( is_page() ) wp_enqueue_style( 'page', get_template_directory_uri() . '/includes/styles/page.css', array(), true, 'all' );
}

function skolastika_theme_scripts() {
    if( is_singular( 'staff') ) wp_enqueue_script( 'single-staff-script', get_template_directory_uri() . '/includes/scripts/single-staff.js', array(), true, true );
    if( is_page( 'pendaftaran-mahasiswa-baru' ) ) {
        wp_enqueue_script( 'captcha', 'https://www.google.com/recaptcha/api.js', array(), true );
        wp_enqueue_script( 'captcha-client', get_template_directory_uri() . '/includes/scripts/captcha-client.js', array(), true, true );
    }
    if( is_front_page() ) wp_enqueue_script( 'whatsapp-popup', get_template_directory_uri() . '/includes/scripts/whatsapp-popup.js', array(), true, true );
}

function skolastika_theme_menus() {
    register_nav_menus(
        array(
            'top-bar-menu'      => __( 'Top Bar Menu' ),
            'hero-cta-menu'     => __( 'Hero CTA Menu' ),
            'marquee-items'     => __( 'Marquee Items' ),
            'header-menu'       => __( 'Header Menu' ),
            'highlights-menu'   => __( 'Highlights Menu' ),
            'footer-menu'       => __( 'Footer Menu' ),
            'student-menu'      => __( 'Student Menu' ),
            'campus-menu'       => __( 'Campus Menu' ),
        )
    );
}

function skolastika_theme_posttypes() {
    register_post_type( 
        'study-program-about',
        array(
            'labels'        => array(
                'name'          => __( 'Study Programs' ),
                'singular_name' => __( 'Study Program' ),
                'plural'        => __( 'Study Programs' ),
            ),
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'rewrite'       => array( 'slug' => 'study-program-about'),
            'menu_icon'     => 'dashicons-welcome-learn-more',
            'menu_position' => 5,
            'show_in_rest'  => true,
        ),
    );

    register_post_type( 
        'highlights',
        array(
            'labels'        => array(
                'name'          => __( 'Highlights' ),
                'singular_name' => __( 'Highlight' ),
                'plural'        => __( 'Highlights' ),
            ),
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => false,
            'rewrite'       => array( 'slug' => 'highlights'),
            'menu_icon'     => 'dashicons-schedule',
            'menu_position' => 5,
            'show_in_rest'  => true,
        ),
    );

    register_post_type( 
        'staff',
        array(
            'labels'            => array(
                'name'              => __( 'Staff' ),
            ),
            'supports'          => array( 'title', 'thumbnail', 'page-attributes'),
            'public'            => true,
            'has_archive'       => true,
            'hierarchical'      => true,
            'rewrite'           => array( 'slug' => 'staff'),
            'menu_icon'         => 'dashicons-groups',
            'menu_position'     => 6,
            'show_in_nav_menus' => true,
        ),
    );
    
    register_post_type( 
        'alumni',
        array(
            'labels'        => array(
                'name'          => __( 'Alumni' ),
                'singular_name' => __( 'Alumnus' ),
                'plural'        => __( 'Alumni' ),
            ),
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'rewrite'       => array( 'slug' => 'alumni'),
            'menu_icon'     => 'dashicons-networking',
            'menu_position' => 6,
            'show_in_rest'  => true,
            'show_in_nav_menus' => true,
        ),
    );
}

function skolastika_theme_taxonomies() {
      
      $labels = array(
        'name' => _x( 'Study Programs', 'taxonomy general name' ),
        'singular_name' => _x( 'Study Program', 'taxonomy singular name' ),
        'search_items' =>  __( 'Study Programs' ),
        'all_items' => __( 'All Study Programs' ),
        'edit_item' => __( 'Edit Study Program' ), 
        'update_item' => __( 'Update Study Program' ),
        'add_new_item' => __( 'Add New Study Program' ),
        'new_item_name' => __( 'New Study Program Name' ),
        'menu_name' => __( 'Study Programs' ),
      );    

      register_taxonomy( 'study_program', array( 'post', 'staff', 'alumni' ), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'study_program' ),
        'show_in_menu' => false,
      ) );
      
      $labels = array(
        'name'              => 'Expertise Topics',
        'singular_name'     => 'Topic',
        'plural_name'       => 'Topics',
        'menu_name'         => 'Expertise Topic',
      );

      register_taxonomy( 'expertise', array( 'staff' ), array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'study_program' ),
        'context'   => 'advanced',
        'show_in_menu' => false,
      ) );

      $labels = array(
        'name'              => 'Image Locations',
        'singular_name'     => 'Location',
        'plural_name'       => 'Locations',
        'menu_name'         => 'Location',
      );

      register_taxonomy( 'image_locations', array( 'attachment' ), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => true,
      ) );
      
}

function skolastika_theme_study_programs_filter() {

    global $typenow;

    $post_types = array( 'staff', 'alumni' );

    $taxonomies = array( 'study_program' );

    if( in_array( $typenow, $post_types ) ) {
        foreach( $taxonomies as $taxonomy ) {
            $selected = isset( $_GET['taxonomy'] ) ? $_GET['taxonomy'] : '';
            $info_taxonomy = get_taxonomy( $taxonomy );

            wp_dropdown_categories( array (
                'show_option_all' => __("Filter by Study Program"),
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => true,
                'hide_empty'      => false,
            ) );
        }
    }

    if( $typenow == 'study-program-about' ) {
        global $post;

        $args = array( 
            'numberposts'   => -1,
            'post_type'     => $typenow,
            'post_parent'   => 0,
        );

        $posts = get_posts( $args );
        $terms = get_terms( array(
            'taxonomy'      => 'study_program',
            'hide_empty'    => false,
            )
        );
        $slugs = array();
        $names = array();

        foreach( $posts as $post ) {
            $names[] = $post->post_name;
        }

        foreach( $terms as $term ) {
            $slugs[] = $term->slug;
        }

        foreach( $posts as $post ) {
            if( !in_array( $post->post_name, $slugs ) ) {
                wp_insert_term(
                    $post->post_title,
                    'study_program',
                    array(
                        'slug'  => $post->post_name,
                    )
                );
            }
        }

        foreach( $terms as $term ) {
            if( !in_array( $term->slug, $names ) ) {
                wp_delete_term(
                    $term->term_id,
                    'study_program'
                );
            }
        }
        
    }
}

add_action( 'init', 'skolastika_theme_menus' );
add_action( 'init', 'skolastika_theme_posttypes' );
add_action( 'init', 'skolastika_theme_taxonomies' );

add_action( 'restrict_manage_posts', 'skolastika_theme_study_programs_filter' );
add_action( 'wp_enqueue_scripts', 'skolastika_theme_styles' );
add_action( 'wp_enqueue_scripts', 'skolastika_theme_scripts' );

add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails' );

include( get_template_directory() . "/includes/plugins/metaboxes.php" ); // metabox plugin
include( get_template_directory() . "/includes/plugins/skolastika-gutenberg-blocks/plugin.php" ); // custom theme boxes

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'single-page', get_template_directory_uri() . '/includes/styles/single-page.css', array(), true, 'all' );
});