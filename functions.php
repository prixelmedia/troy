<?php

/* ---------------------------------------------------------------------------------------------
  File Name:  Functions
  Description: Load the functions
  Version: 1.0
  --------------------------------------------------------------------------------------------- */
update_option('siteurl', 'http://demo.prixelmedia.com/box1/troy/');


update_option('home', 'http://demo.prixelmedia.com/box1/troy/');

/* Load all core functions */
add_theme_support('post-thumbnails');
add_image_size('portfolio', 600, 400, true);
add_image_size( 'team-thumb', 500, 9999 );
define('TEMPLATEPATH', get_template_directory_uri());

require_once(TEMPLATEPATH . '/includes/theme_custom_menus.php');
require_once(TEMPLATEPATH . '/includes/theme_enqueue_scripts.php');
require_once(TEMPLATEPATH . '/includes/twitter_bootstrap_nav_walker.php');
require_once(TEMPLATEPATH . '/includes/theme_sidebar.php');
require_once(TEMPLATEPATH . '/includes/theme_bread_crumb.php');
require_once(TEMPLATEPATH . '/includes/theme_widget.php');
require_once(TEMPLATEPATH . '/includes/theme_shortcodes.php');
require_once(TEMPLATEPATH . '/includes/theme_custom_page.php');
require_once(TEMPLATEPATH . '/includes/theme_mailer.php');
require_once(TEMPLATEPATH . '/portfolio/portfolio-post-type.php');
require_once(TEMPLATEPATH . '/ourteam/our-team.php');
require_once(TEMPLATEPATH . '/imageslider/image-slider.php');
require_once(TEMPLATEPATH . '/sermons/sermons.php');


/* Include back-end */
if (is_admin()) {
    require_once( TEMPLATEPATH . '/includes/admin/wps-panel.php');
}

/* Include front-end */
if (!is_admin()) {
    require_once ( TEMPLATEPATH . '/includes/admin/wps-panel-front.php');
}


function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}
remove_action( 'welcome_panel', 'wp_welcome_panel' );
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

function filter_search($query) {
    if ($query->is_search) {
	$query->set('post_type', array('post', 'plots'));
    };
    return $query;
};
add_filter('pre_get_posts', 'filter_search');





function public_holiday() {
    $date = date('d-m');
    switch($date) {
        case '01-01':
            $message = 'Happy New Years';
        break;
 
        case '25-12':
            $message = 'Merry Christmas';
        break;
		
		 case '27-03':
            $message = 'Happy Easter';
        break;
 
        default:
            $message = 'Welcome';
    }
    return $message;
}



function howdy_message($translated_text, $text, $domain) {
    $message = public_holiday();
    $new_message = str_replace('Howdy', $message, $text);
    return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);





function wp_infinitepaginate(){   
    //$loopFile        = $_POST['loop_file'];  
    $paged           = $_POST['page_no'];  
    $posts_per_page  = get_option('posts_per_page');  
 
    # Load the posts  
	$args = array( 'paged' => $paged, 'posts_per_page' => 2, 'post_type' => 'plots', 'orderby' => 'title', 'order' => 'ASC');
	$myposts = get_posts( $args );
	$result = array();
	$count = 0;
	foreach($myposts as $post){
		$count = $count + 1;
		$post_id = $post->ID;
		$plot_data = get_post_meta($post_id, '_plot', true);
		$result[$count]['title'] = $post->post_title;
		$result[$count]['location'] = $plot_data['plot_location'];
		$result[$count]['area'] = $plot_data['plot_area'];
		$result[$count]['price'] = $plot_data['plot_price'];
		$date = date_create($post->post_date);
		$result[$count]['date'] = date_format($date, 'd / m / Y');
		$terms = get_the_terms($post_id, 'Type');
			foreach ($terms as $term){
				$result[$count]['termname'] = $term->name;
				$result[$count]['termslug'] = $term->slug;			
			}

		$result[$count]['link']= $post->guid;
		$large_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'fullsize', false, '');
		$result[$count]['image'] = $large_image[0];			
	}
    echo json_encode($result);
  
    exit;  
} 

add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');



?>