<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['category_submit'])) {

    $category_id = $_POST['category_id'];
    $category_name_a = $_POST['category_name'];
    $category_name = trim(strip_tags(htmlentities($_POST['category_name'],ENT_DISALLOWED, 'UTF-8')));
    $category_image_old = $_POST['category_image_old'];
    $category_status = "Active";



//************ Category Name Already Exist Check Starts ***************

    $category_slug = generar_texto_amigable($category_name_a);
    $category_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "categories  WHERE  category_slug='" . $category_slug . "' AND category_id != $category_id ");

    if (mysqli_num_rows($category_name_exist_check) > 0) {
        $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

        header('Location: admin-category-edit.php?row=' . $category_id);
        exit;
    }

//************ Category Name Already Exist Check Ends ***************
    
    

    $_FILES['category_image']['name'];

    if (!empty($_FILES['category_image']['name'])) {
        $file = generar_texto_amigable_img($_FILES['category_image']['name']);
        $file_loc = $_FILES['category_image']['tmp_name'];
        $file_size = $_FILES['category_image']['size'];
        $file_type = $_FILES['category_image']['type'];
        $folder = "../images/services/";
        $new_size = $file_size / 1024;
        $event_image = $file;
        move_uploaded_file($file_loc, $folder . $event_image);
        $category_image = $event_image;
    } else {
        $category_image = $category_image_old;
    }


    $sql = mysqli_query($conn,"UPDATE  " . TBL . "categories SET category_name='" . $category_name . "', category_status='" . $category_status. "'
     , category_image='" . $category_image . "', category_slug = '".$category_slug."' where category_id='" . $category_id . "'");

    if ($sql) {

        $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


        header('Location: admin-all-category.php');
        exit;
        
    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
        
        header('Location: admin-category-edit.php?row=' . $category_id);
        exit;
    }

}
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-category.php');
    exit;
}
?>