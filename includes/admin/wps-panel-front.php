<?php

/* ---------------------------------------------------------------------------------------------------

  File: wps-panel-front.php

  Functions for usage in the front-end.

  --------------------------------------------------------------------------------------------------- */


/* ---------------------------------------------------------------------------------------------------
  wpsPanel GET OPTION VALUES
  --------------------------------------------------------------------------------------------------- */

function wps_panel_get_options() {

    /* Include the options */
    include TEMPLATEPATH . '/includes/admin/wps-panel-options.php';

    /* Create an array */
    $wps_options = array();

    /* Loop the options */
    foreach ($options as $option) {

        /* If not open or close */
        if ($option['type'] != 'open' && $option['type'] != 'close') {

            /* If it is not in the database */
            if (get_option($option['id']) === FALSE) {

                /* Get the default value */
                if ($option['std'] != '') {
                    $wps_options[$option['id']] = $option['std'];
                }

                /* If it is in the database */
            } else {

                /* Get the value from the database */
                $option_value = get_option($option['id']);
                if ($option_value != '') {
                    $wps_options[$option['id']] = $option_value;
                }
            }
        }
    }

    /* Return the option values */
    return $wps_options;
}

/* wps_panel_get_options() END */
?>