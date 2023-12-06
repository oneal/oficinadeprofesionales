<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['home_category_submit'])) {

        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category_image_old = $_POST['category_image_old'];
        $category_name_old = $_POST['category_name_old'];
        $category_status = "Active";



//************ Category Name Already Exist Check Starts ***************

        if($category_name != $category_name_old) {
            $category_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "top_categories  WHERE category_name='" . $category_name . "' ");


            if (mysqli_num_rows($category_name_exist_check) > 0) {


                $_SESSION['status_msg'] = "The Given Home Category name is Already Exist Try Other!!!";

                header('Location: admin-home-category-edit.php?row=' . $category_id);
                exit;


            }
        }

//************ Category Name Already Exist Check Ends ***************



        $_FILES['category_image']['name'];

        if (!empty($_FILES['category_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['category_image']['name'];
            $file_loc = $_FILES['category_image']['tmp_name'];
            $file_size = $_FILES['category_image']['size'];
            $file_type = $_FILES['category_image']['type'];
            $folder = "../images/services/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $category_image = $event_image;
        } else {
            $category_image = $category_image_old;
        }


        $sql = mysqli_query($conn,"UPDATE  " . TBL . "top_categories SET category_name='" . $category_name . "', category_status='" . $category_status. "'
     , category_image='" . $category_image . "'
     where category_id='" . $category_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-home-category.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-home-category-edit.php?row=' . $category_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-home-category.php');
    exit;
}
?>