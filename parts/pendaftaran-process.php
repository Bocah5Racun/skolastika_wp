<?php
    const ADMIN_EMAIL = "janisalande@komkom.id";
    const VALID_KEYS = [
        'department',
        'program',
        'full_name',
        'city',
        'email',
        'school',
        'phone',
        'ijazah',
        'transkrip',
        'resume',
        'g-recaptcha-response'
    ];
    $return_url = get_the_permalink();

    if( isset( $_SESSION["submission_time"] ) ) {
        if( time() - $_SESSION["submission_time"] <= 30 ) header( "Location: $return_url" );
    }

    $_SESSION["submission_time"] = time();

    // check that files and post keys are set
    if( !isset( $_POST ) ) die("You didn't send anything!");
    if( !isset( $_FILES ) || count( $_FILES ) !== 3 ) die("You didn't send anything or the right number of files!");

    // validate $_POST keys
    foreach( $_POST as $key => $value ) {
        if( !in_array( $key, VALID_KEYS ) ) die( "$key is not a valid key.");
        if( strlen( $value ) < 5 ) die("$key value is too short!");
        if( is_string( $value ) ) { // clean strings
            $value = preg_replace('/[^\w]+/', ' ', $value);
            $value = trim( $value );
            $_POST[$key] = $value;
        }
    }

    extract( $_POST );

    $supporting_documents = array();
    
    // validate files
    foreach( $_FILES as $key => $file ) {
        $file_path = $file['tmp_name'];
        $file_size = filesize( $file_path );
        $file_info = finfo_open( FILEINFO_MIME_TYPE );
        $file_type = finfo_file( $file_info, $file_path );
        $allowed_ext = array(
            'application/msword' => 'doc',
            'application/pdf' => 'pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'image/png' => 'png',
            'image/jpeg' => 'jpg',
        );
        
        if( $file_size === 0 ) die( "The file is empty." );
        if( $file_size > 10485760 ) die( "The file size is too large." );
        if( !in_array( $file_type, array_keys( $allowed_ext ) ) ) die( "{$key} {$file_type} File format not supported." );

        // you passed! store the file
        $file_name = "{$full_name}_{$key}_" . time();
        $ext = $allowed_ext[ $file_type ];
        $upload_dir = wp_upload_dir();
        $target_dir = $upload_dir['basedir'] . "/pmb/";
        $target_full_path = $target_dir . "{$file_name}.{$ext}";
        $target_file_url = $upload_dir['baseurl'] . "/pmb/{$file_name}.{$ext}";

        if( !file_exists( $target_dir ) ) wp_mkdir_p( $target_dir );

        $uploaded = move_uploaded_file( $file_path, $target_full_path );

        if( !$uploaded ) die( "Error storing file." );

        $supporting_documents[$key] = array(
            'url' => $target_file_url,
            'filename' => $file_name,
        );

    }

    // update the sheet
    $url = "https://script.google.com/macros/s/AKfycbzqCamAnaRmcIvIZ-O009YTg32nuJdLx_47fKcVuvhIzMheUM_3ycPyn_BuW1bRj0xv/exec";
    $key = "K3VBLVZ3QV38LRUQ6N1G181R8KVJJNOH";
    $post_data = array(
        'nama'          => $full_name,
        'kota'          => $city,
        'email'         => $email,
        'whatsapp'      => $phone,
        'asal_sekolah'  => $school,
        'program_studi' => $department,
        'tipe'          => $program,
        'ijazah_url'    => $supporting_documents['ijazah']['url'],
        'transkrip_url' => $supporting_documents['transkrip']['url'],
        'cv_url'        => $supporting_documents['resume']['url'],
        'key'           => $key,
    );

    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post_data) );

    $result = curl_exec( $ch );
    
    curl_close( $ch );

    header( "Location: {$return_url}?success" );

?>