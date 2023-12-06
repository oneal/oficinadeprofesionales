<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $featured_store_price_id = $_POST['adposi'];

    $curDate1 = strtotime($curDate);

    $date = date('Y-m-d', $curDate1);
    
    $sql = mysqli_query($conn, "SELECT * FROM " . TBL . "featured_stores WHERE featured_store_price_id = '".$featured_store_price_id."' AND date_start <= '". $date ."' AND date_end >= '". $date ."' AND status = 'Active'");
    $num = $sql->num_rows;

    if($num < 8){
        echo 1;
    }else{
        echo 0;
    }
}