<footer id="footer">
    <div class="footer-info">
        <div class="footer-branding">
            <?php the_custom_logo(); ?>
            <a href="https://kampusmerdeka.kemdikbud.go.id/" target="_blank"><img class="logo-kampus-merdeka" src="<?= get_template_directory_uri() . '/includes/images/logo_kampus_merdeka.png'; ?>" /></a>
        </div>
        <div class="footer-student-menu-container">
            <?php wp_nav_menu( array( 'theme_location' => 'student-menu', 'container' => 'ul', 'menu_class' => 'student-menu')); ?>
        </div>
        <div class="footer-campus-menu-container">
            <?php wp_nav_menu( array( 'theme_location' => 'campus-menu', 'container' => 'ul', 'menu_class' => 'campus-menu')); ?>
        </div>
        <div class="footer-contact-container">
            <div>
                <h2>Info Kontak</h2>
                <p>Jl. Nipa-Nipa Lama Antang No. 23<br />Makassar, Sulawesi Selatan</p>
            </div>
            <div id="footer-question">
                <h2>Hubungi Kami</h2>
                <a href="https://wa.me/6281244375770" target="_blank"><img class="chat_whatsapp" src="<?= get_template_directory_uri() . "/includes/images/chat_on_whatsapp.png"; ?>" /></a>
            </div>
        </div>
    </div>
    <div class="footer-made-by">
        <img src="<?= get_template_directory_uri() . '/includes/images/fisipupri-vista.webp'; ?>" alt="" class="footer-vista">
        <div>
            © 2024<?= date("Y") > 2024 ? '–'.date("Y") : ''; ?> Fakultas Ilmu Sosial dan Ilmu Politik, Universitas Pejuang Republik Indonesia.<br />
            Design by <a href="https://komkom.id" target="_new">KOMKOM.id</a>.
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>