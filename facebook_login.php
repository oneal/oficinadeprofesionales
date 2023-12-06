<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

include "facebook_config.php"; //Facebook Config File

if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
    header("Location: dashboard");
}

$user_profile = json_decode($_POST['userData']);

//$user_profile = $facebook->api('/me'); //Fetch response data from facebook

$fbemail = $user_profile->email;
$first_name = $user_profile->first_name;


$user_type ='Service provider';
$user_plan = 4;
$register_mode ='Facebook';

$user_slug = generar_texto_amigable($first_name);

$email_check = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE email_id = '$fbemail' ");

$check = mysqli_num_rows($email_check);

if ($check == '0' || empty($check)) { // if new user . Insert a new record

    $user_status = "Active";
    
    $curDate = date("Y-m-d H:i:s", time());

    $query = mysqli_query($conn,"INSERT INTO " . TBL . "users 
					(first_name, email_id, mobile_number, password, user_type, user_plan, register_mode, user_status, user_slug, user_cdt) 
					VALUES ('$first_name', '$fbemail', '$mobile_number', '$password', '$user_type', '$user_plan', '$register_mode', '$user_status', '$user_slug', '$curDate')");
    $LID = mysqli_insert_id($conn);
    $lastID = $LID;

    $userID = 'USER' . substr(sha1(time()), 0, 10);

    $upqry = "UPDATE " . TBL . "users 
					  SET user_code = '$userID' 
					  WHERE user_id = $lastID";

    //echo $upqry; die();
    $upres = mysqli_query($conn,$upqry);

    //****************************    Admin Primary email fetch starts    *************************

    $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
    $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
    $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
    $admin_site_name = $admin_primary_email_fetchrow['website_address'];
    $admin_address = $admin_primary_email_fetchrow['footer_address'];

    //****************************    Admin Primary email fetch ends    *************************

    if ($upres) {
        
        $email_id = $fbemail;
        $admin_email = $admin_primary_email; // Admin Email Id

        $webpage_full_link_with_login = $webpage_full_link. "verification_user?row=".$userID;  //URL Login Link

//****************************    Admin email starts    *************************

        $to = $admin_email;
        $subject = $admin_site_name." - ".$BIZBOOK['NEW_REGISTER'];

        $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 49"); //Admin mail template fetch
        $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

        $mail_template_admin = $admin_sql_fetch_row['mail_template'];

        $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
        $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
        $message1 =   stripslashes(str_replace(array('\' . $admin_site_name . \'', '\' . $first_name . \'', '\' . $email_id . \'','\' . $logo . \''),
            array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '','' . $logo . ''), $mail_template_admin));


        $headers = "From: " . "$admin_email" . "\r\n";
        $headers .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";


        mail($to, $subject, $message1, $headers); //admin email


//****************************    Admin email ends    *************************

//****************************    Client email starts    *************************

        $to1 = $fbemail;
        $subject1 = $admin_site_name." - ".$BIZBOOK['REGISTER_SUCCESS'];

        $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 48"); //User mail template fetch
        $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

        $mail_template_client = $client_sql_fetch_row['mail_template'];

        $message2 =   stripslashes(str_replace(array('\' . $admin_site_name . \'', '\' . $first_name . \'', '\' . $email_id . \'','\' . $webpage_full_link_with_login . \'','\' . $url_img_datasur . \'','\' . $logo . \''),
                        array('' . $admin_site_name . '', '' . $first_name . '', '' . $email_id . '','' . $webpage_full_link_with_login . '','' . $url_img_datasur . '','' . $logo . ''), $mail_template_client));

        
        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


        mail($to1, $subject1, $message2, $headers1); //admin email

//****************************    client email ends    *************************

        $_SESSION['user_code'] = $userID;
        $_SESSION['user_name'] = $first_name;
        $_SESSION['user_id'] = $lastID;

        //header("location: dashboard");
        exit();
    }

} else {   // If Returned user . update the user record
    $curDate = date("Y-m-d H:i:s", time());
    
    $query = mysqli_query($conn,"UPDATE " . TBL . "users SET first_name='".$first_name."', user_type='".$user_type."', register_mode='".$register_mode."', user_cdt='".$curDate."' where email_id='".$fbemail."'");

    $query1 = mysqli_query($conn,"SELECT * FROM " . TBL . "users WHERE ( email_id='" . $fbemail . "') ");
    $row = mysqli_fetch_array($query1);

    $user_code = $row['user_code'];
    $user_name = $row['first_name'];
    $user_id = $row['user_id'];
    $_SESSION['user_code'] = $user_code;
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_id'] = $user_id;

//    header("location: dashboard");
    exit();

}