<?php

$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
$options = wps_panel_get_options();
get_header();
							
							    global $wp_query;
							    $term = $wp_query->get_queried_object();
?>

<!-- header goes here-->	

  <!-- Start Page Header -->
    <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
    <div class="page-header parallax clearfix" style="background-image:url(<?php echo z_taxonomy_image_url($term->term_id); ?>);background-size: contain;">
        <div class="title-subtitle-holder">
        	<div class="title-subtitle-holder-inner">
    			<h2><?php
						if ($post->post_parent) {
							$parent_title = get_the_title($post->post_parent);
							echo $parent_title;
						} else {

							    $title = $term->name;
							    $desc = $term->description;
							    echo $title;								
						
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
   <?php

$args = array(
    'type'                     => 'post',
    'child_of'                 => 0,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'Series',
    'pad_counts'               => false 

    ); 
$categories = get_categories( $args );
?>
<div role="main" class="main">
    	<div class="content full" id="content">
        	<div class="container">
                <div class="row">
                	<div id="content-col" class="col-md-9 col-sm-9">
                        <span class="label label-primary">Current Series</span>                        <div class="sermon-series-description">
                    		<h2 style="text-transform:uppercase;"><?php echo $title; ?></h2>
                        	<p> <?php echo $desc; ?> </p>
 <p></p>
                        </div>
                        <ul class="sermons-list">
                        
                        <?php
                        
                        foreach ( $categories as $cat ) {


			$posts_array = get_posts(
			    array(
			        'posts_per_page' => -1,
			        'post_type' => 'ourprograms',
			        'tax_query' => array(
			            array(
			                'taxonomy' => 'Series',
			                'field' => $term->term_id,
			                'terms' => $term->term_id,
			            )
			        )
			    )
			);
			}  
			foreach ( $posts_array as $post ) : setup_postdata( $post ); 							
			$large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
			$large_image1 = $large_image[0];	
			?>
                                                	<li class="sermon-item format-standard">
                            	<div class="row">
                                	<div class="col-md-5">
                                    	<a class="media-box" href="<?php the_permalink(); ?>"><img alt="echo-hereweare" class="attachment-600x400 size-600x400 wp-post-image" src="<?php echo $large_image1; ?>"><span class="zoom"><span class="icon"><i class="icon-eye"></i></span></span></a>                                        <a class="basic-link" href="<?php the_permalink(); ?>">Watch Sermon</a>
                                    </div>
                                    <div class="col-md-7">
                                    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <span class="meta-data"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                        <p><?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?></p>                                    </div>
                                </div>
                            </li>
                            
                        	<?php  
                        	
                        	endforeach; 
				wp_reset_postdata();
                        	      ?> 

                  
                                                </ul>
                                            </div>
                                        <div id="sidebar-col" class="col-md-3 col-sm-3 sidebar">
                    	<div class="sermon-pastors sidebar-widget widget">
                        	<h3>Contributors</h3>
                            <hr class="sm">
                            <ul class="members-list">
                            <?php foreach ( $posts_array as $post ) : setup_postdata( $post ); 	?>
                            <li style="height: 150px;">
                            <img class="wp-post-image" src="<?php 
                            $author_id=$post->post_author;
                            echo get_avatar_url( get_the_author_meta( 'ID' ),  $author_id); ?>" />
                            <h5><?php $author = get_the_author(); echo strtoupper($author); ?></h5></li> 
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                                    </div>
         	</div>
        </div>
   	</div>

<?php get_footer(); ?>