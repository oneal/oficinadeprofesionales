<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if(file_exists('config/user_authentication.php'))
{
    include('config/user_authentication.php');
}

if(file_exists('config/info.php'))
{
    include('config/info.php');
}

if(isset($_GET['messageenquirymessageenquirymessageenquirymessageenquiry'])){

    $enquiry_id = $_GET['messageenquirymessageenquirymessageenquirymessageenquiry'];


    $listing_qry =
        "DELETE  FROM " . TBL . "enquiries  where enquiry_id='" . $enquiry_id . "'";

    $listing_res = mysqli_query($conn,$listing_qry);



    if ($listing_res) {

        $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];;

        header('Location: admin-all-enquiry.php');
    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-all-enquiry.php');
    }


}