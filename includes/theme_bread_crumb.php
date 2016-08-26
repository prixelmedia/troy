<?php

/* ---------------------------------------------------------------------------------------------
 * Theme Custom BreadCrumb Menu File.
 * Version 1.0
 * Description: Create custom breadcrumbs's
  ---------------------------------------------------------------------------------------------- */

//function to create the breadcrumbs's
function get_breadcrumbs() {
    global $wp_query;

    if (!is_home()) {

        // Start the UL
        echo '<ol class="breadcrumb">';
        // Add the Home link
        echo '<li><a href="' . get_settings('home') . '">' . get_bloginfo('name') . '</a></li>';

        if (is_category()) {
            $catTitle = single_cat_title("", false);
            $cat = get_cat_ID($catTitle);
            echo "<li>  " . get_category_parents($cat, TRUE, "  ") . "</li>";
        }
        elseif (is_tax('Series')) {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$tax_term_breadcrumb_taxonomy_slug = $term->taxonomy;
	echo "<li><a href='".get_term_link(intval($term->term_id), 'Series')."' class='active'>  ".$term->name."</a></li>";
	}
         elseif (is_archive() && !is_category()) {
            echo "<li><a href='#' class='active'>  Archives</a></li>";
        } elseif (is_search()) {

            echo "<li><a href='#' class='active'>   Search Results</a></li>";
        } elseif (is_404()) {
            echo "<li>  404 Not Found</li>";
        } elseif (is_single()) {
            $category = get_the_category();
            $category_id = get_cat_ID($category[0]->cat_name);

            if (get_post_type($wp_query->post->ID)) {
            	if(get_post_type($wp_query->post->ID) != "ourprograms"){
                echo '<li><a href="' . get_settings('home') . '/' . get_post_type($wp_query->post->ID) . '">  ' . get_post_type($wp_query->post->ID) . '</a> </li> ';
                echo "<li><a href='#' class='active'>".the_title('', '', FALSE) . "</a></li>";
                }else{
                 echo '<li><a href="' . get_settings('home') . '/' . get_post_type($wp_query->post->ID) . '"> Sermons</a></li> ';
                echo "<li><a href='#' class='active'>".the_title('', '', FALSE) . "</a></li>";               
                }
            } else {
                echo '<li><a href="' . get_settings('home') . '/' . get_post_type($wp_query->post->ID) . '"> ' . get_category_parents($category_id, TRUE, "  ")."</a></li>";

                echo "<li><a href='#' class='active'>".the_title('', '', FALSE) . "</a></li>";
            }
        } elseif (is_page()) {
            $post = $wp_query->get_queried_object();

            if ($post->post_parent == 0) {

                echo "<li class='active'>  " . the_title('', '', FALSE) . "</li>";
            } else {
                $title = the_title('', '', FALSE);
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                array_push($ancestors, $post->ID);

                foreach ($ancestors as $ancestor) {
                    if ($ancestor != end($ancestors)) {
                        echo '<li>  <a href="' . get_permalink($ancestor) . '">' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '</a></li><li><span class="divider"> / </span></li>';
                    } else {
                        echo '<li>  ' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '</li>';
                    }
                }
            }
        }

        // End the UL
        echo "</ol>";
    }
}