<?php
/*

Plugin Name: Our Program

*/

add_action('init', 'ourprogram_post_type');

function ourprogram_post_type() {
    $labels = array(
        'name' => 'Our Sermons',
        'singular_name' => 'Sermon',
        'add_new' => 'Add New Sermon',
        'add_new_item' => 'Add New Sermon',
        'edit_item' => 'Edit Sermon Details',
        'new_item' => 'New Sermon',
        'view_item' => 'View Sermon',
        'search_items' => 'Search Our Sermon',
        'not_found' => 'No Sermon found',
        'not_found_in_trash' => 'No Sermon in the trash',
        'parent_item_colon' => '',
    );

    register_post_type('ourprograms', array(
    	'taxonomies' => array('post_tag'),
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
		'menu_icon' => 'https://cdn4.iconfinder.com/data/icons/books-booklets-and-manuals/400/biblebook-24.png',		
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
    $sermon_name = ( empty($ourprogram_data['sermon_name']) ) ? '' : $ourprogram_data['sermon_name'];
    $sermon_video = ( empty($ourprogram_data['sermon_video']) ) ? '' : $ourprogram_data['sermon_video'];
    $sermon_audio = ( empty($ourprogram_data['sermon_audio']) ) ? '' : $ourprogram_data['sermon_audio'];
    $sermon_author = ( empty($ourprogram_data['sermon_author']) ) ? '' : $ourprogram_data['sermon_author'];
     $sermon_pdf = ( empty($ourprogram_data['sermon_pdf']) ) ? '' : $ourprogram_data['sermon_pdf'];

    wp_nonce_field('sermons', 'sermons');
    ?>
    <p>
        <label>Sermon Name (Required)</label><br />
        <input type="text" value="<?php echo $sermon_name; ?>" name="ourprogram[sermon_name]" size="60" class="widefat" required/>
    </p> 
	<p>
        <label>Sermon Video ID (Youtube)</label><br />
        <input type="text" value="<?php echo $sermon_video; ?>" name="ourprogram[sermon_video]" size="60" class="widefat" required/>
    </p>
	<p>
        <label>Sermon Audio Link ID (SoundCloud)</label><br />
        <input type="text" value="<?php echo $sermon_audio; ?>" name="ourprogram[sermon_audio]" size="60" class="widefat" required/>
    </p>
	<p>
        <label>Sermon Authors</label><br />
        <input type="text" value="<?php echo $sermon_author; ?>" name="ourprogram[sermon_author]" size="60" class="widefat"/>
    </p>

	<p>
        <label>Sermon PDF (Please add PDF in 'Media' & Link it)</label><br />
        <input type="text" value="<?php echo $sermon_pdf; ?>" name="ourprogram[sermon_pdf]" size="60" class="widefat"/>
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
			'post_title' => $_POST['ourprogram']['sermon_name']
        ));

        add_action('save_post', 'ourprograms_save_post');
    }

    if (!empty($_POST['ourprogram'])) {
        $ourprogram_data['sermon_name'] = ( empty($_POST['ourprogram']['sermon_name']) ) ? '' : sanitize_text_field($_POST['ourprogram']['sermon_name']);
        $ourprogram_data['sermon_name'] = ( empty($_POST['ourprogram']['sermon_name']) ) ? '' : sanitize_text_field($_POST['ourprogram']['sermon_name']);
        $ourprogram_data['sermon_video'] = ( empty($_POST['ourprogram']['sermon_video']) ) ? '' : sanitize_text_field($_POST['ourprogram']['sermon_video']);
        $ourprogram_data['sermon_audio'] = ( empty($_POST['ourprogram']['sermon_audio']) ) ? '' : sanitize_text_field($_POST['ourprogram']['sermon_audio']);
        $ourprogram_data['sermon_author'] = ( empty($_POST['ourprogram']['sermon_author']) ) ? '' : sanitize_text_field($_POST['ourprogram']['sermon_author']);
        $ourprogram_data['sermon_pdf'] = ( empty($_POST['ourprogram']['sermon_pdf']) ) ? '' : sanitize_text_field($_POST['ourprogram']['sermon_pdf']);
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
            if (!empty($ourprogram_data['sermon_name']))
                echo $ourprogram_data['sermon_name'];
            break;
    }
}

function sermons_type() {
    register_taxonomy(__("Series"),
            array(__("ourprograms")),
            array(
        "hierarchical" => true,
        "label" => __("Series"),
        "singular_label" => __("Series"),
        "rewrite" => array(
            'slug' => 'series',
            'hierarchical' => true
        )
            )
    );
}
add_action('init', 'sermons_type', 0);