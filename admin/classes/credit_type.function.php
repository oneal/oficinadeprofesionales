<?php

if (file_exists('../config/info.php')) {
    include('../config/info.php');
}

function getAllCreditType()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "credits WHERE credit_status='Active' ORDER BY credit_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getCreditType($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "credits WHERE credit_status='Active' AND credit_id = '$arg' ";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}



?>