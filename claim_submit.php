<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
//    Claim Insert Part Starts

    $service_name = $_POST["service_name"];
    $service_price = $_POST["service_price"];

    
    $listing_row = getListing($_POST["listing_id"]);
    $listing_id = $listing_row['listing_id'];
    $listing_name = $listing_row['listing_name'];

    $user_row = getUserCode($_POST["listing_user_id"]);
    
    $user_id = $user_row['user_id'];

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

//    $payment_status = "Pending";

//    if($listing_user_id == $enquiry_sender_id){
//
//        echo '3';  // Enquiring User Id and Owner Id is Same
//        exit();
//    }

    $user_email_id = $user_row['email_id'];
    $first_name = $user_row['first_name'];
    $password = $user_row['password'];
    
    $curDate = date("Y-m-d H:i:s", time());

    if($user_email_id != $enquiry_email){

        //****************************    Admin Primary email fetch starts    *************************

        $webpage_full_link_with_login = $webpage_full_link. "login";
        
        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        $admin_email = $admin_primary_email; // Admin Email Id


//****************************    Client email starts    *************************

        $to1 = $enquiry_email;
        $subject1 = $admin_site_name." - ".$BIZBOOK['CLAIM_THIS_BUSINESS'];
        
        $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 38"); //User mail template fetch
        $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
        
        $mail_template_client = $client_sql_fetch_row['mail_template'];
        
        $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
        $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
        $message1 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_message . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $url_img_datasur . \'','\' . $logo . \'','\' . $listing_name . \''),
                    array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_message . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $url_img_datasur . '','' . $logo . '','' . $listing_name . ''), $mail_template_client));

        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to1, $subject1, $message1, $headers1); //Client email
        
        if($listing_id !== 0){

            $to2 = $user_row['email_id'];
            $subject2 = $admin_site_name." - ".$BIZBOOK['CLAIM_THIS_BUSINESS'];

            $client_sql_fetch2 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 39"); //User mail template fetch
            $client_sql_fetch_row2 = mysqli_fetch_array($client_sql_fetch2);

            $mail_template_client2 = $client_sql_fetch_row2['mail_template'];

            $message2 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_message . \'','\' . $webpage_full_link_with_login . \'','\' . admin_site_name . \'','\' . $logo . \'','\' . $listing_name . \''),
                    array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_message . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $listing_name . ''), $mail_template_client2));

            $headers2 = "From: " . $admin_email . "\r\n";
            $headers2 .= "Reply-To: " . $admin_email . "\r\n";
            $headers2 .= "MIME-Version: 1.0\r\n";
            $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

            mail($to2, $subject2, $message2, $headers2); //Client email
        }
        
        $enquiry_qry = "INSERT INTO " . TBL . "claim_listings 
                        (listing_id,enquiry_name, enquiry_email, enquiry_mobile,enquiry_message,claim_cdt,listing_user_id) 
                        VALUES 
                        ('$listing_id','$enquiry_name', '$enquiry_email', '$enquiry_mobile','$enquiry_message','$curDate','$user_id')";

        $enquiry_res = mysqli_query($conn,$enquiry_qry);

        $EnquiryID = mysqli_insert_id($conn);
    }else{
        echo '3';
        exit();
    }    


    if ($enquiry_res) {
        if ($service_name == NULL) {
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

