<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['state_submit'])) {

    $cnt = count($_POST['state_name']);

// *********** if Count of state name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-state.php');
        exit;
    }

// *********** if Count of state name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $state_name = $_POST['state_name'][$i];


//************ state Name Already Exist Check Starts ***************

        $state_slug = generar_texto_amigable($state_name);
        $state_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "states  WHERE state_slug='" . $state_slug . "' ");

        if (mysqli_num_rows($state_name_exist_check) > 0) {

            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-new-state.php');
            exit;
        }

        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "states (state_name,country_id,state_slug)
                        VALUES ('$state_name' , 1, '$state_slug')");
    }


    if ($sql) {

        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];


        header('Location: admin-all-state.php');
        exit;

    } else {


        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-add-state.php');
        exit;
    }

}
?>