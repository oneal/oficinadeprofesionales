<?php

function getAllOffersStores()
{

    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores ORDER BY offer_cdt DESC";

    $rs = mysqli_query($conn, $sql);

    return $rs;

}

function getAllOffersStoresUser($user_id)
{

    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores WHERE user_id = ".$user_id." ORDER BY offer_cdt ASC";

    $rs = mysqli_query($conn, $sql);

    return $rs;

}

function getCountAllOffersStoresUser($user_id)

{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores  WHERE user_id = ".$user_id;

    $rs = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($rs);

    return $row;

}

function getAllOffersByStore($store_id)
{

    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores WHERE store_id = ".$store_id." ORDER BY offer_cdt DESC";

    $rs = mysqli_query($conn, $sql);

    return $rs;

}

function getCountAllOffersByStore($store_id)

{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores INNER  WHERE store_id = ".$store_id;

    $rs = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($rs);

    return $row;

}

function getOfferStore($id)
{

    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores WHERE offer_id = '".$id."'";

    $rs = mysqli_query($conn, $sql);

    return mysqli_fetch_array($rs);

}

function getOfferStoreSlug($slug)
{

    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores WHERE offer_slug = '".$slug."'";

    $rs = mysqli_query($conn, $sql);

    return mysqli_fetch_array($rs);

}


function getCountOfferStoresRelated($category_id, $store_id)

{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores 
    INNER JOIN " . TBL . "stores
    ON " . TBL . "stores.store_id = " . TBL . "offers_stores.store_id
    WHERE " . TBL . "stores.category_id = ".$category_id." AND " . TBL . "offers_stores.store_id != ".$store_id;

    $rs = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($rs);

    return $row;

}

function getOfferStoresRelated($category_id, $store_id)
{
    $countOffers = getCountOfferStoresRelated($category_id, $store_id);

    $offestTemp = rand(0, $countOffers);
    if($countOffers == 1){
        $offest = 0;
    } else {
        if($offestTemp == 5) {
            $offest = 0;
        } else {
            if($offestTemp + 5 > $countOffers){
                $offest = $offestTemp-5;
            } else {
                $offest = $offestTemp;
            }
        }

    }

    global $conn;

    $sql = "SELECT * FROM " . TBL . "offers_stores 
    INNER JOIN " . TBL . "stores
    ON " . TBL . "stores.store_id = " . TBL . "offers_stores.store_id
    WHERE " . TBL . "stores.category_id = '".$category_id."' AND " . TBL . "offers_stores.store_id != ".$store_id." LIMIT 5 OFFSET ".$offest;

    $rs = mysqli_query($conn, $sql);

    return $rs;

}