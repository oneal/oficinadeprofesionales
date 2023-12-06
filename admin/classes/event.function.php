<?php

//Get All Events
function getAllEvents()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "events  WHERE event_type= 'All' ORDER BY event_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Active Events
function getAllActiveEvents($year_id)
{
    global $conn;

    if($year_id > 0){
        $sql_year = ' and year_id='.$year_id;
    }
    $sql = "SELECT * FROM " . TBL . "events WHERE event_status= 'Active'".$sql_year." ORDER BY event_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Events with User Id

function getAllUserEvents($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "events  WHERE event_type= 'All' AND  user_id= '$arg' ORDER BY event_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}


//Get particular Event using event id
function getEvent($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "events where event_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Event using event id
function getSlugEvent($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "events where event_slug='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Events except given event id
function getExceptEvent($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "events WHERE event_status= 'Active' AND event_id !='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Events Count
function getCountEvent()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "events ORDER BY event_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Event Count using User Id
function getCountUserEvent($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "events  WHERE event_type= 'All' AND  user_id= '$arg' ORDER BY event_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}
