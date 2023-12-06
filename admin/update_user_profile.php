<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['register_submit'])) {


        $path_id = $_POST['path_id'];
        $user_id = $_POST['user_id']; //Session User Code
        
        $first_name = $_POST["first_name"];
        $user_type = $_POST["user_type"];

        $cif_nif = $_POST["cif_nif"];

//            if (!empty($_POST["cif_nif"])) {
//                if (cif_validation($_POST["cif_nif"])) {
//                    $cif_nif = $_POST["cif_nif"];
//                } else {
//                    $_SESSION['status_msg'] = $BIZBOOK['CIF_NIF_NO_VALID'];
//                    header('Location: admin-my-profile-edit.php?row=39&path=2');
//                    exit;
//                }
//            } else {
//                $_SESSION['status_msg'] = $BIZBOOK['CIF_NIF_NO_VALID'];
//                header('Location: admin-my-profile-edit.php?row=39&path=2');
//                exit;
//            }


        if(!empty($_POST["mobile_number"])){
            if(validation_phone($_POST["mobile_number"])){
                $mobile_number = trim(strip_tags(htmlspecialchars($_POST["mobile_number"])));
            }else{
               $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];

                header('Location: admin-my-profile-edit.php?row=39&path=2');
                exit; 
            }
        }else{
            $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];

            header('Location: admin-my-profile-edit.php?row='.$user_id.'&path=2');
            exit;
        }
        
        $email_id = $_POST["email_id"];
        
//        $user_email_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "users WHERE user_id != '" . $user_id . "' and email_id='" . $email_id . "'");
//
//        if (mysqli_num_rows($user_email_exist_check) > 0) {
//            $_SESSION['status_msg'] = $BIZBOOK['THE_EMAIL_EXIST'];
//            header('Location: admin-my-profile-edit.php?row='.$user_id.'&path=2');
//            exit;
//        }
        
        $user_address = $_POST["user_address"];
        $user_state = $_POST["user_state"];
        $user_city = $_POST["user_city"];
        $user_zip_code = $_POST["user_zip_code"];

        //$user_details_row = getUser($user_id);

        $password_old = $_POST["password_old"];

        if ($_POST["password"] != NULL) {
            $password = password_hash($_POST["password"], HASH, ['cost' => COST]);
        } else {
            $password = $password_old;
        }
        
        $user_facebook= trim(htmlspecialchars($_POST["user_facebook"]));
        $user_twitter= trim(htmlspecialchars($_POST["user_twitter"]));
        $user_linkedin = trim(htmlspecialchars($_POST["user_linkedin"]));
        $user_instagram = trim(htmlspecialchars($_POST["user_instagram"]));
        $user_whatsapp = trim(htmlspecialchars($_POST["user_whatsapp"]));
        $user_website = trim(htmlspecialchars($_POST["user_website"]));

        $profile_image_old = $_POST["profile_image_old"];

        $_FILES['profile_image']['name'];

        if (!empty($_FILES['profile_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['profile_image']['name'];
            $file_loc = $_FILES['profile_image']['tmp_name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_type = $_FILES['profile_image']['type'];
            $folder = "../images/user/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $profile_image = $event_image;
        } else {
            $profile_image = $profile_image_old;
        }

        $user_slug = generar_texto_amigable($first_name);
        $user_name_exist_check = mysqli_query($conn, "SELECT user_id FROM " . TBL . "users WHERE user_id != '$user_id' and user_slug = '$user_slug'");

        if (mysqli_num_rows($user_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];
            header('Location: admin/admin-add-new-user.php');
            exit();
        }

        $usersql = "UPDATE " . TBL . "users SET email_id='" . $email_id . "',first_name='" . $first_name . "', cif_nif='" . $cif_nif. "', user_address='" . $user_address. "', user_type='" . $user_type."'
         ,user_city='" . $user_city . "', user_state='" . $user_state. "', user_zip_code='" . $user_zip_code. "', profile_image='" . $profile_image . "'
         ,password='" . $password . "', user_facebook='" . $user_facebook. "', user_twitter='" . $user_twitter . "'
         ,user_linkedin='" . $user_linkedin . "',user_instagram='" . $user_instagram . "',user_whatsapp='" . $user_whatsapp . "', user_website='" . $user_website. "', mobile_number='" . $mobile_number . "'
         , user_slug ='" . $user_slug . "' where user_id='" . $user_id . "'";
        $result = mysqli_query($conn, $usersql);

        if ($result) {
            $user_row = getUser($user_id);
            if($user_type == 'Service provider' and $user_row['send_email'] == 0){
                $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
                $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
                $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
                $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
                $admin_site_name = $admin_primary_email_fetchrow['website_address'];
                $admin_address = $admin_primary_email_fetchrow['footer_address'];

                $admin_email = $admin_primary_email; // Admin Email Id

                $webpage_full_link_with_login = $webpage_full_link. "verification_user?row=".$user_id;  //URL Login Link

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

                $upqry = "UPDATE " . TBL . "users 
                                              SET send_email = 1 
                                              WHERE user_id = $user_id";

                //echo $upqry; die();
                $upres = mysqli_query($conn,$upqry);
            }

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

            if ($path_id == 1) {
                header('Location: admin-new-user-requests.php');
                exit;
            } elseif ($path_id == 2) {
                header('Location: admin-all-users.php');
                exit;
            } elseif ($path_id == 3) {
                header('Location: admin-all-users-general.php');
                exit;
            } elseif ($path_id == 4) {
                header('Location: admin-all-users-service-provider.php');
                exit;
            } elseif ($path_id == 5) {
                header('Location: admin-free-users.php');
                exit;
            } elseif ($path_id == 6) {
                header('Location: admin-standard-users.php');
                exit;
            } elseif ($path_id == 7) {
                header('Location: admin-premium-users.php');
                exit;
            } elseif ($path_id == 8) {
                header('Location: admin-premium-plus-users.php');
                exit;
            } else {
                header('Location: admin-all-users.php');
                exit;
            }


        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

//            if ($path_id == 1) {
//                header('Location: admin-new-user-requests.php');
//                exit;
//            } elseif ($path_id == 2) {
//                header('Location: admin-all-users.php');
//                exit;
//            } elseif ($path_id == 3) {
//                header('Location: admin-all-users-general.php');
//                exit;
//            } elseif ($path_id == 4) {
//                header('Location: admin-all-users-service-provider.php');
//                exit;
//            } elseif ($path_id == 5) {
//                header('Location: admin-free-users.php');
//                exit;
//            } elseif ($path_id == 6) {
//                header('Location: admin-standard-users.php');
//                exit;
//            } elseif ($path_id == 7) {
//                header('Location: admin-premium-users.php');
//                exit;
//            } elseif ($path_id == 8) {
//                header('Location: admin-premium-plus-users.php');
//                exit;
//            } else {
//                header('Location: admin-all-users.php');
//                exit;
//            }
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    if ($path_id == 1) {
        header('Location: admin-new-user-requests.php');
        exit;
    } elseif ($path_id == 2) {
        header('Location: admin-all-users.php');
        exit;
    } elseif ($path_id == 3) {
        header('Location: admin-all-users-general.php');
        exit;
    } elseif ($path_id == 4) {
        header('Location: admin-all-users-service-provider.php');
        exit;
    } elseif ($path_id == 5) {
        header('Location: admin-free-users.php');
        exit;
    } elseif ($path_id == 6) {
        header('Location: admin-standard-users.php');
        exit;
    } elseif ($path_id == 7) {
        header('Location: admin-premium-users.php');
        exit;
    } elseif ($path_id == 8) {
        header('Location: admin-premium-plus-users.php');
        exit;
    } else {
        header('Location: admin-all-users.php');
        exit;
    }
}
?>