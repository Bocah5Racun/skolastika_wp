
<div id="single-hero-container">
    <div class="single-hero-title-container container">
    <a href=".."><h1><?= get_the_title(); ?></h1></a>
    </div>
    <img src="<?= get_the_post_thumbnail_url(); ?>" />
    <div class="gradient--radial"></div>
</div>

<section id="study-program-info">
    <div class="study-program-info-inner container">
        <div class="program-studi-info-list">
            <?php
                $args = array(
                    'post_type'     => 'page',
                    'post_parent'   => get_the_ID(),
                );
                
                $query = new WP_Query( $args );

                if( $query->have_posts() ):
                    while( $query->have_posts() ):
                        $query->the_post();
            ?>

            <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>

            <?php
                endwhile;
                endif;
                wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<article class="section">

<div class="study-program-desc-container text-center container">
    <div class="centered-box constrained">
        <?= the_content(); ?>
    </div>
    <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
</div>

</article>