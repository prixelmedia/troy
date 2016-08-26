<?php
/* ---------------------------------------------------------------------------------------------------

  File: wps-panel.php

  --------------------------------------------------------------------------------------------------- */


/* ---------------------------------------------------------------------------------------------------
  Javascript
  --------------------------------------------------------------------------------------------------- */
add_action('admin_enqueue_scripts', 'wps_panel_include_js');

function wps_panel_include_js() {
    wp_enqueue_media();
    /* Register scripts */
    wp_register_script('wps_panel_js', get_template_directory_uri() . '/includes/admin/js/wps-panel-js.js', array('jquery'));
    
    wp_register_script('jquery_cookies', get_template_directory_uri() . '/includes/admin/js/jquery.cookie.js', array('jquery'));
    /* Enqueue scripts */
    wp_enqueue_script('jquery_cookies');
    wp_enqueue_script('wps_panel_js');
}

/* wps_panel_include_js() */


/* ---------------------------------------------------------------------------------------------------
  CSS
  --------------------------------------------------------------------------------------------------- */
add_action('admin_print_styles', 'wps_panel_include_styles');

function wps_panel_include_styles() {

    /* Register styles */
    wp_register_style('wps_panel_style', get_template_directory_uri() . '/includes/admin/css/wps-panel-style.css', false);

    /* Enqueue styles */
    wp_enqueue_style('wps_panel_style');
    wp_enqueue_style('thickbox');
}

/* wps_panel_include_styles() */


/* ---------------------------------------------------------------------------------------------------
  INIT wpsPanel
  --------------------------------------------------------------------------------------------------- */
add_action('admin_menu', 'wps_panel_init');

function wps_panel_init() {

    /* Include the options */
    include TEMPLATEPATH . '/includes/admin/wps-panel-options.php';

    /* Save & Reset */
    if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__)) {

        /* Save */
        if (isset($_REQUEST['action']) && 'save' == $_REQUEST['action']) {

            /* Loop the options, cross reference the current and the submitted values, and save if they're different */
            foreach ($options as $option) {

                if ($option['type'] != 'open' && $option['type'] != 'close') {

                    if (!is_array($_REQUEST[$option['id']])) {
                        $the_value = stripslashes($_REQUEST[$option['id']]);
                    } else {
                        $the_value = serialize($_REQUEST[$option['id']]);
                    }

                    if (isset($_REQUEST[$option['id']])) {
                        update_option($option['id'], $the_value);
                    } else {
                        delete_option($option['id']);
                    }
                }
            }

            /* Redirect to the theme options page */
            header('Location: admin.php?page=wps-panel.php&saved=true');

            /* Chuck Norris */
            die;

            /* Reset */
        } else if (isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {

            /* Loop the options and delete them (setting the default values will happen on next page load) */
            foreach ($options as $option) {
                delete_option($option['id']);
            }

            /* Redirect to the theme options page */
            header("Location: admin.php?page=wps-panel.php&reset=true");

            /* Steven Seagal */
            die;
        }
    }

    /* Add the page */
    add_menu_page('TroyCG Configuration', 'TroyCG Admin', 'edit_themes', basename(__FILE__), 'wps_panel_output', false, 30);
}

/* wps_panel_init() */

/* ---------------------------------------------------------------------------------------------------
  wpsPanel HTML OUTPUT
  --------------------------------------------------------------------------------------------------- */

function wps_panel_output() {

    /* Declare some vars */
    $sidebar_html = '';
    $fields_html = '';

    /* Include the options from wps-panel-options.php */
    include TEMPLATEPATH . '/includes/admin/wps-panel-options.php';

    /* Go through all the options to populate the 2 vars we declared above */
    include TEMPLATEPATH . '/includes/admin/wps-panel-generator.php';
    ?>

    <form method="post" enctype="multipart/form-data">

        <div id="wps-panel">

            <div id="wps-panel-sidebar">

                <ul>

    <?php echo $sidebar_html; ?>

                </ul>

            </div><!-- #wps-panel-sidebar -->

            <div id="wps-panel-content">

    <?php echo $fields_html; ?>

                <div id="wps-panel-actions">



                </div><!-- #wps-panel-actions -->

            </div><!-- #wps-panel-content -->

        </div><!-- #wps_panel -->

    </form>
    <!-- Form to reset options to default values -->
    <form id="reset_def" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="reset" />
        <p>
            Reset to Default Options: <input type="submit" class="button-secondary" value="Reset" />
        </p>
    </form>

    <!-- Form with all the options -->	


    <?php
}

/* wps_panel_output() */