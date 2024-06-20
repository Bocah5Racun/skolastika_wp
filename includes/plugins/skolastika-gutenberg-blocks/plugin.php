<?php
/**
 * Plugin Name: Skolastika Gutenberg Blocks
 * Author: Andi Nuruljihad
 * Version: 1.0.0
 */

 define("PLUGIN_PATH", get_template_directory_uri() . '/includes/plugins/skolastika-gutenberg-blocks');

 function load_highlight_block() {
  wp_enqueue_script( 'highlight-block-js', PLUGIN_PATH . '/highlight-block.js', array('wp-blocks', 'wp-editor'), true );
 }

 function load_block_styles() {
  wp_enqueue_style(
    'custom-block-styles',
   PLUGIN_PATH . '/skolastika-gutenberg-blocks-styles.css',
);
}

add_action( 'enqueue_block_editor_assets', 'load_highlight_block' );
add_action( 'init', function() {
  register_block_style('skolastika/highlight', [
    'name' => 'blue-outline',
    'label' => 'Blue Outline',
  ]);
});
add_action( 'enqueue_block_assets', 'load_block_styles' );
