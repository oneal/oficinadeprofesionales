<?php

//Get All Liked Listing with given User Id
function getAllLikedListingUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listing_likes  WHERE  user_id = '$arg' ";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Count of Liked Listings
function getCountLikedListing($arg)
{
    global $conn;

    $sql = $sql = "SELECT * FROM " . TBL . "listing_likes  WHERE  user_id = '$arg' ";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Count of Liked Listings using listing id and user id
function getCountUserLikedListing($arg,$arg1)
{
    global $conn;

    $sql = "SELECT listing_likes_id FROM " . TBL . "listing_likes  WHERE listing_id = '$arg' AND user_id = '$arg1'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}