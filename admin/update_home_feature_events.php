<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['top_event_submit'])) {

        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $event_image_old = $_POST['event_image_old'];
        $event_name_old = $_POST['event_name_old'];
        $event_pos_id = $_POST['event_pos_id'];
        $event_status = "Active";



//************ event Name Already Exist Check Starts ***************

        if($event_name != $event_name_old) {
            $event_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "top_events  WHERE event_name='" . $event_name . "' ");


            if (mysqli_num_rows($event_name_exist_check) > 0) {


                $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

                header('Location: admin-home-event-edit.php?row=' . $event_id);
                exit;


            }
        }

//************ event Name Already Exist Check Ends ***************



        $_FILES['event_image']['name'];

        if (!empty($_FILES['event_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['event_image']['name'];
            $file_loc = $_FILES['event_image']['tmp_name'];
            $file_size = $_FILES['event_image']['size'];
            $file_type = $_FILES['event_image']['type'];
            $folder = "../images/services/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $event_image = $event_image;
        } else {
            $event_image = $event_image_old;
        }


        $sql = mysqli_query($conn,"UPDATE  " . TBL . "top_events SET event_name='" . $event_name . "', event_status='" . $event_status. "'
     , event_image='" . $event_image . "' , event_pos_id='" . $event_pos_id . "' 
     where event_id='" . $event_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];


            header('Location: admin-home-feature-events.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-home-feature-events-edit.php?row=' . $event_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-home-event.php');
    exit;
}
?>