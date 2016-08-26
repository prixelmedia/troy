<?php
/*
  Plugin Name: Client Testimonials
 */


define('TEMPLATEPATH', get_template_directory_uri());

//include( TEMPLATEPATH . '/includes/widgets/widget-testimonials.php' );



add_action('init', 'testimonials_post_type');


function testimonials_post_type() {
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' => 'No Testimonials found',
        'not_found_in_trash' => 'No Testimonials in the trash',
        'parent_item_colon' => '',
    );

    register_post_type('testimonials', array(
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
		'menu_icon' => 'https://cdn1.iconfinder.com/data/icons/mimiGlyphs/16/user.png',
        'supports' => array('editor'),
        'register_meta_box_cb' => 'testimonials_meta_boxes',
    ));
}


function testimonials_meta_boxes() {
    add_meta_box('testimonials_form', 'Testimonial Details', 'testimonials_form', 'testimonials', 'normal', 'high');
}


function testimonials_form() {
    $post_id = get_the_ID();
    $testimonial_data = get_post_meta($post_id, '_testimonial', true);
    $client_name = ( empty($testimonial_data['client_name']) ) ? '' : $testimonial_data['client_name'];
    $client_job = ( empty($testimonial_data['client_job']) ) ? '' : $testimonial_data['client_job'];
    $client_link = ( empty($testimonial_data['client_link']) ) ? '' : $testimonial_data['client_link'];

    wp_nonce_field('testimonials', 'testimonials');
    ?>
    <p>
        <label>Client's Name (optional)</label><br />
        <input type="text" value="<?php echo $client_name; ?>" name="testimonial[client_name]" size="40" />
    </p>
    <p>
        <label>Client's Job / Occupation (optional)</label><br />
        <input type="text" value="<?php echo $client_job; ?>" name="testimonial[client_job]" size="40" />
    </p>
    <p>
        <label>Client's Web-site Link (optional)</label><br />
        <input type="text" value="<?php echo $client_link; ?>" name="testimonial[client_link]" size="40" />
    </p>
    <?php
}

add_action('save_post', 'testimonials_save_post');


function testimonials_save_post($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!empty($_POST['testimonials']) && !wp_verify_nonce($_POST['testimonials'], 'testimonials'))
        return;

    if (!empty($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }

    if (!wp_is_post_revision($post_id) && 'testimonials' == get_post_type($post_id)) {
        remove_action('save_post', 'testimonials_save_post');

        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => 'Testimonial - ' . $post_id
        ));

        add_action('save_post', 'testimonials_save_post');
    }

    if (!empty($_POST['testimonial'])) {
        $testimonial_data['client_name'] = ( empty($_POST['testimonial']['client_name']) ) ? '' : sanitize_text_field($_POST['testimonial']['client_name']);
        $testimonial_data['client_job'] = ( empty($_POST['testimonial']['client_job']) ) ? '' : sanitize_text_field($_POST['testimonial']['client_job']);
        $testimonial_data['client_link'] = ( empty($_POST['testimonial']['client_link']) ) ? '' : esc_url($_POST['testimonial']['client_link']);

        update_post_meta($post_id, '_testimonial', $testimonial_data);
    } else {
        delete_post_meta($post_id, '_testimonial');
    }
}

add_filter('manage_edit-testimonials_columns', 'testimonials_edit_columns');


function testimonials_edit_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'testimonial' => 'Testimonial',
        'testimonial-client-name' => 'Client\'s Name',
        'testimonial-job' => 'Client\'s Job',
        'testimonial-link' => 'Client\'s Website',
        'author' => 'Posted by',
        'date' => 'Date'
    );

    return $columns;
}

add_action('manage_posts_custom_column', 'testimonials_columns', 10, 2);


function testimonials_columns($column, $post_id) {
    $testimonial_data = get_post_meta($post_id, '_testimonial', true);
    switch ($column) {
        case 'testimonial':
            the_excerpt();
            break;
        case 'testimonial-client-name':
            if (!empty($testimonial_data['client_name']))
                echo $testimonial_data['client_name'];
            break;
        case 'testimonial-job':
            if (!empty($testimonial_data['client_job']))
                echo $testimonial_data['client_job'];
            break;
        case 'testimonial-link':
            if (!empty($testimonial_data['client_link']))
                echo $testimonial_data['client_link'];
            break;
    }
}


function get_testimonial($posts_per_page = 5, $orderby = 'none', $testimonial_id = null, $title = 'Testimonails  For', $color = 'serene', $type = 'other') {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'testimonials',
        'orderby' => $orderby,
        'title' => $title,
        'no_found_rows' => true
    );
    if ($testimonial_id)
        $args['post__in'] = array($testimonial_id);

    $query = new WP_Query($args);
    $count = 0;
    $testimonials = '';

		$testimonials  = '</div></div></div><div class="container listings">';
        $testimonials .= '<h5><span><i class="icon-left-quote "></i></span> ' . $title . '</h5>';
        $testimonials .= '<div class="row-fluid ">';
        $testimonials .= '<div class="client-testimonials">';
        $testimonials .= '<div class="carousel slide carousel-fade" id="clients-testimonials">';
        $testimonials .= '<div class="carousel-inner">';
        //$testimonials .= '';

        if ($query->have_posts()) {
            while ($query->have_posts()) : $query->the_post();
                $count = $count + 1;
                $post_id = get_the_ID();
                $testimonial_data = get_post_meta($post_id, '_testimonial', true);
                $client_name = ( empty($testimonial_data['client_name']) ) ? '' : $testimonial_data['client_name'];
                $source = ( empty($testimonial_data['client_job']) ) ? '' : ' - ' . $testimonial_data['client_job'];
                $link = ( empty($testimonial_data['client_link']) ) ? '' : $testimonial_data['client_link'];
                //$cite = ( $link ) ? '<a href="' . esc_url($link) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;

                if ($count == 1) {
                    $cls = ' active';
                } else {
                    $cls = '';
                }
                $testimonials .= '<div class="item' . $cls . '"><div class="testimonial-holder"><div class="testimonial-content"><p>' . get_the_content() . '</p></div>';
                $testimonials .= '<div class="client-credential"><span class="client-name">' .$client_name. '</span><span class="client-job">' .$source. '</span></div></div></div>';


            endwhile;
            wp_reset_postdata();
            //stimonials .= '</div>';
            $testimonials .= '</div>'; 
			$testimonials .= '</div>';
            $testimonials .= '</div>';
            $testimonials .= '</div>';
            $testimonials .= '</div>';

        }
    return $testimonials;
}

add_shortcode('testimonial', 'testimonial_shortcode');


function testimonial_shortcode($atts) {
    extract(shortcode_atts(array(
                'posts_per_page' => '5',
                'orderby' => 'none',
                'testimonial_id' => '',
                'title' => 'Client Testimonials'
                    ), $atts));

    return get_testimonial($posts_per_page, $orderby, $testimonial_id, $title);
}