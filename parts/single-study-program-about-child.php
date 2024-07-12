<?php 
    $study_program = get_the_title( wp_get_post_parent_id() );
?>

<div id="single-hero-container">
    <div class="single-hero-title-container container">
        <a class="single-hero-container-title" href=".."><?= $study_program ?></a>
    </div>
    <img src="<?= get_the_post_thumbnail_url( wp_get_post_parent_id( get_the_ID() )); ?>" />
    <div class="gradient--radial"></div>
</div>

<section id="study-program-info">
    <div class="study-program-info-inner container">
        <div class="program-studi-info-list">
            <?php
                $staff_query = new WP_Query( array(
                    'post_type'         => 'staff',
                    'tax_query'         => array(
                        array(
                            'taxonomy'  => 'study_program',
                            'field'     => 'name',
                            'terms'     => $study_program,
                        )
                    ),
                ));
            
                if( $staff_query->have_posts() ):
            ?>
            <a href="../#study-program-staff">Staff Pengajar</a>
            <?php
                endif;
                wp_reset_postdata();
            ?>
            <?php

                $args = array(
                    'post_type'     => 'study-program-about',
                    'post_parent'   => wp_get_post_parent_id( get_the_ID() ),
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

<section class="section">
    <div class="section-inner container">
        <article class="centered-box">
            <h1 id="title"><?= get_the_title(); ?></h1>
            <hr class="separator--blue" />
            <div class="constrained">
                <?= the_content(); ?>
            </div>
        </article>
    </div>
    <div class="section section--upri-yellow study-program-child-cta-container">
        <div class="section-inner">
            <h2>Tertarik untuk memulai karier di bidang <?= $study_program; ?>?</h2>
            <a class="single-cta-button" href="<?= get_home_url() . '/penerimaan-mahasiswa-baru/'; ?>">Baca informasi pendaftaran mahasiswa baru →</a>
            <?php if( "Kurikulum" !== get_the_title() ): ?>
                <a href="<?= "../kurikulum"; ?>">Lihat kurikulum →</a>
            <?php endif;?>
        </div>
    </div>
</section>