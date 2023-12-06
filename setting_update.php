<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['setting_update_submit'])) {


        $user_code = $_SESSION['user_code']; //Session User Code
        $user_id = $_SESSION['user_id']; //Session User Code

        // $first_name = $_POST["first_name"];
        $setting_user_status = $_POST["setting_user_status"];
        $setting_review = $_POST["setting_review"];
        $setting_share = $_POST["setting_share"];
        $setting_profile_show = $_POST["setting_profile_show"];
        $setting_guarantee_show = 0;

        if ($setting_user_status == 2) {

            //Delete user from user table
            $user_sql =
                " DELETE FROM  " . TBL . "users  WHERE user_id='" . $user_id . "'";

            $user_sql_res = mysqli_query($conn,$user_sql);


            //Delete user listings from listing table

            $list =
                " DELETE FROM  " . TBL . "listings  WHERE user_id='" . $user_id . "'";

            $list_res = mysqli_query($conn,$list);

            //Delete user products from product table

            $product =
                " DELETE FROM  " . TBL . "products  WHERE user_id='" . $user_id . "'";

            $product_res = mysqli_query($conn,$product);


            
            if($user_sql_res){
                
                header('Location: logout');
                exit;
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                header('Location: db-setting');
                exit;
            }

        } else {


            $sql = mysqli_query($conn, "UPDATE  " . TBL . "users SET  setting_user_status='" . $setting_user_status . "'
     ,setting_review='" . $setting_review . "', setting_share='" . $setting_share . "', setting_profile_show='" . $setting_profile_show . "'
     ,setting_guarantee_show='" . $setting_guarantee_show . "'
     where user_code='" . $user_code . "'");
            
            if ($sql) {

                $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


                header('Location: db-setting');
                exit;

            } else {
                $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                header('Location: db-setting');
                exit;
            }

        }
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: db-setting');
    exit;
}
?>