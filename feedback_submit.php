<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST') {
//    Feedback Insert Part Starts

    if(!empty($_POST['feedback_name'])){
        $enquiry_name = trim(strip_tags(htmlspecialchars($_POST["feedback_name"])));
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ENTER_NAME'];
        header('Location: feedback');
        exit();
    }
    
    if(!empty($_POST['feedback_mobile'])){
        if(validation_phone($_POST["feedback_mobile"])){
            $enquiry_mobile = trim(strip_tags(htmlspecialchars($_POST["feedback_mobile"])));
        }else{
            $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
            header('Location: feedback');
            exit();
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
        header('Location: feedback');
        exit();
    }
    
    if(!empty($_POST['feedback_email'])){
        if(validation_email($_POST["feedback_email"])){
            $enquiry_email = trim(strip_tags(htmlspecialchars($_POST["feedback_email"])));
        }else{
            $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
            header("Location: feedback");
            exit();
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
        header('Location: feedback');
        exit();
    }
    
    if(!empty($_POST['feedback_message'])){
        $enquiry_message = trim(strip_tags(htmlspecialchars($_POST["feedback_message"])));
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ENTER_NAME'];
        header('Location: feedback');
        exit();
    }
    
    $curDate = date("Y-m-d H:i:s", time());
    
    $new_ip = get_client_ip();
    
    $ip_txt =  $new_ip;
    
    $enquiry_qry = "INSERT INTO " . TBL . "messages 
					(sender_name, sender_email, sender_mobile,message,message_cdt,ip) 
					VALUES 
					('$enquiry_name', '$enquiry_email', '$enquiry_mobile','$enquiry_message', '$curDate','$ip_txt')";

    $enquiry_res = mysqli_query($conn,$enquiry_qry);

    $EnquiryID = mysqli_insert_id($conn);


    if ($enquiry_res) {
        
        $webpage_full_link_with_login = $webpage_full_link. "admin";
            
        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        $admin_email = $admin_primary_email; // Admin Email Id

        $to1 = $enquiry_email;
        $subject1 = $admin_site_name." - Nuevo comentario";

        $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 30"); //User mail template fetch
        $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

        $mail_template_client = $client_sql_fetch_row['mail_template'];

        $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
        $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
        $message1 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_message . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $url_img_datasur . \'','\' . $logo . \''),
                    array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_message . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $url_img_datasur . '','' . $logo . ''), $mail_template_client));

        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to1, $subject1, $message1, $headers1); //Client email

        $to2 = $admin_email;
        $subject2 = $admin_site_name." - Nuevo comentario";

        $client_sql_fetch2 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 31"); //User mail template fetch
        $client_sql_fetch_row2 = mysqli_fetch_array($client_sql_fetch2);

        $mail_template_client2 = $client_sql_fetch_row2['mail_template'];

        $message2 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'','\' . $enquiry_message . \'','\' . $webpage_full_link_with_login . \'','\' . admin_site_name . \'','\' . $logo . \''),
                array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '','' . $enquiry_message . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . ''), $mail_template_client2));

        $headers2 = "From: " . $admin_email . "\r\n";
        $headers2 .= "Reply-To: " . $admin_email . "\r\n";
        $headers2 .= "MIME-Version: 1.0\r\n";
        $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to2, $subject2, $message2, $headers2); //Client email

        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

        header('Location: feedback');
        exit();

    } else {
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: feedback');
        exit();
    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: feedback');
    exit();
}

//    Enquiry Insert Part Ends

