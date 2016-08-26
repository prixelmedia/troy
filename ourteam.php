<?php
/* ---------------------------------------------------------------------------------------------
  Template Name: Our Team Template
  Description: Load The Our Videos Template
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

<div role="main" class="main">
    	<div class="content full" id="content">
        	<div class="container">
            <div class="row">
            <div id="content-col" class="col-md-12">
            <h3>Church Pastors</h3>
              	<hr class="sm">
				<div class="row">
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
					'taxonomy'                 => 'Status',
					'pad_counts'               => false 

					); 
				$categories = get_categories( $args );
				?>		
				                        <?php            
											$term = get_term_by('name', 'Pastors', 'Status');
											foreach ( $categories as $cat ) {
											$posts_array = get_posts(
												array(
													'posts_per_page' => -1,
													'post_type' => 'ourteams',
													'tax_query' => array(
														array(
															'taxonomy' => 'Status',
															'field' => $term->term_id,
															'terms' => $term->term_id,
														)
													)
												)
											);
											}  
											foreach ( $posts_array as $post ) : setup_postdata( $post ); 							
											$large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'team-thumb');
											$large_image1 = $large_image[0];	
											$post_id = get_the_ID();
									$team_data = get_post_meta($post_id, '_ourteam', true);
                                    $staff_name = $team_data['staff_name'];												
                                    $staff_designation = $team_data['staff_designation'];												
                                    $staff_fb = $team_data['staff_fb'];												
                                    $staff_mail = $team_data['staff_mail'];												
                                    $staff_twitter = $team_data['staff_twitter'];												
										?>
				<div class="col-md-4 col-sm-6">
                      	<div class="grid-item staff-item format-standard">
                        	<div class="grid-item-inner" style="height: 319px;">
                                <img sizes="(max-width: 500px) 100vw, 500px" src="<?php echo $large_image1; ?>">
                          		<div class="grid-content">
                                	<div class="staff-item-name">
                            			<h5><a class="" href="#" data-target="#team-modal-<?php echo $post_id;?>" data-toggle="modal"><?php echo $staff_name; ?></a></h5>
                                        <span class="meta-data"><?php echo $staff_designation; ?> </span>
                                    </div>
                                    <ul class="social-icons-colored">
									<li class="facebook"><a target="_blank" href="<?php echo $staff_fb; ?>"><i class="fa fa-facebook"></i></a></li>
									</li>
									<li class="twitter"><a target="_blank" href="<?php echo $staff_twitter; ?>"><i class="fa fa-twitter"></i></a></li>
									<li class="email"><a href="mailto:<?php echo $staff_mail; ?>"><i class="fa fa-envelope"></i></a></li>
									</ul>
									<?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?>
                          		</div></div>
                        	</div>
                      	</div>

						
						<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="team-modal-<?php echo $post_id;?>" class="modal fade team-modal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 id="myModalLabel" class="modal-title">Church Pastor</h4>
                          </div>
                            <div class="modal-body">
                                <div class="staff-item">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6">
                                    	<img sizes="(max-width: 500px) 100vw, 500px" src="<?php echo $large_image1; ?>">
                                    </div>
                                    <div class="col-md-7 col-sm-6">
                                    	<h3><?php echo $staff_name; ?></h3>
                                    	<span class="meta-data"><?php echo $staff_designation; ?> </span><?php the_content(); ?>
</div>
                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>
					             	<?php  endforeach; wp_reset_postdata(); ?> 
					</div>
<div class="spacer-40 "> </div>
<h3>Church Officials</h3>
              	<hr class="sm"><div class="row">
				  <?php            
											$term = get_term_by('name', 'Officials', 'Status');
											foreach ( $categories as $cat ) {
											$posts_array = get_posts(
												array(
													'posts_per_page' => -1,
													'post_type' => 'ourteams',
													'tax_query' => array(
														array(
															'taxonomy' => 'Status',
															'field' => $term->term_id,
															'terms' => $term->term_id,
														)
													)
												)
											);
											}  
											foreach ( $posts_array as $post ) : setup_postdata( $post ); 							
											$large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'team-thumb');
											$large_image1 = $large_image[0];	
											$post_id = get_the_ID();
									$team_data = get_post_meta($post_id, '_ourteam', true);
                                    $staff_name = $team_data['staff_name'];												
                                    $staff_designation = $team_data['staff_designation'];												
                                    $staff_fb = $team_data['staff_fb'];												
                                    $staff_mail = $team_data['staff_mail'];												
                                    $staff_twitter = $team_data['staff_twitter'];												
										?>
				<div class="col-md-3 col-sm-6">
                      	<div class="grid-item staff-item format-standard">
                        	<div class="grid-item-inner" style="height: 288px;">
                                <img sizes="(max-width: 500px) 100vw, 500px" src="<?php echo $large_image1; ?>">
                          		<div class="grid-content">
                                	<div class="staff-item-name">
                            			<h5><a class="" href="#" data-target="#team-modal-<?php echo $post_id;?>" data-toggle="modal"><?php echo $staff_name; ?></a></h5>
                                        <span class="meta-data"><?php echo $staff_designation; ?></span>
                                    </div>
                                    <ul class="social-icons-colored">
									<li class="facebook"><a target="_blank" href="<?php echo $staff_fb; ?>"><i class="fa fa-facebook"></i></a></li>
									<li class="twitter"><a target="_blank" href="<?php echo $staff_twitter; ?>"><i class="fa fa-twitter"></i></a></li>
									<li class="email"><a href="mailto:<?php echo $staff_mail; ?>"><i class="fa fa-envelope"></i></a></li>
									</ul>
									<?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?>
                          		</div></div>
                        	</div>
                      	</div>
						<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="team-modal-<?php echo $post_id;?>" class="modal fade team-modal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 id="myModalLabel" class="modal-title">Church Officials</h4>
                          </div>
                            <div class="modal-body">
                                <div class="staff-item">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6">
                                    	<img sizes="(max-width: 500px) 100vw, 500px" src="<?php echo $large_image1; ?>">
                                    </div>
                                    <div class="col-md-7 col-sm-6">
                                    	<h3><?php echo $staff_name; ?></h3>
                                    	<span class="meta-data"><?php echo $staff_designation; ?></span><?php the_content(); ?>
</div>
                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>
					<?php  endforeach; wp_reset_postdata(); ?> 
<div class="spacer-40 "> </div>

				<div class="clearfix"></div>
				</div>
			</div>
           	</div>
     	</div>
 	</div>
		
	
<?php get_footer(); ?>