<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['year_submit'])) {

    $cnt = count($_POST['year_name']);

    $curDate = date("Y-m-d H:i:s", time());

// *********** if Count of category name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-new-year-event.php');
        exit;
    }

// *********** if Count of category name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $year_name_a = $_POST['year_name'][$i];

        $year_name = trim(strip_tags(htmlentities($year_name_a,ENT_DISALLOWED, 'UTF-8')));

        $year_filter_pos_id = 1;


//************ Category Name Already Exist Check Starts ***************

        $year_slug = generar_texto_amigable($year_name_a);

        $year_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "year_events  WHERE year_slug='" . $year_slug . "' ");

        if (mysqli_num_rows($year_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-new-year-event.php');
            exit;
        }


        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "year_events (year_name,year_slug,year_cdt)
                VALUES ('$year_name','$year_slug','$curDate')");

        $LID = mysqli_insert_id($conn);

    }

    if ($LID) {

        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];
        header('Location: admin-year-event.php');
        exit;

    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-add-new-year-event.php');
        exit;
    }

}
?>