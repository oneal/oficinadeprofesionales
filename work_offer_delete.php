<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['work_offer_submit'])) {

        $work_offer_id = $_POST["work_offer_id"];

        $work_offer_qry =
            "DELETE FROM  " . TBL . "work_offers where work_offer_id='" . $work_offer_id . "'";

        $work_offer_res = mysqli_query($conn,$work_offer_qry);

        if ($work_offer_res) {
            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];
            header('Location: db-work-offers');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: db-work-offers');
            exit;
        }

        //    Listing Update Part Ends

    } else {
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: dashboard');
        exit;
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: dashboard');
    exit;
}