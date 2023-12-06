<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_store = $_POST['id_store'];

    $sql = mysqli_query($conn, "UPDATE  " . TBL . "stores SET featured_store_id='0' where store_id='" . $id_store . "'");
    
    if ($sql) {
        echo 1;
    } else {
        echo 0;
    }
}