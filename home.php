<?php
/* ---------------------------------------------------------------------------------------------  
Template Name: Home Page  
Template  Description: Load The Home Page Template  
Version: 1.0  
--------------------------------------------------------------------------------------------- */

$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
get_header();
$options = wps_panel_get_options();
?>
	   <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
                <?php
					$wpbp = new WP_Query(array('post_type' => 'imagesliders', 'order' => 'ASC')); 
                ?>	
      	<ul class="slides">
							<?php
                                if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
                                        $large_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                                        $post_id = get_the_ID();
                                        $imageslider_data = get_post_meta($post_id, '_imageslider', true);
                                        $caption = $imageslider_data['image_caption'];
                            ?>		
        	<li class="parallax" style="background-image:url(<?php echo $large_image; ?>);"> </li>
			<?php endwhile; endif; ?>
			<?php wp_reset_query(); ?>			
      	</ul>
        <canvas id="canvas-animation"></canvas>
    </div>
    <!-- End Hero Slider -->
	
	    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
        	<div class="container">
            	<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center padding-bottom-20">
               	<h2><?php echo $sub_title; ?></h2>
              	
								<?php the_content(); ?>
                                <!-- The edit link -->	
                                <?php edit_post_link(__('(Edit)', 'troy'), '<p>', '</p>'); ?>					
                  
                
			</div>				
			</div>				

            </div>           
            
            
               <!-- Lead Content -->
   <div class="lead-content clearfix">
    	<div class="lead-content-wrapper">
    		<div class="container">
            	<div class="row">
					<?php 
					global $wp_query;
					query_posts( array ( 'category_name' => 'home-blocks', 'posts_per_page' => 5 ) );
					while (have_posts()) : the_post();
					$large_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					?>				
                    <div class="col-md-4 col-sm-4 featured-block text-center">
                        <h3><?php the_title(); ?></h3>
                        <figure>
                        	<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $large_image; ?>" alt="<?php the_title(); ?>"></a>
							<?php the_content(); ?>							
                    	</figure>

                    </div>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>	
                </div>
        	</div>
        </div>
    </div> 
            
             	<div class="container padding-top-20">
<div id="content-col" class="col-md-8 col-sm-7">
                        <div class="element-block events-listing">
                            <div class="events-listing-header">
                                                                <h3 class="element-title">Upcoming Events</h3>
                                <hr class="sm">
                            </div>
                            <div class="events-listing-content">
                                                        
															<script class="ai1ec-widget-placeholder" data-widget="ai1ec_agenda_widget" data-events_seek_type="events" data-events_per_page="7" data-days_per_page="5">
  (function(){var d=document,s=d.createElement('script'),
  i='ai1ec-script';if(d.getElementById(i))return;s.async=1;
  s.id=i;s.src='//demo.prixelmedia.com/box1/troy/?ai1ec_js_widget';
  d.getElementsByTagName('head')[0].appendChild(s);})();
</script>

							</div>
                        </div>
                    </div>



					<div class="row">
						<div class="col-md-4">
						<div class="">
                                <h3 class="element-title">Latest Sermon</h3>
                                <hr class="sm">
                        </div>
                    	<div class="widget latest_sermons_widget">
                        	<ul>
							<?php
							$queryObject = new WP_Query( 'post_type=ourprograms&posts_per_page=1' );
							while ($queryObject->have_posts()) {
									$queryObject->the_post();
									$post_id = get_the_ID();
                                    $ourprogram_data = get_post_meta($post_id, '_ourprogram', true);
                                    $sermon_video = $ourprogram_data['sermon_video'];									
                                    $sermon_name = $ourprogram_data['sermon_name'];									
							?>
                            	<li class="most-recent-sermon clearfix">
                                    <div class="latest-sermon-video fw-video">
                                       <iframe itemprop="video" src="http://www.youtube.com/embed/<?php echo $sermon_video; ?>?wmode=transparent&autoplay=0" width="500" height="281" ></iframe>
                                    </div>
                                    <div class="latest-sermon-content">
                                        <h4><a href="#"><?php echo $sermon_name; ?></a></h4>
                                        <div class="meta-data">by <a href="#"><?php $author = get_the_author(); echo strtoupper($author); ?></a></div>
                                        <?php echo balanceTags(wp_trim_words(get_the_content(), $num_words = 20, $more = null), true); ?>
                                    </div>
                                    <div class="sermon-links">
                                        <ul class="action-buttons">
                                            <li><a href="<?php the_permalink(); ?>" data-toggle="tooltip" data-placement="right" data-original-title="Watch Video"><i class="icon-video-cam"></i></a></li>
                                            <li><a href="<?php the_permalink(); ?>" data-toggle="tooltip" data-placement="right" data-original-title="Listen Audio"><i class="icon-headphones"></i></a></li>
                                            <li><a href="<?php the_permalink(); ?>" data-toggle="tooltip" data-placement="right" data-original-title="Download Audio"><i class="icon-cloud-download"></i></a></li>
                                            <li><a href="<?php the_permalink(); ?>" data-toggle="tooltip" data-placement="right" data-original-title="Download PDF"><i class="icon-download-folder"></i></a></li>
                                        </ul>
                                    </div>
                               	</li>
								    <?php
									}
									?>
                           	</ul>
                        </div>
                    </div>
					
                </div>					
			</div>				

            </div>
        </div>

    <!-- End Body Content -->
 

    <!-- Gallery updates -->
    <div class="gallery-updates cols5 clearfix">
    	<ul>
			<?php 
				$wpbp = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => '5', 'paged' => $paged)); 
				if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
				$large_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');
                $large_image = $large_image[0];
			?>
				<li class="format-image"><a href="<?php echo $large_image ?>" data-rel="prettyPhoto" class="media-box"><?php the_post_thumbnail('portfolio'); ?></a></li>
			<?php
				endwhile;
				endif;
				wp_reset_query();
			?>
      	</ul>
        <div class="gallery-updates-overlay">
        	<div class="container">
            	<i class="icon-multiple-image"></i>
                <h2>From our gallery</h2>
            </div>
        </div>
    </div>
	<script>

(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
            || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());


(function() {

    var width, height, largeHeader, canvas, ctx, circles, target, animateHeader = true;

    // Main
    initHeader();
    addListeners();

    function initHeader() {
        width = window.innerWidth;
        height = window.innerHeight - 120;
        target = {x: 0, y: height};


        canvas = document.getElementById('canvas-animation');
        canvas.width = width;
        canvas.height = height;
        ctx = canvas.getContext('2d');

        // create particles
        circles = [];
        for(var x = 0; x < width*0.5; x++) {
            var c = new Circle();
            circles.push(c);
        }
        animate();
    }

    // Event handling
    function addListeners() {
        window.addEventListener('scroll', scrollCheck);
        window.addEventListener('resize', resize);
    }


   $(window).resize(function(){
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
    });

    function animate() {
        if(animateHeader) {
            ctx.clearRect(0,0,width,height);
            for(var i in circles) {
                circles[i].draw();
            }
        }
        requestAnimationFrame(animate);
    }

    // Canvas manipulation
    function Circle() {
        var _this = this;

        // constructor
        (function() {
            _this.pos = {};
            init();
            console.log(_this);
        })();

        function init() {
            _this.pos.x = Math.random()*width;
            _this.pos.y = height+Math.random()*100;
            _this.alpha = 0.1+Math.random()*0.3;
            _this.scale = 0.1+Math.random()*0.3;
            _this.velocity = Math.random();
        }

        this.draw = function() {
            if(_this.alpha <= 0) {
                init();
            }
            _this.pos.y -= _this.velocity;
            _this.alpha -= 0.0005;
            ctx.beginPath();
            ctx.arc(_this.pos.x, _this.pos.y, _this.scale*10, 0, 2 * Math.PI, false);
            ctx.fillStyle = 'rgba(255,255,255,'+ _this.alpha+')';
            ctx.fill();
        };
    }

})();	
	</script>
	<?php get_footer(); ?>