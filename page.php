<?php get_header(); ?>

<?php
    if( !get_post_parent() ) get_template_part( 'parts/page', 'parent');
    if( get_post_parent() ) :
        get_template_part( 'parts/page', 'child' );
?>

<script>
    const nojump = window.location.href.includes("nojump")

    if( nojump === false ) {
        setTimeout( () => {
            document.querySelector("#title").scrollIntoView({
                behavior: 'smooth',
            })
        }, 1000)
    }
</script>

<?php endif; ?>

<?php get_footer(); ?>