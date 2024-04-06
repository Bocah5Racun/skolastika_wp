<?php
    get_header();
    $profile_meta = get_post_meta( get_the_ID(), 'staff_profile', true);
    $socials_meta = get_post_meta( get_the_ID(), 'staff_socials', true);
?>

<section id="staff-name" class="section">
    <div class="staff-name-inner container">
        <div class="staff-name-pic-container">
            <img class="staff-pic" src="<?= get_the_post_thumbnail_url( get_the_ID(), "large" ); ?>" />
                <?php
                    $topics = wp_get_post_terms( get_the_ID(), 'expertise' );
                    if( is_array ($topics ) && isset( $topics ) && !empty( $topics ) ):
                ?>
            <div class="socials-container">
                <?php
                    if( isset( $socials_meta ) ) :
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
                    endif;
                ?>
                </div>
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

<hr />

<section id="staff-articles" class="section">
    <div class="staff-articles-inner section-inner container">
        <h2>Artikel Terkait</h2>
    </div>  
</section>

<hr />

<section id="staff-work-experience" class="section">
    <div class="staff-work-experience-inner section-inner container">
        <h2>Riwayat Kerja</h2>
    </div>  
</section>

<hr />

<section id="staff-trademarks" class="section">
    <div class="staff-trademarks-inner section-inner container">
        <h2>Karya & Inovasi</h2>
    </div>  
</section>

<hr />

<section id="staff-publications" class="section">
    <div class="staff-publications-inner section-inner container">
        <h2>Riset & Publikasi</h2>
    </div>  
</section>

<?php get_footer(); ?>