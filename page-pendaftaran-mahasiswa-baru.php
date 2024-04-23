<?php get_header(); ?>

<?php 
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
                $args = array(
                    'post_type'     => 'page',
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
        <article class="centered-box constrained">
            <h1 id="title"><?= get_the_title(); ?></h1>
            <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
            <hr class="separator--blue" />
            <div class="constrained">
                <?= the_content(); ?>
            </div>
        </article>
    </div>
</section>

<section class="section">
    <form id="register-form" class="centered-box constrained">
        <div>
            <h2>Formulir Pendaftaran Mahasiswa Baru</h2>
        </div>
        <div class="form-section">
            <h3>Jenis Pendaftaran</h3>
            <div class="form-row">
                <div class="form-radio-option">
                    <input type="radio" id="reguler" name="program" />
                    <label for="reguler">Reguler</label>
                </div>
                <div class="form-radio-option">
                    <input type="radio" id="rpl" name="program" />
                    <label for="rpl">
                        <a href="https://fisipupri.ac.id/penerimaan-mahasiswa-baru/program-rekognisi-pembalajaran-lampau-rpl/">Rekognisi Pembelajaran Lampau (RPL) →</a>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-section">
            <h3>Program Studi Pilihan</h3>
            <div class="form-row">
                <div class="form-radio-option">
                    <input type="radio" id="komunikasi" name="department" />
                    <label for="komunikasi">
                        <a href="https://fisipupri.ac.id/study-program-about/ilmu-komunikasi/">Ilmu Komunikasi →</a>
                    </label>
                </div>
                <div class="form-radio-option">
                    <input type="radio" id="administrasi" name="department" />
                    <label for="administrasi">
                        <a href="https://fisipupri.ac.id/study-program-about/ilmu-administrasi-negara/">Ilmu Administrasi Negara →</a>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-section">
            <h3>Data Personal</h3>
            <div class="form-row">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" />
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" />
            </div>
            <div class="form-row">
                <label for="nama">Sekolah Asal</label>
                <input type="text" name="school" id="school" />
            </div>
            <div class="form-row">
                <label for="phone">Nomor Telepon/WhatsApp*</label>
                <input type="tel" name="phone" id="phone" placeholder="+6285999999999"/>
                <small>*nomor WhatsApp yang aktif.</small>
            </div>
        </div>
        <button class="g-recaptcha button button--blue" 
        data-sitekey="6LcVlcQpAAAAANAtJ4wpBIswn4Cxn7Iiic1Xk09t" 
        data-callback='onSubmit' 
        data-action='submit'>Daftar Jadi Mahasiswa FISIP UPRI</button>
    </form>
</section>

<?php get_footer(); ?>