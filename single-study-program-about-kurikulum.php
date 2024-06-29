<?php
    get_header(); 
    $study_program = get_the_title( wp_get_post_parent_id() );
?>

<div id="single-hero-container">
    <div class="single-hero-title-container container">
        <a href=".."><h1><?= $study_program ?></h1></a>
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

            <a href="<?= get_the_permalink() . "#title"; ?>"><?= get_the_title(); ?></a>

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
            <h1 id="title">Kurikulum</h1>
            <hr class="separator--blue" />
            <div class="constrained">
                <div class="curriculum-container">
                    <?php

                        $courses_query = new WP_Query( array(
                            'post_type'     => 'courses',
                            'tax_query'     => array(
                                'taxonomy'  => 'study_program',
                                'field'     => 'name',
                                'terms'     => $study_program,
                                ),
                            'meta_key'      => 'semester',
                            'orderby'       => 'meta_value_num',
                            'order'         => 'ASC',
                            ),
                        );

                        if( $courses_query->have_posts() ) :

                            ?>

                        <figure class="wp-block-table">
                            <table class="has-fixed-layout">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Lihat Detail</th>
                                        <th>Lihat RPS</th>
                                    </tr>
                                </thead>
                                <tbody>
                        
                        <?php
                            while ( $courses_query->have_posts() ) :
                                $courses_query->the_post();

                                $course_details = get_post_meta( get_the_ID(), 'course_details', true );
                                $rps_file = get_post_meta( get_the_ID(), 'rps', true );
                                $semester = get_post_meta( get_the_ID(), 'semester', true );

                        ?>

                                <tr>
                                    <td><?= $semester; ?></td>
                                    <td><?= $course_details['kode'] ?></td>
                                    <td><?= get_the_title(); ?></td>
                                    <td><?= $course_details['sks'] ?></td>
                                    <td><a href="<?= get_the_permalink(); ?>" target="_blank">Lihat Detail</a></td>
                                    <td><?= is_array($rps_file) && isset( $rps_file['url'] ) ? '<a href="' . $rps_file['url'] . '" target="_blank">Lihat RPS</a>' : "--";?>
                                </tr>

                        <?php
                            endwhile;
                        ?>
                                </tbody>
                            </table>
                        </figure>

                        <?php
                        endif;
                    ?>
                </div>
                <?= the_content(); ?>
            </div>
        </article>
        <div class="section section--upri-yellow study-program-child-cta-container p-4">
            <div class="section-inner">
                <h2>Tertarik untuk berkarier di bidang <?= $study_program; ?>?</h2>
                <a class="single-cta-button" href="<?= get_home_url() . '/penerimaan-mahasiswa-baru/'; ?>">Baca informasi pendaftaran mahasiswa baru →</a>
            </div>
        </div>
    </div>
</section>


<?php
    get_footer();
?>