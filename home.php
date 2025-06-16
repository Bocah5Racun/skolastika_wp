<?php get_header(); ?>

<section id="archive-container" class="container--full py-4">
    <div class="archive-container-inner container">

<h1>Semua Pos</h1>

<div class="more-articles-container">

<?php

    $args = array(
        'post_type'         => 'post',
        'category_name'     => 'blog,news,penelitian',
        'posts_per_page'    => 10,
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ) :
        while( $query->have_posts() ) :
            $query->the_post();
?>
    <div class="more-articles-card">
        <a href="<?= get_the_permalink(); ?>">
            <img class="more-articles-card-img" src="<?= get_the_post_thumbnail_url( get_the_ID(), "medium_large" );?> " alt="" />
        </a>
        <div class="more-articles-card-cat">
            <?php
                $the_category = get_the_category()[0];
            ?>
            <a class="more-articles-cat-link" href="<?= get_category_link( $the_category->term_id ); ?>">
                <?= $the_category->name; ?>
            </a>
        </div>
        <a href="<?= get_the_permalink(); ?>" class="more-articles-card-title"><?= get_the_title(); ?></a>
        <div class="more-articles-card-date"><?= get_the_date(); ?></div>
    </div>
    
    <?php 
        endwhile;
        endif;
    ?>

</div>

    </div>
</section>

<?php get_footer(); ?>