<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['user_dummy_image_submit'])) {
        

        $footer_id = $_POST['footer_id'];
        $user_default_image_old = $_POST['user_default_image_old'];



        $_FILES['user_default_image']['name'];

        if (!empty($_FILES['user_default_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['user_default_image']['name'];
            $file_loc = $_FILES['user_default_image']['tmp_name'];
            $file_size = $_FILES['user_default_image']['size'];
            $file_type = $_FILES['user_default_image']['type'];
            $folder = "../images/user/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $user_default_image = $event_image;
        } else {
            $user_default_image = $user_default_image_old;
        }

       

        $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET user_default_image='" . $user_default_image. "'
     where footer_id='" . $footer_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-dummy-images.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-dummy-images.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-dummy-images.php');
    exit;
}
?>