<?php

/* ---------------------------------------------------------------------------------------------
 * Theme Custom Menu File.
 * Version 1.0
 * Description: Create custom menu's
  ---------------------------------------------------------------------------------------------- */

//function to create the menu's

function home_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'home_page_menu_args');

// Function to initialize menus
function theme_custom_menus() {
    register_nav_menus(
            array(
                'header-menu' => __('Header Menu'),
                'footer-menu' => __('Footer Menu'),
            )
    );
}

//hook up the function theme_custom_menus
add_action('init', 'theme_custom_menus');


add_filter('wp_nav_menu_items', 'add_search_box', 10, 2);

function add_search_box($items, $args) {
    if ($args->theme_location == 'header-menu') {
        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();

    }
    return $items;
}

?>