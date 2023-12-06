<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['store_submit'])) {

        $store_id = $_POST["store_id"];

        $store_qry =
            "DELETE FROM  " . TBL . "stores where store_id='" . $store_id . "'";

        $store_res = mysqli_query($conn,$store_qry);

        if ($store_res) {
            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];
            header('Location: admin-all-stores.php');
            exit;

        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            header('Location: admin-all-stores.php');
            exit;
        }

        //    Listing Update Part Ends

    } else {
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-all-stores.php');
        exit;
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-stores.php');
    exit;
}