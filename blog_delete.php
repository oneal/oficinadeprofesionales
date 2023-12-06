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
    if (isset($_POST['blog_submit'])) {

        $blog_id = $_POST["blog_id"];

        $blog_qry =
            "DELETE FROM  " . TBL . "blogs  where blog_id='" . $blog_id . "'";


        $blog_res = mysqli_query($conn,$blog_qry);


        if ($blog_res) {


            $_SESSION['status_msg'] = "Blog has been Deleted Successfully!!!";

            header('Location: db-blog-posts');

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: db-blog-posts');
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: dashboard');
}