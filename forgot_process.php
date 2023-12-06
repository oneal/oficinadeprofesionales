<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['forgot_submit'])) {


        $response = null;
        // comprueba la clave secreta
        $reCaptcha = new ReCaptcha(SECRET_RECAPTCHA);

        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );
        }

        if ($response != null && $response->success) {
            
            $email_id = $_POST['email_id'];

            $forgot = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE email_id = '$email_id' ");

            if (mysqli_num_rows($forgot) > 0) {

                function randomPassword() {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890@-*/,.+@}{[]';
                    $pass = array();
                    $alphaLength = strlen($alphabet) - 1;
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    return implode($pass);
                }

                $forgot_row = mysqli_fetch_array($forgot);

    //            $password = $forgot_row['password'];
               $user_id = $forgot_row['user_id'];

                $password = randomPassword();    //New Password
                $password_hash = password_hash($password, HASH, ['cost' => COST]);

                $sql = mysqli_query($conn, "UPDATE  " . TBL . "users SET password='" . $password_hash . "' where user_id='" . $user_id . "'");

                $rec_email_id = $forgot_row['email_id'];
                $user_name = $forgot_row['first_name'];

                //****************************    Admin Primary email fetch starts    *************************

                $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = 1 ");
                $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
                $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
                $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
                $admin_site_name = $admin_primary_email_fetchrow['website_address'];
                $admin_address = $admin_primary_email_fetchrow['footer_address'];

                //****************************    Admin Primary email fetch ends    *************************


                $sender_email_id = $admin_primary_email; // Admin Email Id

                $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link

                $to = $rec_email_id;
                $subject = $admin_site_name.' - '.$BIZBOOK['FORGET_PASSWORD'];


                    $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 5 "); //User mail template fetch
                $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

                $mail_template_client = $client_sql_fetch_row['mail_template'];

                $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
                $message =   stripslashes(str_replace(array('\' . $admin_site_name . \'', '\' . $rec_email_id . \'', '\' . $email_id . \'', '\' . $password . \'','\' . $logo . \''),
                    array('' . $admin_site_name . '', '' . $rec_email_id . '', '' . $email_id . '', '' . $password . '','' . $logo . ''), $mail_template_client));


                $headers = "From: " . "$sender_email_id" . "\r\n";
                $headers .= "Reply-To: " . "$sender_email_id" . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=utf-8\r\n";


                if (mail($to, $subject, $message, $headers)) {

                    $_SESSION['status_msg'] = $BIZBOOK['YOUR_PASSWORD_HAS_BEEN_SUCCES'];
                    $_SESSION['forgot_status_msg'] = 1;

                    header('Location: login?login=forgot');
                    exit;
                } else {
                    $_SESSION['status_msg'] = $BIZBOOK['YOUR_PASSWORD_HAS_BEEN_SUCCES'];
                    $_SESSION['forgot_status_msg'] = 1;

                    header('Location: login?login=forgot');
                    exit;
                }

            } else {
                $_SESSION['status_msg'] = $BIZBOOK['GIVEN_MAIL_NO_REGISTER'];
                $_SESSION['forgot_status_msg'] = 1;

                header('Location: login?login=forgot');
                exit;
            }
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];;
            $_SESSION['forgot_status_msg'] = 1;

            header('Location: login?login=forgot');
            exit;
        }    
    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];;
        $_SESSION['forgot_status_msg'] = 1;

        header('Location: login?login=forgot');
        exit;
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
    $_SESSION['forgot_status_msg'] = 1;

    header('Location: login?login=forgot');
    exit;
}