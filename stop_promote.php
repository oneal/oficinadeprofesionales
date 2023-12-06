<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}


        $user_id = $_SESSION['user_id']; //Session data

        $listing_code = $_GET["code"];

        $frequency = 0;


        $traupqry = "UPDATE " . TBL . "users 
					  SET credit_frequency = $frequency
					  WHERE user_id = $user_id";

        $traupres = mysqli_query($conn, $traupqry);

        $upqry = "UPDATE " . TBL . "listings 
					  SET credit_frequency = $frequency
					  WHERE listing_code = '$listing_code'";

        $upres = mysqli_query($conn, $upqry);


        if ($upres) {

            $_SESSION['status_msg'] = $BIZBOOK['AUTO_PROMOTION_SUCCESS'];

            header('Location: db-all-listing');
            exit();
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: db-all-listing');
            exit;
        }

