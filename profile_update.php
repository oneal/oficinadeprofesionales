<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['profile_update_submit'])) {


        $user_code = $_SESSION['user_code']; //Session User Code

//        $first_name = $_POST["first_name"];
//        $last_name = trim(strip_tags(htmlspecialchars($_POST["last_name"])));
//        $mobile_number = trim(strip_tags(htmlspecialchars($_POST["mobile_number"])));
        
        $email_id = trim(strip_tags(htmlspecialchars($_POST["email_id"])));
        
        $user_email_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "users WHERE user_code != '" . $user_code . "' and email_id='" . $email_id . "'");

        if (mysqli_num_rows($user_email_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['THE_EMAIL_EXIST'];

            header('Location: db-my-profile-edit');
            exit;
        } 
//        $date_of_birth = trim(strip_tags(htmlspecialchars($_POST["date_of_birth"])));
        
        $first_name = trim(strip_tags(htmlspecialchars($_POST["first_name"])));
        $last_name = trim(strip_tags(htmlspecialchars($_POST["last_name"])));

        if (!empty($_POST["cif_nif"])) {
            if (cif_validation($_POST["cif_nif"])) {
                $cif_nif = $_POST["cif_nif"];
            } else {
                $_SESSION['status_msg'] = $BIZBOOK['CIF_NIF_NO_VALID'];
                header('Location: db-my-profile-edit');
                exit;
            }
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['CIF_NIF_NO_VALID'];
            header('Location: db-my-profile-edit');
            exit;
        }

        if(!empty($_POST["mobile_number"])){
            if(validation_phone($_POST["mobile_number"])){
                $mobile_number = trim(strip_tags(htmlspecialchars($_POST["mobile_number"])));
            }else{
               $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];

                header('Location: db-my-profile-edit');
                exit; 
            }
        }else{
            $_SESSION['status_msg'] = $BIZBOOK['PHONE_NO_VALID'];

            header('Location: db-my-profile-edit');
            exit;
        }   
        
        $user_address = trim(strip_tags(htmlspecialchars($_POST["user_address"])));
        $user_state = trim(strip_tags(htmlspecialchars($_POST["user_state"])));
        $user_city = trim(strip_tags(htmlspecialchars($_POST["user_city"])));
        $user_zip_code = trim(strip_tags(htmlspecialchars($_POST["user_zip_code"])));

        $user_details_row = getUser($_SESSION['user_id']);
        //$password_old= $_POST["password_old"];

        if($_POST["password"] != NULL){
            $password = password_hash($_POST["password"],HASH, ['cost' => COST]);
        }else{
            $password = $user_details_row['password'];
        }

        $user_facebook= trim(htmlspecialchars($_POST["user_facebook"]));
        $user_twitter= trim(htmlspecialchars($_POST["user_twitter"]));
        $user_linkedin = trim(htmlspecialchars($_POST["user_linkedin"]));
        $user_instagram = trim(htmlspecialchars($_POST["user_instagram"]));
        $user_whatsapp = trim(htmlspecialchars($_POST["user_whatsapp"]));
        $user_website = trim(htmlspecialchars($_POST["user_website"]));

        $profile_image_old= $_POST["profile_image_old"];


        $_FILES['profile_image']['name'];

        if (!empty($_FILES['profile_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['profile_image']['name']);
            $file_loc = $_FILES['profile_image']['tmp_name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_type = $_FILES['profile_image']['type'];
            $folder = "images/user/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $profile_image = $event_image;
        } else {
            $profile_image = $profile_image_old;
        }
        

        function checkUserSlug($link,$user_id, $counter=1){
            global $conn;
            $newLink = $link;
            do{
                $checkLink = mysqli_query($conn, "SELECT user_id FROM " . TBL . "users WHERE user_slug = '$newLink' AND user_id != '$user_id'");
                if(mysqli_num_rows($checkLink) > 0){
                    $newLink = $link.''.$counter;
                    $counter++;
                } else {
                    break;
                }
            } while(1);

            return $newLink;
        }

        $first_name1 = generar_texto_amigable($first_name);
        $user_slug = checkUserSlug($first_name1,$user_id);

        $sql = mysqli_query($conn,"UPDATE  " . TBL . "users SET  first_name='" . $first_name. "', last_name='" . $last_name. "', cif_nif='" . $cif_nif. "', email_id='" . $email_id . "', user_address='" . $user_address. "'
     ,user_city='" . $user_city . "', user_state='" . $user_state. "', user_zip_code='" . $user_zip_code. "', profile_image='" . $profile_image . "'
     ,password='" . $password . "', user_facebook='" . $user_facebook. "', user_twitter='" . $user_twitter . "'
     ,user_linkedin='" . $user_linkedin . "',user_instagram='" . $user_instagram . "',user_whatsapp='" . $user_whatsapp . "', user_website='" . $user_website. "'
     , mobile_number='" . $mobile_number . "'
     , user_slug='" . $user_slug . "'
     where user_code='" . $user_code . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: db-my-profile');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: db-my-profile-edit');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: db-my-profile');
    exit;
}
?>