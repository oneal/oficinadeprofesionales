<?php

//Get All Listings
function getAllStores()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "stores ORDER BY store_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Listing Using Listing Code
function getStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "stores where store_code='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Listing Using Listing Slug
function getSlugStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "stores where store_slug='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Listing Using Listing Code
function getIdStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "stores where store_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Listing with given Category Id
function getAllStoreCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "stores  WHERE category_id= '$arg' ORDER BY store_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Listing Count
function getCountStore()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "stores ORDER BY store_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using State Id
function getCountStateStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "stores WHERE state_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using City Id
function getCountCityStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "stores WHERE city_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Listing with given User Id and Listing Id
function getAllStoreCities()
{
    global $conn;

    $sql = "SELECT city_id FROM " . TBL . "stores  WHERE city_id != 0 ORDER BY store_name ASC GROUP BY city_id";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $rs;

}

function getAllStoreFavoritelisting()
{
    global $conn;
    global $curDate;

    $date = time();
    //$curDate1 = strtotime($curDate);

    //$date = date('Y-m-d', $curDate1);

    $sql = "SELECT s.*,f_s.featured_store_price_id FROM " . TBL . "stores as s, " . TBL . "featured_stores as f_s WHERE s.featured_store_id = f_s.featured_store_id AND f_s.date_start <= '". $date ."' AND f_s.date_end >= '". $date ."' AND f_s.status = 'Active' ORDER BY s.store_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
?>