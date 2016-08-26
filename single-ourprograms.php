<?php
/* ---------------------------------------------------------------------------------------------
  File Name: Single Sermon Template
  Description: Load The Default Page Template
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
                <div class="row">
                	<div class="col-md-8" id="content-col">     
                			<?php if (have_posts()) while (have_posts()) : the_post();
									$post_id = get_the_ID();
									$program_data = get_post_meta($post_id, '_ourprogram', true);
									$sermon_name = $program_data['sermon_name'];
									$sermon_video = $program_data['sermon_video'];
									$sermon_audio = $program_data['sermon_audio'];
									$sermon_author = $program_data['sermon_author'];
									$sermon_pdf = $program_data['sermon_pdf'];
                                    					$large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
                                    					$large_image = $large_image[0];				
					?>               	
                    	<a href="javascript:javascript:history.go(-1)" class="basic-link backward">Back to series</a>                    	<div class="sermon-media clearfix">
                                                	<div class="sermon-media-left sermon-links">
                                <ul class="action-buttons">
									<li class="link">
										<a rel="youtube_video" href="javascript:void(0);" data-toggle="tooltip" data-placement="right" data-original-title="Youtube Video"><i class="fa fa-youtube-play"></i></a>
									</li>
									<li class="link">
										<a rel="soundcloud_audio" href="javascript:void(0);" data-toggle="tooltip" data-placement="right" data-original-title="SoundCloud Audio"><i class="fa fa-soundcloud"></i></a>
									</li>
									<li>
										<a href="<?php echo $sermon_pdf; ?>" data-toggle="tooltip" data-placement="right" data-original-title="Download PDF"><i class="icon-cloud-download"></i></a>
									</li>                                
								</ul>
                          	</div>
								<div class="sermon-media-right">
									<div class="sermon-media-content">
                                                                    <!-- MP4 source must come first for iOS -->
																	<!-- WebM for Firefox 4 and Opera -->
																	<!-- OGG for Firefox 3 -->

										<div class="video-container fw-video sermon-tabs" id="youtube_video">
											<iframe itemprop="video" src="http://www.youtube.com/embed/<?php echo $sermon_video; ?>?wmode=transparent&autoplay=0" width="560" height="315" ></iframe>                                    
										</div>
										<div class="audio-container sermon-tabs" id="soundcloud_audio">
											<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?visual=true&url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2<?php echo $sermon_audio; ?>&show_artwork=true"></iframe>                                    
										</div>
								</div>
					<?php the_content(); ?>
													
					<!-- The edit link -->	
					<?php edit_post_link(__('(Edit)', 'troy'), '<p>', '</p>'); ?>			
                                								<div class="social-share-bar"><h4><i class="fa fa-share-alt"></i> Share</h4><ul class="social-icons-colored share-buttons-tc share-buttons-squared"><li class="share-title"></li><li class="facebook-share"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>&amp;t=<?php echo $sermon_name; ?>" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i></a></li><li class="twitter-share"><a href="https://twitter.com/intent/tweet?source=<?php echo get_permalink(); ?>&amp;text=<?php echo $sermon_name; ?>:<?php echo get_permalink(); ?>" target="_blank" title="Tweet"><i class="fa fa-twitter"></i></a></li><li class="google-share"><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank" title="Share on Google+"><i class="fa fa-google-plus"></i></a></li><li class="tumblr-share"><a href="http://www.tumblr.com/share?v=3&amp;u=<?php echo get_permalink(); ?>&amp;t=<?php echo $sermon_name; ?>&amp;s=" target="_blank" title="Post to Tumblr"><i class="fa fa-tumblr"></i></a></li><li class="pinterest-share"><a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;description=<?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?>" target="_blank" title="Pin it"><i class="fa fa-pinterest"></i></a></li><li class="reddit-share"><a href="http://www.reddit.com/submit?url=<?php echo get_permalink(); ?>&amp;title=<?php echo $sermon_name; ?>" target="_blank" title="Submit to Reddit"><i class="fa fa-reddit"></i></a></li><li class="linkedin-share"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&amp;title=<?php echo $sermon_name; ?>&amp;summary=<?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?>&amp;source=<?php echo get_permalink(); ?>" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin"></i></a></li><li class="email-share"><a href="mailto:?subject=<?php echo $sermon_name; ?>&amp;body=<?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?>:<?php echo get_permalink(); ?>" target="_blank" title="Email"><i class="fa fa-envelope"></i></a></li></ul>
            </div>                                                      	</div>
                       	</div>
								
                    </div>
                    
                                        <!-- Sidebar -->
                    <div id="sidebar-col" class="col-md-4">
                    	<div class="widget sidebar-widget widget_custom_category" id="custom_category-1"><h3 class="widgettitle">Sermon Categories</h3>
                    	<ul><li><a href="<?php $term_list = wp_get_post_terms($post->ID, 'Series', array("fields" => "all"));
                    		echo get_term_link(intval($term_list[0]->term_id), 'Series'); ?>">
                    	<?php echo $term_list[0]->name;?></a></li>
			</ul>
			</div>
			<div class="widget sidebar-widget widget_tag_cloud" id="tag_cloud-1"><h3 class="widgettitle">Sermon Tags</h3>
				<div class="tagcloud">
				<?php the_tags();?>
					<a style="font-size: 8pt;" title="1 topic" class="tag-link-17" href="http://preview.imithemes.com/adore-church-wp/?sermon-tag=anxiety">Anxiety</a>
				</div>
			</div>
<div class="widget sidebar-widget widget_sermon_speakers" id="sermon_speakers-1">
<h3 class="widgettitle">Sermon Contributers</h3>
<ul>
						<li><img src="<?php 
                            $author_id=$post->post_author;
                            echo get_avatar_url( get_the_author_meta( 'ID' ),  $author_id); ?>"><div class="people-info">
                                    	<h5 class="people-name"><a class="" href="#" data-target="#team-modal-2751" data-toggle="modal"><?php $author = get_the_author(); echo strtoupper($author); ?></a></h5>
                                    	<span class="meta-data"> Church Member </span>
                                   	</div>
                               	</li><div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="team-modal-2751" class="modal fade team-modal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 id="myModalLabel" class="modal-title">Team Members</h4>
                          </div>
                            <div class="modal-body">
                                <div class="staff-item">
                                <div class="row">
                                    <div class="col-md-5 col-sm-6">
                                    	<img sizes="(max-width: 500px) 100vw, 500px" srcset="http://preview.imithemes.com/adore-church-wp/wp-content/uploads/2015/01/staff4-300x180.jpg 300w, http://preview.imithemes.com/adore-church-wp/wp-content/uploads/2015/01/staff4.jpg 500w" alt="staff4" class="img-thumbnail wp-post-image" src="http://preview.imithemes.com/adore-church-wp/wp-content/uploads/2015/01/staff4.jpg">
                                    </div>
                                    <div class="col-md-7 col-sm-6">
                                    	<h3>Kyleigh Lam</h3>
                                    	<span class="meta-data"> Events Manager </span><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem.</p>
</div>
                                </div>
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>
					</ul>
					</div>
                    <?php endwhile; ?>	
					</div>
				</div>
         	</div>
        </div>
   	</div>


			

<?php get_footer(); ?>