<?php 
/**
 * Created by Vignesh.
 * User: Vignesh
 */
/*
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


            $_SESSION['status_msg'] = "Event has been Deleted Successfully!!!";

            header('Location: db-events');

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: db-events');
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: dashboard');
}