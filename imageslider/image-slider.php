<?php
/*
  Plugin Name: Image Slider
 */

add_action('init', 'imageslider_post_type');

function imageslider_post_type() {
    $labels = array(
        'name' => 'Image Slider',
        'singular_name' => 'Slider',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Image Slider',
        'edit_item' => 'Edit Image Slider Details',
        'new_item' => 'New Image Slider',
        'view_item' => 'View Image Sliders',
        'search_items' => 'Search Image Slider',
        'not_found' => 'No Image Sliders found',
        'not_found_in_trash' => 'No Image Sliders in the trash',
        'parent_item_colon' => '',
    );

    register_post_type('imagesliders', array(
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
		'menu_icon' => 'https://cdn4.iconfinder.com/data/icons/small-n-flat/24/image-24.png',		
        'supports' => array('title', 'thumbnail'),
        'register_meta_box_cb' => 'imageslider_meta_boxes',
    ));
    flush_rewrite_rules();
}

function imageslider_meta_boxes() {
    add_meta_box('imageslider_form', 'Image Slider Details', 'imageslider_form', 'imagesliders', 'normal', 'high');
}

function imageslider_form() {
    $post_id = get_the_ID();
    $imageslider_data = get_post_meta($post_id, '_imageslider', true);
    $image_caption = ( empty($imageslider_data['image_caption']) ) ? '' : $imageslider_data['image_caption'];
    wp_nonce_field('imagesliders', 'imagesliders');
    ?>
    <p>
        <label>Image Caption (Required)</label><br />
        <textarea name="imageslider[image_caption]" size="80" class="widefat" required> <?php echo $image_caption; ?></textarea>
    </p>

    <?php
}

add_action('save_post', 'imagesliders_save_post');

function imagesliders_save_post($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!empty($_POST['imagesliders']) && !wp_verify_nonce($_POST['imagesliders'], 'imagesliders'))
        return;

    if (!empty($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }


    if (!wp_is_post_revision($post_id) && 'imagesliders' == get_post_type($post_id)) {
        remove_action('save_post', 'imagesliders_save_post');

        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => get_the_title($post_id)
        ));

        add_action('save_post', 'imagesliders_save_post');
    }

    if (!empty($_POST['imageslider'])) {
        $imageslider_data['image_caption'] = ( empty($_POST['imageslider']['image_caption']) ) ? '' : sanitize_text_field($_POST['imageslider']['image_caption']);
        update_post_meta($post_id, '_imageslider', $imageslider_data);
    } else {
        delete_post_meta($post_id, '_imageslider');
    }
}

add_filter('manage_edit-imagesliders_columns', 'imageslider_edit_columns');

function imageslider_edit_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'imageslider-caption' => 'Image Caption',
        'author' => 'Posted by',
        'date' => 'Date'
    );

    return $columns;
}

add_action('manage_posts_custom_column', 'imageslider_columns', 10, 2);

function imageslider_columns($column, $post_id) {
    $imageslider_data = get_post_meta($post_id, '_imageslider', true);
    switch ($column) {
        case 'imageslider-caption':
            if (!empty($imageslider_data['image_caption']))
                echo $imageslider_data['image_caption'];
            break;
    }
}
