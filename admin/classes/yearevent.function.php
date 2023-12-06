<?php

//Get All Categories
function getAllYearEvents()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "year_events ORDER BY year_name ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getYearEvent($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "year_events where year_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getCountYearEvents($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "events WHERE year_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}