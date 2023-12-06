<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$select_search = $_GET['select_search'];
$select_city = $_GET['select_city'];
$select_reg_sub = $_GET['select_reg_sub'];
$select_cate = $_GET['select_cate'];

//get matched data from cities table
$cities_qry = "SELECT * FROM " . TBL . "cities WHERE city_name = '$select_city'";
$cities_query = mysqli_query($conn,$cities_qry);
$cities_row = mysqli_fetch_array($cities_query);

$city_id = $cities_row['city_id'];

if($select_city != NULL){

    $city_search_query = "AND FIND_IN_SET($select_city, country_id)";
}
if($select_city != NULL && $select_reg_sub != NULL){

    $city_search_query1 = "AND FIND_IN_SET($select_reg_sub, city_id)";
}
//get matched data from categories table
$categories_qry = "SELECT * FROM " . TBL . "categories WHERE category_name = '$select_cate' ";
$categories_query = mysqli_query($conn,$categories_qry);

//get matched data from listings table
$listings_qry1 = "SELECT * FROM " . TBL . "listings WHERE listing_name = '$select_search' AND listing_status= 'Active' AND listing_is_delete != '2' ";
$listings_query1 = mysqli_query($conn,$listings_qry1);

//get matched data from listings table
$listings_qry = "SELECT * FROM " . TBL . "listings WHERE listing_status= 'Active' AND listing_is_delete != '2' $city_search_query $city_search_query1 ";
$listings_query = mysqli_query($conn,$listings_qry);

if (mysqli_num_rows($categories_query) > 0) {
    $categories_row = mysqli_fetch_array($categories_query);
    $category_name = $categories_row['category_name'];

    $p_category_name = $categories_row['category_slug'];

    header("location: all-listing?category=$p_category_name");
    exit;

}elseif (mysqli_num_rows($categories_query) <= 0 && mysqli_num_rows($listings_query) > 0) {

    header("location: all-listing");
    exit;


} elseif (mysqli_num_rows($categories_query) <= 0 && mysqli_num_rows($listings_query) <= 0 && mysqli_num_rows($listings_query1) > 0) {

    $listings_row = mysqli_fetch_array($listings_query);

    $listing_code = $listings_row['listing_code'];
    $listing_name = $listings_row['listing_slug'];
    $listing_url = $webpage_full_link.'anuncio/'.$listing_name;

    header("location: $listing_url");
    exit;


}else{
    header("location: search-results?q=$select_search");
    exit;
}

?>
