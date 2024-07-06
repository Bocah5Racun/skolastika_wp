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
                $args = array(
                    'post_type'     => 'page',
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
    
    <div class="section-inner container">
        <article class="centered-box constrained">
            <h1 id="title"><?= get_the_title(); ?></h1>
            <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
            <hr class="separator--blue" />
            <p>Isi formulir di bawah ini untuk memulai proses registrasi mahasiswa baru di Fakultas Ilmu Sosial dan Ilmu Politik Universitas Pejuang Republik Indonesia.</p>
            <p><u>Anda tidak akan dikenakan biaya pada tahap pendaftaran ini.</u></p>
            <form id="register-form" name="register_form" class="centered-box constrained"  method="post">
                <div class="form-section">
                    <h3>Data Pribadi</h3>
                    <div class="form-row">
                        <div class="form-input">
                            <label for="full_name">Nama Lengkap (sesuai KTP)</label>
                            <input required type="text" name="full_name" id="full_name" />
                        </div>
                        <div class="form-input">
                            <label for="city">Kota Domisili</label>
                            <input required type="text" name="city" id="city" placeholder="Cth: Makassar"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input">
                            <label for="school">Sekolah Asal (yang mengeluarkan ijazah SMA/sederajat)</label>
                            <input required type="text" name="school" id="school" placeholder="Cth: SMAN 5 Makassar" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input">
                            <label for="email">Email</label>
                            <input required type="email" name="email" id="email" placeholder="email@anda.or.id" />
                        </div>
                        <div class="form-input">
                            <label for="phone">No. WhatsApp</label>
                            <input required type="tel" name="phone" id="phone" placeholder="085555555555" />
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-row">
                        <div class="form-input">
                            <h3>Program Studi Tujuan</h3>
                            <select name="department" id="department">
                                <option value="komunikasi">Ilmu Komunikasi</option>
                                <option value="adminstrasi">Ilmu Administrasi Negara</option>
                            </select>
                        </div>
                        <div class="form-input">
                            <h3>Jenis Pendaftaran</h3>
                            <select name="program" id="program">
                                <option value="reguler">Kelas Reguler</option>
                                <option value="rpl">Rekognisi Pembelajaran Lampau</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="g-recaptcha button button--blue" data-sitekey="6LcVlcQpAAAAANAtJ4wpBIswn4Cxn7Iiic1Xk09t" data-callback="onSubmit" data-action="submit">Submit →</button>
            </form>
            <div class="constrained">
                <?= the_content(); ?>
            </div>
        </article>
    </div>

<?php endif; ?>
</section>