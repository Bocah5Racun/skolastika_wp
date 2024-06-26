<?php

function skolastika_theme_metaboxes() {

    add_meta_box(
      'staff_profile', // $id
      'Staff Data', // $title
      'show_staff_profile_metabox', // $callback
      'staff', // $screen
      'normal', // $context
      'high' // $priority
    );
    
    add_meta_box(
      'staff_socials', // $id
      'Staff Socials', // $title
      'show_staff_socials_metabox', // $callback
      'staff', // $screen
      'advanced', // $context
      'high' // $priority
    );

    add_meta_box(
      'staff_cv', // $id
      'Staff CV', // $title
      'show_staff_cv_metabox', // $callback
      'staff', // $screen
      'advanced', // $context
      'low' // $priority
    );

}

function show_staff_profile_metabox() {
    global $post;
    $meta = get_post_meta( $post->ID, 'staff_profile');
    ?>

    <input type="hidden" name="staff_profile_nonce" id="staff_profile_nonce" value="<?php echo wp_create_nonce( "staff-profile-nonce" ); ?>">

    <section class="metabox-container">
        <section class="metabox-subsection-container">
          <div class="subsection-title">
            <h3>Position and Job Name</h3>
          </div>
          <div class="metabox-subsection-content">
            <p>This appears under the individual's name on their staff member profile page.</p>
            <div style="display: flex; gap: 1rem;">
              <div>
                <label for="staff_profile[job]">Job Name</label>
                <input type="text" name="staff_profile[job]" id="staff_profile[job]" placeholder="Lecturer" value="<?= ( is_array($meta) && isset( $meta[0]['job'] ) ) ? $meta[0]['job'] : ""; ?>" />
              </div>
              <div>
                <label for="staff_profile[position]">Position</label>
                <input type="text" name="staff_profile[position]" id="staff_profile[position]" placeholder="Department Director" value="<?= ( is_array($meta) && isset( $meta[0]['position'] ) ) ? $meta[0]['position'] : ""; ?>" />
              </div>
            </div>
          </div>
        </section>

        <section class="metabox-subsection-container metabox-subsection-container--full">
          <div class="subsection-title">
            <h3>Biography</h3>
          </div>
          <div class="metabox-subsection-content">
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

    <div class="socials-row metabox-subsection-container">
      <div class="subsection-title">
        <h3>Social Media Profiles</h3>
      </div>
      <div class="socials-row-content">
        <div class="staff-socials-list">
          <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">Facebook</h3>
            </div>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[facebook]" id="staff_socials[facebook]" value="<?= ( is_array($meta) && isset( $meta[0]['facebook'] ) ) ? $meta[0]['facebook'] : ""; ?>" />
            </div>
          </div>
          <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">Instagram</h3>
            </div>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[instagram]" id="staff_socials[instagram]" value="<?= ( is_array($meta) && isset( $meta[0]['instagram'] ) ) ? $meta[0]['instagram'] : ""; ?>" />
            </div>
          </div>
          <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">Twitter</h3>
            </div>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[twitter]" id="staff_socials[twitter]" value="<?= ( is_array($meta) && isset( $meta[0]['twitter'] ) ) ? $meta[0]['twitter'] : ""; ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="socials-row metabox-subsection-container">
      <div class="subsection-title">
          <h3>Professional Profiles</h3>
      </div>
      <div class="socials-row-content">
        <div class="staff-socials-list">
        <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">LinkedIn</h3>
            </div>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[linkedin]" id="staff_socials[linkedin]" value="<?= ( is_array($meta) && isset( $meta[0]['linkedin'] ) ) ? $meta[0]['linkedin'] : ""; ?>"/>
            </div>
          </div>
          <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">Google Scholar</h3>
            </div>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[scholar]" id="staff_socials[scholar]" value="<?= ( is_array($meta) && isset( $meta[0]['scholar'] ) ) ? $meta[0]['scholar'] : ""; ?>"/>
            </div>
          </div>
          <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">ORCID</h3>
            </div>
            <div class="staff-socials-card-content">
              <small>URL</small>
              <input type="text" name="staff_socials[orcid]" id="staff_socials[orcid]" value="<?= ( is_array($meta) && isset( $meta[0]['orcid'] ) ) ? $meta[0]['orcid'] : ""; ?>" />
            </div>
          </div>
          <div class="staff-socials-card">
            <div class="subsection-title">
              <h3 class="card-title">SINTA</h3>
            </div>
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
function show_staff_cv_metabox() {
  global $post;
  $meta = get_post_meta( $post->ID, 'staff_cv' );
  ?>

  <section id="staff-cv-container" class="metabox-container">
    <input type="hidden" name="staff_cv_nonce" id="staff_cv_nonce" value="<?php echo wp_create_nonce( "staff-cv-nonce" ); ?>">
    <div class="metabox-subsection-container">
      <div class="cv-row">
        <div class="subsection-title">
          <h3>Work Experience</h3>
          <a class="add_item" id="add_job" title="Add Position"><img src="<?= get_template_directory_uri() . "/includes/images/add.png"; ?>" /></a>
        </div>
        <div class="metabox-subsection-content">
          <p>To delete an item, erase either Title or Company Name.</p>
          <ul id="job-list" class="subsection-list">
            <?php
              if( is_array( $meta ) && isset( $meta[0]['job_list'] ) ):
                $jobs = $meta[0]['job_list'];
                foreach( $jobs as $key => $job ):
            ?>
                  <li class="list-item">

                    <div class="list-item-move-container">

                      <a class="meta-move meta-move--up" <?php if( $key == 0 ) echo "disabled"; ?>><img src="<?= get_template_directory_uri() . '/includes/images/down.png'; ?>" /></a>
                      <a class="meta-move meta-move--down" <?php if( $key >= (count( $jobs ) - 1) ) echo "disabled"; ?>><img src="<?= get_template_directory_uri() . '/includes/images/down.png'; ?>"></a>

                    </div>
                    
                    <input data-desc="title" type="text" class="job-list-text" id="staff_cv[job_list][<?= $key; ?>][title]" name="staff_cv[job_list][<?= $key; ?>][title]" value="<?= $job['title']; ?>" placeholder="Job title" />
                    <input data-desc="company" type="text" class="job-list-text" id="staff_cv[job_list][<?= $key; ?>][company]" name="staff_cv[job_list][<?= $key; ?>][company]" value="<?= $job['company']; ?>" placeholder="Company name" />
                    <input data-desc="start" type="number" inputmode="numeric" class="job-list-text" id="staff_cv[job_list][<?= $key; ?>][start]" name="staff_cv[job_list][<?= $key; ?>][start]" step="1" size="6" min="1960" max="<?= date("Y"); ?>" value="<?= $job['start']; ?>" placeholder="Start" />
                    <input data-desc="end" type="number" inputmode="numeric" class="job-list-text" id="staff_cv[job_list][<?= $key; ?>][end]" name="staff_cv[job_list][<?= $key; ?>][end]" step="1" size="6" min="1960" max="<?= date("Y"); ?>" value="<?= $job['end']; ?>" placeholder="End" />
                  </li>

            <?php
                endforeach;
              endif;
            ?>
          </ul>
        </div>
      </div>
    </div>
    <input type="hidden" name="staff_cv_nonce" id="staff_cv_nonce" value="<?php echo wp_create_nonce( "staff-cv-nonce" ); ?>">
    <div class="metabox-subsection-container">
      <div class="cv-row">
        <div class="subsection-title">
          <h3>Research and Innovations</h3>
          <a class="add_item" id="add_research" title="Add Item"><img src="<?= get_template_directory_uri() . "/includes/images/add.png"; ?>" /></a>
        </div>
      </div>
      <div class="metabox-subsection-content">
          <p>To delete an item, erase either Project Name or Description.</p>
          <ul id="research-list" class="subsection-list">
              <?php
                if( is_array( $meta ) && isset( $meta[0]['research_list'] ) ):
                  $researches = $meta[0]['research_list'];
                  foreach( $researches as $key => $research ):
              ?>
                    <li class="list-item">

                      <div class="list-item-move-container">

                        <a class="meta-move meta-move--up" <?php if( $key == 0 ) echo "disabled"; ?>><img src="<?= get_template_directory_uri() . '/includes/images/down.png'; ?>" /></a>
                        <a class="meta-move meta-move--down" <?php if( $key >= (count( $researches ) - 1) ) echo "disabled"; ?>><img src="<?= get_template_directory_uri() . '/includes/images/down.png'; ?>"></a>

                      </div>
                      
                      <input data-desc="title" type="text" class="job-list-text" id="staff_cv[research_list][<?= $key; ?>][title]" name="staff_cv[research_list][<?= $key; ?>][title]" value="<?= $research['title']; ?>" placeholder="Project name" />
                      <input data-desc="desc" type="text" class="job-list-text" id="staff_cv[research_list][<?= $key; ?>][company]" name="staff_cv[research_list][<?= $key; ?>][desc]" value="<?= $research['desc']; ?>" placeholder="Project description" />
                      <input data-desc="date" type="date" class="job-list-text" id="staff_cv[research_list][<?= $key; ?>][date]" name="staff_cv[research_list][<?= $key; ?>][date]" value="<?= $research['date']; ?>" />
                    </li>

              <?php
                  endforeach;
                endif;
              ?>
          </ul>
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
    
    if ( !wp_verify_nonce( $_POST["staff_cv_nonce"], 'staff-cv-nonce' ) ) {
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
      delete_post_meta( $post_id, 'staff_socials', $old );
    }

    $old = get_post_meta( $post_id, 'staff_cv');
    $new = $_POST['staff_cv'];

    foreach( $new['job_list'] as $key => $job_data ) {
      if( empty( $job_data['title'] ) || empty( $job_data['company'] ) ) {
        array_splice( $new['job_list'], $key );
      }
    }
    foreach( $new['research_list'] as $key => $research_data ) {
      if( empty( $research_data['title'] ) || empty( $research_data['desc'] ) ) {
        array_splice( $new['research_list'], $key );
      }
    }
  
    if ( $new && $new !== $old ) {
      update_post_meta( $post_id, 'staff_cv', $new );
    } elseif ( '' === $new && $old ) {
      delete_post_meta( $post_id, 'staff_cv', $old );
    }
}

function skolastika_staff_metabox_scripts() {

      wp_enqueue_style( 'metabox_styles', get_template_directory_uri() . '/includes/styles/metabox_styles.css');
      wp_enqueue_script( 'metabox_scripts', get_template_directory_uri() . '/includes/scripts/metabox_scripts.js', array(), false, true, array( 'strategy' => 'defer' ));
      wp_localize_script( 'metabox_scripts', 'GLOBALS', array(
        'baseURL' => get_template_directory_uri(),
      ));
      
    }
    
add_action( 'add_meta_boxes', 'skolastika_theme_metaboxes' );
add_action( 'save_post', 'skolastika_theme_save_metaboxes' );
add_action( 'admin_enqueue_scripts', 'skolastika_staff_metabox_scripts' );
