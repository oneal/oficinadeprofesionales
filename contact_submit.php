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
    
    if(!empty($_POST["enquiry_message"])){
        $enquiry_message = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_message"]))));
    }else{
        echo '-7';
        exit();
    }
    
    if(!empty($_POST["theme"])){
        $theme = addslashes(htmlspecialchars(strip_tags(trim($_POST["theme"]))));
    }else{
        echo '-8';
        exit();
    }   

    $curDate = date("Y-m-d H:i:s", time());
    
    $new_ip = get_client_ip();
    
    $ip_txt =  $new_ip;

    $enquiry_qry = "INSERT INTO " . TBL . "contact 
					(name,email,phone,theme,message,date,ip) 
					VALUES 
					('$enquiry_name','$enquiry_email','$enquiry_mobile','$enquiry_message','$theme','$curDate','$ip_txt')";
    
    $enquiry_res = mysqli_query($conn,$enquiry_qry);

    $EnquiryID = mysqli_insert_id($conn);
    
    
    if ($enquiry_res) {

        
        //****************************    Admin Primary email fetch starts    *************************

        $webpage_full_link_with_login = $webpage_full_link. "login";
        
        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************


        $user_row = getUser($listing_user_id);
        $email_id = $user_row['email_id'];
        $first_name = $user_row['first_name'];

        $user_plan = $user_row['user_plan']; //Fetch of Logged In user Plan

        $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data

        $plan_type_email_notification = $user_plan_type['plan_type_email_notification'];

        $admin_email = $admin_primary_email; // Admin Email Id

        $to = $enquiry_email;
        $subject = $admin_site_name." - ".$BIZBOOK['NEW_ENQUIRY'];

        $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 22"); //User mail template fetch
        $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

        $mail_template_admin = $admin_sql_fetch_row['mail_template'];

        $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
        $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
        $message =   stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'', '\' . $theme . \'', '\' . $enquiry_message . \'', '\' . $curDate . \'', '\' . $admin_site_name . \'', '\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $url_img_datasur . \'','\' . $logo . \''),
            array('' . $enquiry_name . '', '' . $enquiry_email . '','' . $enquiry_mobile . '', '' . $theme . '', '' . $enquiry_message . '', '' . $curDate . '', '' . $admin_site_name . '','' . $webpage_full_link_with_login. '','' . $admin_site_name . '','' . $url_img_datasur . '','' . $logo . ''), $mail_template_admin));

        $headers = "From: " . "$admin_email" . "\r\n";
        $headers .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to, $subject, $message, $headers); //Client email

        $to1 = $admin_email;
        $subject1 = $admin_site_name." - ".$BIZBOOK['NEW_ENQUIRY'];

        $admin_sql_fetch1 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 23"); //User mail template fetch
        $admin_sql_fetch_row1 = mysqli_fetch_array($admin_sql_fetch1);

        $mail_template_admin1 = $admin_sql_fetch_row1['mail_template'];

        $message1 =   stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'', '\' . $theme . \'', '\' . $enquiry_message . \'', '\' . $curDate . \'', '\' . $admin_site_name . \'', '\' . $webpage_full_link_with_login . \'','\' . admin_site_name . \'','\' . $logo . \''),
            array('' . $enquiry_name . '', '' . $enquiry_email . '','' . $enquiry_mobile . '', '' . $theme . '', '' . $enquiry_message . '', '' . $curDate . '', '' . $admin_site_name . '','' . $webpage_full_link_with_login. '','' . $admin_site_name . '','' . $logo . ''), $mail_template_admin1));


        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


        mail($to1, $subject1, $message1, $headers1); //Client email

            
        //****************************    client email ends    *************************
            
        echo '1';

    }
}else {

    header('Location: index');
    exit;
}

//    Enquiry Insert Part Ends

