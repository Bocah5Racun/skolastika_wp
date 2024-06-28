<?php

function register_courses_metaboxes() {

  add_meta_box(
    'course_details',
    'Course Details',
    'show_course_details',
    'courses',
    'normal',
    'high',
  );

}

function show_course_details() {

  global $post;
  $post_id = $post->ID;
  $meta = get_post_meta( $post_id, 'course_details' );
  $rps_file = get_post_meta( $post_id, 'rps' );
  
  ?>

  <input type="hidden" name="course_details_nonce" id="course_details_nonce" value="<?= wp_create_nonce( 'course_details_nonce' ); ?>">

  <section class="metabox-container">
    <section class="metabox-subsection-container">
      <div class="subsection-title">
        <h3>Course Meta</h3>
      </div>
      <div class="metabox-subsection-content" style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap;">
        <div>
          <label for="course_details[semester]">Semester</label>
          <input type="number" min="1" max="8" name="course_details[semester]" id="course_details[semester]" value="<?= ( is_array($meta) && isset( $meta[0]['semester'] ) ) ? $meta[0]['semester'] : ""; ?>" />
        </div>
        <div>
          <label for="course_details[sks]">Jumlah SKS</label>
          <input type="number" min="1" max="6" name="course_details[sks]" id="course_details[sks]" value="<?= ( is_array($meta) && isset( $meta[0]['sks'] ) ) ? $meta[0]['sks'] : ""; ?>" />
        </div>
        <div>
          <label for="course_details[kode]">Kode MK</label>
          <input type="text" name="course_details[kode]" id="course_details[kode]" value="<?= ( is_array($meta) && isset( $meta[0]['kode'] ) ) ? $meta[0]['kode'] : ""; ?>" />
        </div>
        <div>
          <label for="course_details[dosen]">Dosen Pengampuh</label>
          <input type="text" name="course_details[dosen]" id="course_details[dosen]" value="<?= ( is_array($meta) && isset( $meta[0]['dosen'] ) ) ? $meta[0]['dosen'] : ""; ?>" />
        </div>
    </section>
    <section class="metabox-subsection-container">
      <div class="subsection-title"><h3>Upload RPS</h3></div>
      <section class="metabox-subsection-content">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
          <?php
            if ( is_array($rps_file) && isset( $rps_file[0]['url'] ) ):
          ?>
            <div style="display: flex; gap: 1rem;">
              <input type="hidden" name="delete_rps" id="delete_rps" value="false" />
              <a id="view_rps" href="<?= $rps_file[0]['url']; ?>" target="_blank">View Current RPS</a>
              <a href="" onclick="(function() {
                event.preventDefault();

                const toggleText = event.target.innerText;
                const viewRps = document.getElementById('view_rps');
                const deleteRps = document.getElementById('delete_rps');

                if(toggleText == 'Delete') {
                  if(confirm('Do you want to delete this file?') == true) {
                    viewRps.style.display = 'none';
                    deleteRps.value = true;
                    event.target.innerText = 'Undo';
                  }
                } else  {
                  viewRps.style.display = 'block';
                  deleteRps.value = false;
                  event.target.innerText = 'Delete';
                }
              })()">Delete</a>
            </div>
          <?php
            endif;
          ?>
          <input
            type="file"
            accept="application/pdf"
            id="rps"
            name="rps"
          />
        </div>
      </section>
    </section>
    <section class="metabox-subsection-container metabox-subsection-container--full">
      <div class="subsection-title">
        <h3>Course Description</h3>
      </div>
      <div class="metabox-subsection-content">
        <p>Provide a short description of the course. What will the students be learning? What are the expected learning outcomes? What sort of work will the students be doing?</p>
        <textarea name="course_details[description]" id="course_details[description]"><?= ( is_array( $meta ) && isset( $meta[0]['description'] ) ) ? $meta[0]['description'] : ""; ?></textarea>
      </div>
    </section>
  </section>
  
<?php }

function save_course_details( $post_id ) {

  // check autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  if ( !current_user_can( 'edit_page', $post_id ) ) wp_die( 'Can\'t edit page' );
  if ( !current_user_can( 'edit_post', $post_id ) ) wp_die( 'Can\'t edit page' );

  // check course meta
  if( isset( $_POST["course_details_nonce"] ) && wp_verify_nonce( $_POST["course_details_nonce"], 'course_details_nonce' ) ){
    $old_meta = get_post_meta( $post_id, 'course_details' );
    $new_meta = $_POST['course_details'];

    if ( $new_meta && $new_meta !== $old_meta ) {
      update_post_meta( $post_id, 'course_details', $new_meta );
    } elseif ( '' === $new_meta && $old_meta ) {
      delete_post_meta( $post_id, 'course_details', $old_meta );
    }
  }

  // check rps file

  if ( !isset( $_POST['delete_rps'] ) ) { // if they want to delete

    if( !empty($_FILES['rps']['name']) ) {

      if ( get_post_meta( $post_id, 'rps' ) ) unlink( get_post_meta( $post_id, 'rps', true ) );
  
      $name = $_FILES['rps']['name'];
      $tmp = $_FILES['rps']['tmp_name'];
      $bits = file_get_contents( $tmp );
      $upload = wp_upload_bits( $name, null, $bits );
  
      if ( isset( $upload['error']) && $upload['error'] !== false ) wp_die( 'Upload error: ' . $upload['error'] );
  
      update_post_meta( $post_id, 'rps', $upload );
    }

  } else {
    unlink( get_post_meta( $post_id, 'rps', true )['file'] );
    update_post_meta( $post_id, 'rps', ""); 
  }
    

}

function skolastika_staff_metabox_scripts() {

  wp_enqueue_style( 'metabox_styles', get_template_directory_uri() . '/includes/styles/metabox_styles.css');
  wp_localize_script( 'metabox_scripts', 'GLOBALS', array(
    'baseURL' => get_template_directory_uri(),
  ));
    
}

add_action( 'add_meta_boxes', 'register_courses_metaboxes' );
add_action( 'save_post', 'save_course_details' );
add_action( 'admin_enqueue_scripts', 'skolastika_staff_metabox_scripts' );
