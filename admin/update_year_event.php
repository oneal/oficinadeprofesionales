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

        $year_name_a = $_POST['year_name'];

        $year_name = trim(strip_tags(htmlentities($year_name_a, ENT_DISALLOWED, 'UTF-8')));


        //************ Category Name Already Exist Check Starts ***************

        $year_slug = generar_texto_amigable($year_name_a);

        $year_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "year_events  WHERE  year_slug='" . $year_slug . "' AND year_id != $year_id ");

        if (mysqli_num_rows($year_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-year-event-edit.php?row=' . $year_id);
            exit;
        }

        $sql = mysqli_query($conn, "UPDATE  " . TBL . "year_events SET year_name='" . $year_name . "'
         , year_slug = '" . $year_slug . "' where year_id='" . $year_id . "'");

        if ($sql) {
            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];
            header('Location: admin-year-event.php');
            exit;
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            header('Location: admin-year-event-edit.php?row=' . $year_id);
            exit;
        }
    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
        header('Location: admin-year-event.php');
        exit;
    }
}
?>