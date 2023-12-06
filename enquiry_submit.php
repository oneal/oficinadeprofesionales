<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
//    Enquiry Insert Part Starts
    
    $service_name = addslashes(htmlspecialchars(strip_tags(trim($_POST["service_name"]))));
    $service_price = addslashes(htmlspecialchars(strip_tags(trim($_POST["service_price"]))));

    //if($_POST["listing_id"] !== 0){
        $listingrow = getListing($_POST["listing_id"]);
        $listing_id = $listingrow['listing_id'];
    //}else{
    //    $listing_id = $_POST["listing_id"];
    //}
        
    $event_id = $_POST["event_id"];
    $blog_id = $_POST["blog_id"];
    $product_id = $_POST["product_id"];
    
    //if($_POST["listing_user_id"] !== 0){
        $userrow = getUserCode($_POST["listing_user_id"]);
        $listing_user_id = $userrow['user_id'];
    //}else{
    //    $listing_user_id = $_POST["listing_user_id"];
    //}
    
    $enquiry_sender_id = $_POST["enquiry_sender_id"];

    if(!empty($_POST["enquiry_name"])){
        $enquiry_name = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_name"]))));
    }else{
        echo '-4';
        exit();
    }
    if(!empty($_POST["enquiry_email"])){
        if(validation_email($_POST["enquiry_email"])){
            $enquiry_email = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_email"]))));
        }else{
           echo '-5';
            exit(); 
        }
    }else{
        echo '-5';
        exit();
    }        
    
    if(!empty($_POST["enquiry_mobile"])){
        if(validation_phone($_POST["enquiry_mobile"])){
            $enquiry_mobile = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_mobile"]))));
        }else{
           echo '-6';
            exit(); 
        }
    }else{
        echo '-6';
        exit();
    }   
    $appointment_date = addslashes(htmlspecialchars(strip_tags(trim($_POST["appointment_date"]))));
    $appointment_time = addslashes(htmlspecialchars(strip_tags(trim($_POST["appointment_time"]))));
    
    if(!empty($_POST["enquiry_message"])){
        $enquiry_message = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_message"]))));
    }else{
        echo '-7';
        exit();
    }  
    
    $enquiry_source = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_source"]))));
    
    $enquiry_category = 0;
    if(!empty($_POST['enquiry_category'])){
        $enquiry_category = $_POST['enquiry_category'];
    }

    $new_ip = get_client_ip();
    
    $ip_txt =  $new_ip;
    
    $payment_status = "Pending";
    
    if($listing_user_id !== 0 and $enquiry_sender_id!==0){
        if($enquiry_email == $userrow['email_id']){
            echo '3';  // Enquiring User Id and Owner Id is Same
            exit();
        }
    }

    $curDate = date("Y-m-d H:i:s", time());

    $enquiry_qry = "INSERT INTO " . TBL . "enquiries 
					(listing_id,event_id,blog_id,product_id,listing_user_id,enquiry_sender_id,enquiry_source,enquiry_name, enquiry_email, enquiry_mobile, appointment_date,appointment_time,enquiry_message, enquiry_category, service_name, service_price, payment_status, enquiry_cdt,ip) 
                                        VALUES 
					('$listing_id','$event_id','$blog_id', '$product_id', '$listing_user_id', '$enquiry_sender_id', '$enquiry_source','$enquiry_name', '$enquiry_email', '$enquiry_mobile', '$appointment_date', '$appointment_time', '$enquiry_message', '$enquiry_category', '$service_name', '$service_price', '$payment_status', '$curDate','$ip_txt')";
    
    
    
    $enquiry_res = mysqli_query($conn,$enquiry_qry);

    $EnquiryID = mysqli_insert_id($conn);
    
    if ($enquiry_res) {
        if ($service_name == NULL) {

            //****************************    Admin Primary email fetch starts    *************************

            $webpage_full_link_with_login = $webpage_full_link. "login";
            
            $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
            $admin_address = $admin_primary_email_fetchrow['footer_address'];

            //****************************    Admin Primary email fetch ends    *************************

//            $user_row = getUser($listing_user_id);
//            $email_id = $user_row['email_id'];
//            $first_name = $user_row['first_name'];
//
//            $user_plan = $user_row['user_plan']; //Fetch of Logged In user Plan
//
//            $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data
//
//            $plan_type_email_notification = $user_plan_type['plan_type_email_notification'];
            
            $admin_email = $admin_primary_email; // Admin Email Id

            $to1 = $enquiry_email;
            $subject1 = $admin_site_name." - ".$BIZBOOK['NEW_ENQUIRY'];
            
            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 24"); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
            $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
            $message1 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_source . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $url_img_datasur . \'','\' . $logo . \''),
                    array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_message . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $url_img_datasur . '','' . $logo . ''), $mail_template_client));

            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

            //if($plan_type_email_notification == 1) {
                mail($to1, $subject1, $message1, $headers1); //Client email
            //}

            if($listing_id !== 0){
                
                $to2 = $userrow['email_id'];
                $subject2 = $admin_site_name." - ".$BIZBOOK['NEW_ENQUIRY'];

                $client_sql_fetch2 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 25"); //User mail template fetch
                $client_sql_fetch_row2 = mysqli_fetch_array($client_sql_fetch2);

                $mail_template_client2 = $client_sql_fetch_row2['mail_template'];
                
                $message2 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_source . \'','\' . $webpage_full_link_with_login . \'','\' . admin_site_name . \'','\' . $logo . \''),
                        array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_message . '','' . $webpage_full_link_with_login .'','' . $admin_site_name . '','' . $logo . ''), $mail_template_client2));

                $headers2 = "From: " . $admin_email . "\r\n";
                $headers2 .= "Reply-To: " . $admin_email . "\r\n";
                $headers2 .= "MIME-Version: 1.0\r\n";
                $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

                //if($plan_type_email_notification == 1) {
                    mail($to2, $subject2, $message2, $headers2); //Client email
                //}
            } else {
                $to2 = $admin_email;
                $subject2 = $admin_site_name." - ".$BIZBOOK['NEW_ENQUIRY'];

                $client_sql_fetch2 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 25"); //User mail template fetch
                $client_sql_fetch_row2 = mysqli_fetch_array($client_sql_fetch2);

                $mail_template_client2 = $client_sql_fetch_row2['mail_template'];
                
                $message2 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_source . \'','\' . $webpage_full_link_with_login . \''),
                        array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_source . '','' . $webpage_full_link_with_login .''), $mail_template_client2));

                $headers2 = "From: " . $admin_email . "\r\n";
                $headers2 .= "Reply-To: " . $admin_email . "\r\n";
                $headers2 .= "MIME-Version: 1.0\r\n";
                $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

                //if($plan_type_email_notification == 1) {
                    mail($to2, $subject2, $message2, $headers2); //Client email
                //}
            }

//****************************    client email ends    *************************
            
            echo '1';

        } else {
            echo $EnquiryID;
        }

    } else {
        echo '2';
    }
}else {

    header('Location: index');
    exit;
}

//    Enquiry Insert Part Ends

