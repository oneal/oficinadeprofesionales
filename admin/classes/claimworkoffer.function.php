<?php

//Get All Claim Listings
function getAllEnquiryWorkOfferUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiry_work_offer WHERE work_offer_user_id = '" . $arg . "' ORDER BY enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Claim Listings
function getAllEnquiryWorkOffer()
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiry_work_offer ORDER BY enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Claim Listings
function getEnquiryWorkOffer($arg, $arg2)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiry_work_offer WHERE enquiry_id '" . $arg . "' and work_offer_id = '" . $arg1 . "' ORDER BY enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}
