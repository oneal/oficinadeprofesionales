<?php

//Get All Country with given country Id's
function getAllStates($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "states where country_id= '".$arg."' ORDER BY state_name ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Country with given country Id
function getState($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "states where state_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}


