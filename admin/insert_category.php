<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['category_submit'])) {

    $cnt = count($_POST['category_name']);
    $cnt2 = count($_POST['category_image']);
    
    $curDate = date("Y-m-d H:i:s", time());

// *********** if Count of category name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-new-category.php');
        exit;
    }

// *********** if Count of category name is zero means redirect ends ********

        for ($i = 0; $i < $cnt; $i++) {

            $category_name_a = $_POST['category_name'][$i];

            $category_name = trim(strip_tags(htmlentities($_POST['category_name'][$i],ENT_DISALLOWED, 'UTF-8')));

            $category_status = "Active";

            $category_filter_pos_id = 1;


//************ Category Name Already Exist Check Starts ***************

            $category_slug = generar_texto_amigable($category_name_a);
        
            $category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "categories  WHERE category_slug='" . $category_slug . "' ");

            if (mysqli_num_rows($category_name_exist_check) > 0) {
                $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

                header('Location: admin-add-new-category.php');
                exit;
            }

//************ Category Name Already Exist Check Ends ***************


            $_FILES['category_image']['name'][$i];

            if (!empty($_FILES['category_image']['name'][$i])) {
                $file = generar_texto_amigable_img($_FILES['category_image']['name']);
                $file_loc = $_FILES['category_image']['tmp_name'][$i];
                $file_size = $_FILES['category_image']['size'][$i];
                $file_type = $_FILES['category_image']['type'][$i];
                $folder = "../images/services/";
                $new_size = $file_size / 1024;
                $event_image = $file;
                move_uploaded_file($file_loc, $folder . $event_image);
                $category_image = $event_image;
            }

            $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "categories (category_name,category_status,category_image,category_filter_pos_id,category_cdt,category_slug)
                VALUES ('$category_name','$category_status','$category_image','$category_filter_pos_id','$curDate','$category_slug')");

            $LID = mysqli_insert_id($conn);
            $lastID = $LID;

            $CATID = 'CAT' . substr(sha1(time()), 0, 10);

            $upqry = mysqli_query($conn, "UPDATE " . TBL . "categories 
					  SET category_code = '$CATID' 
					  WHERE category_id = $lastID");

        }


        if ($upqry) {

            $_SESSION['status_msg'] = $BIZBOOK['SUCCESS'];


            header('Location: admin-all-category.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-add-new-category.php');
            exit;
        }

}
?>