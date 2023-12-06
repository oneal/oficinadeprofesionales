<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['sub_category_submit'])) {


        $sub_category_id = $_POST['sub_category_id'];
        $sub_category_name = $_POST['sub_category_name'];
        $sub_category_image_old = $_POST['sub_category_image_old'];
        $category_id = $_POST['category_id'];
        $sub_category_status = "Active";



//************ Category Name Already Exist Check Starts ***************


        $sub_category_name_exist_check = mysqli_query($conn,"SELECT * FROM " . TBL . "sub_categories  WHERE sub_category_name='" . $sub_category_name . "' AND sub_category_id != $sub_category_id ");

        if (mysqli_num_rows($sub_category_name_exist_check) > 0) {


            $_SESSION['status_msg'] = "The Given Sub Category name is Already Exist Try Other!!!";

            header('Location: admin-sub-category-edit.php?row=' . $sub_category_id);
            exit;


        }

//************ Category Name Already Exist Check Ends ***************



        $_FILES['sub_category_image']['name'];

        if (!empty($_FILES['sub_category_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['sub_category_image']['name'];
            $file_loc = $_FILES['sub_category_image']['tmp_name'];
            $file_size = $_FILES['sub_category_image']['size'];
            $file_type = $_FILES['sub_category_image']['type'];
            $folder = "../images/services/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $sub_category_image = $event_image;
        } else {
            $sub_category_image = $sub_category_image_old;
        }


        $sql = mysqli_query($conn,"UPDATE  " . TBL . "sub_categories SET sub_category_name='" . $sub_category_name . "', sub_category_status='" . $sub_category_status. "'
     , category_id='" . $category_id . "'
     where sub_category_id='" . $sub_category_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = "Sub Category has been Updated Successfully!!!";


            header('Location: admin-all-sub-category.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-sub-category-edit.php?row=' . $sub_category_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-all-sub-category.php');
    exit;
}
?>