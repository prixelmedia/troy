<?php
/*

Plugin Name: Our Program

*/

add_action('init', 'ourprogram_post_type');

function ourprogram_post_type() {
    $labels = array(
        'name' => 'Our Programs',
        'singular_name' => 'Program',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Program ',
        'edit_item' => 'Edit Program Details',
        'new_item' => 'New Program ',
        'view_item' => 'View Program',
        'search_items' => 'Search Our Program',
        'not_found' => 'No Program found',
        'not_found_in_trash' => 'No Program  in the trash',
        'parent_item_colon' => '',
    );

    register_post_type('ourprograms', array(
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
        'menu_position' => 100,
		'menu_icon' => 'http://www.justforworship.org/wp-content/themes/just4worship/assets/images/program.png',		
        'supports' => array('editor', 'thumbnail', 'tags'),
        'register_meta_box_cb' => 'ourprogram_meta_boxes',
    ));
    flush_rewrite_rules();
}


function ourprogram_meta_boxes() {
    add_meta_box('ourprogram_form', 'Our Program Details', 'ourprogram_form', 'ourprograms', 'normal', 'high');
}

function ourprogram_form() {
    $post_id = get_the_ID();
    $ourprogram_data = get_post_meta($post_id, '_ourprogram', true);
    $program_name = ( empty($ourprogram_data['program_name']) ) ? '' : $ourprogram_data['program_name'];
    wp_nonce_field('ourprograms', 'ourprograms');
    ?>

    <p>
        <label>Program Name (Required)</label><br />
        <input type="text" value="<?php echo $program_name; ?>" name="ourprogram[program_name]" size="60" required/>
    </p>
	



       
    <?php
}

add_action('save_post', 'ourprograms_save_post');


function ourprograms_save_post($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!empty($_POST['ourprograms']) && !wp_verify_nonce($_POST['ourprograms'], 'ourprograms'))
        return;

    if (!empty($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }


    if (!wp_is_post_revision($post_id) && 'ourprograms' == get_post_type($post_id)) {
        remove_action('save_post', 'ourprograms_save_post');

        wp_update_post(array(
            'ID' => $post_id,
			'post_title' => $_POST['ourprogram']['program_name']
        ));

        add_action('save_post', 'ourprograms_save_post');
    }

    if (!empty($_POST['ourprogram'])) {
        $ourprogram_data['program_name'] = ( empty($_POST['ourprogram']['program_name']) ) ? '' : sanitize_text_field($_POST['ourprogram']['program_name']);

        update_post_meta($post_id, '_ourprogram', $ourprogram_data);
    } else {
        delete_post_meta($post_id, '_ourprogram');
    }
}

add_filter('manage_edit-ourprograms_columns', 'ourprogram_edit_columns');


function ourprogram_edit_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',        
        'ourprogram-program-name' => 'Program Name',
        'author' => 'Posted by',
        'date' => 'Date'
    );

    return $columns;
}

add_action('manage_posts_custom_column', 'ourprogram_columns', 10, 2);


function ourprogram_columns($column, $post_id) {
    $ourprogram_data = get_post_meta($post_id, '_ourprogram', true);
    switch ($column) {
        case 'ourprogram-program-name':
            if (!empty($ourprogram_data['program_name']))
                echo $ourprogram_data['program_name'];
            break;
    }
}