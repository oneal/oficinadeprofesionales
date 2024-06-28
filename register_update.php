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
        if(!isset($_POST['user_type'])){
            $response = null;
            // comprueba la clave secreta
            $reCaptcha = new ReCaptcha(SECRET_RECAPTCHA);

            if ($_POST["g-recaptcha-response"]) {
                $response = $reCaptcha->verifyResponse(
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["g-recaptcha-response"]
                );
            }
            $continuar = ($response != null && $response->success);
        }else{
            $continuar = TRUE;
        }

        if ($continuar) {

            $trap_box = $_POST["trap_box"];

            $mode_path = $_POST["mode_path"];

            if (!empty($trap_box) || $trap_box != NULL) {

                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {

                    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                    header('Location: admin/admin-add-new-user.php');
                    exit();
                } else {
                    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
                    $_SESSION['register_status_msg'] = 1;

                    header('Location: login?login=register');
                    exit();
                }
            }

            if (!empty($_POST["first_name"])) {
                $first_name = $_POST["first_name"];
            } else {
                $_SESSION['status_msg'] = $BIZBOOK['ENTER_NAME'];
                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                    header('Location: admin/admin-add-new-user.php');
                    exit();
                } else {
                    $_SESSION['register_status_msg'] = 1;
                    header('Location: login?login=register');
                    exit();
                }
            }
            $last_name = $_POST["last_name"];

            if (!empty($_POST['user_type'])) {
                $user_type = $_POST['user_type'];
            } else {
                $user_type = "Service provider";
            }

            $cif_nif = $_POST["cif_nif"];

//            $cif_nif = "";
//            if ($user_type != 'Prueba') {
//                if (!empty($_POST["cif_nif"])) {
//                    if (cif_validation($_POST["cif_nif"])) {
//                        $cif_nif = $_POST["cif_nif"];
//                    } else {
//                        $_SESSION['status_msg'] = $BIZBOOK['CIF_NIF_NO_VALID'];
//                        if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
//                            header('Location: admin/admin-add-new-user.php');
//                            exit();
//                        } else {
//                            $_SESSION['register_status_msg'] = 1;
//                            header('Location: login?login=register');
//                            exit();
//                        }
//                    }
//                } else {
//                    if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
//                        $_SESSION['status_msg'] = $BIZBOOK['CIF_NIF_NO_VALID'];
//                        header('Location: admin/admin-add-new-user.php');
//                        exit();
//                    }
//                }
//            }
            
            if(!empty($_POST["mobile_number"])){
                if(validation_phone($_POST["mobile_number"])){
                    $mobile_number = $_POST["mobile_number"];
                }else{
                    $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
                    if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                        header('Location: admin/admin-add-new-user.php');
                        exit();
                    } else {
                        $_SESSION['register_status_msg'] = 1;
                        header('Location: login?login=register');
                        exit();
                    }
                }
            }else{
                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                    $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];
                    header('Location: admin/admin-add-new-user.php');
                    exit();
                }
            }
            
            if(!empty($_POST["email_id"])){
                if(validation_email($_POST["email_id"])){
                    $email_id = $_POST["email_id"];
                }else{
                    $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
                    if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                        header('Location: admin/admin-add-new-user.php');
                        exit();
                    } else {
                        $_SESSION['register_status_msg'] = 1;
                        header('Location: login?login=register');
                        exit();
                    }
                }
            }else{
                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                    $_SESSION['status_msg'] = $BIZBOOK['EMAIL_NO_VALID'];
                    header('Location: admin/admin-add-new-user.php');
                    exit();
                }
            }

            $password = $_POST["password"];

//                if (!empty($_POST["password"])) {
//                    $password = $_POST["password"];
//                } else {
//                    $_SESSION['status_msg'] = $BIZBOOK['PASSWORD_NO_VALID'];
//                    if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
//                        header('Location: admin/admin-add-new-user.php');
//                        exit();
//                    } else {
//                        $_SESSION['register_status_msg'] = 1;
//                        header('Location: login?login=register');
//                        exit();
//                    }
//                }

            $user_address = $_POST["user_address"];
            $user_state = $_POST["user_state"];
            $user_city = $_POST["user_city"];
            $user_zip_code = $_POST["user_zip_code"];
            $password_hash = password_hash($_POST["password"],HASH, ['cost' => COST]);



    //        if($user_type == "General"){
    //            $user_plan = '';
    //        }elseif($user_type == "Service provider"){
                $user_plan = 4;
    //        }
            $register_mode = "Direct";
            
            if($user_type === "Service provider"){
                $user_status = "Inactive";
            } else if($user_type === "Service provider store") {
                $user_status = "Inactive";
            }else if($user_type === 'Store'){
                $user_status = "Inactive";
            } else if($user_type === "General") {
                $user_status = "Active";
            } else if($user_type === 'Prueba'){
                $user_status = "Inactive";
            }

            $user_facebook= trim(htmlspecialchars($_POST["user_facebook"]));
            $user_twitter= trim(htmlspecialchars($_POST["user_twitter"]));
            $user_linkedin = trim(htmlspecialchars($_POST["user_linkedin"]));
            $user_instagram = trim(htmlspecialchars($_POST["user_instagram"]));
            $user_whatsapp = trim(htmlspecialchars($_POST["user_whatsapp"]));
            $user_website = trim(htmlspecialchars($_POST["user_website"]));

            if (!empty($_FILES['profile_image']['name'])) {
                $file = rand(1000, 100000) . $_FILES['profile_image']['name'];
                $file_loc = $_FILES['profile_image']['tmp_name'];
                $file_size = $_FILES['profile_image']['size'];
                $file_type = $_FILES['profile_image']['type'];
                $folder = "images/profile/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                move_uploaded_file($file_loc, $folder . $event_image);
                $profile_image = $event_image;
            }

            $user_slug = generar_texto_amigable($first_name);

            $user_name_exist_check = mysqli_query($conn, "SELECT user_id FROM " . TBL . "users WHERE user_slug = '$user_slug'");

            if (mysqli_num_rows($user_name_exist_check) > 0) {
                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {

                    $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

                    header('Location: admin/admin-add-new-user.php');
                    exit();
                } else {

                    $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];
                    $_SESSION['register_status_msg'] = 1;

                    header('Location: login?login=register');
                    exit();
                }
            }

    //************ Email Already Exist Check Starts ***************


            $email_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE email_id = '$email_id' ");


            if (mysqli_num_rows($email_exist_check) > 0) {


                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {

//                    $_SESSION['status_msg'] = $BIZBOOK['THE_EMAIL_EXIST'];
//
//                    header('Location: admin/admin-add-new-user.php');
//                    exit();
                } else {

                    $_SESSION['status_msg'] = $BIZBOOK['THE_EMAIL_EXIST'];
                    $_SESSION['register_status_msg'] = 1;

                    header('Location: login?login=register');
                    exit();
                }

            }

    //************ Email Already Exist Check Ends ***************

    //************ Mobile Number Already Exist Check Starts ***************


            $mobile_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE mobile_number = '$mobile_number' ");

            if (mysqli_num_rows($mobile_exist_check) > 0) {


                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {

//                    $_SESSION['status_msg'] = $BIZBOOK['THE_MOBILE_EXIST'];
//
//                    header('Location: admin/admin-add-new-user.php');
//                    exit();
                } else {

                    $_SESSION['status_msg'] = $BIZBOOK['THE_MOBILE_EXIST'];
                    $_SESSION['register_status_msg'] = 1;

                    header('Location: login?login=register');
                    exit();
                }

            }

    //************ Mobile Number Already Exist Check Ends ***************

            $curDate = date("Y-m-d H:i:s", time());

            $user_code = 'USER' . substr(sha1(time()), 0, 10);

            $qry = "INSERT INTO " . TBL . "users 
                                            (user_code, first_name, last_name, cif_nif, email_id, mobile_number, password, user_type, user_plan, register_mode, user_address, user_city, user_state, user_zip_code, profile_image
                                            , user_facebook, user_twitter, user_linkedin, user_instagram, user_whatsapp, user_website, user_slug, user_status, user_cdt) 
                                            VALUES ('$user_code', '$first_name', '$last_name', '$cif_nif', '$email_id', '$mobile_number', '$password_hash', '$user_type', '$user_plan', '$register_mode',
                                             '$user_address', '$user_city', '$user_state','$user_zip_code','$profile_image', '$user_facebook','$user_twitter', '$user_linkedin', '$user_instagram', '$user_whatsapp', '$user_website',
                                             '$user_slug','$user_status', '$curDate')";

            $res = mysqli_query($conn,$qry);
            $userID = mysqli_insert_id($conn);

            //****************************    Admin Primary email fetch starts    *************************

            $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
            $admin_address = $admin_primary_email_fetchrow['footer_address'];

            //****************************    Admin Primary email fetch ends    *************************

            if ($userID) {

                $admin_email = $admin_primary_email; // Admin Email Id

                $webpage_full_link_with_login = $webpage_full_link. "verification_user?row=".$user_code;  //URL Login Link

    //****************************    Admin email starts    *************************
                if($user_type == "Service provider" || $user_type == "Service provider store" || $user_type == "Stores"){
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
                                              WHERE user_id = $userID";

                    //echo $upqry; die();
                    $upres = mysqli_query($conn,$upqry);

                }

    //****************************    client email ends    *************************

                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                    $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];  // Success Message in session

                    header('Location: admin/admin-add-new-user.php');
                    exit();
                } else {

    //                $_SESSION['user_code'] = $userID;
    //                $_SESSION['user_name'] = $first_name;

     //               header("location: dashboard");
                    $_SESSION['status_msg'] = $BIZBOOK['REGISTER_WEB_SUCCESS'];  // Success Message in session
                    $_SESSION['register_status_msg'] = 1;

                    header('Location: login?login=register');
                    exit();
                }

            } else {


                if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
                    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                    header('Location: admin/admin-add-new-user.php');
                    exit();
                } else {
                    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
                    $_SESSION['register_status_msg'] = 1;

                    header('Location: login?login=register');
                    exit();
                }
            }
        }else{
            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            $_SESSION['register_status_msg'] = 1;

            header('Location: login?login=register');
            exit();
        }

    }
} else {


    if ($mode_path == "XeBaCk_MoDeX_PATHXHU") {
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin/admin-add-new-user.php');
        exit();
    } else {
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
        $_SESSION['register_status_msg'] = 1;

        header('Location: login?login=register');
        exit();
    }
}