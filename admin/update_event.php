<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['event_submit'])) {

        $event_id = $_POST["event_id"];
        $year_id = $_POST["year_id"];

        $event_image_old = $_POST["event_image_old"];


// Basic Personal Details
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $mobile_number = $_POST["mobile_number"];
        $email_id = $_POST["email_id"];

        $register_mode = "Direct";
        $user_status = "Active";

// Common Event Details
        $event_name = addslashes($_POST["event_name"]);
        $event_address = addslashes($_POST["event_address"]);
        $event_map = $_POST["event_map"];
        $event_contact_name = $_POST["event_contact_name"];
        $event_website = $_POST["event_website"];
        if(!empty($_POST['event_mobile'])){
            if(validation_phone($_POST["event_mobile"])){
                $event_mobile = $_POST["event_mobile"];
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
                header("Location: admin-edit-event.php?row=$event_id");
                exit();
            }
        }
        
        if(!empty($_POST['event_email'])){
            if(validation_email($_POST["event_email"])){
                $event_email = $_POST["event_email"];
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
                header("Location: admin-edit-event.php?row=$event_id");
                exit();
            }
        }
        $event_description = addslashes($_POST["event_description"]);

        $event_start_date_old = $_POST["event_start_date"];
        $timestamp = strtotime($event_start_date_old);
        $event_start_date = date('Y-m-d', $timestamp);
        
        $event_end_date = $_POST["event_end_date"];
        $event_time = $_POST["event_time"];
//        $isenquiry_old = $_POST["isenquiry"];
        $user_id = $_POST["user_id"];

//        if($isenquiry_old == "on"){
//            $isenquiry = 1;
//        }else{
//            $isenquiry = 0;
//        }
        
        $isenquiry = 0;

        $event_type = "All";

        $user_sql = "SELECT * FROM  " . TBL . "admin where admin_id='" . $user_id . "'";
        $user_rs = mysqli_query($conn, $user_sql);
        $usersqlrow = mysqli_fetch_array($user_rs);

// Event Status
        $event_status = "Active";
        // $event_status = "Pending";
        $payment_status = "Pending";

        $event_type_id = 1;

        if (!empty($_FILES['event_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['event_image']['name']);
            $file_loc = $_FILES['event_image']['tmp_name'];
            $file_size = $_FILES['event_image']['size'];
            $file_type = $_FILES['event_image']['type'];
            $folder = "../images/events/";
            $new_size = $file_size / 1024;
            $event_image_old1 = $file;
            move_uploaded_file($file_loc, $folder . $event_image_old1);
            $event_image = $event_image_old1;
        }else {
            $event_image = $event_image_old;
        }

        $event_slug = generar_texto_amigable($event_name);
        $event_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "events  WHERE event_slug='" . $event_slug . "' and event_id != '" . $event_id . "'");

        if (mysqli_num_rows($event_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header("Location: admin-edit-event.php?row=$event_id");
            exit;
        }

        $event_qry =
            "UPDATE  " . TBL . "events  SET user_id='" . $user_id . "', year_id='" . $year_id . "', event_name='" . $event_name . "',event_description='" . $event_description . "', event_email='" . $event_email . "'
            , event_mobile='" . $event_mobile . "',event_website='" . $event_website . "', event_address='" . $event_address . "'
            ,event_contact_name='" . $event_contact_name . "' ,event_map='" . $event_map . "' 
        ,event_start_date='" . $event_start_date . "' , event_time='" . $event_time . "' 
    ,event_image='" . $event_image . "', event_status='" . $event_status . "', event_type='" . $event_type . "', isenquiry='" . $isenquiry . "'
    ,event_slug='" . $event_slug . "' where event_id='" . $event_id . "'";


        $event_res = mysqli_query($conn,$event_qry);

        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        if ($event_res) {

//            $admin_email = $admin_primary_email; // Admin Email Id
//
//            $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link

//****************************    Admin email starts    *************************

//            $to = $admin_email;
//            $subject = $admin_site_name." - ".$BIZBOOK['EVENT_UPDATE_SUCCESS'];

//            $to = $admin_email;
//            $subject = $admin_site_name." - ".$BIZBOOK['NEW_EVENT_CREATE'];
//
//            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 13 "); //admin mail template fetch
//            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);
//
//            $mail_template_admin = $admin_sql_fetch_row['mail_template'];
//
//            $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $event_name . \'', '\' . $event_email . \'', '\' . $event_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $event_name . '', '' . $event_email . '', '' . $event_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));
//
//            $headers = "From: " . "$email_id" . "\r\n";
//            $headers .= "Reply-To: " . "$email_id" . "\r\n";
//            $headers .= "MIME-Version: 1.0\r\n";
//            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
//
//
//            mail($to, $subject, $message1, $headers); //admin email


//****************************    Admin email ends    *************************

//****************************    Client email starts    *************************

//            $to1 = $email_id;
//            $subject1 = $admin_site_name." - ".$BIZBOOK['EVENT_UPDATE_SUCCESS'];
//
//            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 12 "); //User mail template fetch
//            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
//
//            $mail_template_client = $client_sql_fetch_row['mail_template'];
//
//            $message2 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $event_name . \'', '\' . $event_email . \'', '\' . $event_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $event_name . '', '' . $event_email . '', '' . $event_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_client));
//
//
//            $headers1 = "From: " . "$admin_email" . "\r\n";
//            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
//            $headers1 .= "MIME-Version: 1.0\r\n";
//            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";
//
//
//            mail($to1, $subject1, $message2, $headers1); //admin email

//****************************    client email ends    *************************

            if ($event_type_id == 1) {

                $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

                header('Location: admin-event.php');
                exit();
            } else {

                header("Location: paypal_pay.php?map_id=$event_id&type_id=$event_type_id");

                $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

                //           header('Location: db-payment.php');

                exit();
            }

//            $_SESSION['status_msg'] = "Your Event has been Updated Successfully!!!";
//
//            header('Location: db-all-events.php');
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header("Location: admin-edit-event.php?row=$event_id");
            exit();
        }

        //    Event Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-event.php');
    exit();
}