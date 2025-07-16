<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Email Pendaftaran</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
  <p>Halo <strong><?= htmlspecialchars($full_name) ?></strong>,</p>

  <p>
    Terima kasih telah mendaftar sebagai mahasiswa baru di 
    <strong>Fakultas Ilmu Sosial dan Ilmu Politik Universitas Pejuang Republik Indonesia</strong>.
  </p>

  <p>Kamu mendaftar melalui formulir online dengan mengisi data sebagai berikut:</p>

  <ul style="list-style-type: none; padding-left: 0;">
    <li><strong>Nama:</strong> <?= htmlspecialchars($full_name) ?></li>
    <li><strong>Program Studi:</strong> <?= htmlspecialchars($department) ?></li>
    <li><strong>Jenis Program:</strong> <?= htmlspecialchars($program) ?></li>
    <li><strong>Nomor WhatsApp:</strong> <?= htmlspecialchars($phone) ?></li>
  </ul>

  <p>
    Untuk menyelesaikan proses pendaftaran, silakan kirim dokumen berikut ke 
    <a href="mailto:admisi@fisipupri.ac.id">admisi@fisipupri.ac.id</a>:
  </p>

  <ul>
    <li>Transkrip Nilai dan Ijazah terakhir</li>
    <li>Curriculum Vitae</li>
    <li>Kartu Keluarga</li>
    <li>Scan KTP</li>
    <li>Pas Foto Ukuran 4x6</li>
  </ul>

  <p><strong>Selesaikan pendaftaran sebelum <?= htmlspecialchars($batas) ?>.</strong></p>

  <h3>Informasi Beasiswa dan Bantuan Dana</h3>

  <p>
    Biaya pendidikan menjadi tantangan bagi sebagian mahasiswa. Oleh karena itu, FISIP UPRI menyediakan berbagai metode pembayaran dan program beasiswa bagi mahasiswa yang memenuhi syarat.
  </p>

  <p>
    Calon mahasiswa yang memiliki Kartu Indonesia Pintar (KIP) berhak mendapatkan 
    <strong>Beasiswa KIP Kuliah Penuh</strong> yang mencakup seluruh biaya kuliah serta biaya hidup selama masa studi kamu di FISIP UPRI.
  </p>

  <p>
    Jangan ragu untuk menghubungi tim admisi FISIP UPRI untuk informasi lebih lanjut mengenai syarat dan cara pendaftaran bantuan keuangan.
  </p>

  <ul>
    <li><strong>Email:</strong> <a href="mailto:admisi@fisipupri.ac.id">admisi@fisipupri.ac.id</a></li>
    <li><strong>WhatsApp:</strong> 0812-4437-5770</li>
  </ul>

  <p>
    Tim Admisi Fakultas<br>
    Ilmu Sosial dan Ilmu Politik<br>
    Universitas Pejuang Republik Indonesia<br>
    Jl. Nipa-Nipa Lama Antang No. 23 Makassar, Sulawesi Selatan<br>
    WA: 0812-4437-5770
  </p>
</body>
</html>