<?php get_header(); ?>

<?php
    if( !get_post_parent() ) get_template_part( 'parts/single-study-program-about', 'parent');
    if( get_post_parent() ) get_template_part( 'parts/single-study-program-about', 'child' );
?>

<script>
    setTimeout( () => {
        document.querySelector("#title").scrollIntoView({
            behavior: 'smooth',
        })
    }, 1000)
</script>

<?php get_footer(); ?>