<?php

function skolastika_theme_metabox_styles() {
    wp_enqueue_style( 'metabox_styles' , get_template_directory_uri() . '/includes/styles/metabox_styles.css');
}
add_action( 'admin_enqueue_scripts', 'skolastika_theme_metabox_styles' );

function skolastika_theme_metaboxes() {

    add_meta_box(
      'staff_profile', // $id
      'Staff Data', // $title
      'show_staff_profile_metabox', // $callback
      'staff', // $screen
      'advanced', // $context
      'high' // $priority
    );
    
    add_meta_box(
      'staff_socials', // $id
      'Staff Socials', // $title
      'show_staff_socials_metabox', // $callback
      'staff', // $screen
      'side', // $context
      'high' // $priority
    );

}

add_action( 'add_meta_boxes', 'skolastika_theme_metaboxes' );

function show_staff_profile_metabox() {
    global $post;
    $meta = get_post_meta( $post->ID, 'staff_profile');
    ?>

    <input type="hidden" name="staff_profile_nonce" id="staff_profile_nonce" value="<?php echo wp_create_nonce( "staff-profile-nonce" ); ?>">

    <section id="staff-data-container" class="metabox-container">
        <section class="staff-data-section">
          <h3>Position and Job Name</h3>
          <div class="staff-data-section-content">
            <p>This appears under the individual's name on their staff member profile page.</p>
            <div style="display: flex; gap: 1rem;">
              <div>
                <label for="staff_profile[job]">Job Name</label>
                <input type="text" size="25" name="staff_profile[job]" id="staff_profile[job]" placeholder="Lecturer" value="<?= ( is_array($meta) && isset( $meta[0]['job'] ) ) ? $meta[0]['job'] : ""; ?>" />
              </div>
              <div>
                <label for="staff_profile[position]">Position</label>
                <input type="text"  size="25" name="staff_profile[position]" id="staff_profile[position]" placeholder="Department Director" value="<?= ( is_array($meta) && isset( $meta[0]['position'] ) ) ? $meta[0]['position'] : ""; ?>" />
              </div>
            </div>
          </div>
        </section>

        <section class="staff-data-section">
          <h3>Biography</h3>
          <div class="staff-data-section-content">
            <p>Include relevant information about the staff member's personal background and interests.</p>
            <textarea name="staff_profile[biography]" id="staff_profile[about]" placeholder="Example: <?= get_the_title(); ?> is a professor and has written three books about digital literacy and digital culture."><?= ( is_array($meta) && isset( $meta[0]['biography'] ) ) ? $meta[0]['biography'] : ""; ?></textarea>
          </div>
        </section>
    </section>

<?php }

function show_staff_socials_metabox() {
  global $post;
  $meta = get_post_meta( $post->ID, 'staff_socials' );
  ?>

  <section id="staff-socials-container" class="metabox-container">
    <input type="hidden" name="staff_socials_nonce" id="staff_socials_nonce" value="<?php echo wp_create_nonce( "staff-socials-nonce" ); ?>">

    <p>Enter full social profile URLs.</p>
    <div class="socials-row">
      <h3>Social Media</h3>
      <div class="socials-row-content">
        <div class="staff-socials-list">
          <div class="staff-socials-card">
            <h3 class="card-title">Facebook</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[facebook]" id="staff_socials[facebook]" value="<?= ( is_array($meta) && isset( $meta[0]['facebook'] ) ) ? $meta[0]['facebook'] : ""; ?>" />
            </div>
          </div>
          <div class="staff-socials-card">
            <h3 class="card-title">Instagram</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[instagram]" id="staff_socials[instagram]" value="<?= ( is_array($meta) && isset( $meta[0]['instagram'] ) ) ? $meta[0]['instagram'] : ""; ?>" />
            </div>
          </div>
          <div class="staff-socials-card">
            <h3 class="card-title">Twitter</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[twitter]" id="staff_socials[twitter]" value="<?= ( is_array($meta) && isset( $meta[0]['twitter'] ) ) ? $meta[0]['twitter'] : ""; ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="socials-row">
      <h3>Professional Profiles</h3>
      <div class="socials-row-content">
        <div class="staff-socials-list">
        <div class="staff-socials-card">
            <h3 class="card-title">LinkedIn</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[linkedin]" id="staff_socials[linkedin]" value="<?= ( is_array($meta) && isset( $meta[0]['linkedin'] ) ) ? $meta[0]['linkedin'] : ""; ?>"/>
            </div>
          </div>
          <div class="staff-socials-card">
            <h3 class="card-title">Google Scholar</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[scholar]" id="staff_socials[scholar]" value="<?= ( is_array($meta) && isset( $meta[0]['scholar'] ) ) ? $meta[0]['scholar'] : ""; ?>"/>
            </div>
          </div>
          <div class="staff-socials-card">
            <h3 class="card-title">ORCID</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[orcid]" id="staff_socials[orcid]" value="<?= ( is_array($meta) && isset( $meta[0]['orcid'] ) ) ? $meta[0]['orcid'] : ""; ?>" />
            </div>
          </div>
          <div class="staff-socials-card">
            <h3 class="card-title">SINTA</h3>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[sinta]" id="staff_socials[sinta]" value="<?= ( is_array($meta) && isset( $meta[0]['sinta'] ) ) ? $meta[0]['sinta'] : ""; ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php }

function skolastika_theme_save_metaboxes( $post_id ) {
    // verify nonce
    if ( !wp_verify_nonce( $_POST["staff_profile_nonce"], 'staff-profile-nonce' ) ) {
        return $post_id;
    }

    if ( !wp_verify_nonce( $_POST["staff_socials_nonce"], 'staff-socials-nonce' ) ) {
        return $post_id;
    }

    // check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return $post_id;
    }
    // check permissions
    if ( 'staff' == $_POST['post_type'] ) {
      if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
      } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
      }
    }
  
    $old = get_post_meta( $post_id, 'staff_profile');
    $new = $_POST['staff_profile'];
  
    if ( $new && $new !== $old ) {
      update_post_meta( $post_id, 'staff_profile', $new );
    } elseif ( '' === $new && $old ) {
      delete_post_meta( $post_id, 'staff_profile', $old );
    }

    $old = get_post_meta( $post_id, 'staff_socials');
    $new = $_POST['staff_socials'];
  
    if ( $new && $new !== $old ) {
      update_post_meta( $post_id, 'staff_socials', $new );
    } elseif ( '' === $new && $old ) {
      delete_post_meta( $post_id, 'staff_profile', $old );
    }
}
add_action( 'save_post', 'skolastika_theme_save_metaboxes' );