<?php 
    get_header();
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

<?php if( isset($_GET["success"] ) ) : ?>

    <section class="section">
        <section class="section-inner container constrained">
            <h2>Terima Kasih!</h2>
            <p>Anda berhasil melakukan pendaftaran mahasiswa baru di FISIP UPRI.</p>
            <p>Tim Admisi kami akan segera memroses data Anda.</p>
            <p>Pengumuman kelulusan akan diumumkan di situs FISIP UPRI pada tanggal <b>7 Oktober 2024</b>.</p>
        </section>
    </section>

<?php else: ?>

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
            <div class="constrained">
                <?= the_content(); ?>
            </div>
            <p><u>Anda tidak akan dikenakan biaya pada tahap pendaftaran ini.</u></p>
            <form id="register-form" name="register_form" class="centered-box constrained" enctype="multipart/form-data" method="post">
                <div class="form-section">
                    <h3>Data Pribadi</h3>
                    <div class="form-row">
                        <div class="form-input">
                            <label for="full_name">Nama Lengkap (sesuai KTP)</label>
                            <input required type="text" minlength="5" name="full_name" id="full_name" />
                        </div>
                        <div class="form-input">
                            <label for="city">Kota Domisili</label>
                            <input required type="text" minlength="5" name="city" id="city" placeholder="Cth: Makassar"/>
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
                    <h3>Pendidikan Terakhir</h3>
                    <div class="form-row">
                        <div class="form-input">
                            <label for="school">Asal Sekolah/Institusi Pendidikan</label>
                            <small>(yang mengeluarkan ijazah terakhir)</small>
                            <input required type="text" name="school" id="school" placeholder="Cth: SMAN 5 Makassar/Politeknik Kreatif Makassar" />
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h3>Program Studi Tujuan</h3>
                    <div class="form-row">
                        <div class="form-input">
                            <label for="department-satu">Program Studi</label>
                            <small>Pilih satu program studi tujuan.</small>
                            <select name="department" id="department-satu">
                                <option value="komunikasi">Ilmu Komunikasi</option>
                                <option value="administrasi">Ilmu Administrasi Negara</option>
                            </select>
                        </div>
                        <!-- <div class="form-input">
                            <label for="department-dua">Pilihan Kedua</label>
                            <select name="department[1]" id="department-dua">
                                <option value="--">--</option>
                                <option value="komunikasi">Ilmu Komunikasi</option>
                                <option value="administrasi">Ilmu Administrasi Negara</option>
                            </select>
                        </div> -->
                        <div class="form-input">
                            <label for="program">Tipe Kelas</label>
                            <small><a href="<?= get_site_url(); ?>/penerimaan-mahasiswa-baru/program-rekognisi-pembalajaran-lampau-rpl/" target="_blank">Apa itu Kelas Karyawan (Rekognisi Pembelajaran Lampau)?</a></small>
                            <select name="program" id="program">
                                <option value="reguler">Kelas Reguler</option>
                                <option value="rpl">Kelas Karyawan (RPL)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <h3>Dokumen Pendukung</h3>
                    <label>Unggah dokumen pendukung dalam format PDF, JPG, PNG, DOC, DOCX. Maksimum 10MB.</label>
                    <div class="form-row">
                        <div class="form-input form-border">
                            <label for="school">Ijazah Terakhir</label>
                            <input required type="file" accept=".pdf, .doc, .docx, .jpg, .png" name="ijazah" id="ijazah" />
                        </div>
                        <div class="form-input form-border">
                            <label for="school">Transkrip Nilai Terakhir</label>
                            <input required type="file" accept=".pdf, .doc, .docx, .jpg, .png" name="transkrip" id="transkrip" />
                        </div>
                        <div class="form-input form-border">
                            <label for="school">Curriculum Vitae (CV)</label>
                            <small>CV dengan riwayat pendidikan, riwayat kerja, serta prestasi akademik maupun non-akademik.</small>
                            <input required type="file" accept=".pdf, .doc, .docx, .jpg, .png" name="resume" id="resume" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="g-recaptcha button button--blue" data-sitekey="6LcVlcQpAAAAANAtJ4wpBIswn4Cxn7Iiic1Xk09t" data-callback="onSubmit" data-action="submit">Submit →</button>
            </form>
.        </article>
    </div>

<?php endif; ?>
</section>

<?php endif; ?>