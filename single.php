<?php get_header(); ?>

<?php
    $the_categories = array();
    foreach( get_the_category() as $category_object ) {
        $the_categories[] = $category_object->slug;
    }
?>

<article class="<?= in_array("blog", $the_categories) ? "blog" : ""; ?>">
</article>

<?php get_footer(); ?>