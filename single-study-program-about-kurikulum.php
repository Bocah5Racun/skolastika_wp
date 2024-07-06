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
            <h1 id="title">Kurikulum</h1>
            <hr class="separator--blue" />
            <div class="constrained">
                <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
                <?= the_content(); ?>
                <div class="curriculum-container">
                    <?php

                        $courses_query = new WP_Query( array(
                            'post_type'     => 'courses',
                            'posts_per_page'=> -1,
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

                            $current_semester = 0;
                            while ( $courses_query->have_posts() ) :
                                $courses_query->the_post();

                                $course_details = get_post_meta( get_the_ID(), 'course_details', true );
                                $semester = get_post_meta( get_the_ID(), 'semester', true );
                                $rps_file = get_post_meta( get_the_ID(), 'rps', true );

                                if ( $semester !== $current_semester || $current_semester === 0 ) :
                                    if ( $current_semester > 0 ) :
                                ?>

                                    </table>
                                </figure>
                        
                        <?php
                                    endif;
                                
                                    $current_semester = $semester;

                        ?>

                        <figure class="wp-block-table">
                            <table class="has-fixed-layout">
                                <tr class="kurikulum-header">
                                    <th colspan="3">Semester <?= $semester; ?></th>
                                </tr>
                                <tr class="kurikulum-sub-header">
                                    <td>Kode</td>
                                    <td>Mata Kuliah</td>
                                    <td>Detail MK</td>
                                </tr>

                    <?php
                                endif;
                    ?>

                                <tr>
                                    <td><?= $course_details['kode']; ?></td>
                                    <td><?= get_the_title(); ?></td>
                                    <td>
                                    <?php if( $course_details['description'] ) : ?>
                                        <a
                                            target="_blank"
                                            class="toggle-link"
                                            onclick="toggleRow('<?= get_the_ID() . '-details-row'; ?>', this)">Show</a>
                                    <?php else : ?>
                                        --
                                    <?php endif;?>
                                    </td>
                                </tr>
                                <?php if( $course_details['description'] ) : ?>
                                    <tr id="<?= get_the_ID(); ?>-details-row" class="collapse">
                                        <td colspan="3">
                                            <div class="details-wrapper">
                                                <div class="curriculum-box">
                                                    <div class="curriculum-cell">
                                                        <h3 class="curriculum-box-label">Nama Mata Kuliah</h3>
                                                        <div><?= get_the_title(); ?></div>
                                                    </div>
                                                    <div class="curriculum-cell">
                                                        <h3 class="curriculum-box-label">Jumlah SKS</h3>
                                                        <div><?= $course_details['sks']; ?></div>
                                                    </div>
                                                    <div class="curriculum-cell">
                                                        <h3 class="curriculum-box-label">Semester</h3>
                                                        <div><?= $semester; ?></div>
                                                    </div>
                                                    <div class="curriculum-cell">
                                                        <h3 class="curriculum-box-label">Dosen Pengampuh</h3>
                                                        <div><?= $course_details['dosen']; ?></div>
                                                    </div>
                                                    <?php
                                                        if ( isset( $rps_file['url'] ) ) :
                                                    ?>
                                                    <div class="curriculum-cell">
                                                        <h3 class="curriculum-box-label">RPS</h3>
                                                        <div><a class="rps-link" href="<?= $rps_file['url']; ?>" target="_blank">🗎</a></div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="curriculum-description-wrapper">
                                                    <?= $course_details['description']; ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                    <?php
                            endwhile;
                    ?>
                    
                            </table>
                        </figure>

                    <?php
                        endif;
                    ?>
                </div>
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

<script>
    setTimeout( () => {
        document.querySelector("#title").scrollIntoView({
            behavior: 'smooth',
        })
    }, 1000)

    function toggleRow(rowID, el) {
        const allRows = document.querySelectorAll('.collapse');
        const targetRow = document.getElementById(rowID);
        allRows.forEach( row => {
            if(row.id == targetRow.id ) return;
            row.previousElementSibling.querySelector('.toggle-link').innerText = "Show";
            row.classList.remove('active');
            el.innerText = "Show"
        });
        if(targetRow.classList.contains('active')) {
            targetRow.classList.remove('active');
            el.innerText = "Show";
        } else {
            targetRow.classList.add('active');
            el.innerText = "Hide";

            setTimeout( () => {
                el.scrollIntoView({behavior: 'smooth',});
            }, 500)
        }
    }
</script>
<?php
    get_footer();
?>