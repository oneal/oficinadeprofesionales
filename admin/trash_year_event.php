<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['year_submit'])) {

        $year_id = $_POST['year_id'];
        $year_name = $_POST['year_name'];


        $year_qry =
            " DELETE FROM  " . TBL . "year_events  WHERE year_id='" . $year_id . "'";


        $year_res = mysqli_query($conn,$year_qry);


        if ($year_res) {

            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];
            header('Location: admin-year-event.php');
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            header('Location: admin-year-event-delete.php?row=' . $year_id);
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-year-event.php');
}