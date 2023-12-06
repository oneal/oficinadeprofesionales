<?php

//Get All Top Categories
function getAllMarcas()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "marcas ORDER BY marca_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Top Category with given category Id
function getMarca($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "marcas where marca_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}


