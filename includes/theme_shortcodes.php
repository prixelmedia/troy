<?php

/* ---------------------------------------------------------------------------------------------
 * Theme Short Codes Definitions
 * Version 1.0
 * Description: Create Custom Short Codes
  ---------------------------------------------------------------------------------------------- */

/* * ****** Short Codes ********* */

function collapse_group($atts, $content = null) {
    extract(shortcode_atts(array(
                'id' => '',
                'class' => '',
                'title' => '',
                'color' => ''
                    ), $atts));
    $output .= '<h4>' . $title . '<span class="colorful-text">' . $color . '</span></h4>';
    $output .= '<div id="" class="accordion ' . $class . '"  ';

    if (!empty($id))
        $output .= 'id="' . $id . '"';

    $output .='>' . do_shortcode($content) . '</div>';
    return $output;
}

add_shortcode("collapse_group", "collapse_group");

function collapse($atts, $content = null) {
    extract(shortcode_atts(array(
                'id' => '',
                'title' => '',
                'open' => 'n'
                    ), $atts));

    // autogenerate id to link the accordian title with contents.
    if (empty($id))
        $id = 'accordian_item_' . rand(100, 999);

    $output = '<div class="accordion-group">
        <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" 
        data-parent="#accordion2" href="#' . $id . '"><i class="icon-plus-3"></i>' . $title . '</a>
        </div>
         <div id="' . $id . '" class="accordion-body collapse ' . ($open == 'y' ? 'in' : '') . '">
            <div class="accordion-inner">' . $content . '</div>
         </div>
        </div>';

    return $output;
}

add_shortcode("collapse", "collapse");

function add_col($atts, $content = null) {
    extract(shortcode_atts(array(
                'id' => '',
                'class' => '',
                'wrap' => ''
                    ), $atts));

    if (!empty($wrap)) {
        $output .= '<div class="' . $class . '"><div class="' . $wrap . '"';
        $output .='>' . do_shortcode($content) . '</div></div>';
    } else {
        $output = '<div class="' . $class . '"  ';
        if (!empty($id))
            $output .= 'id="' . $id . '"';
        $output .='>' . do_shortcode($content) . '</div>';
    }

    return $output;
}

add_shortcode("column", "add_col");

function add_row($atts, $content = null) {
    extract(shortcode_atts(array(
                'class' => '',
                'space' => ''
                    ), $atts));

    $output = '</div></div><div class="row-fluid ';

    if (!empty($space))
        $output .= 'padding' . $space . '"';
    else
        $output .= '"';

    $output .='>' . do_shortcode($content) . '<div class="hide">';
    return $output;
}

add_shortcode("row", "add_row");

function add_slider($atts, $content = null) {
    extract(shortcode_atts(array(
                'class' => '',
                'space' => ''
                    ), $atts));
		$image = explode(" <", $content);
		$output = '<div id="listSingleslider" class="carousel slide carousel-fade"><div class="carousel-inner">';
		for($i = 0; $i<sizeof($image); $i++){
			if($i==0){
				$cls = 'active';
				$img = $image[$i];
			}else{
				$cls = '';
				$img = '<'.$image[$i];			
			}
			$output .= '<div class="'.$cls.' item">'.$img.'</div>';	
		}				
		$output .= '</div><a class="carousel-control left" href="#listSingleslider" data-slide="prev">&lsaquo;</a><a class="carousel-control right" href="#listSingleslider" data-slide="next">&rsaquo;</a></div>';

    return $output;
}

add_shortcode("slider", "add_slider");


function add_banner($atts, $content = null) {
    extract(shortcode_atts(array(
                'class' => '',
                    ), $atts));

    $output = '<div class="grey-box"';

    $output .='>' . do_shortcode($content) . '</div>';

    if (!empty($class)) {
        $output = '<div class="' . $class . '">' . $output . '</div>';
    }
    return $output;
}

add_shortcode("banner", "add_banner");

function get_specialists($posts_per_page = 5, $title = 'Specialits  For', $subtitle = 'serene', $icon = 'icon-user-2') {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'ourteams',
        'title' => $title,
        'subtitle' => $subtitle,
        'icon' => $icon,
        'no_found_rows' => true,
    );

    $query = new WP_Query($args);
    $count = 0;
    $ourteam = '';
    $ourteam .= '<div class="box-heading"><i class="' . $icon . ' box-icon pull-left"></i><h4>' . $title . '<small>' . $subtitle . '</small></h4></div>';
    $ourteam .= '<div class="box-content">';
    $ourteam .= '<div id="our-specs" class="carousel slide carousel-fade">';
    $ourteam .= '<ul class="carousel-indicators">';
    $posts = ceil(sizeof($query->get_posts($args)) / 2);
    $nav = '';
    for ($i = 0; $i < $posts; $i++) {
        if ($i == 0) {
            $acls = 'active';
        } else {
            $acls = '';
        }
        $nav .= '<li data-target="#our-specs" data-slide-to="' . $i . '" class="' . $acls . '"></li>';
    }
    $ourteam .= $nav . '</ul>';
    $ourteam .= '<div class="carousel-inner">';
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            $count = $count + 1;
            $post_id = get_the_ID();
            $team_data = get_post_meta($post_id, '_ourteam', true);

            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
            $img = $img[0];

            $name = ( empty($team_data['member_name']) ) ? '' : $team_data['member_name'];
            $qualification = ( empty($team_data['member_position']) ) ? '' : $team_data['member_position'];
            $position = ( empty($team_data['member_qualification']) ) ? '' : $team_data['member_qualification'];
            $content = wp_trim_words(get_the_content(), $num_words = 60, $more = null);
            $link = get_permalink(get_the_ID());
            if ($count == 1) {
                $cls = ' active';
            } else {
                $cls = '';
            }
            $ourteam .= '<div class="row-fluid specialists-row"><div class="span6"><img src="' . $img . '" style="width: 208px; height: 228px;" /></div>';
            $ourteam .= '<div class="span6"><h3>' . $name . '<span class="qualification">' . $qualification . '</span></h3>';
            $ourteam .= '<span class="specilisation">' . $position . '</span><p>' . $content . '<span class="read-more"><a href="' . $link . '">Read More</a></span></p></div></div>';

        endwhile;
        wp_reset_postdata();
        $ourteam .= '</div>';
        $ourteam .= '</div>';
        $ourteam .= '</div>';
    }

    return $ourteam;
}

add_shortcode('specialists', 'specialist_shortcode');

function specialist_shortcode($atts) {
    extract(shortcode_atts(array(
                'posts_per_page' => '5',
                'title' => 'Specialits For',
                'subtitle' => 'Serene',
                'icon' => 'icon-user-2'
                    ), $atts));

    return get_specialists($posts_per_page, $title, $subtitle, $icon);
}

function get_randpage($posts_per_page = 3, $parent_id, $title, $subtitle, $icon) {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'page',
        'post_parent' => (int) $parent_id,
        'title' => $title,
        'subtitle' => $subtitle,
        'icon' => $icon,
        'orderby' => 'rand',
        'no_found_rows' => true,
    );

    $query = new WP_Query($args);
    $count = 0;
    $featured = '';
    $featured .= '<div class="box-heading"><i class="' . $icon . ' box-icon pull-left"></i><h4>' . $title . '<small>' . $subtitle . '</small></h4></div>';
    $featured .= '<div class="box-content">';
    $featured .= '<ul class="left-sidebar-features span12">';

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            $count = $count + 1;
            $post_id = get_the_ID();
            $team_data = get_post($post_id);
            $content = wp_trim_words(get_the_content(), $num_words = 30, $more = null);
            $title = get_the_title($post_id);
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
            $img = $img[0];


            $featured .= '<li class="f1_container"><div id="f1_card" class="shadow"><div class="front face">';
            $featured .= '<a class="featured-image" href="#"><img src="' . $img . '"  class="img-polaroid"/></a>';
            $featured .= '<span class="features-caption">' . $title . '</span></div>';
            $featured .= '<div class="back face center"><p>' . $content . '</p></div></div></li>';

        endwhile;
        wp_reset_postdata();
        $featured .= '</ul>';
        $featured .= '</div>';
    }

    return $featured;
}

add_shortcode('featured', 'featured_shortcode');

function featured_shortcode($atts) {
    extract(shortcode_atts(array(
                'posts_per_page' => '3',
                'title' => '',
                'subtitle' => '',
                'icon' => 'icon-user-2',
                'parent_id' => ''
                    ), $atts));

    return get_randpage($posts_per_page, $parent_id,  $title, $subtitle, $icon);
}

?>
