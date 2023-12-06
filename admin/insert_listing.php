<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['listing_submit'])) {

        // Basic Personal Details
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $mobile_number = $_POST["mobile_number"];
        $email_id = $_POST["email_id"];

        $curDate = date("Y-m-d H:i:s", time());

        $register_mode = "Direct";
        //$user_status = "Inactive";

        // Common Listing Details
        $listing_name = $_POST["listing_name"];
        $listing_mobile = $_POST["listing_mobile"];
        $listing_email = $_POST["listing_email"];
        $listing_website = $_POST["listing_website"];
        $listing_address = $_POST["listing_address"];
        $listing_lat = $_POST["listing_lat"];
        $listing_lng = $_POST["listing_lng"];
        $listing_description = $_POST["listing_description"];
        $listing_type_id = 1;
        
        $state_id = $_POST["state_id"];
        $service_locations = $_POST["service_locations"];

        $country_id = "1";

        $city_id = $_POST["city_id"];
        
//        $prefix = $fruitList = '';
//        foreach ($city_id1 as $fruit)
//        {
//            $city_id .= $prefix .  $fruit ;
//            $prefix = ',';
//        }

//        $cities = "SELECT * FROM " . TBL . "cities WHERE city_name='$city_id1'";
//        $rs_cities = mysqli_query($conn,$cities);
//
//        if(mysqli_num_rows($rs_cities)>0) {
//            $cities_row = mysqli_fetch_array($rs_cities);
//
//            $city_id = $cities_row['city_id'];
//        }else{
//            $city_id = 10519;
//        }
        
        $category_id = $_POST["category_id"];
//        $category_id123 = $_POST["category_id"];
//
//        $prefix = $fruitList = '';
//        foreach ($category_id123 as $fruit)
//        {
//            $category_id .= $prefix .  $fruit ;
//            $prefix = ',';
//        }

        $sub_category_id = "";
//        $sub_category_id123 = $_POST["sub_category_id"];
//
//        $prefix = $fruitList = '';
//        foreach ($sub_category_id123 as $fruit)
//        {
//            $sub_category_id .= $prefix .  $fruit ;
//            $prefix = ',';
//        }

        $service_id123 = $_POST["service_id"];

        $prefix1 = $fruitList = '';
        foreach ($service_id123 as $fruit1)
        {
            $service_id .= $prefix1 .  $fruit1 ;
            $prefix1 = '|';
        }

// Listing Timing Details
        $opening_days = $_POST["opening_days"];
        $opening_time = $_POST["opening_time"];
        $closing_time = $_POST["closing_time"];

// Listing Social Link Details
        $fb_link = $_POST["fb_link"];
        $gplus_link = $_POST["gplus_link"];
        $twitter_link = $_POST["twitter_link"];

// Listing Location Details
        $google_map = $_POST["google_map"];
        $threesixty_view = $_POST["360_view"];

        // Listing Video
        $listing_video123 = $_POST["listing_video"];

        $prefix6 = $fruitList = '';
        foreach ($listing_video123 as $fruit6)
        {
            $listing_video1 = $prefix6 .  $fruit6 ;
            $listing_video .= addslashes($listing_video1);
            $prefix6 = ',';
        }

// Listing Service Names Details

        $service_1_name123 = $_POST["service_1_name"];

        $prefix1 = $fruitList = '';
        foreach ($service_1_name123 as $fruit1)
        {
            $service_1_name .= $prefix1 .  $fruit1 ;
            $prefix1 = '|';
        }

//        $service_2_name = $_POST["service_2_name"];
//        $service_3_name = $_POST["service_3_name"];
//        $service_4_name = $_POST["service_4_name"];
//        $service_5_name = $_POST["service_5_name"];
//        $service_6_name = $_POST["service_6_name"];

// Listing Offer Prices Details
        $service_1_price123 = $_POST["service_1_price"];

        $prefix1 = $fruitList = '';
        foreach ($service_1_price123 as $fruit1)
        {
            $service_1_price .= $prefix1 .  $fruit1 ;
            $prefix1 = '|';
        }
        
        $service_2_price = 0;
        $service_3_price = 0;
        $service_4_price = 0;
        $service_5_price = 0;
        $service_6_price = 0;

// Listing Offer Details
        $service_1_detail123 = $_POST["service_1_detail"];
        $prefix1 = $fruitList = '';
        foreach ($service_1_detail123 as $fruit1)
        {
            $service_1_detail1 .= $prefix1 .  $fruit1 ;
            $service_1_detail .= addslashes($service_1_detail1);
            $prefix1 = '|';
        }
        
        

 // Listing Offer View more link
        $service_1_view_more123 = $_POST["service_1_view_more"];
        $prefix1 = $fruitList = '';
        foreach ($service_1_view_more123 as $fruit1)
        {
            $service_1_view_more .= $prefix1 .  $fruit1 ;
            $prefix1 = '|';
        }


//        $service_2_detail = $_POST["service_2_detail"];
//        $service_3_detail = $_POST["service_3_detail"];
//        $service_4_detail = $_POST["service_4_detail"];
//        $service_5_detail = $_POST["service_5_detail"];
//        $service_6_detail = $_POST["service_6_detail"];

//Listing Other Informations
        $listing_info_question123 = $_POST["listing_info_question"];
        
        $prefix1 = $fruitList = '';
        foreach ($listing_info_question123 as $fruit1)
        {
            if($fuit!=""){
                $listing_info_question .= $prefix1 .  $fruit1 ;
                $prefix1 = '|';
            }
        }

        $listing_info_answer123 = $_POST["listing_info_answer"];
        $prefix1 = $fruitList = '';
        foreach ($listing_info_answer123 as $fruit1)
        {
            if($fuit!=""){
                $listing_info_answer .= $prefix1 .  $fruit1 ;
                $prefix1 = '|';
            }
        }

        // Listing Status
         $listing_status = "Active";
        // $listing_status = "Pending";
        // $payment_status = "Pending";

        $listing_slug = generar_texto_amigable($listing_name);
        $listing_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "listings  WHERE listing_slug='" . $listing_slug . "' ");

        if (mysqli_num_rows($listing_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-new-listings-start.php');
            exit;
        }

//    Condition to get User Id starts

        if (isset($_POST['user_code']) && !empty($_POST['user_code'])) {
            $user_code = $_POST['user_code'];
            $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_code='" . $user_code . "'");
            $user_details_row = mysqli_fetch_array($user_details);

            $user_id = $user_details_row['user_id'];  //User Id

            if($user_details_row['user_status'] == 'Active'){
                // Listing Status
                $listing_status = "Active";
            }else{
                // Listing Status
                $listing_status = "Inactive";
            }

        } else {

//            $user_status = "Inactive";
//
//            $qry = "INSERT INTO " . TBL . "users 
//					(first_name, last_name, email_id, mobile_number, register_mode, user_status, user_cdt) 
//					VALUES ('$first_name', '$last_name', '$email_id', '$mobile_number','$register_mode', '$user_status', '$curDate')";
//
//            $res = mysqli_query($conn,$qry);
//            $LID = mysqli_insert_id($conn);
//            $lastID = $LID;
//
//            switch (strlen($LID)) {
//                case 1:
//                    $LID = '00' . $LID;
//                    break;
//                case 2:
//                    $LID = '0' . $LID;
//                    break;
//                default:
//                    $LID = $LID;
//                    break;
//            }
//
//            $userID = 'USER' . substr(sha1(time()), 0, 10);
//
//            $upqry = "UPDATE " . TBL . "users 
//					  SET user_code = '$userID' 
//					  WHERE user_id = $lastID";
//
//            //echo $upqry; die();
//            $upres = mysqli_query($conn,$upqry);
//
//            $user_id = $lastID; //User Id
//
//            // Listing Status
//            $listing_status = "Inactive";


        }
//    Condition to get User Id Ends

//************************  Profile Image Upload starts  **************************
        
        if (!empty($_FILES['profile_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['profile_image']['name']);
            $file_loc = $_FILES['profile_image']['tmp_name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_type = $_FILES['profile_image']['type'];
            $folder = "../images/listings/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $profile_image = $event_image;
        }
//************************  Profile Image Upload Ends  **************************

//************************  Cover Image Upload starts  **************************
        
        if (!empty($_FILES['cover_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['cover_image']['name']);
            $file_loc = $_FILES['cover_image']['tmp_name'];
            $file_size = $_FILES['cover_image']['size'];
            $file_type = $_FILES['cover_image']['type'];
            $folder = "../images/listing-ban/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $cover_image = $event_image;
        }

//************************  Cover Image Upload ends  **************************
        
// ************************  Gallery Image Upload starts  **************************   


        for ($k = 0; $k<=count($_FILES['gallery_image']['name']); $k++) {
            if (!empty($_FILES['gallery_image']['name'][$k])) {
                $file = generar_texto_amigable_img($_FILES['gallery_image']['name'][$k]);
                $file_loc = $_FILES['gallery_image']['tmp_name'][$k];
                $file_size = $_FILES['gallery_image']['size'][$k];
                $file_type = $_FILES['gallery_image']['type'][$k];
                $folder = "../images/listings/";
                $new_size = $file_size / 1024;
                $event_image = $file;
                move_uploaded_file($file_loc, $folder . $event_image);
                $gallery_image1[$k] = $event_image;
            }else{
                $gallery_image1[$k] = "0";
            }
        }

        $array_gallery_image = $gallery_image1;

        $gallery_image = implode(",",$array_gallery_image);

// ************************  Gallery Image Upload ends  **************************   
        
// ************************  Service Image Upload starts  ************************** 


        for ($k = 0; $k<=count($_FILES['service_image']['name']); $k++) {
            if (!empty($_FILES['service_image']['name'][$k])) {
                $file = generar_texto_amigable_img($_FILES['service_image']['name'][$k]);
                $file_loc = $_FILES['service_image']['tmp_name'][$k];
                $file_size = $_FILES['service_image']['size'][$k];
                $file_type = $_FILES['service_image']['type'][$k];
                $folder = "../images/services/";
                $new_size = $file_size / 1024;
                $event_image = $file;
                move_uploaded_file($file_loc, $folder . $event_image);
                $service_image1[$k] = $event_image;
            }else{
                $service_image1[$k] = "0";
            }
        }
        
        $array_service_img = $service_image1;

        $service_image = implode(",",$array_service_img);
        
// ************************  Service Image Upload ends  **************************

// ************************  Offer Image Upload Starts  **************************


        for ($k = 0; $k<=count($_FILES['service_1_image']['name']); $k++) {
            if (!empty($_FILES['service_1_image']['name'][$k])) {
                $file = generar_texto_amigable_img($_FILES['service_1_image']['name'][$k]);
                $file_loc = $_FILES['service_1_image']['tmp_name'][$k];
                $file_size = $_FILES['service_1_image']['size'][$k];
                $file_type = $_FILES['service_1_image']['type'][$k];
                $folder = "../images/services/";
                $new_size = $file_size / 1024;
                $event_image = $file;
                move_uploaded_file($file_loc, $folder . $event_image);
                $service_1_image1[$k] = $event_image;
            }else{
                $service_1_image1[$k] = "0";
            }
        }

        $array_service_1_img = $service_1_image1;

        $service_1_image = implode(",",$array_service_1_img);
// ************************  Offer Image Upload ends  **************************

//        if (!empty($_FILES['service_3_image']['name'])) {
//            $file = rand(1000, 100000) . $_FILES['service_3_image']['name'];
//            $file_loc = $_FILES['service_3_image']['tmp_name'];
//            $file_size = $_FILES['service_3_image']['size'];
//            $file_type = $_FILES['service_3_image']['type'];
//            $folder = "../images/services/";
//            $new_size = $file_size / 1024;
//            $new_file_name = strtolower($file);
//            $event_image = str_replace(' ', '-', $new_file_name);
//            move_uploaded_file($file_loc, $folder . $event_image);
//            $service_3_image = $event_image;
//        }
//
//        if (!empty($_FILES['service_4_image']['name'])) {
//            $file = rand(1000, 100000) . $_FILES['service_4_image']['name'];
//            $file_loc = $_FILES['service_4_image']['tmp_name'];
//            $file_size = $_FILES['service_4_image']['size'];
//            $file_type = $_FILES['service_4_image']['type'];
//            $folder = "../images/services/";
//            $new_size = $file_size / 1024;
//            $new_file_name = strtolower($file);
//            $event_image = str_replace(' ', '-', $new_file_name);
//            move_uploaded_file($file_loc, $folder . $event_image);
//            $service_4_image = $event_image;
//        }
//
//        if (!empty($_FILES['service_5_image']['name'])) {
//            $file = rand(1000, 100000) . $_FILES['service_5_image']['name'];
//            $file_loc = $_FILES['service_5_image']['tmp_name'];
//            $file_size = $_FILES['service_5_image']['size'];
//            $file_type = $_FILES['service_5_image']['type'];
//            $folder = "../images/services/";
//            $new_size = $file_size / 1024;
//            $new_file_name = strtolower($file);
//            $event_image = str_replace(' ', '-', $new_file_name);
//            move_uploaded_file($file_loc, $folder . $event_image);
//            $service_5_image = $event_image;
//        }
//
//        if (!empty($_FILES['service_6_image']['name'])) {
//            $file = rand(1000, 100000) . $_FILES['service_6_image']['name'];
//            $file_loc = $_FILES['service_6_image']['tmp_name'];
//            $file_size = $_FILES['service_6_image']['size'];
//            $file_type = $_FILES['service_6_image']['type'];
//            $folder = "../images/services/";
//            $new_size = $file_size / 1024;
//            $new_file_name = strtolower($file);
//            $event_image = str_replace(' ', '-', $new_file_name);
//            move_uploaded_file($file_loc, $folder . $event_image);
//            $service_6_image = $event_image;
//        }

//    Listing Insert Part Starts

        $listing_qry = "INSERT INTO " . TBL . "listings 
					(user_id, category_id, sub_category_id, service_id, service_image, listing_type_id, listing_name, listing_mobile, listing_email
					, listing_website, listing_description, listing_address, listing_lat, listing_lng, service_locations, country_id, state_id, city_id, profile_image, cover_image
					, gallery_image, opening_days, opening_time, closing_time, fb_link, twitter_link, gplus_link, google_map
					, 360_view, listing_video, service_1_name, service_1_price, service_1_detail, service_1_image, service_1_view_more, service_2_name,service_2_price, service_2_image, service_3_name,service_3_price, service_3_image
					, service_4_name,service_4_price,service_4_image,service_5_name,service_5_price, service_5_image, service_6_name,service_6_price, service_6_image, listing_status
					, listing_info_question , listing_info_answer, payment_status, listing_slug, listing_cdt) 
					VALUES 
					('$user_id', '$category_id', '$sub_category_id', '$service_id', '$service_image', '$listing_type_id', '$listing_name', '$listing_mobile', '$listing_email', '$listing_website', '$listing_description'
					, '$listing_address', '$listing_lat', '$listing_lng', '$service_locations', '$country_id'
					, '$state_id', '$city_id', '$profile_image', '$cover_image'
					,'$gallery_image', '$opening_days', '$opening_time', '$closing_time', '$fb_link', '$twitter_link', '$gplus_link', '$google_map'
					,'$threesixty_view', '$listing_video', '$service_1_name', '$service_1_price', '$service_1_detail', '$service_1_image', '$service_1_view_more', '$service_2_name', '$service_2_price', '$service_2_image', '$service_3_name', '$service_3_price', '$service_3_image'
					, '$service_4_name', '$service_4_price', '$service_4_image', '$service_5_name', '$service_5_price', '$service_5_image', '$service_6_name', '$service_6_price', '$service_6_image', '$listing_status'
					, '$listing_info_question', '$listing_info_answer', '$payment_status', '$listing_slug', '$curDate')";

        $listing_res = mysqli_query($conn,$listing_qry);
        $ListingID = mysqli_insert_id($conn);
        $listlastID = $ListingID;

        $ListCode = 'LIST' . substr(sha1(time()), 0, 10);

        $lisupqry = "UPDATE " . TBL . "listings 
					  SET listing_code = '$ListCode' 
					  WHERE listing_id = $listlastID";

        $lisupres = mysqli_query($conn,$lisupqry);

        //****************************    Top Service Providers listing count check and addition starts    *************************


            //**  To check the given category id is available on top_service_provider_table    ***

         $top_service_sql = "SELECT * FROM  " . TBL . "top_service_providers where top_service_provider_category_id='".$category_id."'";
         $top_service_sql_rs = mysqli_query($conn, $top_service_sql);
        $top_service_sql_count = mysqli_num_rows($top_service_sql_rs);

        if($top_service_sql_count > 0){  //if category ID available in top service provider

            $top_service_sql_row = mysqli_fetch_array($top_service_sql_rs);

            $top_service_provider_listings = $top_service_sql_row['top_service_provider_listings'];
            $top_service_provider_category_id = $top_service_sql_row['top_service_provider_category_id'];

            $top_service_provider_listings_array = explode(",", $top_service_provider_listings);

            $top_service_provider_listings_array_count = count($top_service_provider_listings_array);

            if($top_service_provider_listings_array_count <= 4){   //if Listings less than or equal to 4 means update top service provider

                $parts = $top_service_provider_listings_array;
                $parts[] = $ListingID;                                  //updating existing listings array with new listing ID

               $top_service_provider_listings_new = implode(',', $parts);

                $top_service_provider_sql = mysqli_query($conn,"UPDATE  " . TBL . "top_service_providers SET top_service_provider_listings = '$top_service_provider_listings_new'
     where top_service_provider_category_id='" . $top_service_provider_category_id . "'");

            }
        }
        
        //****************************    Top Service Providers listing count check and addition ends    *************************


        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************


        if ($lisupres) {

            $admin_email = $admin_primary_email; // Admin Email Id
            
            $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link

            if($user_details_row['user_type'] == 'Service provider') {

                //****************************    Admin email starts    *************************

                $to = $admin_email;
                $subject = $admin_site_name . " - " . $BIZBOOK['NEW_LISTING_CREATE'];

                $admin_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 7 "); //admin mail template fetch
                $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

                $mail_template_admin = $admin_sql_fetch_row['mail_template'];

                $logo = $webpage_full_link . "images/home/24147logo-blanco.png";

                $message1 = stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
                , '\' . $mobile_number . \'', '\' . $listing_name . \'', '\' . $listing_email . \'', '\' . $listing_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'', '\'.$webpage_full_link_with_login.\'', '\'.$admin_primary_email.\'', '\' . $logo . \''),
                    array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '', '' . $listing_name . '', '' . $listing_email . '', '' . $listing_mobile . '', '' . $admin_footer_copyright . '', '' . $admin_address . '', '' . $webpage_full_link . '', '' . $webpage_full_link_with_login . '', '' . $admin_primary_email . '', '' . $logo . ''), $mail_template_admin));


                $headers = "From: " . "$admin_email" . "\r\n";
                $headers .= "Reply-To: " . "$admin_email" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";


                mail($to, $subject, $message1, $headers); //admin email


                //****************************    Admin email ends    *************************

                //****************************    Client email starts    *************************

                $to1 = $email_id;
                $subject1 = $admin_site_name . " - " . $BIZBOOK['LISTING_CREATE_SUCCESS'];

                $client_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 6 "); //User mail template fetch
                $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

                $mail_template_client = $client_sql_fetch_row['mail_template'];

                $message2 = stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
                , '\' . $mobile_number . \'', '\' . $listing_name . \'', '\' . $listing_email . \'', '\' . $listing_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'', '\'.$webpage_full_link_with_login.\'', '\'.$admin_primary_email.\'', '\' . $logo . \''),
                    array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '', '' . $listing_name . '', '' . $listing_email . '', '' . $listing_mobile . '', '' . $admin_footer_copyright . '', '' . $admin_address . '', '' . $webpage_full_link . '', '' . $webpage_full_link_with_login . '', '' . $admin_primary_email . '', '' . $logo . ''), $mail_template_client));


                $headers1 = "From: " . "$admin_email" . "\r\n";
                $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
                $headers1 .= "MIME-Version: 1.0\r\n";
                $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


                mail($to1, $subject1, $message2, $headers1); //admin email

                //****************************    client email ends    *************************

            }
            $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

            header('Location: admin-all-listings.php');
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-add-new-listings-start.php');
        }

        //    Listing Insert Part Ends

    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-add-new-listings-start.php');
}