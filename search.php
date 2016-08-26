<?php 
/* ---------------------------------------------------------------------------------------------
  File Name: Search Results Template
  Description: Load The Search Results Template
  Version: 1.0
  --------------------------------------------------------------------------------------------- */
$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
$options = wps_panel_get_options();
get_header();
?>

<!-- header goes here-->	
			<div class="container listings">
			
				<h4><span><i class="icon-home-3 "></i></span> 				
					<?php
						if ($post->post_parent) {
							$parent_title = get_the_title($post->post_parent);
							echo $parent_title;
						} else {
							wp_title($sep = '');
						}
					?></h4>
				<div class="row-fluid bread-crumbs">
					<?php get_breadcrumbs(); ?>
				</div>
				<?php get_search_form(); ?>
			</div>

			<div class="container listings">

				
	
                    <?php if (have_posts()) : ?>
					<div class="row-fluid">
						<h5><span><i class="icon-search-2"></i></span> <?php _e('Search Results for: ', 'your-theme'); ?><?php the_search_query(); ?></h5>
					</div>					

                        <?php
                        global $wp_query;
                        $total_pages = $wp_query->max_num_pages;
                        if ($total_pages > 1) {
                            ?>
                            <div id="nav-above" class="navigation">
                                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'your-theme')) ?></div>
                                <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'your-theme')) ?></div>
                            </div><!-- #nav-above -->
                            <?php } ?>                           
                        <div class="search-results">
    <?php while (have_posts()) : the_post() ?>

                                <div class="search-result span6" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permalink to %s', 'your-theme'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

        <?php if ($post->post_type == 'post') { ?>          
            <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID, 'thumbnail')); ?>
                                        <img src="<?php echo $url ?>" />                                    

                                        <div class="entry-meta">
                                            <span class="meta-prep meta-prep-author"><?php _e('By ', 'your-theme'); ?></span>
                                            <span class="author vcard"><a class="url fn n" href="<?php echo get_author_link(false, $authordata->ID, $authordata->user_nicename); ?>" title="<?php printf(__('View all posts by %s', 'your-theme'), $authordata->display_name); ?>"><?php the_author(); ?></a></span>
                                            <span class="meta-sep"> | </span>
                                            <span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'your-theme'); ?></span>
                                            <span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time(get_option('date_format')); ?></abbr></span>
                                        <?php edit_post_link(__('Edit', 'your-theme'), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t") ?>
                                        </div><!-- .entry-meta -->
                                        <?php } ?>

                                    <div class="entry-summary">  
        <?php the_excerpt(__('Continue reading <span class="meta-nav">&raquo;</span>', 'your-theme')); ?>
                                    <?php wp_link_pages('before=<div class="page-link">' . __('Pages:', 'your-theme') . '&after=</div>') ?>
                                    </div><!-- .entry-summary -->

        <?php if ($post->post_type == 'post') { ?>                                  
                                        <div class="entry-utility">
                                            <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e('Posted in ', 'your-theme'); ?></span><?php echo get_the_category_list(', '); ?></span>
                                            <span class="meta-sep"> | </span>
                                            <?php the_tags('<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', 'your-theme') . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\">|</span>\n") ?>
                                            <span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'your-theme'), __('1 Comment', 'your-theme'), __('% Comments', 'your-theme')) ?></span>
                                        <?php edit_post_link(__('Edit', 'your-theme'), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n") ?>
                                        </div><!-- #entry-utility -->  
                                <?php } ?>                   
                                </div><!-- #post-<?php the_ID(); ?> -->

                        <?php endwhile; ?>
                        </div>

                        <?php
                        global $wp_query;
                        $total_pages = $wp_query->max_num_pages;
                        if ($total_pages > 1) {
                            ?>
                            <div id="nav-below" class="navigation">
                                <div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'your-theme')) ?></div>
                                <div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'your-theme')) ?></div>
                            </div><!-- #nav-below -->
    <?php } ?>           

<?php else : ?>
					<div class="row-fluid">
						<h5><span><i class="icon-search-2"></i></span> <?php _e('Search Results for: '); ?></h5>
					</div>	
                        <div id="post-0" class=" row-fluid padding20 post no-results not-found">
                            <h2 class="entry-title text-center"><?php _e('Nothing Found', 'your-theme') ?></h2>
                            <div class="entry-content row-fluid text-center">
                                <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'your-theme'); ?></p>                   
                            </div><!-- .entry-content -->
                        </div>

                <?php endif; ?>   				
                </div>                                  
            </div>	
	
	
	
	
	
	
	
	
	
	
	
	</div>
</div>
</section>

</div>
<?php get_footer(); ?>