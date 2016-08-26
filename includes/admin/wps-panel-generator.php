<?php

/* ---------------------------------------------------------------------------------------------------

  File: wps-panel-generator.php

  --------------------------------------------------------------------------------------------------- */

foreach ($options as $option) {

    /* Get the value of the field (nothing for types open and close). */
    if ($option['type'] != 'open' && $option['type'] != 'close') {

        /* Variable that will hold the value of this option */
        $real_value = '';

        /* Get default value */
        $default_value = $option['std'];

        /* Get the value if user has set it */
        $user_defined_value = get_option($option['id']);

        /* Set the $real_value */
        if ($user_defined_value == '') {
            $real_value = $default_value;
        } else {
            $real_value = $user_defined_value;
        }
    }/* end if */

    /* Populate $sidebar_html and $content_html according to the option type */
    switch ($option['type']) {

        /* open: Opens a new section */
        case 'open':

            /* Generate the id which will be used as the id of the section (for the tabs system purposes) */
            $tab_id = str_replace(' ', '-', strtolower($option['title']));

            /* Add the new link in the sidebar for this section */
            $sidebar_html .= '<li><a href="#wps-panel-' . $tab_id . '">' . $option['title'] . '</a></li>';

            /* Open the new section */
            $fields_html .= '<div class="wps-panel-section" id="wps-panel-' . $tab_id . '">';
            if ($option['title'] != "Welcome") {
                $fields_html .= '<h3 class="wps-tab-heading">' . $tab_id . ' Options</h3>';
            }
            break;

        /* close: Closes the current section */
        case 'close':

            /* Close the current section */
            if ($option['title'] != "welcome") {

                $fields_html .= '<p><input type="hidden" name="action" value="save" />
                <input type="submit" class="button-primary" value="Save ' . $option['title'] . ' Options" /></p>
                    </div><!-- .wps-panel-section -->';
            } else {

                $fields_html .= '</div>';
            }
            break;
			
        case 'hidden':

            /* create a hidden field */


                $fields_html .= '<input type="hidden" id="' . $option['id'] . '" name="' . $option['id'] . '" value="'. $real_value . '" />';

            break;
			
        /* divider: Simple Content Divider */
        case 'divider':

            /* divide  the current section */

            $fields_html .= '<hr />';

            break;

        /* text: Simple textual input field */
        case 'text':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            $fields_html .= '<label for="' . $option['id'] . '">' . $option['title'] . '</label>';

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<div class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</div><!-- .jw-field-description -->';
            }

            /* The Field */
			// $limit = get_option($option['class']);
			// if($limit > 0){
				
				// for($i = 0; $i < $limit; $i++){
				// $option['id'] = $option['id'].$i;
				// $fields_html .= '<input type="text" name="' . $option['id'] . '" class="' . $option['class'] . '" id="' . $option['id'] . '" value="' . get_option($option['id']) . '"/>';
				
				// if ($option['action'] == 'upload') {
					// $fields_html .='<button class="upload_image_button" name="upload_image_button">' . $option['title'] . '</button>';
				// }
				// }
			// }else{
				$fields_html .= '<input type="text" name="' . $option['id'] . '" class="' . $option['class'] . '" id="' . $option['id'] . '" value="' . $real_value . '"/>';
				
				if ($option['action'] == 'upload') {
					$fields_html .='<button class="upload_image_button" name="upload_image_button">' . $option['title'] . '</button>';
				}			
			//}
            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;

        /* paragraph field */
        case 'paragraph':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            if ($option['title']) {
                $fields_html .= '<h3 class="wps-tab-heading">' . $option['title'] . '</h3>';
            }

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<p class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</p><!-- .jw-field-description -->';
            }

            /* The Field */
            $fields_html .= '<img src="' . get_template_directory_uri() . '/includes/admin/images/serene-logo.png"/>';

            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;

        /* textarea: Text area field */
        case 'textarea':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            $fields_html .= '<label for="' . $option['id'] . '">' . $option['title'] . '</label>';

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<div class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</div><!-- .jw-field-description -->';
            }

            /* The Field */
            $fields_html .= '<textarea name="' . $option['id'] . '" id="' . $option['id'] . '">' . $real_value . '</textarea>';

            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;
        case 'button':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            $fields_html .= '<label for="' . $option['id'] . '">' . $option['title'] . '</label>';

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<div class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</div><!-- .jw-field-description -->';
            }

            /* The Field */
            $fields_html .= '<button name="' . $option['id'] . '" id="' . $option['id'] . '">' . $option['value'] . '</button>';

            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;

        /* select: Select field */
        case 'select':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            $fields_html .= '<label for="' . $option['id'] . '">' . $option['title'] . '</label>';

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<div class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</div><!-- .jw-field-description -->';
            }

            /* The Field */
            $fields_html .= '<select name="' . $option['id'] . '" id="' . $option['id'] . '">';

            /* Loop options */
            foreach ($option['opts'] as $key => $value) {

                /* Which options should be selected */
                if ($value == $real_value) {
                    $active_attr = 'selected';
                } else {
                    $active_attr = '';
                }

                /* Option */
                $fields_html .= '<option value="' . $value . '" ' . $active_attr . '>' . $key . '</option>';
            }

            $fields_html .= '</select>';

            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;

        /* radio: radio field */
        case 'radio':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            $fields_html .= '<label for="' . $option['id'] . '">' . $option['title'] . '</label>';

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<div class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</div><!-- .jw-field-description -->';
            }

            /* The Field */
            foreach ($option['opts'] as $key => $value) {

                /* Which options should be selected */
                if ($value == $real_value) {
                    $active_attr = 'checked';
                } else {
                    $active_attr = '';
                }

                /* Field */
                $fields_html .= '<p><input type="radio" name="' . $option['id'] . '" value="' . $value . '" ' . $active_attr . '>' . $key . '</p>';
            }

            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;

        /* checkbox: checkbox field */
        case 'checkbox':

            /* Field container open */
            $fields_html .= '<div class="wps-panel-field">';

            /* Label */
            $fields_html .= '<label for="' . $option['id'] . '">' . $option['title'] . '</label>';

            /* Description */
            if (isset($option['desc'])) {
                $fields_html .= '<div class="wps-panel-description">';
                $fields_html .= $option['desc'];
                $fields_html .= '</div><!-- .jw-field-description -->';
            }

            /* The Field */
            if ($real_value == 1) {
                $active_attr = 'checked';
            } else {
                $active_attr = '';
            }

            /* Field */
            $fields_html .= '<p><input type="checkbox" name="' . $option['id'] . '" value="' . $option['value'] . '" ' . $active_attr . '>' . $option['title'] . '</p>';

            /* Field container close */
            $fields_html .= '</div><!-- .wps-panel-field -->';

            break;
    }/* end switch */
}/* end foreach */