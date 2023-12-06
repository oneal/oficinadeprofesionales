<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_listing = $_POST['id_listing'];

    $sql = mysqli_query($conn, "UPDATE  " . TBL . "listings SET featured_listing_id='0' where listing_id='" . $id_listing . "'");
    
    if ($sql) {
        echo 1;
    } else {
        echo 0;
    }
}