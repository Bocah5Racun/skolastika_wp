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
    
    <?php
        $disable_submission = false;
        
        if( isset( $_SESSION["submission_time"] ) ) {
            if( time() - $_SESSION["submission_time"] <= 30 ) $disable_submission = true;
        }

        if( $disable_submission ) :
    ?>

    <section class="section-inner container constrained">
        <h2>Mohon tunggu...</h2>
        <p>Anda baru saja melakukan registrasi. Mohon tunggu 30 detik sebelum mencoba untuk mendaftar kembali.</p>
    </section>

    <?php else: ?>


    <form id="register-form" name="register_form" class="centered-box constrained"  method="post">
        <div>
            <h2>Formulir Pendaftaran Mahasiswa Baru</h2>
        </div>
        <div class="form-section">
            <h3>Jenis Pendaftaran</h3>
            <div class="form-row">
                <div class="form-radio-option">
                    <input type="radio" id="reguler" value="reguler" name="register_program" />
                    <label for="reguler">Reguler</label>
                </div>
                <div class="form-radio-option">
                    <input type="radio" id="rpl" value="rpl" name="register_program" />
                    <label for="rpl">
                    Rekognisi Pembelajaran Lampau (RPL) (<a href="https://fisipupri.ac.id/penerimaan-mahasiswa-baru/program-rekognisi-pembalajaran-lampau-rpl/">Lihat Detail →</a>)
                    </label>
                </div>
            </div>
        </div>
        <div class="form-section">
            <h3>Program Studi Pilihan</h3>
            <div class="form-row">
                <div class="form-radio-option">
                    <input type="radio" id="komunikasi" value="komunikasi" name="register_department" required />
                    <label for="komunikasi">
                    Ilmu Komunikasi (<a href="https://fisipupri.ac.id/study-program-about/ilmu-komunikasi/">Lihat Detail →</a>)
                    </label>
                </div>
                <div class="form-radio-option">
                    <input type="radio" id="administrasi" value="komunikasi" name="register_department" />
                    <label for="administrasi">
                        Ilmu Administrasi Negara (<a href="https://fisipupri.ac.id/study-program-about/ilmu-administrasi-negara/">Lihat Detail →</a>)
                    </label>
                </div>
            </div>
        </div>
        <div class="form-section">
            <h3>Data Personal</h3>
            <div class="form-row">
                <label for="register_name">Nama Lengkap</label>
                <input type="text" name="register_name" id="register_name" required />
            </div>
            <div class="form-row">
                <label for="register_email">Email</label>
                <input type="email" name="register_email" id="register_email" required />
            </div>
            <div class="form-row">
                <label for="register_school">Sekolah Asal (yang mengeluarkan Ijazah SMA/sederajat)</label>
                <input type="text" name="register_school" id="register_school" required />
            </div>
            <div class="form-row">
                <label for="register_phone">Nomor Telepon/WhatsApp*</label>
                <input type="tel" name="register_phone" id="register_phone" placeholder="+6285999999999" required />
                <small>*nomor WhatsApp yang aktif.</small>
            </div>
        </div>
        <button type="submit" class="g-recaptcha button button--blue" 
        data-sitekey="6LcVlcQpAAAAANAtJ4wpBIswn4Cxn7Iiic1Xk09t" 
        data-callback='onSubmit'
        data-action='submit'>Daftar Jadi Mahasiswa FISIP UPRI</button>
    </form>
<?php endif; ?>
</section>
