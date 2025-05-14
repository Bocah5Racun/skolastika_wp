<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/includes/styles/peta-minat.css">
</head>
<body>
    <div class="mobile-overlay"></div>

    <?php
        if( !empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            get_template_part( 'parts/peta-minat', 'hasil');
        } else {
            get_template_part( 'parts/peta-minat', 'survei');
        }
    ?>
</body>
</html>