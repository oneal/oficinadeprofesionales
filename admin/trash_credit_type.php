<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['credit_submit'])) {

        $credit_id = $_POST['credit_id'];


        $credit_qry =
            " DELETE FROM  " . TBL . "credits  WHERE credit_id='" . $credit_id . "'";


        $credit_res = mysqli_query($conn,$credit_qry);


        if ($credit_res) {

            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];


            header('Location: admin-credit.php');
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-credit-delete.php?row=' . $credit_id);
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-credit.php');
}