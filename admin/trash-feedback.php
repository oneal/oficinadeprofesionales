<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if(isset($_GET['trashfeedbacktrashfeedbacktrashfeedbacktrashfeedbacktrashfeedback'])){

    $message_id = $_GET['trashfeedbacktrashfeedbacktrashfeedbacktrashfeedbacktrashfeedback'];


    $listing_qry =
        "DELETE  FROM " . TBL . "messages  where message_id ='" . $message_id . "'";

    $listing_res = mysqli_query($conn,$listing_qry);



    if ($listing_res) {

        $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];

        header('Location: admin-all-feedbacks.php');
    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-all-feedbacks.php');
    }


}else{
    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
    
    header('Location: admin-all-feedbacks.php');
    exit();
}