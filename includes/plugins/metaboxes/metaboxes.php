<?php

add_action( 'current_screen', function() {
  
  $current_screen = get_current_screen();

  switch( $current_screen-> id ) {
    case 'staff':
      require_once( get_template_directory() . "/includes/plugins/metaboxes/metabox-staff.php" );
      break;
    case 'courses':
      require_once( get_template_directory() . "/includes/plugins/metaboxes/metabox-courses.php" );
      break;
    default:
      return;
  }
  
});
