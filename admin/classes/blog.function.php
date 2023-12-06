<?php

//Get All Blogs
function getAllBlogs()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blogs  ORDER BY blog_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Blogs
function getAllActiveBlogs()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blogs WHERE blog_status = 'Active' ORDER BY blog_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Blogs with given User ID

function getAllUserBlogs($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blogs WHERE user_id= '$arg' ORDER BY blog_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Blog using blog id
function getBlog($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "blogs where blog_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Blog using blog Slug
function getSlugBlog($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "blogs where blog_slug='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Blogs except given event id
function getExceptBlog($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "blogs WHERE blog_status= 'Active' AND blog_id !='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Blog Count using User Id
function getCountUserBlog($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blogs  WHERE user_id= '$arg' ORDER BY blog_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Blogs Count
function getCountBlog()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "blogs ORDER BY blog_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}
