<?php

//Get All Listings
function getAllListing()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE  listing_is_delete != '2' ORDER BY listing_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Trash Deleted Listings
function getAllTrashListing()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE  listing_is_delete = '2' ORDER BY listing_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllListingFavoriteHome()
{
    global $conn;
    global $curDate;

    $date = time();
    //$curDate1 = strtotime($curDate);

    //$date = date('Y-m-d', $curDate1);

    $sql = "SELECT * FROM " . TBL . "listings as l, " . TBL . "featured_listings as f_l WHERE l.featured_listing_id = f_l.featured_listing_id AND (f_l.featured_listing_price_id = 1 OR f_l.featured_listing_price_id = 6 OR f_l.featured_listing_price_id = 7) AND f_l.date_start <= '". $date ."' AND f_l.date_end >= '". $date ."' AND f_l.status = 'Active'  ORDER BY l.listing_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllListingFavoritelisting()
{
    global $conn;
    global $curDate;

    $date = time();
    //$curDate1 = strtotime($curDate);

    //$date = date('Y-m-d', $curDate1);
    
    $sql = "SELECT l.*,f_l.featured_listing_price_id FROM " . TBL . "listings as l, " . TBL . "featured_listings as f_l WHERE l.featured_listing_id = f_l.featured_listing_id AND f_l.featured_listing_price_id != 1 AND f_l.date_start <= '". $date ."' AND f_l.date_end >= '". $date ."' AND f_l.status = 'Active' ORDER BY listing_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}

//Get particular Listing Using Listing Code
function getListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "listings where listing_code='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Listing Using Listing Slug
function getSlugListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "listings where listing_slug='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Listing Using Listing Code
function getIdListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "listings where listing_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Listing with given User Id
function getAllListingUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE user_id= '$arg' AND listing_is_delete != '2' ORDER BY listing_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Listing with given Category Id
function getAllListingCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE category_id= '$arg' AND listing_is_delete != '2' ORDER BY listing_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Listing with given User Id and Listing Id
function getAllListingUserListing($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE user_id= '$arg' AND listing_is_delete != '2' AND listing_id = '$arg1'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Listing with given User Id and Listing Id
function getAllListingListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE  listing_is_delete != '2' AND listing_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Listing Count
function getCountListing()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE listing_is_delete != '2' ORDER BY listing_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using User Id
function getCountUserListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings  WHERE user_id= '$arg' AND listing_is_delete != '2' ORDER BY listing_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using Category Id
function getCountCategoryListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings WHERE  listing_is_delete != '2' AND category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using Country Id
function getCountCountryListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings WHERE  listing_is_delete != '2' AND country_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using State Id
function getCountStateListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings WHERE  listing_is_delete != '2' AND state_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Listing Count using City Id
function getCountCityListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings WHERE  listing_is_delete != '2' AND city_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Listing with given User Id and Listing Id
function getAllListingCities()
{
    global $conn;

    $sql = "SELECT city_id FROM " . TBL . "listings  WHERE  listing_is_delete != '2' AND city_id != 0 ORDER BY city_name ASC GROUP BY city_id";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $rs;

}

//Listing Count using Category Id
function getCountSubCategoryListing($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "listings WHERE  listing_is_delete != '2' AND sub_category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

?>