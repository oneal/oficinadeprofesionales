<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['city_submit'])) {

        $city_id = $_POST['city_id'];
        $state_id = $_POST['state_id'];
        $city_name = $_POST['city_name'];


//************ city Name Already Exist Check Starts ***************

        $city_slug = generar_texto_amigable($city_name);
        $city_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "cities  WHERE city_slug='" . $city_slug . "' AND city_id != $city_id AND state_id != $state_id ");

        if (mysqli_num_rows($city_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-city-edit.php?row=' . $city_id);
            exit;
        }

//************ city Name Already Exist Check Ends ***************



        $_FILES['city_image']['name'];

        if (!empty($_FILES['city_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['city_image']['name'];
            $file_loc = $_FILES['city_image']['tmp_name'];
            $file_size = $_FILES['city_image']['size'];
            $file_type = $_FILES['city_image']['type'];
            $folder = "../images/services/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $city_image = $event_image;
        } else {
            $city_image = $city_image_old;
        }

        $sql = mysqli_query($conn,"UPDATE " . TBL . "cities SET city_name='" . $city_name . "', city_slug='".$city_slug."' where city_id='" . $city_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

            header('Location: admin-all-city.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-city-edit.php?row=' . $city_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-city.php');
    exit;
}
?>