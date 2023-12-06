<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['event_submit'])) {

        $event_id = $_POST["event_id"];

        $event_qry =
            "DELETE FROM  " . TBL . "events  where event_id='" . $event_id . "'";


        $event_res = mysqli_query($conn,$event_qry);


        if ($event_res) {


            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];

            header('Location: admin-event.php');

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-event.php');
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-event.php');
}