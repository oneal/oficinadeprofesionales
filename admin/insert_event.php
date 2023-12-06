<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";

if ($_SERVER['REQUEST_METHOD']=='POST') {

    if (isset($_POST['event_submit'])) {

// Basic Personal Details
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $mobile_number = $_POST["mobile_number"];
        $email_id = $_POST["email_id"];
        $year_id = $_POST["year_id"];

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
                header('Location: admin-add-new-event.php');
                exit();
            }
        }
        
        if(!empty($_POST['event_email'])){
            if(validation_email($_POST["event_email"])){
                $event_email = $_POST["event_email"];
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
                header('Location: admin-add-new-event.php');
                exit();
            }
        }
        
        $event_description = addslashes($_POST["event_description"]);
        $event_start_date_old = $_POST["event_start_date"];
        $timestamp1 = strtotime($event_start_date_old);
        $event_start_date = date('Y-m-d', $timestamp1);
        
        $event_end_date = $_POST["event_end_date"];
        
        $event_time = $_POST["event_time"];
//        $isenquiry_old = $_POST["isenquiry"];
        $user_id = $_POST['user_id'];

//        if($isenquiry_old == "on"){
//            $isenquiry = 1;
//        }else{
//            $isenquiry = 0;
//        }
        $isenquiry = 0;
        $event_type = "All";



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
            $event_image_1 = $file;
            move_uploaded_file($file_loc, $folder . $event_image_1);
            $event_image = $event_image_1;
        }

        $event_slug = generar_texto_amigable($event_name);
        $event_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "events  WHERE event_slug='" . $event_slug . "' ");

        if (mysqli_num_rows($event_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-new-event.php');
            exit;
        }

        $curDate = date("Y-m-d H:i:s", time());

        //    Event Insert Part Starts        
        $event_qry = "INSERT INTO " . TBL . "events 
					(user_id, year_id, event_name, event_description,event_email,event_mobile,event_website, event_address
					,event_contact_name, event_map, event_start_date, event_time, event_image, event_status, event_type, isenquiry, event_slug, event_cdt) 
					VALUES 
					('$user_id', '$year_id', '$event_name', '$event_description', '$event_email', '$event_mobile', '$event_website'
					, '$event_address', '$event_contact_name', '$event_map', '$event_start_date', '$event_time', '$event_image', '$event_status', '$event_type', '$isenquiry', '$event_slug', '$curDate')";

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
//            $subject = $admin_site_name." - ".$BIZBOOK['NEW_EVENT_CREATE'];
//
//            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 11 "); //admin mail template fetch
//            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);
//
//            $mail_template_admin = $admin_sql_fetch_row['mail_template'];
//
//            $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $event_name . \'', '\' . $event_email . \'', '\' . $event_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $event_name . '', '' . $event_email . '', '' . $event_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));
//
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
//            $subject1 = $admin_site_name.' - '.$BIZBOOK['EVENT_CREATION_SUCCESS'];
//
//            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 10 "); //User mail template fetch
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

                $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

                header('Location: admin-event.php');

            } else {


                $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];
                header("Location: paypal_pay.php?map_id=$listlastID&type_id=$event_type_id");

                //           header('Location: db-payment.php');

                exit;
            }

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-add-new-event.php');
        }

        //    Event Insert Part Ends

    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-event.php');
}