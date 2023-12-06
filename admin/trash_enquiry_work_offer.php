<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

$enquiry_work_offer_id = $_GET["row"];
$work_offer_ide = $_GET["code"];
$enquiry_work_offer = getEnquiryWorkOffer($enquiry_work_offer_id, $work_offer_ide);

if(isset($enquiry_work_offer)){
    $work_offer_qry =
        "DELETE FROM  " . TBL . "enquiry_work_offer where enquiry_id='" . $enquiry_work_offer_id . "'";

    $work_offer_res = mysqli_query($conn,$work_offer_qry);

    if ($work_offer_res) {
        $_SESSION['status_msg'] = $BIZBOOK['DELETE_PERMANENTLY'];
        header('Location: admin-enquiry-workoffer.php');
        exit;

    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-enquiry-workoffer.php');
        exit;
    }

    //    Listing Update Part Ends
}else{
    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-enquiry-workoffer.php');
    exit;
}

