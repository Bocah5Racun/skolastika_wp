<?php get_header(); ?>

<?php
    $the_categories = array();
    foreach( get_the_category() as $category_object ) {
        $the_categories[] = $category_object->slug;
    }
?>

<article class="container section">
    <div class="section-inner">
        <h1><?= get_the_title(); ?></h1>
        <div class="constrained centered-box">
            <?php if( has_post_thumbnail() ) : ?>
            <img class="post-thumbnail" src="<?= get_the_post_thumbnail_url( get_the_ID(), "full" ); ?>" />
            <?php if( get_the_post_thumbnail_caption() ) : ?>
                <div class="post-caption"><?= get_the_post_thumbnail_caption(); ?></div>
            <?php endif; ?>
            <?php endif; ?>
            <div class="last-updated">Laman ini terakhir diperbarui pada tanggal <?= get_the_modified_date(); ?>.</div>
        </div>
        <div class="article-content constrained centered-box">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4861861095469626"
                crossorigin="anonymous"></script>
            <ins class="adsbygoogle"
                style="display:block; text-align:center;"
                data-ad-layout="in-article"
                data-ad-format="fluid"
                data-ad-client="ca-pub-4861861095469626"
                data-ad-slot="7043857511"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <?= get_the_content(); ?>
        </div>
    </div>
</article>
<section class="section section--upri-yellow study-program-child-cta-container">
    <div class="section-inner centered-box constrained text-center">
        <h2>Gabung bersama kami membuat perubahan positif bagi masyarakat.</h2>
        <a class="single-cta-button" href="<?= get_home_url() . '/penerimaan-mahasiswa-baru/'; ?>">Baca informasi pendaftaran mahasiswa baru →</a>
        <?php if( "Kurikulum" !== get_the_title() ): ?>
            <a href="<?= "../brosur"; ?>">Download brosur FISIP UPRI →</a>
        <?php endif;?>
    </div>
</section>

<?php get_footer(); ?>