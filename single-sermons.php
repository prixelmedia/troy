<?php
/* ---------------------------------------------------------------------------------------------

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
               	<h2><?php echo $sub_title; ?></h2>
              	<hr class="sm">
	<div class="row-fluid hero-content">
                    <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                            <?php
                            $large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
                            $large_image = $large_image[0];
                            ?>  
        <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && !is_page()) : ?>    
            <?php $cls = 6; ?>
                                <div class="span6 pull-right">                                           

                                    <img src="<?php echo $large_image ?>" class="featured-image" />

                                </div>
                            <?php else : ?>
            <?php $cls = 12; ?>
        <?php endif; ?>
                             <div class="span<?php echo $cls; ?>">
                               
								<p>
                                <?php the_content(); ?>
								</p>
                                <!-- The edit link -->	
                                <?php edit_post_link(__('(Edit)', 'a2zdental'), '<p>', '</p>'); ?>						

    <?php endwhile; ?>

                    </div>					

	</div>
						
            </div>
        </div>
   	</div>
    <!-- End Body Content -->


			

<?php get_footer(); ?>