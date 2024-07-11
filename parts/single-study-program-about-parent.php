<div id="single-hero-container">
    <div class="single-hero-title-container container">
    <span class="single-hero-container-title"><?= get_the_title(); ?></span>
    </div>
    <img src="<?= get_the_post_thumbnail_url(); ?>" />
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
                            'terms'     => get_the_title(),
                        )
                    ),
                ));
            
                if( $staff_query->have_posts() ):
            ?>
            <a href="#study-program-staff">Staff Pengajar</a>
            <?php
                endif;
                wp_reset_postdata();
            ?>
            <?php

                $args = array(
                    'post_type'     => 'study-program-about',
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
    <a class="single-cta-button" href="<?= get_home_url() . '/penerimaan-mahasiswa-baru/'; ?>">Baca informasi tentang pendaftaran mahasiswa baru →</a>
    <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
</div>

</article>

<?php

    $args = array(
        'post_type'     => 'post',
        'category_name' => 'blog',
        'tax_query'     => array(
            array(
                'taxonomy'  => 'study_program',
                'field'     => 'name',
                'terms'     => get_the_title(),
            )
        )
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ):
?>
<section id="blog" class="section">
    <div class="section-inner container">
        <h2>Blog <?= get_the_title(); ?></h2>
        <hr class="separator--blue" />
        <h3>Cicipan ilmu yang dipelajari mahasiswa <?= get_the_title(); ?>.</h3>
        <div class="blog-list">
            <?php
                while( $query->have_posts() ):
                    $query->the_post();
            ?>
            <div class="blog-card">
                <a href="<?= get_the_permalink(); ?>">
                    <img class="blog-thumbnail" src="<?= get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" />
                    <div class="dark-gradient"></div>
                    <div class="blog-title"><?= get_the_title(); ?></div>
                </a>
            </div>
            <?php
                endwhile;
            ?>
        </div>
        <?php
            if( $query->found_posts > 8 ):
        ?>
        <div>
            <a class="see-more see-more--blue" href="#">Lihat semua artikel →</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php
    endif;
    wp_reset_postdata();
?>

<?php

    if( $staff_query->have_posts() ):
?>

<section id="study-program-staff" class="section container">
    <div class="study-program-staff-inner section-inner section--dark container text-center py-4">
        <h2>Staf Pengajar <?= get_the_title(); ?></h2>
        <hr class="separator--yellow align-center" />
        <h3>Berkenalan dengan tim pengajar program studi <?= get_the_title(); ?> di FISIP UPRI.</h3>
        <div class="staff-list">

        <?php
                while( $staff_query->have_posts() ):
                    $staff_query->the_post();

        ?>

            <div class="staff-card">
                <a class="staff-card-link" href="<?= get_permalink(); ?>">
                    <img src="<?= get_the_post_thumbnail_url(); ?>" />
                    <div><?= get_the_title(); ?></div>
                </a>
            </div>
        
        <?php
            endwhile;
        ?>

        </div>
    </div>
</section>

<?php
    endif;
    wp_reset_postdata();
?>