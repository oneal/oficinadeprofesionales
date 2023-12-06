<?php

//Get All Categories
function getAllCategoriesStores()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "categories_stores ORDER BY category_name ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getCategoryStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "categories_stores where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getCountCategoryStore($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "stores WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}