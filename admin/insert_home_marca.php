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

        if(isset($_POST['marca_name']) and $_POST['marca_name'] == "") {
            $_SESSION['status_msg'] = $BIZBOOK['NAME_IS_REQUIRED'];
            header('Location: admin-add-new-home-marca.php');
            exit;
        }
        $marca_name = $_POST['marca_name'];
        $marca_descripcion = addslashes($_POST['marca_descripcion']);

//************ Category Name Already Exist Check Starts ***************

        $marca_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "marcas  WHERE marca_name='" . $marca_name."'");

        if (mysqli_num_rows($marca_name_exist_check) > 0) {
            $row = mysqli_fetch_array($marca_name_exist_check);
            $_SESSION['status_msg'] = "La marca ya existe, prueba con otra!!!";
            header('Location: admin-home-marca-sector-edit.php?row=' . $row['marca_id']);
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
        }

        $curDate = date("Y-m-d H:i:s", time());

        $marca_qry = "INSERT INTO " . TBL . "marcas 
					(marca_name, marca_descripcion, marca_image, marca_cdt) 
					VALUES 
					('$marca_name', '$marca_descripcion', '$marca_image', '$curDate')";

        $marca_id = mysqli_query($conn, $marca_qry);

        if ($marca_id) {

            $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];
            header('Location: admin-home-marcas-sector.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            header('Location: admin-home-marcas-sector.php?row=' . $marca_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
    header('Location: admin-home-marcas-sector.php');
    exit;
}
?>