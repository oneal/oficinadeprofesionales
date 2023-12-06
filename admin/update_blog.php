<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['blog_submit'])) {

        $blog_id = $_POST["blog_id"];

        $blog_image_old = $_POST["blog_image_old"];


// Basic Personal Details
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        
         if(!empty($_POST['mobile_number'])){
            if(validation_phone($_POST["mobile_number"])){
                $mobile_number = $_POST["mobile_number"];
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
                header("Location: admin-edit-blogs.php?row=$blog_id");
                exit();
            }
        }
        
        if(!empty($_POST['email_id'])){
            if(validation_email($_POST["email_id"])){
                $email_id = $_POST["email_id"];
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
                header("Location: admin-edit-blogs.php?row=$blog_id");
                exit();
            }
        }

        $register_mode = "Direct";
        $user_status = "Inactive";

// Common blog Details
        $blog_name = $_POST["blog_name"];
        $blog_description = addslashes($_POST["blog_description"]);
//        $isenquiry_old = $_POST["isenquiry"];
        $user_id = $_POST["user_id"];

//        if($isenquiry_old == "on"){
//            $isenquiry = 1;
//        }else{
//            $isenquiry = 0;
//        }
        $isenquiry = 0;
        $user_sql = "SELECT * FROM  " . TBL . "admin where admin_id='" . $user_id . "'";
        $user_rs = mysqli_query($conn, $user_sql);
        $usersqlrow = mysqli_fetch_array($user_rs);

        $blog_status = "Active";

// blog Status
//        $blog_status = "Active";
        // $blog_status = "Pending";
        $payment_status = "Pending";

        $blog_type_id = 1;


        if (!empty($_FILES['blog_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['blog_image']['name']);
            $file_loc = $_FILES['blog_image']['tmp_name'];
            $file_size = $_FILES['blog_image']['size'];
            $file_type = $_FILES['blog_image']['type'];
            $folder = "../images/blogs/";
            $new_size = $file_size / 1024;
            $blog_image_old1 =$file;
            move_uploaded_file($file_loc, $folder . $blog_image_old1);
            $blog_image = $blog_image_old1;
        }else {
            $blog_image = $blog_image_old;
        }

        $blog_slug = generar_texto_amigable($blog_name);
        $blog_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "blogs WHERE blog_id != '" . $blog_id . "' and blog_slug='" . $blog_slug . "'");

        if (mysqli_num_rows($blog_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header("Location: admin-edit-blogs.php?row=$blog_id");
            exit;
        }

        $blog_qry =
            "UPDATE  " . TBL . "blogs  SET user_id='" . $user_id . "', blog_name='" . $blog_name . "',blog_description='" . $blog_description . "',
      blog_image='" . $blog_image . "', blog_status='" . $blog_status . "',  isenquiry='" . $isenquiry . "'
      , blog_slug='" . $blog_slug . "' where blog_id='" . $blog_id . "'";

        $blog_res = mysqli_query($conn,$blog_qry);

        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        if ($blog_res) {

//            $admin_email = $admin_primary_email; // Admin Email Id
//
//            $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link

//****************************    Admin email starts    *************************

//            $to = $admin_email;
//            $subject = $admin_site_name." - ".$BIZBOOK['BLOG_UPDATE'];
//
//            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 17 "); //admin mail template fetch
//            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);
//
//            $mail_template_admin = $admin_sql_fetch_row['mail_template'];
//
//            $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $blog_name . \'', '\' . $blog_email . \'', '\' . $blog_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $blog_name . '', '' . $blog_email . '', '' . $blog_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));
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
//            $subject1 = $admin_site_name." - ".$BIZBOOK['UPDATE_BLOG_SUCCESS'];
//
//            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 16 "); //User mail template fetch
//            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
//
//            $mail_template_client = $client_sql_fetch_row['mail_template'];
//
//            $message2 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $blog_name . \'', '\' . $blog_email . \'', '\' . $blog_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $blog_name . '', '' . $blog_email . '', '' . $blog_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_client));
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

            if ($blog_type_id == 1) {

                $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

                header('Location: admin-all-blogs.php');
                exit;
            } else {

                header("Location: paypal_pay.php?map_id=$blog_id&type_id=$blog_type_id");

                $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

                //           header('Location: db-payment.php');

                exit;
            }

//            $_SESSION['status_msg'] = "Your blog has been Updated Successfully!!!";
//
//            header('Location: db-all-blogs.php');
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header("Location: admin-edit-blogs.php?row=$blog_id");
        }

        //    blog Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-blogs.php');
}