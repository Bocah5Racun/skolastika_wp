<?php get_header(); ?>

<?php
    if( !get_post_parent() ) get_template_part( 'parts/page', 'parent');
    if( get_post_parent() ) get_template_part( 'parts/page', 'child' );
?>

<?php get_footer(); ?>