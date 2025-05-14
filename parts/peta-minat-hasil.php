<?php

if( !isset( $_POST ) ) die( "You didn't send anything!" );

// validate and clean $_POST items
$name = isset( $_POST['nama'] ) ? filter_var( $_POST['nama'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) : die( "Name not set" );
$sekolah = isset( $_POST['sekolah'] ) ? filter_var( $_POST['sekolah'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) : die( "School not set" );
$nomor = isset( $_POST['nomor'] ) ? preg_replace('/[^\d]/', '', $_POST['nomor']) : die( "Number not set" );

$ratings = json_decode( stripslashes( $_POST['dimensions'] ), true );

// validate the dimensions and ratings then add to a total score
$riasec_scores = [
    'R' => 0,
    'I' => 0,
    'A' => 0,
    'S' => 0,
    'E' => 0,
    'C' => 0,
];

foreach( $ratings as $rating ) {

    $the_dimension = $rating['dimension'];
    $the_value = $rating['value'];

    if( !str_contains( 'RIASEC', $the_dimension ) ) die( "Not a valid dimension." );
    if( !str_contains( '012', $the_value ) ) die( "Not a valid value." );

    $riasec_scores[ $the_dimension ] += $the_value;

}

// sort the $riasec_scores array descending order based on dimension score
arsort( $riasec_scores );

// get the keys and output the final profile
$riasec_keys = array_keys( $riasec_scores ); // get the keys in order
$riasec_values = array_values( $riasec_scores );

$first_dim = $riasec_values[0];
$second_dim = $riasec_values[1];
$third_dim = $riasec_values[2];

$profile = $riasec_keys[0] . $riasec_keys[1]; // initialize $profile and add the first score
$profile_desc = [
    return_desc( $riasec_keys[0] ),
    return_desc( $riasec_keys[1] ),
];

// returns the description of the dimension name
function return_desc( $letter ) {

    $descriptions = [
        'R' => 'Realistic',
        'I' => 'Investigative',
        'A' => 'Artistic',
        'S' => 'Social',
        'E' => 'Enterprising',
        'C' => 'Conventional',
    ];

    foreach( $descriptions as $key => $value ) {
        if( $key == $letter) return $value;
    }
}

// returns a third dimension if it's >=80% of the second dim's score
if( ( $third_dim / $second_dim ) >= 0.8 ) {
    $profile .= $riasec_keys[2];
    $profile_desc[] = return_desc( $riasec_keys[2] );
}

$sorted_profile = str_split( $profile );
$profile_length = count( $sorted_profile );


sort( $sorted_profile );
$sorted_profile = implode( '', $sorted_profile );
$long_desc;

// list of all possible 2- and 3-letter RIASEC combinations
$combo_desc = [
    'ACR' => [
        'desc' => '<p>Individu dengan kombinasi ini cocok di pekerjaan yang terstruktur dan praktis tetapi juga memerlukan daya kreatif yang tinggi.</p>',
        'bidang' => 'Desain dan Seni, Pemasaran dan Periklanan, Manajemen Proyek, Produksi dan Media',
        'karir_komunikasi' => 'Manajer Pemasaran Kreatif'
    ]
]
?>

<!-- OPEN JOB-CARDS-WRAPPER -->
<div id="job-cards-wrapper">

<!-- CARD NO. 1 -->

    <div class="job-card-wrapper">
        <div class="job-card results-card-1">
            <div class="job-card-logo">
                <?php the_custom_logo(); ?>
            </div>
            <h1><?= $profile; ?></h1>
            <div class="dimension-names">
                <?php
                    foreach( $riasec_keys as $key ):
                ?>
                <div class="dimension-name"><?= return_desc( $key ); ?></div>
                <div class="dimension-bar-wrapper">
                    <div class="dimension-bar"></div>
                </div>

                <?php endforeach; ?>
            </div>
            <div class="icon pointdown" style="margin-top: auto;">👇</div>
        </div>
    </div>

<!-- CARD NO. 2 -->

    <div class="job-card-wrapper">
        <div class="job-card results-card-1">
            <div class="job-card-logo">
                <?php the_custom_logo(); ?>
            </div>
            <h1><?= $profile; ?></h1>
            <div class="results-section">
                <div class="results-card-text">
                    <?=
                        $combo_desc[$sorted_profile]['desc'];
                    ?>
                </div>
            </div>
            <div class="results-fields results-section">
                <h3 class="results-card-heading">Rekomendasi Bidang Kerja</h3>
                <div><?= $combo_desc[$sorted_profile]['bidang']; ?></div>
            </div>
        </div>
    </div>

<!-- CARD NO. 3 - JOB # 1 -->

    <div class="job-card-wrapper">
        <div id="q${questionNo}" class="job-card">
            <div class="job-card-counter">${questionNo}/${questionsLength}</div>
            <img src="<?= $img_dir; ?>/job-images/${id}.png" class="job-card-image">
            <div class="job-card-description">
                <div class="job-card-question-pretext">Apakah kamu suka...</div>
                <div class="job-card-question-text">${question}</div>
            </div>
            <div class="job-card-rating-wrapper">
                <div class="job-card-rating-hearts-wrapper">
                <input type="radio" id="q${questionNo}_rating1" name="q${questionNo}" value="0" data-dimension="${dimension}" required>
                <label for="q${questionNo}_rating1">😔</label>
                <input type="radio" id="q${questionNo}_rating2" name="q${questionNo}" value="1" data-dimension="${dimension}" required>
                <label for="q${questionNo}_rating2">😐</label>
                <input type="radio" id="q${questionNo}_rating3" name="q${questionNo}" value="2" data-dimension="${dimension}" required>
                <label for="q${questionNo}_rating3">😊</label>
                </div>
            </div>
        </div>
    </div>

<!-- CLOSE JOB-CARDS-WRAPPER -->

<script>
    const bars = document.querySelectorAll('.dimension-bar')

    console.log(bars)
    const riasec_scores = [
        <?php foreach( $riasec_values as $value ): ?>
            <?= $value; ?>,
        <?php endforeach; ?>
    ]
    
    for(let i = 0; i < bars.length; i++) {
        bars[i].style.width = `${riasec_scores[i] * 100 / 16}%`
    }
</script>