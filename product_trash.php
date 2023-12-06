<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
/*
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_submit'])) {

        $product_id = $_POST["product_id"];

        $product_qry =
            "DELETE FROM  " . TBL . "products  where product_id='" . $product_id . "'";


        $product_res = mysqli_query($conn,$product_qry);


        if ($product_res) {


            $_SESSION['status_msg'] = "product has been Deleted Successfully!!!";

            header('Location: db-products');

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: db-products');
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: dashboard');
}