<?php
/*
  Plugin Name: Our Team
 */

add_action('init', 'ourteam_post_type');

function ourteam_post_type() {
    $labels = array(
        'name' => 'Our Staff',
        'singular_name' => 'staff',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Staff',
        'edit_item' => 'Edit Staff Details',
        'new_item' => 'New Staff Item',
        'view_item' => 'View Staff Items',
        'search_items' => 'Search Our Staff',
        'not_found' => 'No Staff Items found',
        'not_found_in_trash' => 'No Staff Items in the trash',
        'parent_item_colon' => '',
    );

    register_post_type('ourteams', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 80,
		'menu_icon' => 'https://cdn4.iconfinder.com/data/icons/books-booklets-and-manuals/400/userbook-24.png',
        'supports' => array('editor', 'thumbnail'),
        'register_meta_box_cb' => 'ourteams_meta_boxes',
    ));
    flush_rewrite_rules();
}


function ourteams_meta_boxes() {
    add_meta_box('ourteam_form', 'Our Staff Details', 'ourteam_form', 'ourteams', 'normal', 'high');
}

function ourteam_form() {
    $post_id = get_the_ID();
    $ourteam_data = get_post_meta($post_id, '_ourteam', true);
    $staff_name = ( empty($ourteam_data['staff_name']) ) ? '' : $ourteam_data['staff_name'];
    $staff_designation = ( empty($ourteam_data['staff_designation']) ) ? '' : $ourteam_data['staff_designation'];
    $staff_fb = ( empty($ourteam_data['staff_fb']) ) ? '' : $ourteam_data['staff_fb'];
    $staff_email = ( empty($ourteam_data['staff_mail']) ) ? '' : $ourteam_data['staff_mail'];
    $staff_twitter = ( empty($ourteam_data['staff_twitter']) ) ? '' : $ourteam_data['staff_twitter'];
    wp_nonce_field('ourteams', 'ourteams');
    ?>
    <p>
        <label>Staff Name (Required)</label><br />
        <input type="text" value="<?php echo $staff_name; ?>" name="ourteam[staff_name]" size="60" class="widefat" required/>
    </p> 
	<p>
        <label>Staff Designation (Required)</label><br />
        <input type="text" value="<?php echo $staff_designation; ?>" name="ourteam[staff_designation]" size="60" class="widefat" required/>
    </p>
	<p>
        <label>Staff Facebook (Required)</label><br />
        <input type="text" value="<?php echo $staff_fb; ?>" name="ourteam[staff_fb]" size="60" class="widefat" required/>
    </p>
	<p>
        <label>Staff Email</label><br />
        <input type="text" value="<?php echo $staff_mail; ?>" name="ourteam[staff_mail]" size="60" class="widefat"/>
    </p>
	<p>
        <label>Staff Twitter</label><br />
        <input type="text" value="<?php echo $staff_twitter; ?>" name="ourteam[staff_twitter]" size="60" class="widefat"/>
    </p>

         
    <?php
}

add_action('save_post', 'ourteams_save_post');


function ourteams_save_post($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!empty($_POST['ourteams']) && !wp_verify_nonce($_POST['ourteams'], 'ourteams'))
        return;

    if (!empty($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }


    if (!wp_is_post_revision($post_id) && 'ourteams' == get_post_type($post_id)) {
        remove_action('save_post', 'ourteams_save_post');

        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $_POST['ourteam']['staff_name']
        ));

        add_action('save_post', 'ourteams_save_post');
    }

    if (!empty($_POST['ourteam'])) {
        $ourteam_data['staff_name'] = ( empty($_POST['ourteam']['staff_name']) ) ? '' : sanitize_text_field($_POST['ourteam']['staff_name']);
        $ourteam_data['staff_designation'] = ( empty($_POST['ourteam']['staff_designation']) ) ? '' : sanitize_text_field($_POST['ourteam']['staff_designation']);
        $ourteam_data['staff_fb'] = ( empty($_POST['ourteam']['staff_fb']) ) ? '' : sanitize_text_field($_POST['ourteam']['staff_fb']);
        $ourteam_data['staff_mail'] = ( empty($_POST['ourteam']['staff_mail']) ) ? '' : sanitize_text_field($_POST['ourteam']['staff_mail']);
        $ourteam_data['staff_twitter'] = ( empty($_POST['ourteam']['staff_twitter']) ) ? '' : sanitize_text_field($_POST['ourteam']['staff_twitter']);
        
        update_post_meta($post_id, '_ourteam', $ourteam_data);
    } else {
        delete_post_meta($post_id, '_ourteam');
    }
}

add_filter('manage_edit-ourteams_columns', 'ourteam_edit_columns');


function ourteam_edit_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',        
        'ourteam-team-name' => 'Staff Name',
        
        'author' => 'Posted by',
        'date' => 'Date'
    );

    return $columns;
}

add_action('manage_posts_custom_column', 'ourteam_columns', 10, 2);


function ourteam_columns($column, $post_id) {
    $ourteam_data = get_post_meta($post_id, '_ourteam', true);
    switch ($column) {
        case 'ourteam-team-name':
            if (!empty($ourteam_data['staff_name']))
                echo $ourteam_data['staff_name'];
            break;
		case 'ourteam-team-designation':
            if (!empty($ourteam_data['staff_designation']))
                echo $ourteam_data['staff_designation'];
            break;
		case 'ourteam-team-mail':
            if (!empty($ourteam_data['staff_mail']))
                echo $ourteam_data['staff_mail'];
            break;
		case 'ourteam-team-fb':
            if (!empty($ourteam_data['staff_fb']))
                echo $ourteam_data['staff_fb'];
            break;
		case 'ourteam-team-twiitter':
            if (!empty($ourteam_data['staff_twitter']))
                echo $ourteam_data['staff_twitter'];
            break;
    }
}

function teams_type() {
    register_taxonomy(__("Status"),
            array(__("ourteams")),
            array(
        "hierarchical" => true,
        "label" => __("Status"),
        "singular_label" => __("Status"),
        "rewrite" => array(
            'slug' => 'status',
            'hierarchical' => true
        )
            )
    );
}
add_action('init', 'teams_type', 0);