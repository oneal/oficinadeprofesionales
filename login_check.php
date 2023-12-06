<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login_submit'])) {
        
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
    
            $email_id = mysqli_real_escape_string($conn,$_POST["email_id"]);
            $password = mysqli_real_escape_string($conn,$_POST["password"]);
            
            $login = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE email_id = '$email_id' AND user_type = 'Service provider' AND user_status = 'Active'");
            //$login = mysqli_query($conn,"SELECT * FROM " . TBL . "users  WHERE email_id = '$email_id'");

            if (mysqli_num_rows($login) > 0) {
                $login_row = mysqli_fetch_array($login);

                if (password_verify($password,$login_row['password'])) {
                    $user_code = $login_row['user_code'];
                    $user_name = $login_row['first_name'];
                    $user_id = $login_row['user_id'];
                    $_SESSION['user_code'] = $user_code;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_id'] = $user_id;

                    $userID = $login_row['user_code'];
                    if (password_needs_rehash($login_row['password'], HASH , ['cost' => COST])) {
                        $newHash = password_hash($password, HASH, ['cost' => COST]);
                        $upqry = "UPDATE " . TBL . "users 
					  SET password = '$newHash' 
					  WHERE user_code = $userID";
                        
                        $upres = mysqli_query($conn,$upqry);
                    }
                    
                    header("location: dashboard");
                } else {
                    $_SESSION['status_msg'] = $BIZBOOK['YOUR_PASSWORD_IS_WRONG'];
                    $_SESSION['login_status_msg'] = 1;

                    header("location: login");
                }
            } else {

                $_SESSION['status_msg'] = $BIZBOOK['YOUR_EMAIL_IS_WRONG'];
                $_SESSION['login_status_msg'] = 1;

                header("location: login");
            }
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            $_SESSION['login_status_msg'] = 1;

            header('Location: login');
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
    $_SESSION['login_status_msg'] = 1;

    header('Location: login');
}