<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['edit_slider_submit'])) {


        $slider_id = $_POST['slider_id'];
        $slider_photo_old = $_POST['slider_photo_old'];


        $slider_link = addslashes($_POST["slider_link"]);


        $_FILES['slider_photo']['name'];

        if (!empty($_FILES['slider_photo']['name'])) {
            $file = rand(1000, 100000) . $_FILES['slider_photo']['name'];
            $file_loc = $_FILES['slider_photo']['tmp_name'];
            $file_size = $_FILES['slider_photo']['size'];
            $file_type = $_FILES['slider_photo']['type'];
            $folder = "../images/slider/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $slider_photo = $event_image;
        } else {
            $slider_photo = $slider_photo_old;
        }


        $sql = mysqli_query($conn, "UPDATE  " . TBL . "slider SET  slider_photo='" . $slider_photo . "' , slider_link ='" . $slider_link . "'
     where slider_id='" . $slider_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


                header('Location: admin-slider-all.php');
                exit;


        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-slider-edit.php?row=' . $slider_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-slider-all.php');
    exit;
}
?>