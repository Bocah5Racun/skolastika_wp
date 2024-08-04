<?php
    const ADMIN_EMAIL = "janisalande@komkom.id";
    const VALID_KEYS = [
        'department',
        'program',
        'full_name',
        'city',
        'email',
        'school',
        'phone'
    ];

    if( 
        isset( $_POST['department'] )
        && isset( $_POST['program'] )
        && isset( $_POST['full_name'] )
        && isset( $_POST['city'] )
        && isset( $_POST['email'] )
        && isset( $_POST['school'] )
        && isset( $_POST['phone'] )
    ) :

        foreach( $_POST as $key => $value ) {
            if( in_array( $key, VALID_KEYS ))
            $_POST[$key] == trim( $value );
            $_POST[$key] == stripslashes( $value );
            $_POST[$key] == htmlspecialchars( $value );
        }

        extract( $_POST );

        if( !isset( $_SESSION["submission_time"] ) ) $_SESSION["submission_time"] = time();

        // send email to ADMIN_EMAIL
        $to = ADMIN_EMAIL;
        $subject = "[PMB FISIP] - {$program} - {$department} - {$full_name}";
        $message = <<<EOD
        Nama Lengkap: $full_name
        Kota: $city
        Email: $email
        WhatsApp: $phone
        Asal Sekolah: $school
        Jenis Pendaftaran: $program
        Program Studi Pilihan: $department
        EOD;

        mail( $to, $subject, $message );

?>

<section class="section section--upri-blue">
    <div class="section-inner container constrained">
        <h2>Terima kasih!</h2>
        <p>Anda berhasil memulai proses pendaftaran diri sebagai mahasiswa baru di FISIP UPRI Makassar!</p>
        <h2>Apa Langkah Selanjutnya?</h2>
        <p>Tim Admisi akan segera menghubungi Anda melalui WhatsApp untuk memandu Anda dalam melanjutkan proses pendaftaran. Pastikan nomor WhatsApp Anda aktif dan dapat dihubungi.</p>
    </div>
</section>

<section id="data-review" class="section container">
    <div class="section-inner section--light-gray p-4 container constrained">
        <h2>Data Diri Anda</h2>
        <div class="note">
            <p>Harap periksa kembali data personal Anda di bawah ini. Apabila terdapat kesalahan, silakan daftar kembali.</p>
            <a class="see-more see-more--blue" href="<?= get_site_url() . "/penerimaan-mahasiswa-baru/pendaftaran-mahasiswa-baru/" ?>">Kembali ke Formulir Pendaftaran Mahasiswa Baru →</a>
        </div>
        <div class="review-item">
            <label>Nama Lengkap</label>
            <div><?= $full_name; ?></div>
        </div>
        <div class="review-item">
            <label>Kota Domisili</label>
            <div><?= $city; ?></div>
        </div>
        <div class="review-item">
            <label>Email</label>
            <div><?= $email; ?></div>
        </div>
        <div class="review-item">
            <label>Asal Sekolah</label>
            <div><?= $school; ?></div>
        </div>
        <div class="review-item">
            <label>Nomor WhatsApp</label>
            <div><?= $phone; ?></div>
        </div>
        <div class="review-item">
            <label>Jenis Pendaftaran yang Dipilih</label>
            <div>
                Kelas 
                <?php if( $program == 'rpl' ) echo "RPL"; ?>
                <?php if( $program == 'reguler' ) echo "Reguler"; ?>
            </div>
        </div>
        <div class="review-item">
            <label>Program Studi yang Dipilih</label>
            <div>
                <?php if( $department == 'administrasi' ) echo "Ilmu Administrasi Negara"; ?>
                <?php if( $department == 'komunikasi' ) echo "Ilmu Komunikasi"; ?>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-inner container constrained">
        <a class="see-more see-more--blue" href="<?= get_site_url(); ?>">Kembali ke Halaman Utama →</a>    
    </div>
</section>

<?php else : ?>

<section class="section section--upri-blue">
    <div class="section-inner container">
        <h2>Galat Mengirimkan Data</h2>
        <p>Data yang Anda kirimkan salah atau tidak dapat diunggah. Silakan coba kembali.</p>
        <a href="<?= get_site_url(); ?>">Kembali ke halaman utama →</a>
    </div>
</section>
    
<?php endif; ?>