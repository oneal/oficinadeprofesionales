<?php

//Get All Enquiry
function getAllEnquiries()
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiries where payment_status='Pending' OR payment_status=' ' ORDER BY enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Enquiry
function getAllSavedEnquiries()
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiries where payment_status='Pending' AND enquiry_save = 1 OR payment_status=' ' ORDER BY enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Enquiry with given user Id
function getUserEnquiries($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiries where listing_user_id='" . $arg . "' AND payment_status='Pending' OR payment_status=' ' ORDER BY enquiry_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Enquiry Count
function getCountEnquiries()
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "enquiries ";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Received Enquiries Count using User Id
function getCountUserEnquiries($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "enquiries  WHERE listing_user_id= '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}


