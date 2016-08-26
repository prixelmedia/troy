<?php
/* ---------------------------------------------------------------------------------------------
  Template Name: Sermons Template
  Description: Load The Our Services Template
  Version: 1.0
  --------------------------------------------------------------------------------------------- */
$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
$options = wps_panel_get_options();
get_header();
?>

<!-- header goes here-->	

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
	<div role="main" class="main">
    	<div class="content full" id="content">
        	<div class="container">
                <div class="row">
					<div id="content-col" class="col-md-12 col-sm-12">
                    <ul class="isotope-grid isotope">
						<div class="row">
							<?php
								$paged = get_query_var('paged') ? get_query_var('paged') : 1;  
								if($_GET['type']==null||$_GET['type']==""){
									$type = "";
								}
								else{$type = $_GET['type'];
								}
								$wpbp = new WP_Query(array('post_type' => 'ourprograms', 'posts_per_page' => '9', 'orderby' => 'title', 'order' => 'ASC', 'type' => $type, 'paged' => $paged));
								$count_post = wp_count_posts( 'ourprograms' )->publish;
								$limit = ceil($count_post/3);

								$args = array(
									'parent' => 0
								); 
								$terms = get_terms('Series', $args);

								$count = count($terms);
								$i = 0;
								if ($count > 0) {
                                foreach ($terms as $term) {
                                    $i++;
									
									?>
                              <li class="col-md-4 col-sm-6 sermon-item grid-item format-standard isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">
								<div class="grid-item-inner">
									<a class="media-box" href="">
										<img src="<?php echo z_taxonomy_image_url($term->term_id); ?>" />
									<span class="zoom"><span class="icon"><i class="icon-eye"></i></span></span></a>
									<div class="grid-content">
										<span class="sermon-series-date">Current Series</span>                                	
										<h3><a href="<?php echo get_term_link($term->slug, 'Series'); ?>"><?php echo strtoupper($termchild->name); ?></a></h3>
										<p><?php echo term_description( $term->term_id, 'Series' ) ?></p>
										<a class="btn btn-primary" href="<?php echo get_term_link($term->slug, 'Series'); ?>">View series <i class="fa fa-chevron-right"></i></a>
									</div>
								</div> 
								</li>									
									
									<?

                                   
                                }
                                echo $term_list;
                            }
                            ?>	                                           
							</div>
						</ul>
					</div>
				</div>
         	</div>
        </div>
   	</div>
    <!-- End Body Content -->
	
<?php get_footer(); ?>