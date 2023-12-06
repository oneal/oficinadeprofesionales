<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['home_marca_submit'])) {

        $marca_id = $_POST["marca_id"];

        $marca_qry =
            "DELETE FROM  " . TBL . "marcas where marca_id='" . $marca_id . "'";

        $marca_res = mysqli_query($conn,$marca_qry);

        if ($marca_res) {
            $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];
            header('Location: admin-home-marcas-sector.php');
            exit;

        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            header('Location: admin-home-marcas-sector.php');
            exit;
        }

        //    Listing Update Part Ends

    } else {
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-home-marcas-sector.php');
        exit;
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-stores.php');
    exit;
}