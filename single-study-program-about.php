<?php get_header(); ?>

<?php
    if( !get_post_parent() ) get_template_part( 'parts/single-study-program-about', 'parent');
    if( get_post_parent() ) get_template_part( 'parts/single-study-program-about', 'child' );
?>

<?php get_footer(); ?>