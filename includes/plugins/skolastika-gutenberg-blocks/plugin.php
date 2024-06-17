<?php
/**
 * Plugin Name: Skolastika Gutenberg Blocks
 * Author: Andi Nuruljihad
 * Version: 1.0.0
 */
  
function load_highlight() {
  wp_enqueue_script(
    'highlight-block',
    get_template_directory_uri() . '/includes/plugins/skolastika-gutenberg-blocks/highlight-block.js',
    array('wp-blocks','wp-editor'),
    true
  );
}

function load_block_styles() {
  wp_enqueue_style(
    'custom-block-styles',
    get_stylesheet_directory_uri() . '/includes/plugins/skolastika-gutenberg-blocks/skolastika-gutenberg-blocks-styles.css',
);
}

add_action( 'enqueue_block_editor_assets', 'load_highlight' );
add_action( 'enqueue_block_assets', 'load_block_styles' );