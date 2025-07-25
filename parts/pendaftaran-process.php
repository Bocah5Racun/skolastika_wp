<?php

    $dir_path = dirname(__DIR__, 5);

    require_once(dirname(__DIR__, 1) . '/vendor/autoload.php');

    //Grab relevant .env constants
    $dotenv = Dotenv\Dotenv::createImmutable($dir_path);
    $dotenv->load();

    //Process the form
    const ADMIN_EMAIL = "janisalande@komkom.id";
    const VALID_KEYS = [
        'department',
        'program',
        'full_name',
        'city',
        'email',
        'school',
        'phone',
        'g-recaptcha-response'
    ];
    $return_url = get_the_permalink();

    if( isset( $_SESSION["submission_time"] ) ) {
        if( time() - $_SESSION["submission_time"] <= 30 ) header( "Location: $return_url" );
    }

    $_SESSION["submission_time"] = time();

    // check that files and post keys are set
    if( !isset( $_POST ) ) die("You didn't send anything!");

    // validate $_POST keys
    foreach( $_POST as $key => $value ) {
        if( !in_array( $key, VALID_KEYS ) ) die( "$key is not a valid key.");
        if( strlen( $value ) < 5 ) die( "$key value is too short!" );
        if( $key = 'email' ) filter_var( $value, FILTER_VALIDATE_EMAIL );
        if( is_string( $value ) && $key != 'email' ) { // clean strings
            $value = preg_replace('/[^\w]+/', ' ', $value);
            $value = trim( $value );
            $_POST[$key] = $value;
        }
    }

    extract( $_POST );

    $supporting_documents = array();

    // update the sheet
    $url = $_ENV['SHEET_URL'];
    $key = $_ENV['SHEET_KEY'];
    $post_data = array(
        'nama'          => $full_name,
        'kota'          => $city,
        'email'         => $email,
        'whatsapp'      => $phone,
        'asal_sekolah'  => $school,
        'program_studi' => $department,
        'tipe'          => $program,
        'key'           => $key,
    );

    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post_data) );

    $result = curl_exec( $ch );
    
    curl_close( $ch );

    session_write_close();

    header( "Location: {$return_url}?success" );

?>