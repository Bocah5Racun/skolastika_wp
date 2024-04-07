<?php
    get_header();
    $profile_meta = get_post_meta( get_the_ID(), 'staff_profile', true);
    $socials_meta = get_post_meta( get_the_ID(), 'staff_socials', true);
    $cv_meta = get_post_meta( get_the_ID(), 'staff_cv', true);
?>

<section id="staff-name" class="section">
    <div class="staff-name-inner container">
        <div class="staff-name-pic-container">
            <img class="staff-pic" src="<?= get_the_post_thumbnail_url( get_the_ID(), "large" ); ?>" />
                <?php
                    if( is_array( $socials_meta) && isset( $socials_meta ) ) :
                ?>
                <div class="socials-container">
                <?php
                        foreach( $socials_meta as $platform => $url ) :
                            if( !empty( $url ) ) :
                                $social_pic_url = get_template_directory_uri() . "/includes/images/social_" . $platform . ".png";
                                $social_desc = "";
                                switch( $platform ) {
                                    case "facebook":
                                        $social_desc = "Facebook";
                                        break;
                                    case "instagram":
                                        $social_desc = "Instagram";
                                        break;
                                    case "twitter":
                                        $social_desc = "Twitter";
                                        break;
                                    case "linkedin":
                                        $social_desc = "LinkedIn";
                                        break;
                                    case "orcid":
                                        $social_desc = "ORCID";
                                        break;
                                    case "scholar":
                                        $social_desc = "Google Scholar";
                                        break;
                                    case "sinta":
                                        $social_desc = "SINTA";
                                        break;
                                }
                ?>

                    <a href="<?= $url; ?>" target="_new" title="Lihat profil <?= $social_desc; ?>">
                        <img src="<?= $social_pic_url; ?>" class="social-pic" />
                    </a>

                <?php
                        endif;
                    endforeach;
                ?>
                </div>
                <?php endif; ?>
                <?php
                    $topics = wp_get_post_terms( get_the_ID(), 'expertise' );
                    if( is_array ($topics ) && isset( $topics ) && !empty( $topics ) ):
                ?>
                <div class="staff-name-expertise">
                    <div class="expertise-title">Bidang Keahlian</div>
                    <div class="topics">
                <?php
                    foreach( $topics as $topic ) {
                ?>
                    <div class="topic-card"><?= $topic->name; ?></div>
                <?php
                    }
                ?>
                    </div>
                </div>
                <?php endif; ?>
        </div>
        <div class="staff-name-info">
            <h2><?= get_the_title(); ?></h2>
            <h3><?= isset( $profile_meta['job'] ) ? $profile_meta['job'] : "Dosen"; ?> di <?= wp_get_post_terms( get_the_ID(), 'study_program' )[0]->name; ?></h3>
            <h4><?= isset( $profile_meta['position'] ) ? $profile_meta['position'] : ""; ?></h4>
            <hr class="separator--blue" style="margin-bottom: 1rem;" />
            <div class="staff-name-bio constrained"><?= isset( $profile_meta['biography'] ) ? $profile_meta['biography'] : ''; ?></div>
            <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
        </div>
    </div>
</section>

<section id="staff-articles" class="section">
    <div class="staff-articles-inner section-inner container">
        <h2>Artikel Terkait</h2>
    </div>  
</section>

<?php
    if( isset( $cv_meta ) && isset( $cv_meta['job_list'] ) && !empty( $cv_meta['job_list'] ) ):
?>

<hr />

<section id="staff-work-experience" class="section">
    <div class="staff-work-experience-inner section-inner container">
        <div class="staff-work-header-container">
            <h2>Riwayat Kerja</h2>
            <a class="accordion-toggle" data-accordion-for-list="job-list"><img src="<?= get_template_directory_uri() . '/includes/images/down.png'; ?>" /></a>
        </div>
        <ul id="job-list" class="staff-list">
            <?php foreach( $cv_meta['job_list'] as $job ): ?>
            <li>
                <div class="job-title">
                    <?= $job['title']; ?>
                </div>
                <div class="job-period">
                    <?= $job['start']; ?> – <?= !empty( $job['end'] ) ? $job['end'] : 'Sekarang'; ?>
                </div>
                <div class="job-company"><?= $job['company']; ?></div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>  
</section>

<?php endif; ?>

<?php
    if( isset( $cv_meta ) && isset( $cv_meta['research_list'] ) && !empty( $cv_meta['research_list'] ) ):
?>

<hr />

<section id="staff-research" class="section">
    <div class="staff-research-inner section-inner container">
        <div class="staff-work-header-container">
            <h2>Riset & Inovasi</h2>
            <a class="accordion-toggle" data-accordion-for-list="research-list"><img src="<?= get_template_directory_uri() . '/includes/images/down.png'; ?>" /></a>
        </div>
        <ul id="research-list" class="staff-list">
            <?php foreach( $cv_meta['research_list'] as $research ): ?>
            <li>
                <div class="job-title">
                    <?= $research['title']; ?>
                </div>
                <div class="job-period">
                    <?= $research['date']; ?>
                </div>
                <div class="job-company"><?= $research['desc']; ?></div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>  
</section>

<?php endif; ?>

<script>

    const accordions = document.querySelectorAll('.accordion-toggle')

    accordions.forEach( (e) => {
        e.addEventListener("click", () => {
            const forList = e.getAttribute('data-accordion-for-list')
            const forListNode = document.getElementById(forList)
            const listStatusNow = e.hasAttribute('data-accordion-open')
            
            if(listStatusNow) {
                e.removeAttribute('data-accordion-open')
                e.classList.remove('on')
            } else {
                e.setAttribute('data-accordion-open', '')
                e.classList.add('on')
                accordions.forEach( (el) => {
                  if( el.getAttribute('data-accordion-for-list') != forList ) {
                    el.removeAttribute('data-accordion-open')
                    el.classList.remove('on')
                    document.getElementById(el.getAttribute('data-accordion-for-list')).style.display = 'none'
                  }  
                })
            }

            forListNode.style.display = e.hasAttribute('data-accordion-open') ? 'flex' : 'none'
            forListNode.parentElement.scrollIntoView()

        })
    })
</script>

<?php get_footer(); ?>