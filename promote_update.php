<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['create_promote_submit'])) {


        $user_id = $_SESSION['user_id']; //Session data

        $listing_id = $_POST["type_id"];

        $frequency = $_POST["frequency"];

        $frequency_type = $_POST["t-p"];
        
        $curDate = date("Y-m-d H:i:s", time());
                
        $listing_row = getIdListing($listing_id);
        $listing_code = $listing_row['listing_code'];
        
        if($_POST["frequency_time"]==""){
            $_SESSION['status_msg'] = "Debes seleccionar un tipo de frecuencia";

            header('Location: promote_now?code='.$listing_code.'&type=listing');
            exit;
        }

        if($frequency == 1){
            $credit_frequency = 0;
        } else if($frequency == 2){
            if($_POST["frequency_time"] == NULL){
                $credit_frequency = 1;
            }else{
                $credit_frequency = $_POST["frequency_time"];
            }
        }

        $user_credit = $_POST["type_value"];

        $new_user_credit = $user_credit - 1;

        $traupqry = "UPDATE " . TBL . "users 
					  SET user_credit = $new_user_credit
					  ,credit_frequency = $credit_frequency
					  WHERE user_id = $user_id";

        $traupres = mysqli_query($conn, $traupqry);

        $upqry = "UPDATE " . TBL . "listings 
					  SET listing_cdt = '$curDate'
					  ,credit_frequency = $credit_frequency
                                          ,frequency_type = $frequency_type
					  WHERE listing_id = $listing_id";

        $upres = mysqli_query($conn, $upqry);


        if ($upres) {

            $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

            header('Location: db-all-listing');
            exit();
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: promote_now?code='.$listing_code.'&type=listing');
            exit;
        }

    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: promote_now?code='.$listing_code.'&type=listing');
        exit;
    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: promote_now?code='.$listing_code.'&type=listing');
    exit;
}
?>