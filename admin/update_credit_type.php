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
        $credit_name = $_POST['credit_name'];
        $credit_price = $_POST['credit_price'];
        $credit_points = $_POST['credit_points'];
        $credit_status = "Active";
        

        $sql = mysqli_query($conn,"UPDATE  " . TBL . "credits SET credit_name='" . $credit_name . "', credit_price='" . $credit_price. "'
     , credit_points='" . $credit_points . "', credit_status='" . $credit_status . "'
     where credit_id='" . $credit_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-credit.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-credit-edit.php?row=' . $credit_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-price.php');
    exit;
}
?>