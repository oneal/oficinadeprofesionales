<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$select_search = $_GET['select_search'];
$select_city = $_GET['select_city'];

//get matched data from cities table
$cities_qry = "SELECT * FROM " . TBL . "cities WHERE city_name = '$select_city'";
$cities_query = mysqli_query($conn,$cities_qry);
$cities_row = mysqli_fetch_array($cities_query);

$city_id = $cities_row['city_id'];


//get matched data from categories table
$categories_qry = "SELECT * FROM " . TBL . "categories WHERE category_name = '$select_search' ";
$categories_query = mysqli_query($conn,$categories_qry);

//get matched data from listings table
$listings_qry = "SELECT * FROM " . TBL . "listings WHERE listing_name = '$select_search' AND listing_status= 'Active' AND listing_is_delete != '2' ";
$listings_query = mysqli_query($conn,$listings_qry);

//get matched data from events table
$event_qry = "SELECT * FROM " . TBL . "events WHERE event_name = '$select_search' AND event_status= 'Active'";
$event_query = mysqli_query($conn,$event_qry);

//get matched data from blog table
$blog_qry = "SELECT * FROM " . TBL . "blogs WHERE blog_name = '$select_search' AND blog_status= 'Active'";
$blog_query = mysqli_query($conn,$blog_qry);

//get matched data from product table
$product_qry = "SELECT * FROM " . TBL . "products WHERE product_name = '$select_search' AND product_status= 'Active'";
$product_query = mysqli_query($conn,$product_qry);

if (mysqli_num_rows($categories_query) > 0) {
    $categories_row = mysqli_fetch_array($categories_query);
    $category_name = $categories_row['category_name'];

    $p_category_name = $categories_row['category_slug'];

    header("location: all-listing?category=$p_category_name");
    exit;

} elseif (mysqli_num_rows($categories_query) <= 0 && mysqli_num_rows($listings_query) > 0) {

        $listings_row = mysqli_fetch_array($listings_query);

        $listing_code = $listings_row['listing_code'];
        $listing_name = $listings_row['listing_slug'];
        $listing_url = $webpage_full_link.'anuncio/'.$listing_name;

        header("location: $listing_url");
        exit;


}elseif (mysqli_num_rows($categories_query) <= 0 && mysqli_num_rows($listings_query) <= 0 && mysqli_num_rows($event_query) > 0 ) {

        $event_row = mysqli_fetch_array($event_query);

        $event_id = $event_row['event_id'];
       $event_name = $event_row['event_slug'];
       $event_url = $webpage_full_link.'event/'.$event_name;

        header("location: $event_url");
        exit;

}elseif (mysqli_num_rows($categories_query) <= 0 && mysqli_num_rows($listings_query) <= 0 && mysqli_num_rows($event_query) <= 0 && mysqli_num_rows($blog_query) > 0 ) {

    $blog_row = mysqli_fetch_array($blog_query);

    $blog_id = $blog_row['blog_id'];
    $blog_name = $blog_row['blog_slug'];
    $blog_url = $webpage_full_link.'blog/'.$blog_name;

    header("location: $blog_url");
    exit;

}elseif (mysqli_num_rows($categories_query) <= 0 && mysqli_num_rows($listings_query) <= 0 && mysqli_num_rows($event_query) <= 0 && mysqli_num_rows($blog_query) <= 0 && mysqli_num_rows($product_query) > 0) {

    $product_row = mysqli_fetch_array($product_query);

    $product_code = $product_row['product_code'];
    $product_name = $product_row['product_slug'];
    $product_url = $webpage_full_link.'product/'.$product_name;

    header("location: $product_url");
    exit;

}else{
    header("location: search-results?q=$select_search");
    exit;
}

?>
