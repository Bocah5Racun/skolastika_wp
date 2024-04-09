<?php get_header(); ?>

<?php
    if( !get_post_parent() ) get_template_part( 'parts/single-study-program', 'parent');
    if( get_post_parent() ) get_template_part( 'parts/single-study-program', 'child' );
?>

<?php get_footer(); ?>