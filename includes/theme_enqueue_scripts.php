<?php

/* ---------------------------------------------------------------------------------------------
 * Theme enqueue scripts
 * Version 1.0
 * Description: Load all javascript files in the theme correctly.
  --------------------------------------------------------------------------------------------- */


define('TEMPLATE_PATH', get_template_directory_uri());

// Enqueue all scripts for normal pages.
function theme_enqueue_scripts() {
    global $is_IE;
    wp_enqueue_script('jquery');
    wp_deregister_script('jquery-ui');
    wp_enqueue_script('modernizer', TEMPLATE_PATH . '/assets/js/modernizr.js', array('jquery'), null);
    
    wp_enqueue_script('prettyphoto', TEMPLATE_PATH . '/assets/vendor/prettyphoto/js/prettyphoto.js', array('jquery'), null);
    wp_enqueue_script('helper-plugins', TEMPLATE_PATH . '/assets/js/helper-plugins.js', array('jquery'), null);
    wp_enqueue_script('bootstrap', TEMPLATE_PATH . '/assets/js/bootstrap.js', array('jquery'), null);
    wp_enqueue_script('init', TEMPLATE_PATH . '/assets/js/init.js', array('jquery'), null);
	if (is_page('Home')){
		//wp_enqueue_script('home', TEMPLATE_PATH . '/assets/js/home.js', array('jquery'), null);
    }
	wp_enqueue_script('jquery-flexslider', TEMPLATE_PATH . '/assets/vendor/flexslider/js/jquery.flexslider.js', array('jquery'), null);
    wp_enqueue_script('jquery-countdown', TEMPLATE_PATH . '/assets/vendor/countdown/js/jquery.countdown.min.js', array('jquery'), null);
    wp_enqueue_script('mediaelement-player', TEMPLATE_PATH . '/assets/vendor/mediaelement/mediaelement-and-player.min.js', array('jquery'), null);
    wp_enqueue_script('jquery-player', TEMPLATE_PATH . '/assets/style-switcher/js/jquery_cookie.js', array('jquery'), null);

    // Custom Scripts
    wp_enqueue_script('custom-javascript', TEMPLATE_PATH . '/assets/style-switcher/js/script.js', array('jquery'), null);
    
    // For Ie
    
    if ( $is_IE ) {
        wp_enqueue_script('jquery-epz_hint', TEMPLATE_PATH . '/assets/js/jquery.ezpz_hint.js', array('jquery'), null);
    }
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function theme_queue_js(){
if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
  wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'theme_queue_js')
?>