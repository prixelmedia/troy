<?php

/* ---------------------------------------------------------------------------------------------
 * Theme Sidebar
 * Version 1.0
 * Description: Create sidebars, add column to the sidebar
  --------------------------------------------------------------------------------------------- */
if (function_exists('register_sidebar'))
    register_sidebar(array(
        'name' => 'Footer Bar',
        'before_widget' => '<div class="box-content">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
if (function_exists('register_sidebar'))
    register_sidebar(array(
        'name' => 'Page Sidebar',
        'before_widget' => '<div class="sidebar-box">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="sidebar-heading">',
        'after_title' => '</div><div class="sidebar-content">',
    ));
if (function_exists('register_sidebar'))
    register_sidebar(array(
        'name' => 'Home Menubar',
        'before_widget' => '<li>',
        'after_widget' => '</li>'
    ));
?>