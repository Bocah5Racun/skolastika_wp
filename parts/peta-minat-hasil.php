<?php

// API url
global $api_url, $secret_key;
$api_url = "https://script.google.com/macros/s/AKfycbxCctR7wiKAV4seJ9iJuyYjfhIBF_BDKoLIbL2z5J0fgmAJfYB1PEJ_kds1_Z6uFs0A/exec";
$secret_key = "K3VBLVZ3QV38LRUQ6N1G181R8KVJJNOH";

if( isset( $_POST['dimensions'] ) ) {

    // validate and clean $_POST items
    $nama = isset( $_POST['nama'] ) ? filter_var( $_POST['nama'], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) : die( "Name not set" );
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
    
        if( !str_contains( 'RIASEC', $the_dimension ) ) die( 'Not a valid dimension in $rating' );
        if( !str_contains( '012', $the_value ) ) die( 'Not a valid value in $the_value' );
    
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
    
    // initialize $profile and $profile_desc and add the first two values
    $profile = $riasec_keys[0];
    $profile_desc = [
        return_desc( $riasec_keys[0] ),
    ];

    // checks if $second_dim is not zero
    if( $second_dim / $first_dim > 0.5 ) {
        $profile .= $riasec_keys[1];
        array_push( $profile_desc, return_desc( $riasec_keys[1] ) );
    
        // adds a third dimension if it's >=80% of the second dim's score
        if( ( $third_dim / $second_dim ) >= 0.75 ) {
            $profile .= $riasec_keys[2];
            $profile_desc[] = return_desc( $riasec_keys[2] );
        }
    }
    
    // send the results to Google Sheets
    $return_url = get_the_permalink();
    $post_data = array(
        'nama'          => $nama,
        'sekolah'       => $sekolah,
        'nomor'         => $nomor,
        'kode'          => $profile,
        'action'        => 'add_response',
        'key'           => $secret_key,
    );
    
    $ch = curl_init();
    
    curl_setopt( $ch, CURLOPT_URL, $api_url );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post_data) );
    
    $result = curl_exec( $ch );
    
    curl_close( $ch );
    
    $riasec_string = 'success=true';
    
    foreach( $riasec_scores as $key => $value ) {
        $riasec_string .= "&$key=$value";
    }
    
    header( "Location: {$return_url}?$riasec_string" );

    die("It should never get here!");

}

// This is what shows up if successfully submitted
$riasec_scores = [
    'R'     => $_GET['R'],
    'I'     => $_GET['I'],
    'A'     => $_GET['A'],
    'S'     => $_GET['S'],
    'E'     => $_GET['E'],
    'C'     => $_GET['C'],
];

// sort the $riasec_scores array descending order based on dimension score
arsort( $riasec_scores );

// get the keys and output the final profile
$riasec_keys = array_keys( $riasec_scores ); // get the keys in order
$riasec_values = array_values( $riasec_scores );

$first_dim = $riasec_values[0];
$second_dim = $riasec_values[1];
$third_dim = $riasec_values[2];

// initialize $profile and $profile_desc and add the first two values
$profile = $riasec_keys[0];
$profile_desc = [
    return_desc( $riasec_keys[0] ),
];

// checks if $second_dim is not zero
if( $second_dim > 0 ) {
    $profile .= $riasec_keys[1];
    array_push( $profile_desc, return_desc( $riasec_keys[1] ) );

    // adds a third dimension if it's >=80% of the second dim's score
    if( ( $third_dim / $second_dim ) >= 0.8 ) {
        $profile .= $riasec_keys[2];
        $profile_desc[] = return_desc( $riasec_keys[2] );
    }
}

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

$sorted_profile = str_split( $profile );
$profile_length = count( $sorted_profile );


sort( $sorted_profile );
$sorted_profile = implode( '', $sorted_profile );
$long_desc;

// sheets functions
function get_code_info( $code, $desc = true ) {
    global $api_url;
    global $secret_key;

    $post_data = array(
        'action' => $desc ? 'get_code_desc' : 'get_code_bidang',
        'key'   => $secret_key,
        'kode'  => $code,
    );
    
    $ch = curl_init();
    
    curl_setopt( $ch, CURLOPT_URL, $api_url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post_data) );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true ); // Follow redirect
    
    $result = curl_exec( $ch );
    
    curl_close( $ch );

    $out = json_decode( $result, true );

    return $out['content'];
}

// get jobs by code
function get_jobs_by_code( $code ) {

    global $api_url;
    global $secret_key;

    $post_data = array(
        'action' => 'get_jobs_by_code',
        'key'   => $secret_key,
        'kode'  => $code,
    );
    
    $ch = curl_init();
    
    curl_setopt( $ch, CURLOPT_URL, $api_url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post_data) );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true ); // Follow redirect
    
    $result = curl_exec( $ch );
    
    curl_close( $ch );

    $out = json_decode( $result, true );

    return $out['content'];

}
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
            <p style="font-size: 1.2em; margin-top: auto; text-align: center;"><b>Geser untuk melihat karier yang cocok buat tipemu!</b></p>
        </div>
    </div>

<!-- CARD NO. 2 -->

    <div class="job-card-wrapper">
        <div class="job-card">
            <div class="job-card-logo">
                <?php the_custom_logo(); ?>
            </div>
            <h1><?= $profile; ?></h1>
            <div class="results-section">
                <div class="results-card-text">
                    <?= get_code_info( $sorted_profile ); ?>
                </div>
            </div>
            <h3 class="results-card-heading">Rekomendasi Bidang Kerja</h3>
            <ul class="bidang-list">
                <?php
                    $bidang_kerja = get_code_info( $sorted_profile, false );
                    $bidang_kerja_array = explode( ',', $bidang_kerja );
                    foreach( $bidang_kerja_array as $bidang ):
                ?>
                    <li><?= $bidang; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

<!-- CARD NO. 3–5 - JOBS -->

<div class="job-card-wrapper">
    <div class="job-card">
        <div class="job-card-logo">
            <?php the_custom_logo(); ?>
        </div>
        <h1><?= $profile; ?></h1>
        <h3 class="results-card-heading">Rekomendasi Karier</h3>
        <div class="karier-heading-wrapper">
            <div class="karier-heading">Kode</div>
            <div class="karier-heading">Zona</div>
            <div class="karier-heading">Pekerjaan</div>
        </div>
        <div class="karier-list-wrapper">
            <div class="karier-list">
                <?php
                    $jobs = get_jobs_by_code( $sorted_profile);
                    
                    foreach( $jobs as $job ):
                ?>
                    <div><?= $job['code'] ;?></div>
                    <div><?= $job['zone'] ;?></div>
                    <div><?= $job['pekerjaan'] ;?></div>
                <?php endforeach; ?>
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

<script>
    const jobCardWrapper = document.getElementById('job-cards-wrapper')
    // scroll to next page function
    function scrollToNextPage() {
        setTimeout(() => {
            jobCardWrapper.scrollBy({
                top: window.innerHeight,
                behavior: 'smooth',
            })
        }, 75)
    }
</script>