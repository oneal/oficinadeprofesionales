<?php

//Get All Inactive Ads Enquiry

function getAllInactiveAdsEnquiry()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry WHERE ad_enquiry_status = 'InActive' ORDER BY all_ads_enquiry_id DESC";;
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Active Ads Enquiry

function getAllActiveAdsEnquiry()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry WHERE ad_enquiry_status = 'Active' and invoice_less = 0 ORDER BY all_ads_enquiry_id DESC";;
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllActiveAdsLessEnquiry()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry WHERE ad_enquiry_status = 'Active' and invoice_less = 1 ORDER BY all_ads_enquiry_id DESC";;
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Ads Enquiry with given user id

function getAllUserAdsEnquiry($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry WHERE user_id = '" . $arg . "' ORDER BY all_ads_enquiry_id DESC";;
    $rs = mysqli_query($conn, $sql);
    return $rs;

}


//Get All Ads Enquiry with given ad enquiry Id
function getAdsEnquiry($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry where all_ads_enquiry_id = '" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Ads Enquiry with given ad enquiry Id
function getAds($arg, $type, $category_id = 0)
{
    global $conn;
    global $curDate;

    $date = time();
    //$curDate1 = strtotime($curDate);

    //$date = date('Y-m-d', $curDate1);

    $sqlType = "";
    if($type != 4) {
        $sqlType = " type = ".$type. " AND";
        if ($category_id != 0) {
            $sqlType .= " category_id = ".$category_id. " AND";
        } else if( $category_id == 0) {
            $sqlType .= " category_id = 0 AND";
        }
    } else if($type == 4) {
        $sqlType = " type = ".$type. " AND category_id = 0 AND";
    }

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry where".$sqlType." all_ads_price_id = '" . $arg . "' AND ad_start_date <= '". $date ."' AND ad_end_date >= '". $date ."' AND ad_enquiry_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    if($type != 4 && $rs->num_rows == 0) {
        $sqlType = " type = ".$type. " AND category_id = 0 AND";
        $sql = "SELECT * FROM " . TBL . "all_ads_enquiry where".$sqlType." all_ads_price_id = '" . $arg . "' AND ad_start_date <= '". $date ."' AND ad_end_date >= '". $date ."' AND ad_enquiry_status = 'Active'";
        $rs = mysqli_query($conn, $sql);
    }
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Ad Request Count
function getCountAds()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "all_ads_enquiry ORDER BY all_ads_enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}
