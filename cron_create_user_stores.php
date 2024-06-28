<?php


if (file_exists('config/info.php')) {

    include('config/info.php');

}


$stores = getAllStoresWithoutUser();

if(isset($stores) && count($stores) > 0) {

    foreach ($stores as $store) {
        $email_id = $store['store_email'];
        $mobile_number = $store['store_mobile'];
        $store_id = $store['store_id'];
        $user = null;

        $user_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE email_id = '$email_id' OR mobile_number = '$mobile_number'");

        if(mysqli_num_rows($user_exist_check)>0) {
            $user = mysqli_fetch_array($user_exist_check);
            $user_id = $user['user_id'];
            $upqry = "UPDATE " . TBL . "stores 
                        SET create_user = 1, user_id = $user_id WHERE store_id = $store_id";
            $upres = mysqli_query($conn,$upqry);
        }

        if(!isset($user)) {
            $curDate = date("Y-m-d H:i:s", time());

            $user_code = 'USER' . substr(sha1(time()), 0, 10);

            $city = getCity($store['city_id']);
            $state = getState($store['state_id']);

            $user_slug = generar_texto_amigable($store['store_name']);

            $password = substr(time(),0,10);
            $password_hash = password_hash($password,HASH, ['cost' => COST]);

            $first_name = $store['store_name'];
            $last_name = '';
            $cif_nif = '';
            $user_type = 'Store';
            $register_mode = "Direct";
            $user_plan = 4;
            $user_address = '';
            $user_city = $city['city_name'];
            $user_state = $state['state_name'];
            $user_zip_code = '';
            $profile_image = '';
            $user_facebook = '';
            $user_twitter = '';
            $user_linkedin = '';
            $user_instagram = '';
            $user_whatsapp = '';
            $user_website = $store['store_website'];
            $user_status = 'Active';

            $qry = "INSERT INTO " . TBL . "users 
                                                (user_code, first_name, last_name, cif_nif, email_id, mobile_number, password, user_type, user_plan, register_mode, user_address, user_city, user_state, user_zip_code, profile_image
                                                , user_facebook, user_twitter, user_linkedin, user_instagram, user_whatsapp, user_website, user_slug, user_status, user_cdt) 
                                                VALUES ('$user_code', '$first_name', '$last_name', '$cif_nif', '$email_id', '$mobile_number', '$password_hash', '$user_type', '$user_plan', '$register_mode',
                                                 '$user_address', '$user_city', '$user_state','$user_zip_code','$profile_image', '$user_facebook','$user_twitter', '$user_linkedin', '$user_instagram', '$user_whatsapp', '$user_website',
                                                 '$user_slug','$user_status', '$curDate')";

            $res = mysqli_query($conn,$qry);
            $userID = mysqli_insert_id($conn);

            $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
            $admin_address = $admin_primary_email_fetchrow['footer_address'];

            $admin_email = $admin_primary_email; // Admin Email Id

            $webpage_full_link_with_login = $webpage_full_link. "verification_user?row=".$user_code;  //URL Login Link

            $to = $admin_email;
            $subject = $admin_site_name." - ".$BIZBOOK['NEW_REGISTER'];

            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 2 "); //Admin mail template fetch
            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

            $mail_template_admin = $admin_sql_fetch_row['mail_template'];

            $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
            $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
            $message1 =   stripslashes(str_replace(array('\' . $admin_site_name . \'', '\' . $first_name . \'', '\' . $email_id . \'','\' . $logo . \''),
                array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '','' . $logo . ''), $mail_template_admin));

            $headers = "From: " . "$email_id" . "\r\n";
            $headers .= "Reply-To: " . "$email_id" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";


            mail($to, $subject, $message1, $headers); //admin email


            //****************************    Admin email ends    *************************

            //****************************    Client email starts    *************************

            $to1 = $email_id;
            $subject1 = $admin_site_name." - ".$BIZBOOK['REGISTER_SUCCESS'];

            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 1 "); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $message2 =   stripslashes(str_replace(array('\' . $admin_site_name . \'', '\' . $first_name . \'', '\' . $email_id . \'', '\' . $mobile_phone . \'','\' . $webpage_full_link_with_login . \'','\' . $url_img_datasur . \'','\' . $logo . \''),
                array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '', '' . $mobile_number . '','' . $webpage_full_link_with_login . '','' . $url_img_datasur . '','' . $logo . ''), $mail_template_client));

            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

            mail($to1, $subject1, $message2, $headers1); //admin email

            $user = getUser($userID);

            $upqry = "UPDATE " . TBL . "stores 
                        SET create_user = 1, user_id = $userID WHERE store_id = $store_id";
            $upres = mysqli_query($conn,$upqry);

        }
    }


}
