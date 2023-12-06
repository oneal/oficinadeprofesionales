<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

$email = $_POST['email'];
$url_actual = $_POST['url_actual'];

if(!empty($email)){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

        $to1 = $email;
        $subject1 = $admin_site_name." - Creo que te puede interesar esto";

        $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 43"); //User mail template fetch
        $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

        $mail_template_client = $client_sql_fetch_row['mail_template'];

        $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
        $message1 = stripslashes(str_replace(array('\' . $url_actual . \'','\' . $admin_site_name . \'','\' . $logo . \''),
                    array('' . $url_actual . '','' . $admin_site_name . '','' . $logo . ''), $mail_template_client));

        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to1, $subject1, $message1, $headers1); //Client email

        echo 1;
    }else{
        echo 3;
    }
}else{
    echo 2;
}
