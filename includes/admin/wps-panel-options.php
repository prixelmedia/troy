<?php

/* ---------------------------------------------------------------------------------------------------

  File: wps-panel-options.php

  Here we will set the options we are going to have in the theme options panel.

  --------------------------------------------------------------------------------------------------- */

/* ---------------------------------------------------------------------------------------------------
  Declare vars
  --------------------------------------------------------------------------------------------------- */

$shortname = 'wps';
$options = array();

/* ---------------------------------------------------------------------------------------------------
  Welcome Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Welcome',
    'type' => 'open',
    'desc' => 'Welcome to the Admin Area of TroyCG Theme');

$options[] = array('type' => 'paragraph',
    'title' => 'welcome',
    'desc' =>  'Welcome to the admin area of the TroyCG theme. 
                        Use the below options to configure the theme according to your specifications. 
                        If you encounter any problems configuring this theme, please feel free to contact the author at mailto:support@prixelmedia.com ');

$options[] = array('type' => 'close',
    'title' => 'welcome');

/* ---------------------------------------------------------------------------------------------------
  Home Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Home Page',
    'type' => 'open',
    'desc' => 'Configure Options for Home Page');

$options[] = array('title' => 'Upload Logo',
    'desc' => 'Select The Image to be Displayed as Logo',
    'class' => 'upload_image',    
    'id' => 'upload_image',
    'name' => 'upload_image',
    'std' => '',
    'action' => 'upload',
    'type' => 'text');

$options[] = array('title' => 'Upload Favicon',
    'desc' => 'Select The Image to be Displayed as Favicon',
    'class' => 'upload_image',    
    'id' => 'upload_favicon',    
    'name' => 'upload_favicon',
    'action' => 'upload',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Church Name',
    'desc' => 'Your Company / Organization Name',
    'id' => $shortname . '_company_name',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Church Slogan',
    'desc' => 'Your Company Slogan.',
    'id' => $shortname . '_company_slogan',
    'std' => '',
    'type' => 'textarea');
	
$options[] = array('title' => 'Service Timings',
    'desc' => 'Your Service Timings',
    'id' => $shortname . '_service_time',
    'std' => '',
    'type' => 'textarea');

$options[] = array('title' => 'Church Description',
    'desc' => 'Your Company Description to be Displayed in Hero Container (short).',
    'id' => $shortname . '_company_desc',
    'std' => '',
    'type' => 'textarea');

$options[] = array('type' => 'divider');

$options[] = array('type' => 'paragraph',
    'title' => 'Search Engine Optimization Options',
    'desc' => 'Enter the Details Below to Optimize Your Wordpress Installation for SEO Purposes & Google Analytics Code ');

$options[] = array('title' => 'Keywords',
    'desc' => 'Enter the Desired Keywords Seperated By Commas',
    'id' => $shortname . '_company_meta_keywords',
    'std' => '',
    'type' => 'textarea');

$options[] = array('title' => 'Company Description',
    'desc' => 'Your Company Description',
    'id' => $shortname . '_company_meta_desc',
    'std' => '',
    'type' => 'textarea');

$options[] = array('title' => 'Google Analytics Code',
    'desc' => 'Copy-Paste Your Google Analytics Code (if-any)',
    'id' => $shortname . '_company_google_analytics',
    'std' => '',
    'type' => 'textarea');
	
$options[] = array('type' => 'close',
    'title' => 'HomePage');

/* ---------------------------------------------------------------------------------------------------
  Blog Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Blog',
    'type' => 'open',
    'desc' => 'Confugure Options for Blog');

$options[] = array('title' => 'Select Number of Posts',
    'desc' => 'Number of Posts to Show In A Blog Page',
    'id' => $shortname . '_num_posts_blog',
    'opts' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10',),
    'std' => '1',
    'type' => 'select');

$options[] = array('type' => 'close',
    'title' => 'Blog');


/* ---------------------------------------------------------------------------------------------------
  Contact Details  Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Contact Details',
    'type' => 'open',
    'desc' => 'Contact Details Configuration');

/*********************************************************/	
$options[] = array('type' => 'divider');
/********************************************************/	

$options[] = array('title' => 'Address Details Heading',
    'desc' => 'Heading For Address Details',
    'id' => $shortname . '_address_head',
    'std' => '',
    'type' => 'text');

	
$options[] = array('title' => 'Phone Number',
    'desc' => 'Your Company Phone Number',
    'id' => $shortname . '_phone_number',
	'class' => 'wps_locationno',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Mobile / Fax Number',
    'desc' => 'Your Company Fax / Mobile Number',
    'id' => $shortname . '_mobile_number',
	'class' => 'wps_locationno',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'e-mail Address',
    'desc' => 'Your Company Email Address',
    'id' => $shortname . '_email_id',
	'class' => 'wps_locationno',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Contact Address',
    'desc' => 'Your Contact Address',
    'id' => $shortname . '_contact_address',
	'class' => 'wps_locationno',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Google Map Latitude',
    'desc' => 'Your Company Location in Latitude',
    'id' => $shortname . '_latitude',
	'class' => 'wps_locationno',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Google Map Longitude',
    'desc' => 'Your Company Location in Lognitude',
    'id' => $shortname . '_longitude',
	'class' => 'wps_locationno',
    'std' => '',
    'type' => 'text');
	

/*********************************************************/	
$options[] = array('type' => 'divider');
/********************************************************/

/*	
$options[] = array(
	'type' => 'button',
	'class' => 'btn btn-primary',
	'value' => 'Add Another Location',
	'id'=> 'add_location');
*/	
$options[] = array(
	'type' => 'hidden',
    'id' => $shortname . '_locationno',
	);

$options[] = array('type' => 'divider');

$options[] = array('type' => 'close',
    'title' => 'Contact');

/* ---------------------------------------------------------------------------------------------------
  Footer  Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Footer',
    'type' => 'open',
    'desc' => 'Footer Options Configuration');

$options[] = array('title' => 'Copyright Info',
    'desc' => 'Enter the Copyright Inforamtion to be Displayed in Footer',
    'id' => $shortname . '_company_copy_right',
    'std' => '',
    'type' => 'textarea');

$options[] = array('type' => 'close',
    'title' => 'Footer');

/* ---------------------------------------------------------------------------------------------------
  SocialNetworks  Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Social Network',
    'type' => 'open',
    'desc' => 'Social Networking Options Configuration');

$options[] = array('title' => 'Facebook ID',
    'desc' => 'Your Facebook ID',
    'id' => $shortname . '_facebook_id',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Google+ ID',
    'desc' => 'Your Google+ ID',
    'id' => $shortname . '_google_id',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Twitter ID',
    'desc' => 'Your Twitter  ID',
    'id' => $shortname . '_twitter_id',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Dribble ID',
    'desc' => 'Your Dribble  ID',
    'id' => $shortname . '_dribble_id',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'RSS ID',
    'desc' => 'Your RSS  ID',
    'id' => $shortname . '_rss_id',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'LinkedIn ID',
    'desc' => 'Your LinkedIn ID',
    'id' => $shortname . '_linkedin_id',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'PInterest ID',
    'desc' => 'Your PInterest ID',
    'id' => $shortname . '_pinterest_id',
    'std' => '',
    'type' => 'text');


$options[] = array('type' => 'close',
    'title' => 'Social Network');

/* ---------------------------------------------------------------------------------------------------
  Mailer  Section
  --------------------------------------------------------------------------------------------------- */

$options[] = array('title' => 'Mailer',
    'type' => 'open',
    'desc' => 'Mailer Options Configuration');

	
$options[] = array('title' => 'e-mail Address to which Mails should be Sent',
    'desc' => 'e-mail Address to which Mails should be Sent',
    'id' => $shortname . '_send_mail',
    'std' => '',
    'type' => 'text');
	
$options[] = array('title' => 'Contact Us / Feedback Form e-mail Subject',
    'desc' => 'Enter the e-mail Subject For Feedback e-mails',
    'id' => $shortname . '_contact_subject',
    'std' => '',
    'type' => 'text');

$options[] = array('title' => 'Interested Plot Form e-mail Subject',
    'desc' => 'Enter the e-mail Subject For Online-Appointment e-mails',
    'id' => $shortname . '_intplot_subject',
    'std' => '',
    'type' => 'text');


$options[] = array('type' => 'close',
    'title' => 'Mailer');