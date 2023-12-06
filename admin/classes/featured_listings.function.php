<?php

//Get All Featured Listings

function getAllFeaturedListing()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "featured_listings ORDER BY featured_listing_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllFeaturedListingWithInvoice()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "featured_listings WHERE invoice_less = 0 ORDER BY date_start DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllFeaturedListingInvoiceLess()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "featured_listings WHERE invoice_less = 1 ORDER BY date_start DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular featured Listing Using Listing id

function getFeaturedListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "featured_listings where listing_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}