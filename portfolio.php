<?php
/* ---------------------------------------------------------------------------------------------
  Template Name: Gallery Page Template
  Description: Load The Gallery Page Template
  Version: 1.0
  --------------------------------------------------------------------------------------------- */
$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
$options = wps_panel_get_options();
get_header();
?>

  <!-- Start Page Header -->
    <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
    <div class="page-header parallax clearfix" style="background-image:url(<?php echo $feat_image; ?>);">
        <div class="title-subtitle-holder">
        	<div class="title-subtitle-holder-inner">
    			<h2><?php
						if ($post->post_parent) {
							$parent_title = get_the_title($post->post_parent);
							echo $parent_title;
						} else {
							wp_title($sep = '');
						}
					?></h2>
        	</div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Breadcrumbs -->
    <div class="lgray-bg breadcrumb-cont">
    	<div class="container">
            	<?php get_breadcrumbs(); ?>
        </div>
    </div>
    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
      		<div class="container">
            <ul class="nav nav-pills sort-source" data-sort-id="gallery" data-option-key="filter">
			 <li data-option-value="*" class="active"><a href="#"><i class="fa fa-image"></i> <span>Show All</span></a></li>
							<?php
                            // Get the taxonomy
                            $terms = get_terms('filter', $args);
                            // set a count to the amount of categories in our taxonomy
                            $count = count($terms);
                            // set a count value to 0
                            $i = 0;
                            // test if the count has any categories
                            if ($count > 0) {
                                // break each of the categories into individual elements
                                foreach ($terms as $term) {
                                    // increase the count by 1
                                    $i++;
                                    // rewrite the output for each category
                                    $term_list .= '<li data-option-value=".' . $term->slug . '"><a href="javascript:void(0)"><span>' . ucfirst($term->name) . '</span></a></li>';
                                    // if count is equal to i then output blank
                                    if ($count != $i) {
                                        $term_list .= '';
                                    } else {
                                        $term_list .= '';
                                    }
                                }
                                // print out each of the categories in our new format
                                echo $term_list;
                            }
                            ?>			
            </ul>
                <div class="row">
                  	<ul class="sort-destination isotope-grid" data-sort-id="gallery">
					<?php
						// Set the page to be pagination
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

						// Query Out Database
                        $wpbp = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => '100', 'paged' => $paged));
                        ?>

                        <?php
                        // Begin The Loop
                        $ct = 1;
                        if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
						
                                ?>

                                <?php
                                // Get The Taxonomy 'Filter' Categories
                                $terms = get_the_terms(get_the_ID(), 'filter');
                                ?>

                                <?php
                                $large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
                                $large_image = $large_image[0];
                                ?>

                                <?php
                                //Apply a data-id for unique indentity, 
                                //and loop through the taxonomy and assign the terms to the portfolio item to a data-type,
                                // which will be referenced when writing our Quicksand Script
                                ?>
                    	<li class="col-md-4 col-sm-4 grid-item format-link isotope-item <?php
                        foreach ($terms as $term) {
                            echo strtolower(preg_replace('/\s+/', '-', $term->name)) . ' ';
                        }
                                ?>">
                        	<div class="grid-item-inner"> <a href="<?php echo $large_image ?>" data-rel="prettyPhoto" class="media-box"> <?php the_post_thumbnail('portfolio'); ?> </a> </div>
                    	</li>
			 
                            <?php
							$ct += 1;
                            endwhile;
                        endif; // END the Wordpress Loop 
                        ?>
<?php wp_reset_query(); // Reset the Query Loop  ?>
					

                  	</ul>
           		</div>

        </div>
   	</div>
    <!-- End Body Content -->
<?php get_footer(); ?>