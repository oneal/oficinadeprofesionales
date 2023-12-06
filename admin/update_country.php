<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['country_submit'])) {

        $country_id = $_POST['country_id'];
        $country_name = $_POST['country_name'];


//************ country Name Already Exist Check Starts ***************


        $country_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "countries  WHERE country_name='" . $country_name . "' AND country_id != $country_id ");

        if (mysqli_num_rows($country_name_exist_check) > 0) {


            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-country-edit.php?row=' . $country_id);
            exit;


        }

        $sql = mysqli_query($conn,"UPDATE  " . TBL . "countries SET country_name='" . $country_name . "'
     where country_id='" . $country_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-all-country.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-country-edit.php?row=' . $country_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-country.php');
    exit;
}
?>