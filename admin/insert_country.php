<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['country_submit'])) {

    $cnt = count($_POST['country_name']);

// *********** if Count of country name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-country.php');
        exit;
    }

// *********** if Count of country name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $country_name = $_POST['country_name'][$i];


//************ country Name Already Exist Check Starts ***************


        $country_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "countries  WHERE country_name='" . $country_name . "' ");

        if (mysqli_num_rows($country_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-new-country.php');
            exit;
        }

        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "countries (country_name)
VALUES ('$country_name')");
    }


    if ($sql) {

        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];


        header('Location: admin-all-country.php');
        exit;

    } else {


        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-add-country.php');
        exit;
    }

}
?>