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

        $marca_id = $_POST['marca_id'];
        if(isset($_POST['marca_name']) and $_POST['marca_name'] == "") {
            $_SESSION['status_msg'] = $BIZBOOK['NAME_IS_REQUIRED'];
            header('Location: admin-home-marca-sector-edit.php?row=' . $marca_id);
            exit;
        }
        $marca_name = $_POST['marca_name'];
        $marca_descripcion = $_POST['marca_descripcion'];
        $marca_image_old = $_POST['marca_image_old'];

//************ Category Name Already Exist Check Starts ***************

        $marca_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "marcas  WHERE marca_name='" . $marca_name . "' and marca_id != ".$marca_id);

        if (mysqli_num_rows($marca_name_exist_check) > 0) {
            $_SESSION['status_msg'] = "The Given Home Category name is Already Exist Try Other!!!";

            header('Location: admin-home-marca-sector-edit.php?row=' . $marca_id);
            exit;
        }


//************ Category Name Already Exist Check Ends ***************

        $_FILES['marca_image']['name'];

        if (!empty($_FILES['marca_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['marca_image']['name']);
            $file_loc = $_FILES['marca_image']['tmp_name'];
            $file_size = $_FILES['marca_image']['size'];
            $file_type = $_FILES['marca_image']['type'];
            $folder = "../images/services/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $marca_image = $event_image;
        } else {
            $marca_image = $marca_image_old;
        }

        $sql = mysqli_query($conn,"UPDATE  " . TBL . "marcas SET marca_name='" . $marca_name . "', marca_image='" . $marca_image . "', marca_descripcion = '". $marca_descripcion . "'
     where marca_id='" . $marca_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-home-marcas-sector.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-home-marca-sector-edit.php?row=' . $marca_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-home-marcas-sector.php');
    exit;
}
?>