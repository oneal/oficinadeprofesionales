<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['sub_category_submit'])) {

    $cnt = count($_POST['sub_category_name']);
    $category_id = $_POST['category_id'];


// *********** if Count of sub category name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-new-product-sub-category.php');
        exit;
    }

// *********** if Count of sub category name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $sub_category_name = $_POST['sub_category_name'][$i];

        $sub_category_status = "Active";



//************ sub_category Name Already Exist Check Starts ***************


        $sub_category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "product_sub_categories  WHERE sub_category_name='" . $sub_category_name . "' ");

        if (mysqli_num_rows($sub_category_name_exist_check) > 0) {


            $_SESSION['status_msg'] = "The Given sub category name $sub_category_name is Already Exist Try Other!!!";

            header('Location: admin-add-new-product-sub-category.php');
            exit;


        }

        $curDate = date("Y-m-d H:i:s", time());
        
        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "product_sub_categories (sub_category_name,sub_category_status,category_id,sub_category_cdt)
VALUES ('$sub_category_name','$sub_category_status','$category_id','$curDate')");

        $LID = mysqli_insert_id($conn);
        $lastID = $LID;

        switch (strlen($LID)) {
            case 1:
                $LID = '00' . $LID;
                break;
            case 2:
                $LID = '0' . $LID;
                break;
            default:
                $LID = $LID;
                break;
        }

        $CATID = 'SUB_CAT' . $LID;

        $upqry = mysqli_query($conn, "UPDATE " . TBL . "product_sub_categories 
					  SET sub_category_code = '$CATID' 
					  WHERE sub_category_id = $lastID");

    }


    if ($upqry) {

        $_SESSION['status_msg'] = "Sub category(s) has been Added Successfully!!!";


        header('Location: admin-all-product-sub-category.php');
        exit;

    } else {


        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

        header('Location: admin-add-new-product-sub-category.php');
        exit;
    }

}
?>