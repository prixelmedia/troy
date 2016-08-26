<?php
/* ---------------------------------------------------------------------------------------------
  File Name:  Comments
  Description: Get the comments from a single blogpost
  Version: 1.0
  --------------------------------------------------------------------------------------------- */


function pixellin_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    ?>
    <!-- begin #li-comment-number -->
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <!-- begin .comment-container --> 
        <div class="comment-wrapper comment-container" id="comment-<?php comment_ID(); ?>">
            <!-- begin .comment-avatar -->
            <div class="comment-avatar">
                <!-- begin .comment-author .vcard -->
                <div class="comment-author vcard">
                    <!-- get the avatar with a width height of 50px -->
                    <?php echo get_avatar($comment, 80); ?>
                    <!-- end .comment-author .vcard -->
                </div>
                <!-- end .comment-avatar -->
            </div>

            <!-- begin .comment-body -->
            <div class="comment-body">
                <!-- begin .comment-meta -->
                <div class="comment-meta commentmetadata">
                    <!-- print the author name with a link to the website -->
                    <h5 class="comment-author"><?php printf(__('%s', 'serene'), sprintf('%s', get_comment_author_link())); ?></h5>
                    <!-- begin .reply -->
                    <div class="reply-link reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => 4))); ?>
                        <!-- end reply -->
                    </div>
                </div>
                <!-- begin .comment-date -->
                <div class="date-posted comment-date">
                    <?php printf(__('%1$s', 'serene'), get_comment_date('F, dS, Y')); ?>
                    <!-- end .comment-date -->
                </div>
                <div class="time-posted comment-date">
                    <?php printf(__('%1$s', 'serene'), get_comment_time()); ?>
                    <!-- end .comment-date -->
                </div>


                <!-- begin .comment-content -->
                <div class="comment-content">
                    <!-- get the comment entry -->
                    <?php comment_text(); ?>
                    <!-- check if the comment is approved -->
                    <?php if ($comment->comment_approved == '0') : ?>
                        <!-- if not, echo an error message -->
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'serene'); ?></p>
                    <?php endif; ?>
                    <!-- insert edit link -->
                    <?php edit_comment_link(__('(Edit)', 'serene'), ' '); ?>
                    <!-- end comment-content -->
                </div>
                <!-- end comment-body -->
            </div>
            <!-- end comment-container -->	
        </div>

        <?php
    }
    ?>

    <h5 class="blog-comment-h5">Comments (<?php
    $comments = get_comments();
    echo sizeof($comments);
    ?>)</h5><hr class="blog-inner-hr"/>
   <?php if(sizeof($comments)==0){ echo '<div id="no-comments">No Comments Have Been Posted For This Article Yet! Be the First to Comment.</div>';}?>
    <!-- If comment is password protected, begin #comments -->
    <div id="comments">
        <?php if (post_password_required()) : ?>
            <p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'serene'); ?></p>
            <!-- end #comments -->
        </div>

        <?php
        return;
    endif;
    ?>

    <!-- If there are comments -->
    <?php if (have_comments()) : ?>
        <!-- Get the comment page count -->
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <!-- begin .navigation -->
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'serene')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'serene')); ?></div>
                <!-- end .navigation -->
            </div>
        <?php endif; ?>

        <div class="comments-wrapper span12">
            <div class="span9">
                <!-- begin .commentlist -->
                <ul class="commentlist">
                    <?php wp_list_comments(array('callback' => 'pixellin_comment')); ?>
                    <!-- end .commentlist -->
                </ul>
            </div>
        </div>    
        <!-- check if there are comments to navigate to trough -->
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <!-- begin .navigation -->
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'serene')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'serene')); ?></div>
                <!-- end .navigation -->
            </div>
        <?php endif; ?>

        <!-- If not, tell them that the comments are closed -->
    <?php
    else :
        if (!comments_open()) :
            ?>		
            <?php if (!is_page()) : ?>
                <p class="nocomments"><?php _e('Comments are closed.', 'serene'); ?></p>
            <?php endif; ?>
        <?php endif; ?>

<?php endif; ?>

    <!-- if the comments are open let them leave a reply-->
<?php if ('open' == $post->comment_status) : ?>
        <!-- begin #respond -->
   <h5 class="blog-comment-h5">Leave A Comment</h5><hr class="blog-inner-hr"/>  
        <div class="blog-comment-form" id="respond">       
            <!-- begin .cancel-comment-reply -->
            <div class="cancel-comment-reply">
    <?php cancel_comment_reply_link(); ?>
                <!-- end .cancel-comment-reply -->
            </div>

            <!-- if the user has to be logged in, tell them -->
            <?php if (get_option('comment_registration') && !$user_ID) : ?>
                <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>

                <!-- If not show them the commentform, begin form-->
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

                    <!-- get the userID and tell them what they are logged in as -->
        <?php if ($user_ID) : ?>
                        <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

                        <!-- if the user is not logged in yet, show them the name, email, website option -->
        <?php else : ?>
        <div class="row-fluid">
            <div class="span12">                        
                        <!-- name -->
                       <input class="comment_input" type="text" name="author" id="author" placeholder="Enter Your Name" value="<?php echo $comment_author; ?>" size="22" tabindex="1" required="required" />
                           
                        <!-- email -->
                       <input class="comment_input" type="text" name="email" id="email" placeholder="Enter Your e-mail Address" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" required="required"/>
                          
                        <!-- website -->
                       <input class="comment_input" type="text" name="url" id="url" placeholder="Enter Your Website Name" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
                           
            </div>
        </div>
        <?php endif; ?>

                    <!-- the commentarea -->
                    <div class="row-fluid">
                        <div class="span12">        
                            <textarea placeholder="Enter your message" class="comment_textarea span12" name="comment" id="comment" cols="50" rows="10" tabindex="4" required="required"></textarea>
                            <!-- the submit button -->
                            <button name="submit" id="submit" type="submit" class="btn btn-primary blue">
                                <i class="icon-checkmark-3"></i> Leave A Comment
                            </button>
                        </div>
                    </div>	
                    <?php comment_id_fields(); ?>
                    </p>
        <?php do_action('comment_form', $post->ID); ?>
                    <!-- end form -->
                </form>

    <?php endif; ?>
            <!-- end #respond -->
        </div>
<?php endif; ?>
    <!-- end #comments -->
</div>
