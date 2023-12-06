<?php

//Get All Categories
function getAllCategoriesWorkOffer()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "categories_work_offer ORDER BY category_name ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getCategoryWokrOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "categories_work_offer where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getCountCategoryWokrOffer($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "work_offers WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}