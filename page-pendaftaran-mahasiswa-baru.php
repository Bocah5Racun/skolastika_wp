<?php
    session_start();
    get_header();
?>

<?php
    if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
        get_template_part( 'parts/pendaftaran', 'process');
    } else {
        get_template_part( 'parts/pendaftaran', 'form');
    }
?>

<script>
    setTimeout( () => {
        document.querySelector("#title").scrollIntoView({
            behavior: 'smooth',
        })
    }, 1000)
</script>

<?php get_footer(); ?>