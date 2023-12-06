<?php
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}


//get search term
//$searchTerm = $_GET['term'];

$display_json = array();
//$display_json1 = array();
//$display_json2 = array();
//$display_json3 = array();
//$display_json4 = array();
//get matched data from skills table
//$qry ="SELECT * FROM " . TBL . "listings ORDER BY listing_name ASC";

$qry ="SELECT city_name FROM " . TBL . "cities where state_id='" . $country_id . "'"; //State Table Fetch

//$qry1 ="SELECT category_name FROM " . TBL . "categories";  //Category Table Fetch
//
//$qry2 ="SELECT * FROM " . TBL . "events  WHERE event_type= 'All' AND event_status= 'Active'"; //Event Table Fetch
//
//$qry3 ="SELECT * FROM " . TBL . "blogs WHERE blog_status= 'Active'"; //Blog Table Fetch
//
//$qry4 ="SELECT * FROM " . TBL . "products WHERE product_status= 'Active'"; //Product Table Fetch

$query = mysqli_query($conn,$qry);
while ($row = mysqli_fetch_array($query)) {
    $display_json[] = $row['city_name'];
}
//$query1 = mysqli_query($conn,$qry1);
//while ($row = mysqli_fetch_array($query1)) {
//    $display_json1[] = $row['category_name'];
//
//}
//
//$query2 = mysqli_query($conn,$qry2);
//while ($row = mysqli_fetch_array($query2)) {
//    $display_json2[] = $row['event_name'];
//
//}
//
//$query3 = mysqli_query($conn,$qry3);
//while ($row = mysqli_fetch_array($query3)) {
//    $display_json3[] = $row['blog_name'];
//
//}
//
//$query4 = mysqli_query($conn,$qry4);
//while ($row = mysqli_fetch_array($query4)) {
//    $display_json4[] = $row['product_name'];
//
//}

echo json_encode($display_json);
//echo json_encode(array_merge($display_json,$display_json1,$display_json2,$display_json3,$display_json4));

?>
