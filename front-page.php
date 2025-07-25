<?php

    if( !isset( $_SESSION['popup_timer'] ) ) $_SESSION['popup_timer'] = time();

    get_header(); ?>

<section id="new-hero" class="container--full">
    <div class="new-hero-inner container">
        <img class="new-hero-model" src="<?= get_template_directory_uri() . "/includes/images/hero-model.png"; ?>" />
        <div class="new-hero-text-container">
            <h2 class="new-hero-title">Sarjana Administrasi atau Komunikasi dalam <span class="cta--yellow">2 Tahun!</span>*</h2>
            <div class="new-hero-conditions">* Khusus untuk Kelas Karyawan</div>
            <div class="new-hero-menu-container">
                <div class="new-hero-menu-card">
                    <div class="new-hero-menu-card-title">Kuliah Reguler</div>
                    <div class="new-hero-menu-card-desc">Tingkatkan potensi dan raih peluang kerja dengan kuliah full-time.</div>
                    <ul class="new-hero-menu-card-checklist">
                        <li>5 hari seminggu</li>
                        <li>Studi lapangan & kunjungan industri</li>
                        <li>Kuliah hybrid (online dan offline)</li>
                    </ul>
                    <a href="<?= get_site_url(); ?>/pmb/jalur-studi-di-fisip-upri?nojump#kelas-reguler" class="new-hero-menu-card-button">Baca Info</a>
                </div>
                <div class="new-hero-menu-card">
                    <div class="new-hero-menu-card-title">Kelas Karyawan</div>
                    <div class="new-hero-menu-card-desc">Beban belajar yang dapat disesuaikan dengan jadwal pekerjaan.</div>
                    <ul class="new-hero-menu-card-checklist">
                        <li><b>2 hari seminggu</b></li>
                        <li><b>Bisa sarjana dalam 2 tahun</b></li>
                        <li>Potensi konversi pengalaman kerja jadi SKS</li>
                        <li>Kuliah hybrid (online dan offline)</li>
                    </ul>
                    <a href="<?= get_site_url(); ?>/pmb/jalur-studi-di-fisip-upri?nojump#kelas-rpl" class="new-hero-menu-card-button">Baca Info</a>
                </div>
            </div>
        </div>
    </div>
    <div class="new-hero-social-proof container">
        <div class="new-hero-social-proof-label">Gabung di komunitas FISIP UPRI bersama ribuan alumni yang <b>bekerja di industri dinamis</b> seperti</div>
        <div class="new-hero-social-proof__company-list">
            <?php

                $args = array(
                    'post_type'         => 'attachment',
                    'posts_per_page'    => 16,
                    'post_status'       => 'any',
                    'tax_query'         => array(
                        array(
                            'taxonomy'  => 'image_locations',
                            'field'     => 'name',
                            'terms'     => 'workplace',
                        )
                    )
                );

                $query = new WP_query( $args );

                if( $query->have_posts() ):
                    while( $query->have_posts() ):
                        $query->the_post();
                ?>

                <img class="new-hero-social-proof__company-list-card" src="<?= wp_get_attachment_image_url( get_the_ID(), 'full' ); ?>" title="<?= wp_get_attachment_caption( get_the_ID() ); ?>" />

                <?php
                endwhile;
                endif;

                wp_reset_postdata();

                ?>
        </div>
    </div>
</section>

<section id="prodi" class="section">
    <div class="prodi-inner section-inner container text-center">
        <h2>Berjuang Meraih Sukses.</h2>
        <p class="centered-box constrained">Klik link di bawah untuk belajar bagaimana program-program studi FISIP UPRI dapat membantu Anda meraih keberhasilan dan mewujudkan potensi.</p>
        <p style="font-weight: 200;"><i>Semua Program Studi di FISIP UPRI terakreditasi BAN-PT.</i></p>
        <div>
            <a class="see-more see-more--blue" href="https://fisipupri.ac.id/tentang-fisip-upri/akreditasi/">Baca tentang Akreditasi BAN-PT →</a>
        </div>
        <div class="prodi-list">
        
        <?php

            $args = array(
                'post_type'     => 'study-program-about',
                'post_parent'   => 0,
            );

            $query = new WP_Query( $args );

            if( $query->have_posts() ) :
                while( $query->have_posts() ) :
                    $query->the_post();

        ?>

        <div class="study-program-card p-2">
            <a href="<?= get_permalink(); ?>" title="Program studi <?= get_the_title(); ?>">
                    <img src="<?= get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" />
                <h2><?= get_the_title(); ?></h2>
            </a>
        </div>

        <?php
            endwhile;
            endif;
            wp_reset_postdata();
        ?>

        </div>
    </div>
</section>

<section id="details" class="section section--dark container--full">
    <div class="section-inner container">
        <div class="details-left-col">
            <h2>Dampak Sosial yang Nyata.</h2>
            <h3>FISIP UPRI berkomitmen menghasilkan lulusan dengan kepekaan sosial yang tinggi.</h3>
            <p> Kurikulum FISIP UPRI fokus pada isu-isu sosial dan mendorong solusi yang berkelanjutan. Melalui kolaborasi dengan organisasi lokal dan internasional, mahasiswa dibimbing agar dapat membuat perubahan yang berdampak langsung pada masyarakat.</p>
        </div>
        <div class="details-right-col">
            <?php

                $args = array(
                    'post_type'         => 'attachment',
                    'posts_per_page'    => 3,
                    'post_status'       => 'any',
                    'tax_query'         => array(
                        array(
                            'taxonomy'  => 'image_locations',
                            'field'     => 'name',
                            'terms'     => 'stock',
                        )
                    )
                );

                $query = new WP_query( $args );

                if( $query->have_posts() ):
                    while( $query->have_posts() ):
                        $query->the_post();
            ?>

                <img class="details-card" src="<?= wp_get_attachment_image_url( get_the_ID(), 'large' ); ?>" title="<?= wp_get_attachment_caption( get_the_ID() ); ?>" />

            <?php
                endwhile;
                endif;
            ?>
        </div>
    </div>
</section>

<section id="prodi" class="section">
    <div class="prodi-inner section-inner container">
        <h2>Kembangkan Karir. Kuliah Sambil Kerja.</h2>
        <h3>Konversi pengalaman kerja menjadi SKS.</h3>
        <p class="constrained">Dengan Program RPL, Anda dapat mengkonversi pengetahuan dan pengalaman nyata dari dunia kerja menjadi Satuan Kredit Semester (SKS) untuk gelar Sarjana.</p>
        <div>
            <a class="see-more see-more--blue" href="https://fisipupri.ac.id/pmb/program-rekognisi-pembalajaran-lampau-rpl/">Baca detail tentang program RPL →</a>
        </div>
    </div>
</section>

<section id="brosur" class="section">
    <section class="brosur-inner container">
        <div class="brosur-form-container">
            <h2>Download Brosur FISIP UPRI</h2>
            <p>Dapatkan semua informasi terpenting mengenai proses pembelajaran dan pengalaman berkuliah di UPRI.</p>
            <a href="https://fisipupri.ac.id/wp-content/uploads/2024/07/brosur_fisip_upri_2024.pdf" id="btn-download-brosur" class="button button--blue">Download Brosur</a>
        </div>
        <div class="brosur-girl-container unselectable">
            <img class="brosur-girl" src="<?= get_template_directory_uri() . '/includes/images/upri_girl.png;' ?>" />
        </div>
    </section>
</section>

<section id="experience-fisip" class="section">
    <div class="experience-fisip-inner section-inner container">
        <h2>Experience FISIP@UPRI</h2>
        <h3>Ruang yang nyaman untuk seluruh mahasiswa dan civitas akademika.</h3>
        <p class="constrained">Kami menyediakan berbagai layanan dan fasilitas demi proses perkuliahan yang kondusif untuk belajar.</p>
        <div class="experience-fisip-list">
            <?php
                $query = new WP_Query( array(
                    'post_type'         => 'highlights',
                    'posts_per_page'    => 7
                ));

                if( $query->have_posts() ):
                    while( $query->have_posts() ):
                        $query->the_post();

            ?>
            <a href="<?= get_the_permalink(); ?>" class="experience-card">
                <img class="experience-thumbnail" src="<?= get_the_post_thumbnail_url( get_the_ID(), $size = 'large' ); ?>" />
                <div class="dark-gradient"></div>
                <div class="experience-title"><?= get_the_title(); ?></div>
            </a>
            <?php
                endwhile;
                endif;
                wp_reset_postdata();
            ?>
        </div>
        <div>
            <a class="see-more see-more--blue" href="/pmb/program-rekognisi-pembalajaran-lampau-rpl/">Baca tentang pengalaman berkuliah di FISIP UPRI →</a>
        </div>
    </div>
</section>

<section id="news" class="section section--dark container--full">
    <div class="news-inner section-inner text-center">
        <h2>Info FISIP</h2>
        <h3>Berita dan informasi terbaru tentang FISIP UPRI.</h3>
        <div class="news-carousel container">
        
        <?php
        
        $query = new WP_Query( array(
            'post_type'         => 'post',
            'posts_per_page'    => 4,
            'category__in'      => array(
                get_category_by_slug( 'blog' )->term_id,
                get_category_by_slug( 'news' )->term_id,
                get_category_by_slug( 'penelitian' )->term_id,
            ),
            'orderby'           => 'date',
        ));

        if( $query->have_posts() ):
            while( $query->have_posts() ):
                $query->the_post();

        ?>

        <div class="news-card">
            <a href="<?= get_the_permalink(); ?>">
                <img class="news-thumbnail" src="<?= get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" />
            </a>
            <div class="news-label">
                <a href="<?= get_category_link( get_the_category()[0]->term_id ); ?>">
                    <?= get_the_category()[0]->name; ?>
                </a>
            </div>
            <a href="<?= get_the_permalink(); ?>">
                <h2><?= get_the_title(); ?></h2>
            </a>
            <div class="news-date"><?= get_the_date(); ?></div>
            </a>
        </div>

        <?php
            endwhile;
            endif;
            wp_reset_postdata();
        ?>

        </div>
        <div>
            <a class="see-more see-more--yellow" href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>">Lihat semua →</a>
        </div>
    </div>
</div>
</section>

<section id="final-cta" class="section">
    <div class="final-cta-inner section-inner container">
        <h2>Siap Memulai Perjalanan Akademik Anda?</h2>
        <h3>Mari kita bersama-sama membuat dampak positif dalam komunitas.</h3>
        <p class="constrained">Wujudkan potensi penuh Anda dengan pendidikan berkualitas di FISIP UPRI. Kejar ilmu, kembangkan diri, berjuang meraih sukses. </p>
        <div class="final-cta-box">
            <h3 class="final-cta-title"><i>Quicklinks</i> Info PMB</h3>
            <div class="final-cta-list">
                <?php

                    $args = array(
                        'post_type'     => 'page',
                        'post_name__in'         => array(
                            'penerimaan-mahasiswa-baru',
                        ),
                    );

                    $query = new WP_Query( $args );

                    if( !empty( $query )):
                        $pmb_id = $query->posts[0]->ID; // id for PMB parent

                        $args = array(
                            'post_type'     => 'page',
                            'post_parent'   => $pmb_id,
                        );

                        wp_reset_postdata();

                        $query = new WP_Query( $args );

                        if( $query->have_posts() ) :
                            while( $query->have_posts() ) :
                                $query->the_post();

                ?>

                    <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?> →</a>

                <?php
                    endwhile;
                    endif;
                    endif; 
                ?>
            </div>
            <hr />
            <h3 class="final-cta-title"><i>Quicklinks</i> Layanan Mahasiswa</h3>
            <div class="final-cta-list">
                <?php

                    $args = array(
                        'post_type'     => 'page',
                        'post_name__in'         => array(
                            'layanan-mahasiswa',
                        ),
                    );

                    $query = new WP_Query( $args );

                    if( !empty( $query )):
                        $pmb_id = $query->posts[0]->ID; // id for PMB parent

                        $args = array(
                            'post_type'     => 'page',
                            'post_parent'   => $pmb_id,
                        );

                        wp_reset_postdata();

                        $query = new WP_Query( $args );

                        if( $query->have_posts() ) :
                            while( $query->have_posts() ) :
                                $query->the_post();

                ?>

                    <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?> →</a>

                <?php
                    endwhile;
                    endif;
                    endif; 
                ?>
            </div>
        </div>
    </div>
</section>

<section id="mid-cta" class="section">
    <div id="mid-cta-inner" class="container">
        <div class="mid-cta-image">
            <img src="<?= get_template_directory_uri() . "/includes/images/fisip_girl.png"; ?>" />
        </div>
        <div class="mid-cta-text">
            <h2>Awali Masa Depan yang Cerah. Daftar Sekarang.</h2>
            <p>Jika Anda ingin menjadi agen perubahan positif di komunitas, gabung bersama kami di FISIP UPRI.</p>
            <div class="cta-column text-center">
                <a href="https://fisipupri.ac.id/pmb/pendaftaran-mahasiswa-baru/" class="cta cta--blue">Klik untuk Memulai Registrasi →</a>
                <a class="see-more see-more--small see-more--blue" href="https://wa.me/6281244375770">Mau bertanya? →</a>
            </div>
        </div>
    </div>
</section>

<div id="question" class="question text-center">
    <a id="question-close">X</a>
    <h2>Punya pertanyaan?</h2>
    <a href="https://wa.me/6281244375770" target="_blank"><img class="chat_whatsapp" src="<?= get_template_directory_uri() . "/includes/images/chat_on_whatsapp.png"; ?>" /></a>
</div>


<?php

$args = array(
    'post_type'         => 'attachment',
    'posts_per_page'    => 1,
    'post_status'       => 'any',
    'tax_query'         => array(
        array(
            'taxonomy'  => 'image_locations',
            'field'     => 'name',
            'terms'     => 'footer',
        )
    )
);

$query = new WP_query( $args );
$the_footer_image_url = get_template_directory_uri() . "/includes/images/vista-background.jpeg";

if( $query->have_posts() ) {
    while( $query->have_posts() ) {
        $query->the_post();

        $the_footer_image_url = wp_get_attachment_image_url( get_the_ID(), 'full' );
    }
}

wp_reset_postdata();

?>

<?php get_footer(); ?>