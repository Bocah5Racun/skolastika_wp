<?php
    get_header();

    $course_details = get_post_meta( get_the_ID(), 'course_details', true );
    $rps_file = get_post_meta( get_the_ID(), 'rps', true );
    $semester = get_post_meta( get_the_ID(), 'semester', true );

?>

<article class="container section">
    <div class="section-inner">
        <article class="constrained centered-box">
            <h1><?= get_the_title(); ?></h1>
            <hr class="separator--blue" />
            <div class="curriculum-box">
                <div>
                    <h3 class="curriculum-box-label">Kode Mata Kuliah</h3>
                    <div><?= $course_details['kode']; ?></div>
                </div>
                <div>
                    <h3 class="curriculum-box-label">Jumlah SKS</h3>
                    <div><?= $course_details['sks']; ?></div>
                </div>
                <div>
                    <h3 class="curriculum-box-label">Semester</h3>
                    <div><?= $semester; ?></div>
                </div>
                <div>
                    <h3 class="curriculum-box-label">Dosen Pengampuh</h3>
                    <div><?= $course_details['dosen']; ?></div>
                </div>
                <div>
                    <h3 class="curriculum-box-label">RPS</h3>
                    <div><?= isset( $rps_file['url'] ) ? '<a href="' . $rps_file['url'] . '" target="_blank">Lihat RPS</a>' : "" ?></div>
                </div>
            </div>
            <p><?= $course_details['description']; ?></p>
            <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
        </article>
    </div>
</article>

<?php get_footer(); ?>