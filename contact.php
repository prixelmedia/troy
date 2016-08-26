<?php
/* ---------------------------------------------------------------------------------------------
  Template Name: Contact Us Template
  Description: Load The Contact Us Template
  Version: 1.0
  --------------------------------------------------------------------------------------------- */
$options = wps_panel_get_options();
$sub_title = get_post_meta($post->ID, '_my_meta_value_key', true);
get_header();
?>
    <!-- Start Page Header -->
<div class="page-header parallax clearfix" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/images/slide7.jpg);">
    	<div id="contact-map"></div>
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
                	<div class="col-md-4 col-sm-5">
                    	<h2><?php
						if ($post->post_parent) {
							$parent_title = get_the_title($post->post_parent);
							echo $parent_title;
						} else {
							wp_title($sep = '');
						}
						?></h2>
                    	<hr class="sm">
                    	<h4 class="short accent-color"><?php echo $options['wps_company_name']; ?></h4>
                    	<p><?php echo $options["wps_contact_address"]; ?><br><?php echo $options["wps_phone_number"]; ?><br><a href="mailto:<?php echo $options["wps_email_id"]; ?>"><?php echo $options["wps_email_id"]; ?></a></p>

                   	</div>
                    <div class="col-md-8 col-sm-7">
                       	<form method="post" id="contactform" name="contactform" class="contact-form clearfix" action="mail/contact.php">
                        	<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="fname" name="First Name"  class="feedback_field form-control input-lg" placeholder="First name*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="lname" name="Last Name"  class="feedback_field form-control input-lg" placeholder="Last name">
                                    </div>
                              	</div>
                           	</div>
                        	<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email"  class="feedback_field form-control input-lg" placeholder="Email*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="phone" name="phone" class="feedback_field form-control input-lg" placeholder="Phone">
                                    </div>
                                </div>
                          	</div>
                        	<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea cols="6" rows="7" id="comments" name="comments" class="feedback_field form-control input-lg" placeholder="Message"></textarea>
                                    </div>
                                </div>
                          	</div>
                        	<div class="row">
                                <div class="col-md-12">
                                    <input id="submit" name="submit" type="submit" class="btn btn-primary btn-lg btn-block" value="Submit now!">
                                </div>
                          	</div>
                		</form>
                        <div class="clearfix"></div>
                        <div id="message"></div>
                    </div>
               	</div>
           	</div>
        </div>
   	</div>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
var address = "Troy, USA"; //Add your address here, all on one line.
var latitude;
var longitude;
var color = "#3bafda"; //Set your tint color. Needs to be a hex value.

function getGeocode() {
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
    		latitude = results[0].geometry.location.lat();
			longitude = results[0].geometry.location.lng(); 
			initGoogleMap();   
    	} 
	});
}

function initGoogleMap() {
	var styles = [
	    {
	      stylers: [
	        { saturation: -100 }
	      ]
	    }
	];
	
	var options = {
		mapTypeControlOptions: {
			mapTypeIds: ['Styled']
		},
		center: new google.maps.LatLng(latitude, longitude),
		zoom: 13,
		scrollwheel: false,
		navigationControl: false,
		mapTypeControl: false,
		zoomControl: true,
		disableDefaultUI: true,	
		mapTypeId: 'Styled'
	};
	var div = document.getElementById('contact-map');
	var map = new google.maps.Map(div, options);
	marker = new google.maps.Marker({
	    map:map,
	    draggable:false,
	    animation: google.maps.Animation.DROP,
	    position: new google.maps.LatLng(latitude,longitude)
	});
	var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
	map.mapTypes.set('Styled', styledMapType);
	
	var infowindow = new google.maps.InfoWindow({
	      content: "<div class='iwContent'>"+address+"</div>"
	});
	google.maps.event.addListener(marker, 'click', function() {
	    infowindow.open(map,marker);
	  });
	
	
	bounds = new google.maps.LatLngBounds(
	  new google.maps.LatLng(-84.999999, -179.999999), 
	  new google.maps.LatLng(84.999999, 179.999999));

	rect = new google.maps.Rectangle({
	    bounds: bounds,
	    fillColor: color,
	    fillOpacity: 0.2,
	    strokeWeight: 0,
	    map: map
	});
}
google.maps.event.addDomListener(window, 'load', getGeocode);
</script>	
    <!-- End Body Content -->
    <?php get_footer(); ?>