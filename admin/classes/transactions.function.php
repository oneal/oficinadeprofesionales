<?php

//Get All Transactions
function getAllTransaction($pending = 0)
{
    global $conn;

    if($pending == 1){
        $sql = "SELECT * FROM " . TBL . "transactions, " . TBL . "status_transactions WHERE transaction_invoice is null and transaction_pay_cdt is null and id_status_transaction = id and (id_status = 2 or id_status = 3) ORDER BY transaction_id DESC";
        $rs = mysqli_query($conn, $sql);
        return $rs;
    }else{
        $sql = "SELECT * FROM " . TBL . "transactions, " . TBL . "status_transactions WHERE transaction_invoice is not null and transaction_pay_cdt is not null and id_status_transaction = id and id_status = 1 ORDER BY transaction_create_cdt DESC";
        $rs = mysqli_query($conn, $sql);
        return $rs; 
    }
}

//Get All Transactions with given User Id
function getAllUserTransaction($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "transactions  WHERE user_id = '$arg' ORDER BY transaction_create_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllStatusTransaction($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "status_transactions  WHERE id_transactions = '$arg' ORDER BY status_transaction_cdt DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getStatusTransaction($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "status_transactions  WHERE id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getStatus($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "status  WHERE id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}


//Get Transaction with given Transaction Code
function getTransaction($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "transactions  WHERE transaction_code = '$arg' ";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get Transaction with given Transaction id
function getTransactionId($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "transactions  WHERE transaction_id = '$arg' ";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}