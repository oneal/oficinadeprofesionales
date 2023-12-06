<?php

//Get All Users with Active status
function getAllUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllUserListingAdmin()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE (user_status = 'Active' and user_type = 'Service provider') or user_type = 'Prueba' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Users with Inactive status
function getAllInactiveUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Inactive' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Users with given User type
function getAllTypeUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND user_type = '" . $arg . "' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Service Provider Users with given User type and User plan
function getAllServiceUser($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status ='Active' AND user_plan = '".$arg1."' and user_type = '".$arg."' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Service Provider Users with Not given User Id
function getAllServiceUserExceptUserId($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status ='Active' AND user_plan IN (2,3,4) AND user_type = 'Service provider' AND user_id !='" . $arg . "' ORDER BY user_id DESC LIMIT 5";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Users using user ID
function getUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users where user_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getUserCode($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users where user_code='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Active Users using user ID
function getActiveUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users where user_slug='" . $arg . "' AND user_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All COD Request From Users with Active status
function getAllCODUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND payment_status = 'COD'  ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Paid Users with Active status
function getAllPaidUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND payment_status = 'Paid'  ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Paid Users with Active status
function getAllNonPaidUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND user_plan IN (2,3,4) AND payment_status = ' '  ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Count of users
function getCountUser()
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users where user_status='Active'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Count of users
function getCountUserServiceProviverActive()
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users where user_type = 'Service provider' and user_status='Active'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get Count of user following with given user id
function getUserFollowing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users WHERE FIND_IN_SET('" .$arg . "',user_followers) AND user_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get Count of user Not following with given user id
function getUserNotFollowing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users WHERE NOT FIND_IN_SET('" .$arg . "',user_followers) AND user_id != '" . $arg . "' AND user_type='Service provider' AND user_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get Count of user Not following with given user id
function getUserServiceProvider($arg)
{
    global $conn;

    if(isset($arg)) {
        $user = " user_id != '" . $arg . "' AND";
    }

    $sql = "SELECT * FROM  " . TBL . "users WHERE".$user." user_type='Service provider' AND user_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}



//Get Count of user following with given user id
function getCountUserFollowing($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users WHERE FIND_IN_SET('" .$arg . "',user_followers) AND user_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}

//Get Count of user following with given user Id and profile ID
function getCountUserProfileFollowing($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "users WHERE FIND_IN_SET('" .$arg . "',user_followers) AND user_id = '$arg1' AND user_status = 'Active'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}


//Get All InActive Count
function getCountInactiveUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Inactive' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get Count of All All Service Provider Users with given User plan
function getCountServiceUser($arg1)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status ='Active' AND user_plan = '".$arg1."' ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Paid User Count
function getCountPaidUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND payment_status = 'Paid'  ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Non Paid User Count
function getCountNonPaidUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND user_plan IN (2,3,4) AND payment_status = ' '  ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All COD Request User Count
function getCountCODUser()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "users WHERE user_status = 'Active' AND payment_status = 'COD'  ORDER BY user_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}




?>