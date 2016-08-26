<!DOCTYPE html>
<?php
/* ---------------------------------------------------------------------------------------------
  File Name:  Header  
  Description: Load the header, part of index.php  
  Version: 1.0 
  --------------------------------------------------------------------------------------------- */
?>
  <?php
  
  $options = wps_panel_get_options();
  
  ?>
  <html <?php language_attributes(); ?>>    
  <head>        
	  <meta charset="utf-8">
	  <title><?php bloginfo('name'); ?><?php global $page, $paged; wp_title('|', true, 'left'); ?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
	  <meta name="description" content="<?php echo $options['wps_company_meta_desc']; ?>">        
	  <meta name="keywords" content="<?php echo $options['wps_company_meta_keywords']; ?>">        
	  <!-- Serene style sheet -->        
	  <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">        
	  <!-- A2ZClinic Google Fonts -->        
	  <link href='http://fonts.googleapis.com/css?family=PT+Sans|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	  
	  <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

	  <link rel="shortcut icon" type='image/x-icon' href="<?php echo $options['upload_favicon']; ?>" />
	  <!-- Fav and touch icons -->    
	  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
	  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png"> 
	  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png"> 
	  <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">   
	  <!-- Load wp_head -->	       
	  <?php wp_head(); ?>       
	  <!-- Remove unnecessary rsd_link --> 
	  <?php remove_action('wp_head', 'rsd_link'); ?> 


  </head> 
<body class="home boxed">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body"> 
<!-- social icons -->
<!--<div class="topbar">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-6 col-sm-6">
                    <ul class="social-icons-colored">
                        <li class="facebook"><a href="http://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li class="vimeo"><a href="http://www.vimeo.com/"><i class="fa fa-vimeo-square"></i></a></li>
                        <li class="twitter"><a href="http://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                        <li class="googleplus"><a href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            	<div class="col-md-6 col-sm-6">
                	<ul class="top-navigation">
                    	<li><a href="about.html">Our Mission</a></li>
                    	<li><a href="donate.html">Donate Now</a></li>
                    	<li><a href="new-here.html">New Here?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
	<!-- social icons end -->
	<!-- Start Site Header -->
	<header class="site-header">
    	<div class="container for-navi">
        	<div class="site-logo">
            <h1>
                <a href="#">
                    <!--<span class="logo-icon"><i class="fa fa-heart"></i></span>-->
					<img src="<?php echo $options['upload_image']; ?>" width="50px" alt="<?php echo $options['wps_company_name']; ?>"/>
                    <span class="logo-text"><?php echo $options['wps_company_name']; ?></span>
                    <span class="logo-tagline"></span>
                </a>
            </h1>
            </div>
            <!-- Main Navigation -->
            <nav class="main-navigation" role="navigation">
				<?php wp_nav_menu(array('theme_location' => 'header-menu', 'container' => false, 'menu_class' => 'sf-menu sf-js-enabled', 'walker' => new twitter_bootstrap_nav_walker())); ?> 	
            </nav>       
            <a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>
    	</div>
	</header>
	<!-- End Site Header -->
    <!-- Start Hero Slider -->
