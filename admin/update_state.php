<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['state_submit'])) {

        $state_id = $_POST['state_id'];
        $state_name = $_POST['state_name'];


//************ state Name Already Exist Check Starts ***************

        $state_slug = generar_texto_amigable($state_name);

        $state_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "states  WHERE state_slug='" . $state_slug . "' AND state_id != $state_id ");

        if (mysqli_num_rows($state_name_exist_check) > 0) {

            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-state-edit.php?row=' . $state_id);
            exit;
        }
        
        $sql = mysqli_query($conn,"UPDATE  " . TBL . "states SET state_name='". $state_name ."', state_slug='".$state_slug."'
                where state_id='" . $state_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-all-state.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-state-edit.php?row=' . $state_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-state.php');
    exit;
}
?>