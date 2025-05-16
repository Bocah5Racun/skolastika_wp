<?php
    $img_dir = get_template_directory_uri() . '/includes/images/peta-minat';
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
?>

<a href="#explainer-summary-wrapper" id="jump-to-summary">
    Review Jawaban
</a>

<div id="popup">
    <form autocomplete="off" id="popup-survei" method="POST" class="popup-inner-wrapper">
        <div class="job-card">
            <div class="job-card-logo">
                <img src="<?= esc_url( $logo[0] ); ?>" class="custom-logo">
            </div>
            <h2>Tinggal Satu Langkah Lagi!</h2>
            <div class="popup-desc-text">
                <p>Isi informasi di bawah ini untuk menerima <b>Profil Minat</b> dan rekomendasi program studi yang pas buat kamu.</p>
                <div class="disclaimer-text">Data Anda tidak akan dibagikan atau diperjualbelikan kepada pihak ketiga.</div>
            </div>
            <div class="popup-form-wrapper">
                <input type="hidden" id="dimensions" name="dimensions">
                <input type="text" name="nama" placeholder="Nama lengkap" required>
                <input type="text" name="sekolah" placeholder="Asal sekolah" required>
                <input type="tel" name="nomor" placeholder="Nomor WhatsApp" required>
                <div class="disclaimer-wrapper">
                    <input id="popup-disclaimer" type="checkbox">
                    <span>Saya setuju menerima info tentang penawaran dan promosi dari FISIP UPRI.</span>
                </div>
                <div id="popup-submit-wrapper" class="popup-form-button-wrapper">
                    <button id="submit-button" class="popup-btn-submit">Lihat Potensiku</button>
                    <a class="popup-btn-other">Cancel</a>
                </div>
                <img src="<?= $img_dir; ?>/loading.png" alt="" id="loader">
            </div>
        </div>
    </form>
</div>

<div class="mobile-overlay"></div>

<div id="job-cards-wrapper">
    <div class="job-card-wrapper">
        <div id="the-explainer" class="job-card explainer">
            <div class="job-card-logo">
                <img src="<?= esc_url( $logo[0] ); ?>" class="custom-logo">
            </div>
            <h1>Peta Minat</h1>
            <div class="explainer-desc-wrapper">
                <p>Survei ini akan membantu kamu mencari program studi yang cocok dengan minat.</p>
                <p>Kamu tinggal pilih apakah kamu suka atau tidak suka aktivitas-aktivitas di bawah.</p>
                <p><b>Waktu Penyelesaian: 3–5 menit</b>.</p>
            </div>
            <img src="<?= $img_dir; ?>/down-arrow.png" class="point point--down"onclick="scrollPage( 1 )">
        </div>
    </div>
</div>

<script>

const questionsDatabase = [
    {
        'id': 1,
        'question': 'Merakit komponen elektronik',
        'dimension': 'R',
    },
    {
        'id': 2,
        'question': 'Menguji kualitas komponen sebelum dikirim',
        'dimension': 'R',
    },
    {
        'id': 3,
        'question': 'Memasang batu bata atau ubin',
        'dimension': 'R',
    },
    {
        'id': 4,
        'question': 'Bekerja di pengeboran minyak lepas pantai',
        'dimension': 'R',
    },
    {
        'id': 5,
        'question': 'Mengoperasikan mesin di pabrik',
        'dimension': 'R',
    },
    {
        'id': 6,
        'question': 'Memperbaiki keran yang rusak',
        'dimension': 'R',
    },
    {
        'id': 7,
        'question': 'Merakit produk di pabrik',
        'dimension': 'R',
    },
    {
        'id': 8,
        'question': 'Memasang lantai di rumah',
        'dimension': 'R',
    },
    {
        'id': 9,
        'question': 'Membuat peta dasar laut',
        'dimension': 'I',
    },
    {
        'id': 10,
        'question': 'Mempelajari struktur tubuh manusia',
        'dimension': 'I',
    },
    {
        'id': 11,
        'question': 'Mempelajari perilaku hewan',
        'dimension': 'I',
    },
    {
        'id': 12,
        'question': 'Melakukan penelitian tentang tumbuhan atau hewan',
        'dimension': 'I',
    },
    {
        'id': 13,
        'question': 'Mengembangkan pengobatan atau prosedur medis baru',
        'dimension': 'I',
    },
    {
        'id': 14,
        'question': 'Melakukan penelitian biologi',
        'dimension': 'I',
    },
    {
        'id': 15,
        'question': 'Mempelajari paus dan jenis kehidupan laut lainnya',
        'dimension': 'I',
    },
    {
        'id': 16,
        'question': 'Bekerja di laboratorium biologi',
        'dimension': 'I',
    },
    {
        'id': 17,
        'question': 'Mendesain set panggung untuk pertunjukan teater',
        'dimension': 'A',
    },
    {
        'id': 18,
        'question': 'Melakukan aksi laga untuk film atau acara televisi',
        'dimension': 'A',
    },
    {
        'id': 19,
        'question': 'Memainkan alat musik',
        'dimension': 'A',
    },
    {
        'id': 20,
        'question': 'Menulis buku atau naskah drama',
        'dimension': 'A',
    },
    {
        'id': 21,
        'question': 'Menulis lagu',
        'dimension': 'A',
    },
    {
        'id': 22,
        'question': 'Mendesain karya seni untuk majalah',
        'dimension': 'A',
    },
    {
        'id': 23,
        'question': 'Menyutradarai sebuah pertunjukan teater',
        'dimension': 'A',
    },
    {
        'id': 24,
        'question': 'Memimpin paduan suara musik',
        'dimension': 'A',
    },
    {
        'id': 25,
        'question': 'Membantu orang lansia dengan aktivitas sehari-hari',
        'dimension': 'S',
    },
    {
        'id': 26,
        'question': 'Mengajarkan anak-anak cara membaca',
        'dimension': 'S',
    },
    {
        'id': 27,
        'question': 'Mengawasi kegiatan anak-anak di sebuah perkemahan',
        'dimension': 'S',
    },
    {
        'id': 28,
        'question': 'Membantu orang dengan masalah terkait keluarga',
        'dimension': 'S',
    },
    {
        'id': 29,
        'question': 'Mengajarkan rutinitas latihan kepada seseorang',
        'dimension': 'S',
    },
    {
        'id': 30,
        'question': 'Membantu orang yang memiliki masalah dengan narkoba atau alkohol',
        'dimension': 'S',
    },
    {
        'id': 31,
        'question': 'Melakukan pekerjaan sukarela di organisasi nirlaba',
        'dimension': 'S',
    },
    {
        'id': 32,
        'question': 'Memberikan bimbingan karir kepada orang',
        'dimension': 'S',
    },
    {
        'id': 33,
        'question': 'Mengelola toko mainan',
        'dimension': 'E',
    },
    {
        'id': 34,
        'question': 'Menjual rumah',
        'dimension': 'E',
    },
    {
        'id': 35,
        'question': 'Mengelola toko pakaian',
        'dimension': 'E',
    },
    {
        'id': 36,
        'question': 'Mengelola sebuah departemen dalam perusahaan besar',
        'dimension': 'E',
    },
    {
        'id': 37,
        'question': 'Mengelola salon kecantikan atau toko cukur',
        'dimension': 'E',
    },
    {
        'id': 38,
        'question': 'Mengelola operasi sebuah hotel',
        'dimension': 'E',
    },
    {
        'id': 39,
        'question': 'Menjual barang dagangan di toko kelontong',
        'dimension': 'E',
    },
    {
        'id': 40,
        'question': 'Menjual waralaba restoran kepada pelanggan',
        'dimension': 'E',
    },
    {
        'id': 41,
        'question': 'Menyimpan catatan pengiriman dan penerimaan',
        'dimension': 'C',
    },
    {
        'id': 42,
        'question': 'Menangani transaksi bank pelanggan',
        'dimension': 'C',
    },
    {
        'id': 43,
        'question': 'Mengoperasikan kalkulator',
        'dimension': 'C',
    },
    {
        'id': 44,
        'question': 'Menghitung dan mencatat data statistik dan data numerik lainnya',
        'dimension': 'C',
    },
    {
        'id': 45,
        'question': 'Mengelola database karyawan',
        'dimension': 'C',
    },
    {
        'id': 46,
        'question': 'Menggunakan program komputer untuk menghasilkan tagihan pelanggan',
        'dimension': 'C',
    },
    {
        'id': 47,
        'question': 'Mengelola inventaris alat kantor',
        'dimension': 'C',
    },
    {
        'id': 48,
        'question': 'Menyusun laporan gaji bulanan untuk kantor',
        'dimension': 'C',
    },
]

const questionsLength = questionsDatabase.length

const shuffledQuestions = questionsDatabase.sort(() => Math.random() - 0.5);

const jobCardWrapper = document.getElementById('job-cards-wrapper')

shuffledQuestions.forEach((questionObject, index) => {
    const {id, question, dimension} = questionObject
    const jobCard = document.createElement('div')
    const questionNo = index + 1;
    jobCard.className = 'job-card-wrapper'
    jobCard.innerHTML = `
        <div id="q${questionNo}" class="job-card">
            <img src="<?= $img_dir; ?>/down-arrow.png" class="point point--up"onclick="scrollPage( -1 )">
            <div class="job-card-counter">${questionNo}/${questionsLength}</div>
            <img src="<?= $img_dir; ?>/survey-images/${id}.jpg" class="job-card-image">
            <div class="job-card-description">
                <div class="job-card-question-pretext">Kamu suka...</div>
                <div class="job-card-question-text">${question}</div>
            </div>
            <div class="job-card-rating-wrapper">
                <div class="job-card-emoji">😔</div>
                <div class="job-card-rating-hearts-wrapper">
                    <input type="radio" id="q${questionNo}_rating5" name="q${questionNo}" value="4" data-dimension="${dimension}" required>
                    <label for="q${questionNo}_rating5"></label>
                    <input type="radio" id="q${questionNo}_rating4" name="q${questionNo}" value="3" data-dimension="${dimension}" required>
                    <label for="q${questionNo}_rating4"></label>
                    <input type="radio" id="q${questionNo}_rating3" name="q${questionNo}" value="2" data-dimension="${dimension}" required>
                    <label for="q${questionNo}_rating3"></label>
                    <input type="radio" id="q${questionNo}_rating2" name="q${questionNo}" value="1" data-dimension="${dimension}" required>
                    <label for="q${questionNo}_rating2"></label>
                    <input type="radio" id="q${questionNo}_rating1" name="q${questionNo}" value="0" data-dimension="${dimension}" required>
                    <label for="q${questionNo}_rating1"></label>
                </div>
                <div class="job-card-emoji">😊</div>
            </div>
            <img src="<?= $img_dir; ?>/down-arrow.png" class="point point--down"onclick="scrollPage( 1 )">
        </div>
    `
    jobCardWrapper.appendChild(jobCard)
});

const summaryCard = document.createElement('div')

summaryCard.className = 'job-card-wrapper'
summaryCard.innerHTML = `
    <div id="summary-card" class="job-card">
        <a class="return-to-top" href="#the-explainer">Kembali ke Atas ⤴️</a>
        <div id="explainer-summary-wrapper">
        </div>
        <div id="submission-warning">
            <div class="submission-icon">⚠</div>
            <div id="warning-text" class="submission-text"></div>
        </div>
        <button id="submit" class="peta-minat-btn" onclick="checkPopup()">Lihat Profil Minat</button>
    </div>
`

jobCardWrapper.appendChild(summaryCard)

// populate summary with empty values for each question
const summaryWrapper = document.getElementById('explainer-summary-wrapper')

for(let i = 0; i < questionsLength; i++) {
    const summaryCard = document.createElement('a')
    summaryCard.className = 'summary-card'
    summaryCard.id = `q${i + 1}-summary`
    summaryCard.href = `#q${i + 1}`
    summaryCard.innerHTML = `
        <div class="summary-card-no">${i + 1}</div>
        <div class="summary-card-icon">⚫</div>
    `

    summaryWrapper.appendChild(summaryCard)
}

document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', (e) => {
        const name = e.target.name
        const value = parseInt(e.target.value)

        const summaryCard = document.getElementById(`${name}-summary`)
        const summaryCardIcon = summaryCard.querySelector('.summary-card-icon')

        summaryCardIcon.innerHTML = (value || value === 0) ? "🟢" : "⚫"
    })
});

// scroll to next page function
function scrollPage( dir ) {
    setTimeout(() => {
        jobCardWrapper.scrollBy({
            top: window.innerHeight * dir,
            behavior: 'smooth',
        })
    }, 75)
}

// jump to the very bottom
const summaryJump = document.getElementById("jump-to-summary")

jobCardWrapper.addEventListener("scroll", (e) => {
    if(jobCardWrapper.scrollTop >= 0.5 * jobCardWrapper.clientHeight&& jobCardWrapper.scrollTop <= 48.5 * jobCardWrapper.clientHeight) {
        summaryJump.classList.add("summary--show")
    } else {
        summaryJump.classList.remove("summary--show")
    }
})

// check if all questions answered then show popup
const popup = document.getElementById('popup')
const warningBox = document.getElementById('submission-warning')
const warningText = document.getElementById('warning-text')

function checkAnswers() {
    const ratings = document.querySelectorAll('input[type="radio"]:checked')
    const totalRatings = ratings.length
    return totalRatings >= questionsLength ? true : false
}

function checkPopup() {
    const questionsAnswered = checkAnswers()
    const ratings = document.querySelectorAll('input[type="radio"]:checked')

    if(questionsAnswered) {
        let notZero = false; // checks if RIASEC score is zero

        const ratingsArray = Array.from(ratings).map( rating => {
            if(rating.value > 0) notZero = true
            return {
                name: rating.name,
                dimension: rating.dataset.dimension,
                value: rating.value,
            }
        })

        const dimensions = document.getElementById('dimensions')
        dimensions.value = JSON.stringify( ratingsArray )

        if(notZero) {
            popup.classList.add('popup--show')
        } else {
            popup.classList.remove('popup--show')
            warningText.textContent = 'Kamu harus suka sekurang-kurangnya satu aktivitas untuk mendapatkan profil.'
            warningBox.classList.add('submission--show')
            setTimeout(() => {
                warningBox.classList.remove('submission--show')
            }, 5000);
        }
    } else {
        popup.classList.remove('popup--show')
        warningText.textContent = 'Jawab semua pertanyaan.'
        warningBox.classList.add('submission--show')
        setTimeout(() => {
            warningBox.classList.remove('submission--show')
        }, 5000);
    }
}

// popup controls
const popupSubmit = popup.querySelector('.popup-btn-submit')
popupSubmit.addEventListener("click", () => {
    const questionsAnswered = checkAnswers()
    if(questionsAnswered) console.log("All answered!")
})

const popupCancel = popup.querySelector('.popup-btn-other')
popupCancel.addEventListener("click", () => popup.classList.remove("popup--show"))

// loading animation
const loader =  document.getElementById('loader')
const popupSubmitWrapper = document.getElementById('popup-submit-wrapper')

document.getElementById('submit-button').addEventListener('click', () => {
    popupSubmitWrapper.style.display = 'none'
    loader.style.display = 'block'

    setTimeout( () => {
        loader.style.display = 'none'
        popupSubmitWrapper.style.display = 'flex'
    }, 10000)
})

// test combos
function getPermutations(str, length) {
  const results = [];

  function permute(path, remaining) {
    if (path.length === length) {
      results.push(path);
      return;
    }
    for (let i = 0; i < remaining.length; i++) {
      permute(path + remaining[i], remaining.slice(0, i) + remaining.slice(i + 1));
    }
  }

  permute("", str);
  return results;
}

const input = "RIASEC";
const allPermutations = new Set();

for (let len = 1; len <= 3; len++) {
  getPermutations(input, len).forEach(p => allPermutations.add(p));
}

console.log([...allPermutations].sort());

</script>