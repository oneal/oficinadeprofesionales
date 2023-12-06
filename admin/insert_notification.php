<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['notification_submit'])) {


        $notification_title = $_POST["notification_title"];
        $notification_message = $_POST["notification_message"];
        $notification_link = $_POST["notification_link"];
        $notification_cdt = $_POST["notification_cdt"];
        $notification_user = $_POST["notification_user"];

        $curDate = date("Y-m-d H:i:s", time());
        
        $qry = "INSERT INTO " . TBL . "notifications 
					(notification_title,notification_user, notification_message, notification_link, notification_cdt) 
					VALUES ('$notification_title', '$notification_user', '$notification_message', '$notification_link', '$curDate')";

        $res = mysqli_query($conn,$qry);

        if ($res) {

            $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];


            header('Location: admin-notification-all.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-create-notification.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-notifications.php');
    exit;
}
?>