<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST') {

    if (isset($_POST['popup_enquiry_submit'])) {

        $listingrow = getWorkOfferCode($_POST["listing_id"]);
        $listing_id = $listingrow['work_offer_id'];

        $work_offer_name = $listingrow['work_offer_name'];

        $userrow = getUserCode($_POST["listing_user_id"]);
        $listing_user_id = $userrow['user_id'];

        if (!empty($_POST["enquiry_name"])) {
            $enquiry_name = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_name"]))));
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ENTER_NAME'];
            header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
            exit();
        }
        if (!empty($_POST["enquiry_email"])) {
            if (validation_email($_POST["enquiry_email"])) {
                $enquiry_email = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_email"]))));
            } else {
                $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
                header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
                exit();
            }
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
            header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
            exit();
        }

        if (!empty($_POST["enquiry_mobile"])) {
            if (validation_phone($_POST["enquiry_mobile"])) {
                $enquiry_mobile = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_mobile"]))));
            } else {
                $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
                header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
                exit();
            }
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
            header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
            exit();
        }

        if (!empty($_POST["enquiry_message"])) {
            $enquiry_message = addslashes(htmlspecialchars(strip_tags(trim($_POST["enquiry_message"]))));
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ENTER_MESSAGE'];
            header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
            exit();
        }

        if ($listing_user_id !== 0 and $enquiry_sender_id !== 0) {
            if ($enquiry_email == $userrow['email_id']) {
                $_SESSION['status_msg'] = $BIZBOOK['YOU_CANNOT_MAKE_ENQUIRY'];
                header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
                exit();
            }
        }

        $work_offer_curri = "";
        if (!empty($_FILES['work_offer_curri']['name'])) {
            $file = generar_texto_amigable_img($_FILES['work_offer_curri']['name']);
            $file_loc = $_FILES['work_offer_curri']['tmp_name'];
            $file_size = $_FILES['work_offer_curri']['size'];
            $file_type = $_FILES['work_offer_curri']['type'];
            $folder = "images/workoffer/curriculum/";
            $work_offers_curri_1 = $file;
            move_uploaded_file($file_loc, $folder . $work_offers_curri_1);
            $work_offer_curri = $work_offers_curri_1;
        }

        $curDate = date("Y-m-d H:i:s", time());

        $enquiry_qry = "INSERT INTO " . TBL . "enquiry_work_offer 
                        (work_offer_id,work_offer_user_id,enquiry_name, enquiry_email, enquiry_mobile,enquiry_message, work_offer_curriculum, enquiry_cdt) 
                                            VALUES 
                        ('$listing_id', '$listing_user_id','$enquiry_name', '$enquiry_email', '$enquiry_mobile', '$enquiry_message', '$work_offer_curri', '$curDate')";

        $enquiry_res = mysqli_query($conn, $enquiry_qry);

        $EnquiryID = mysqli_insert_id($conn);

        if ($enquiry_res) {

            //****************************    Admin Primary email fetch starts    *************************

            $webpage_full_link_with_login = $webpage_full_link . "login";

            $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
            $admin_address = $admin_primary_email_fetchrow['footer_address'];

            //****************************    Admin Primary email fetch ends    *************************

            //            $user_row = getUser($listing_user_id);
            //            $email_id = $user_row['email_id'];
            //            $first_name = $user_row['first_name'];
            //
            //            $user_plan = $user_row['user_plan']; //Fetch of Logged In user Plan
            //
            //            $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data
            //
            //            $plan_type_email_notification = $user_plan_type['plan_type_email_notification'];

            $admin_email = $admin_primary_email; // Admin Email Id

            $to1 = $enquiry_email;
            $subject1 = $admin_site_name . " - " . $BIZBOOK['NEW_ENQUIRY'];

            $client_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 50"); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
            $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
            $message1 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'', '\' . $enquiry_source . \'', '\' . $webpage_full_link_with_login . \'', '\' . $admin_site_name . \'', '\' . $url_img_datasur . \'', '\' . $logo . \'', '\' . $work_offer_name . \''),
                array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '', '' . $enquiry_message . '', '' . $webpage_full_link_with_login . '', '' . $admin_site_name . '', '' . $url_img_datasur . '', '' . $logo . '', '' . $work_offer_name . ''), $mail_template_client));

            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

            //if($plan_type_email_notification == 1) {
            mail($to1, $subject1, $message1, $headers1); //Client email
            //}


            $to2 = $userrow['email_id'];
            $subject2 = $admin_site_name . " - " . $BIZBOOK['NEW_ENQUIRY'];

            if($work_offer_curri != ""){
                $client_sql_fetch2 = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 51"); //User mail template fetch
                $work_offer_curriculum = $webpage_full_link.'images/workoffer/curriculum/'.$work_offer_curri;
            }else{
                $client_sql_fetch2 = mysqli_query($conn, "SELECT * FROM " . TBL . "mail  WHERE mail_id = 52"); //User mail template fetch
            }

            $client_sql_fetch_row2 = mysqli_fetch_array($client_sql_fetch2);

            $mail_template_client2 = $client_sql_fetch_row2['mail_template'];

            if($work_offer_curri != "") {
                $message2 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'', '\' . $enquiry_source . \'', '\' . $webpage_full_link_with_login . \'', '\' . admin_site_name . \'', '\' . $logo . \'', '\' . $work_offer_curriculum . \'', '\' . $work_offer_name . \''),
                    array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '', '' . $enquiry_message . '', '' . $webpage_full_link_with_login . '', '' . $admin_site_name . '', '' . $logo . '', '' . $work_offer_curriculum . '', '' . $work_offer_name . ''), $mail_template_client2));
            }else{
                $message2 = stripslashes(str_replace(array('\' . $enquiry_name . \'', '\' . $enquiry_email . \'', '\' . $enquiry_mobile . \'', '\' . $enquiry_source . \'', '\' . $webpage_full_link_with_login . \'', '\' . admin_site_name . \'', '\' . $logo . \'', '\' . $work_offer_name . \''),
                    array('' . $enquiry_name . '', '' . $enquiry_email . '', '' . $enquiry_mobile . '', '' . $enquiry_message . '', '' . $webpage_full_link_with_login . '', '' . $admin_site_name . '', '' . $logo . '', '' . $work_offer_name . ''), $mail_template_client2));
            }

            $headers2 = "From: " . $admin_email . "\r\n";
            $headers2 .= "Reply-To: " . $admin_email . "\r\n";
            $headers2 .= "MIME-Version: 1.0\r\n";
            $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

            //if($plan_type_email_notification == 1) {
            mail($to2, $subject2, $message2, $headers2); //Client email
            //}

            //****************************    client email ends    *************************

            $_SESSION['status_succes_msg'] = $BIZBOOK['YOUT_ENQUIRY_SEND_SUCCESS'];
            header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
            exit();
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['SOMETHING_WENT_WRONG'];
            header("Location: oferta-trabajo/" . $listingrow['work_offer_slug']);
            exit();
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['SOMETHING_WENT_WRONG'];
        header("Location: index");
        exit();
    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['SOMETHING_WENT_WRONG'];
    header("Location: index");
    exit();
}