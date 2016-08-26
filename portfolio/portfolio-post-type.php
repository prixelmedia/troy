<?php

// function: post_type BEGIN
function post_type() {
    // Create The Labels (Output) For The Post Type
    $labels =
            array(

                'name' => __('Gallery'),

                'singular_name' => __('Gallery'),

                'rewrite' =>
                array(

                    'slug' => __('portfolio')
                ),
                'add_new' => _x('Add Item', 'portfolio'),
                'edit_item' => __('Edit Gallery Item'),
      
                'new_item' => __('New Gallery Item'),
                
                'view_item' => __('View Gallery'),
                
                'search_items' => __('Search Gallery'),
                
                'not_found' => __('No Gallery Items Found'),
                
                'not_found_in_trash' => __('No Gallery Items Found In Trash'),
                
                'parent_item_colon' => ''
				
    );

    // Set Up The Arguements
    $args =
            array(
                // Pass The Array Of Labels
                'labels' => $labels,
                // Display The Post Type To Admin
                'public' => true,
                // Allow Post Type To Be Queried 
                'publicly_queryable' => true,
                // Build a UI for the Post Type
                'show_ui' => true,
                // Use String for Query Post Type
                'query_var' => true,
                // Rewrite the slug
                'rewrite' => true,
                // Set type to construct arguements
                'capability_type' => 'post',
                // Disable Hierachical - No Parent
                'hierarchical' => false,
                // Set Menu Position for where it displays in the navigation bar
                'menu_position' => 80,
				
				'menu_icon' => 'http://wacotrib.mycapture.com/mycapture/images/icon_images.png',
                // Allow the portfolio to support a Title, Editor, Thumbnail
                'supports' =>
                array(
                    'title',
                    'editor',
                    'thumbnail'
                )
    );

    // Register The Post Type
    register_post_type(__('portfolio'), $args);
}

// function: post_type END
// function: portfolio_messages BEGIN
function portfolio_messages($messages) {
    $messages[__('portfolio')] =
            array(
                // Unused. Messages start at index 1
                0 => '',
                // Change the message once updated
                1 => sprintf(__('Portfolio Updated. <a href="%s">View portfolio</a>'), esc_url(get_permalink($post_ID))),
                // Change the message if custom field has been updated
                2 => __('Custom Field Updated.'),
                // Change the message if custom field has been deleted
                3 => __('Custom Field Deleted.'),
                // Change the message once portfolio been updated
                4 => __('Portfolio Updated.'),
                // Change the message during revisions
                5 => isset($_GET['revision']) ? sprintf(__('Portfolio Restored To Revision From %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
                // Change the message once published
                6 => sprintf(__('Portfolio Published. <a href="%s">View Portfolio</a>'), esc_url(get_permalink($post_ID))),
                // Change the message when saved
                7 => __('Portfolio Saved.'),
                // Change the message when submitted item
                8 => sprintf(__('Portfolio Submitted. <a target="_blank" href="%s">Preview Portfolio</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
                // Change the message when a scheduled preview has been made
                9 => sprintf(__('Portfolio Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                // Change the message when draft has been made
                10 => sprintf(__('Portfolio Draft Updated. <a target="_blank" href="%s">Preview Portfolio</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );
    return $messages;
}

// function: portfolio_messages END
// function: portfolio_filter BEGIN
function portfolio_filter() {
    // Register the Taxonomy
    register_taxonomy(__("filter"),
            // Assign the taxonomy to be part of the portfolio post type
            array(__("portfolio")),
            // Apply the settings for the taxonomy
            array(
        "hierarchical" => true,
        "label" => __("Filter"),
        "singular_label" => __("Filter"),
        "rewrite" => array(
            'slug' => 'filter',
            'hierarchical' => true
        )
            )
    );
}

// function: portfolio_filter END


add_action('init', 'post_type');
add_action('init', 'portfolio_filter', 0);
add_filter('post_updated_messages', 'portfolio_messages');
?>