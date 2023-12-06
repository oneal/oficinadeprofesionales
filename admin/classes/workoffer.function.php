<?php

//Get All work offers
function getAllWorkOffers()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "work_offers  ORDER BY work_offer_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All work offers
function getAllActiveWorkOffers()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "work_offers WHERE work_offer_status = 'Active' ORDER BY work_offer_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All work offers with given User ID

function getAllUserWorkOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "work_offers WHERE  work_offer_status = 'Active' and user_id= '$arg' ORDER BY work_offer_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular work offer using work offer id
function getWorkOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "work_offers where work_offer_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getWorkOfferCode($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "work_offers where work_offer_code = '" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular work offer using work offer Slug
function getSlugWorkOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "work_offers where work_offer_slug = '" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All work offers except given event id
function getExceptWorkOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "work_offers WHERE work_offer_status= 'Active' AND work_offer_id !='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//work offer Count using User Id
function getCountUserWorkOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "work_offers  WHERE user_id= '$arg' ORDER BY work_offer_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All work offers Count
function getCountWorkOffer()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "work_offers WHERE work_offer_status= 'Active'" ;
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}
