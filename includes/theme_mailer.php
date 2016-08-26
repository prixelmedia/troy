<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('wp_ajax_mail_before_submit', 'send_AJAX_mail_before_submit');

//for non-logged-in users

add_action('wp_ajax_nopriv_mail_before_submit', 'send_AJAX_mail_before_submit');

function send_AJAX_mail_before_submit(){

    $to = get_option(wps_send_mail);
    check_ajax_referer('my_email_ajax_nonce');
    if (isset($_POST['action']) && $_POST['action'] =="mail_before_submit"){
        if($_POST['formtype']=="showInterest"){
            $email_sub = get_option(wps_contact_subject);
            $subject = $email_sub."-Date-".date("d-m-Y");
            $message = $_POST['profile']."/n".$_POST['consultDetails'];
            wp_mail($to,$subject,$message);
            echo 'success';
            die();
        }
		elseif ($_POST['formtype']=="feedbackreport") {

            $email_sub = get_option(wps_onlinecons_subject);
            $subject = $email_sub."-Date-".date("d-m-Y");
            $message = $_POST['info'];
            wp_mail($to,$subject,$message);
            echo 'success';
            die();          
         }           
        
    }
    echo 'error';
    die();
}
?>
