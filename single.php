<?php get_header(); ?>

<?php
    $the_categories = array();
    foreach( get_the_category() as $category_object ) {
        $the_categories[] = $category_object->slug;
    }

    $the_content = get_the_content();

    libxml_use_internal_errors(true);

    $dom = new DOMDocument( '1.0', 'UTF-8' );
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $the_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

    libxml_clear_errors();

    $h2Elements = $dom->getElementsByTagName( 'h2' );
    $count = 0;

    $ad_code = <<<ADCODE
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4861861095469626" crossorigin="anonymous"></script>
    <ins class="adsbygoogle"
        style="display:block; text-align:center;"
        data-ad-layout="in-article"
        data-ad-format="fluid"
        data-ad-client="ca-pub-4861861095469626"
        data-ad-slot="7043857511"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    ADCODE;

    $adDom = new DOMDocument( '1.0', 'UTF-8' );
    $adDom->loadHTML( '<?xml encoding="utf-8" ?>' . $ad_code );
    $adDomElement = $adDom->documentElement;
    

    foreach( $h2Elements as $h2 ) {
        $count++;

        if( $count % 3 === 0 ) {
            $adContainer = $dom->importNode( $adDomElement, true );
            $h2->parentNode->insertBefore( $adContainer, $h2 );
        }
    }

    $the_content = $dom->saveHTML();
?>

<?php if( has_post_thumbnail() ) : ?>
<img class="post-thumbnail" src="<?= get_the_post_thumbnail_url( get_the_ID(), "full" ); ?>" />
<?php if( get_the_post_thumbnail_caption() ) : ?>
    <div class="post-caption"><?= get_the_post_thumbnail_caption(); ?></div>
<?php endif; ?>
<?php endif; ?>

<article class="article-container container section">
    <div class="section-inner">
        <div class="centered-box">
            <div class="article-meta">
                <h1><?= get_the_title(); ?></h1>
                <div class="article-author">Oleh <?= get_the_author_meta( 'display_name', get_post_field( 'post_author' ) ); ?> <span class="article-author-separator">|</span> <?= get_the_date(); ?></div>
            </div>
        </div>
        <div class="article-content constrained centered-box">
            <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
            <?= $the_content; ?>
        </div>
    </div>
</article>

<section class="more-articles">
    <h2 class="more-articles-title">Artikel Terkait</h2>
    <div class="more-articles-container">
    <?php
        $query = new WP_Query( array(
            'post_type'         => 'post',
            'post__not_in'      => array( get_the_ID() ),
            'posts_per_page'    => 8,
            'category__in'      => wp_get_post_categories( get_the_ID() ),
            'orderby'          => 'rand',
        ));

        if( $query->have_posts() ):
            while( $query->have_posts() ):
                $query->the_post();
    ?>
    
    <div class="more-articles-card">
        <a href="<?= get_the_permalink(); ?>">
            <img class="more-articles-card-img" src="<?= get_the_post_thumbnail_url( get_the_ID(), "medium_large" );?> " alt="" />
        </a>
        <div class="more-articles-card-cat"><?= get_the_category()[0]->name; ?></div>
        <a href="<?= get_the_permalink(); ?>" class="more-articles-card-title"><?= get_the_title(); ?></a>
        <div class="more-articles-card-date"><?= get_the_date(); ?></div>
    </div>
    
    <?php 
        endwhile;
        endif;
    ?>
    </div>
</section>

<section class="section section--upri-yellow study-program-child-cta-container">
    <div class="section-inner centered-box constrained text-center">
        <h2>Gabung bersama kami membuat perubahan positif bagi masyarakat.</h2>
        <a class="single-cta-button" href="<?= get_home_url() . '/pmb/'; ?>">Baca informasi pendaftaran mahasiswa baru →</a>
        <?php if( "Kurikulum" !== get_the_title() ): ?>
            <a href="<?= BROSUR_URL; ?>">Download brosur FISIP UPRI →</a>
        <?php endif;?>
    </div>
</section>

<?php get_footer(); ?>