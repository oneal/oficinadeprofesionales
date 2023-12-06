<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}


$user_code           = $_REQUEST['item_number'];
$paypal_transaction_id  = $_REQUEST['tx']; // PayPal transaction ID
$amount_paid         = $_REQUEST['amt']; // PayPal received amount
$item_currency      = $_REQUEST['cc']; // PayPal received currency type

$plan_type_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "plan_type where plan_type_price='" . $amount_paid . "'");
$plan_type_details_row = mysqli_fetch_array($plan_type_details);

$plan_type_id = $plan_type_details_row['plan_type_id'];  //Plan Type Id

$user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_code='" . $user_code . "'");
$user_details_row = mysqli_fetch_array($user_details);

$user_id = $user_details_row['user_id'];  //User Id

$curDate = date("Y-m-d H:i:s", time());

$transaction_qry = "INSERT INTO " . TBL . "transactions 
					( user_code, plan_type_id , user_id, transaction_amount, transaction_currency, transaction_create_cdt) 
					VALUES 
					('$user_code', '$plan_type_id', '$user_id', '$amount_paid', '$item_currency', '$curDate')";

$transaction_res = mysqli_query($conn,$transaction_qry);
$TransactionID = mysqli_insert_id($conn);
$translastID = $TransactionID;

$TransCode = 'TRANS' . substr(sha1(time()), 0, 5);

$traupqry = "UPDATE " . TBL . "transactions 
					  SET transaction_code = '$TransCode' 
					  WHERE transaction_id = $translastID";

$traupres = mysqli_query($conn,$traupqry);

if ($traupres) {

    $lisupqry = "UPDATE " . TBL . "users 
					  SET payment_status = 'Paid' 
					  WHERE user_id = $user_id";

    $lisupres = mysqli_query($conn,$lisupqry);

    $_SESSION['status_msg'] = $BIZBOOK['PAYMENT_SUCCESS'];

    header('Location: db-invoice-all');
}

