<?php
/* ---------------------------------------------------------------------------------------------  
File Name:  Footer  
Description: Load the footer, part of index.php 
Version: 1.0  
--------------------------------------------------------------------------------------------- 
*/
$options = wps_panel_get_options();
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <!-- Start site footer -->
    <footer class="site-footer">
       	<div class="container">
    		<div class="site-footer-top">
            	<div class="row">
                	<div class="col-md-4 widget footer_widget text_widget">
                        <h4>About our church</h4>
                        <hr class="sm">
                        <p><?php echo $options['wps_company_desc']; ?></p>
                    </div>
                	<div class="col-md-4 widget footer_widget twitter_widget">
                    	<h4>Facebook Stream</h4>
                        <hr class="sm">
                      	<div class="fb-page" data-href="https://www.facebook.com/troyinternationalchurchofgod/" data-tabs="timeline" data-height="280" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/troyinternationalchurchofgod/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/troyinternationalchurchofgod/">Troy International Church of God, 1285 E Wattles Rd, Troy, MI</a></blockquote></div>
            		</div>
                	<div class="col-md-4 widget footer_widget newsletter_widget">
                        <h4>Quick Links</h4>
                        <hr class="sm">
                      
										<li><a href="#">Member Login</a></li>
                                        <li><a href="#">Livestream</a></li>
										<li><a href="#">Contact Us</a></li>
										
									
                     
            		</div>
               	</div>
        		<!-- Quick Info -->
        		<div class="quick-info">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-clock-o"></i> Service Times</h4>
                            <p><?php echo $options["wps_service_time"]; ?></p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-map-marker"></i> Our Location</h4>
                            <p><?php echo $options["wps_contact_address"]; ?></p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-envelope"></i> Contact Info</h4>
                            <p><?php echo $options["wps_phone_number"]; ?><br><?php echo $options["wps_email_id"]; ?></p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-clock-o"></i> Socialize with us</h4>
                            <ul class="social-icons-colored inversed">
                                <li class="youtube"><a href="<?php echo $options['wps_youtube_id']; ?>"><i class="fa fa-youtube-square"></i></a></li>
                                <li class="twitter"><a href="<?php echo $options['wps_twitter_id']; ?>"><i class="fa fa-twitter"></i></a></li>
                                <li class="googleplus"><a href="<?php echo $options['wps_google_id']; ?>"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
            	</div>
        		<div class="site-footer-bottom">
            		<div class="row">
                		<div class="col-md-6 col-sm-6 copyrights-coll">
        					<?php echo $options['wps_company_copy_right']; ?></span>
            			</div>
                		<div class="col-md-6 col-sm-6 copyrights-colr">
        					<nav class="footer-nav" role="navigation">
								<?php wp_nav_menu(array('theme_location' => 'footer-menu', 'menu_class' => 'menu-footer-menu', 'container' => false)); ?> 
                        	</nav>
            			</div>
                   	</div>
               	</div>
           	</div>
        </div>
    </footer>
    <!-- End site footer -->
  	<a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>  
</div>
<!-- Event Directions Popup -->
<div class="quick-info-overlay">
	<div class="quick-info-overlay-left accent-bg">
        <a href="#" class="btn-close"><i class="icon-delete"></i></a>
    	<div class="event-info">
    		<h3 class="event-title"> </h3>
      		<div class="event-address"></div>
            <a href="" class="btn btn-default btn-transparent btn-permalink">Full details</a>
        </div>
    </div>
	<div class="quick-info-overlay-right">
      	<div id="event-directions"></div>
    </div>
</div>
<!-- Event Contact Modal Window -->
<div class="modal fade" id="Econtact" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="Econtact" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Event Manager <span class="accent-color"></span></h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="fname" class="form-control" placeholder="First name (Required)">
                </div>
                <div class="col-md-6">
                    <input type="text" name="lname" class="form-control" placeholder="Last name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Your email (Required)">
                </div>
                <div class="col-md-6">
                    <input type="number" name="phone" class="form-control" placeholder="Your phone">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea rows="3" cols="5" class="form-control" placeholder="Additional notes"></textarea>
                </div>
            </div>
            <input type="submit" name="donate" class="btn btn-primary btn-lg btn-block" value="Contact Now">
        </form>
      </div>
      <div class="modal-footer">
        <p class="small short">If you would prefer to call in for inquiries, please call 98452011454</p>
      </div>
    </div>
  </div>
</div>
<!-- Event Register Tickets -->
<div class="ticket-booking-wrapper">
    <a href="#" class="ticket-booking-close label-danger"><i class="icon icon-delete"></i></a>
    <div class="ticket-booking">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3><strong>Book your</strong> <span>Spot</span></h3>
                </div>
                <div class="col-md-9">
                    <div class="event-ticket ticket-form">
                        <div class="event-ticket-left">
                            <div class="ticket-handle"></div>
                            <div class="ticket-cuts ticket-cuts-top"></div>
                            <div class="ticket-cuts ticket-cuts-bottom"></div>
                        </div>
                        <div class="event-ticket-right">
                            <div class="event-ticket-right-inner">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9">
                                        <span class="meta-data">Your seat for</span>
                                        <h4 id="dy-event-title"></h4>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <span class="meta-data">Bookings for</span>
                                        <select class="form-control input-sm">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="event-ticket-info">
                                    <div class="row">
                                        <div class="col">
                                            <p class="ticket-col" id="dy-event-date"></p>
                                        </div>
                                        <div class="col">
                                            <a href="#" class="btn btn-warning btn btn-block ticket-col">Book</a>
                                        </div>
                                        <div class="col">
                                            <p id="dy-event-time">Starts </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="event-location" id="dy-event-location"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   	</div>
</div>
</body>
</html>