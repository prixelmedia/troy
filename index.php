<?php
/* ---------------------------------------------------------------------------------------------
  File Name: Index Page Template
  Description: Load The Inex Page Template
  Version: 1.0
  --------------------------------------------------------------------------------------------- */
$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
$options = wps_panel_get_options();
get_header();
?>


			

<?php get_footer(); ?>