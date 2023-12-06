<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}


//    Review Insert Part Starts

$listingrow = getListing($_POST["listing_id"]);
$listing_id = $listingrow["listing_id"];
$userrow = getUserCode($_POST["listing_user_id"]);
$listing_user_id = $userrow["user_id"];
$review_user_id = $_POST["review_user_id"];

$price_rating = $_POST["price_rating"];
$customer_service_rating = $_POST["customer_service_rating"];
$staff_rating = $_POST["staff_rating"];
$overall_rating = $_POST["overall_rating"];

if(!empty($_POST["review_name"])){
    $review_name = addslashes(htmlspecialchars(strip_tags(trim($_POST["review_name"]))));
}else{
    echo '-4';
    exit();
}

if(!empty($_POST["review_email"])){
    if(validation_email($_POST["review_email"])){
        $review_email = addslashes(htmlspecialchars(strip_tags(trim($_POST["review_email"]))));
    }else{
       echo '-5';
        exit(); 
    }
}else{
    echo '-5';
    exit();
} 

if(!empty($_POST["review_mobile"])){
    if(validation_phone($_POST["review_mobile"])){
        $review_mobile = addslashes(htmlspecialchars(strip_tags(trim($_POST["review_mobile"]))));
    }else{
       echo '-6';
        exit(); 
    }
}else{
    echo '-6';
    exit();
}

$review_city = addslashes(htmlspecialchars(strip_tags(trim($_POST["review_city"]))));

if(!empty($_POST["review_message"])){
    $review_message = addslashes(htmlspecialchars(strip_tags(trim($_POST["review_message"]))));
}else{
    echo '-7';
    exit();
}

$review_status = "Active";

$new_ip = get_client_ip();

$ip_txt =  $new_ip;

$curDate = date("Y-m-d H:i:s", time());

if($listing_user_id !== 0 and $enquiry_sender_id!==0){
    if($review_email == $userrow['email_id']){
        echo '3';  // Enquiring User Id and Owner Id is Same
        exit();
    }
}

$review_qry = "INSERT INTO " . TBL . "reviews 
					(listing_id, listing_user_id, review_user_id, price_rating, customer_service_rating, staff_rating, overall_rating, review_name, review_email, review_mobile, review_city, review_message, review_status, review_cdt,ip) 
					VALUES 
					('$listing_id', '$listing_user_id', '$review_user_id','$price_rating','$customer_service_rating','$staff_rating','$overall_rating','$review_name', '$review_email', '$review_mobile', '$review_city', '$review_message','$review_status', '$curDate', '$ip_txt')";
$review_res = mysqli_query($conn,$review_qry);

if ($review_res) {
    //****************************    Admin Primary email fetch starts    *************************

    $webpage_full_link_with_login = $webpage_full_link. "login";
    
    $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
    $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
    $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
    $admin_site_name = $admin_primary_email_fetchrow['website_address'];
    $admin_address = $admin_primary_email_fetchrow['footer_address'];

    //****************************    Admin Primary email fetch ends    *************************


    $email_id = $userrow['email_id'];
    $first_name = $userrow['first_name'];

    $user_plan = $userrow['user_plan']; //Fetch of Logged In user Plan

    $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data

    $plan_type_email_notification = $user_plan_type['plan_type_email_notification'];

    $admin_email = $admin_primary_email; // Admin Email Id

    $to1 = $review_email;
    $subject1 = $admin_site_name." - ".$BIZBOOK['NEW_REVIEW'];

    $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 26"); //User mail template fetch
    $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

    $mail_template_client = $client_sql_fetch_row['mail_template'];

    $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
    $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
    $message1 = stripslashes(str_replace(array('\' . $review_name . \'', '\' . $review_email . \'', '\' . $review_mobile . \'','\' . $review_message . \'','\' . $review_city . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $url_img_datasur . \'','\' . $logo . \''),
                array('' . $review_name . '', '' . $review_email . '', '' . $review_mobile . '','' . $review_message . '','' . $review_city . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $url_img_datasur . '','' . $logo . ''), $mail_template_client));
    
    $headers1 = "From: " . "$admin_email" . "\r\n";
    $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
    $headers1 .= "MIME-Version: 1.0\r\n";
    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

    mail($to1, $subject1, $message1, $headers1); //Client email    

    if($listing_id!=""){

        $to2 = $userrow['email_id'];
        $subject2 = $admin_site_name." - ".$BIZBOOK['NEW_ENQUIRY'];

        $client_sql_fetch2 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 27"); //User mail template fetch
        $client_sql_fetch_row2 = mysqli_fetch_array($client_sql_fetch2);

        $mail_template_client2 = $client_sql_fetch_row2['mail_template'];

        $message2 = stripslashes(str_replace(array('\' . $review_name . \'', '\' . $review_email . \'', '\' . $review_mobile . \'','\' . $review_message . \'','\' . $review_city . \'','\' . $webpage_full_link_with_login . \'','\' . admin_site_name . \'','\' . $logo . \''),
                array('' . $review_name . '', '' . $review_email . '', '' . $review_mobile . '','' . $review_message . '','' . $review_city . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . ''), $mail_template_client2));

        $headers2 = "From: " . $admin_email . "\r\n";
        $headers2 .= "Reply-To: " . $admin_email . "\r\n";
        $headers2 .= "MIME-Version: 1.0\r\n";
        $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to2, $subject2, $message2, $headers2); //Client email

    }
    echo '1';
} else {
    echo '2';
}

//    Review Insert Part Ends

