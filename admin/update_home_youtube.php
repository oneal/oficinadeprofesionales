<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['home_youtube'])) {


        $admin_home_youtube = $_POST['admin_home_youtube'];
        $footer_id = $_POST['footer_id'];


            $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET  admin_home_youtube='" . $admin_home_youtube. "'  
        where footer_id='" . $footer_id . "'");


        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-home-youtube-video.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-home-youtube-video.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-home-youtube-video.php');
    exit;
}
?>