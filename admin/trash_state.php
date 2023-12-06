<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['state_submit'])) {

        $state_id = $_POST['state_id'];
        $state_name = $_POST['state_name'];


        $state_qry =
            " DELETE FROM  " . TBL . "states  WHERE state_id='" . $state_id . "'";


        $state_res = mysqli_query($conn,$state_qry);


        if ($state_res) {

            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];


            header('Location: admin-all-state.php');
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-state-delete.php?row=' . $state_id);
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-state.php');
}