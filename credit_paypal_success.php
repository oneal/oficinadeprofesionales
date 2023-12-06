<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$TransCode = $_GET['code'];

$user_code           = $_REQUEST['item_number'];
$paypal_transaction_id  = $_REQUEST['tx']; // PayPal transaction ID
$amount_paid         = $_REQUEST['amt']; // PayPal received amount
$item_currency      = $_REQUEST['cc']; // PayPal received currency type

$transaction_row = getTransaction($TransCode);

$TransactionID = $transaction_row['transaction_id'];

$credit_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "credits where credit_price='" . $amount_paid . "'");
$credit_details_row = mysqli_fetch_array($credit_details);

$credit_id = $credit_details_row['credit_id'];  //Plan Type Id
$credit_points = $credit_details_row['credit_points'];  //Points

$user_id = $_SESSION['user_id'];

$user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_id='" . $user_id . "'");
$user_details_row = mysqli_fetch_array($user_details);

$user_credit = $user_details_row['user_credit'];  //User Id

$new_credit_points = $credit_points + $user_credit;

$method_pay = 2;

$curDate = date("Y-m-d H:i:s", time());

$date = date('Y',time());

$sql = mysqli_query($conn, "SELECT * FROM " . TBL . "transactions WHERE DATE_FORMAT(transaction_create_cdt, '%Y') = '".$date."'  AND transaction_invoice != ''");
$num_transactions_year = $sql->num_rows;

$num_transaction = "";
if(strlen($num_transactions_year) == 1){
    $num_transaction = "00000000".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 2){
    $num_transaction = "0000000".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 3){
    $num_transaction = "000000".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 4){
    $num_transaction = "00000".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 5){
    $num_transaction = "0000".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 6){
    $num_transaction = "000".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 7){
    $num_transaction = "00".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 8){
    $num_transaction = "0".($num_transactions_year+1);
}else if(strlen($num_transactions_year) == 9){
    $num_transaction = ($num_transactions_year+1);
}

$transaction_invoice = $date.$num_transaction;

$status_transaction_cdt = date("Y-m-d H:i:s", time());
$status_transaction_qry = "INSERT INTO " . TBL . "status_transactions 
                                    (id_transactions, id_status, status_transaction_cdt) 
                                    VALUES 
                                    ('$TransactionID','1','$status_transaction_cdt')";

$status_transaction_res = mysqli_query($conn,$status_transaction_qry);
$StatusTransactionID = mysqli_insert_id($conn);

$transaction_pay_cdt = date("Y-m-d H:i:s", time());
$traupqry = "UPDATE " . TBL . "transactions 
                                SET id_status_transaction = '$StatusTransactionID', transaction_invoice = '$transaction_invoice', transaction_pay_cdt = '$transaction_pay_cdt'
                                WHERE transaction_id = $TransactionID";

$traupres = mysqli_query($conn,$traupqry);

if ($traupres) {
    
    
    $transaction_user_plan_type = getCreditType($transaction_row['plan_type_id']);
    
    $num_credits = $transaction_user_plan_type['credit_points'];
    $credit_name = $transaction_user_plan_type['credit_name'];
    $credit_price = number_format(($transaction_row['transaction_amount'] / $transaction_user_plan_type['credit_points']),2,',','').'&euro;';
    $transaction_amount = number_format($transaction_row['transaction_amount'],2,',','').'&euro;';

    $webpage_full_link_with_login = $webpage_full_link. "login";
            
    $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
    $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
    $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
    $admin_site_name = $admin_primary_email_fetchrow['website_address'];
    $admin_address = $admin_primary_email_fetchrow['footer_address'];

    //****************************    Admin Primary email fetch ends    *************************


    $admin_email = EMAIL_PAY; // Admin Email Id

    $to1 = $user_details_row['email_id'];
    $subject1 = $admin_site_name." - ".$BIZBOOK['BUY_CREDITS'];

    $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 32"); //User mail template fetch
    $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

    $mail_template_client = $client_sql_fetch_row['mail_template'];

    $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
    $message1 = stripslashes(str_replace(array('\' . $num_credits . \'', '\' . $credit_name . \'', '\' . $credit_price . \'','\' . $transaction_amount . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \''),
            array('' . $num_credits . '', '' . $credit_name . '', '' . $credit_price . '','' . $transaction_amount . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . ''), $mail_template_client));

    $headers1 = "From: " . "$admin_email" . "\r\n";
    $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
    $headers1 .= "MIME-Version: 1.0\r\n";
    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

    mail($to1, $subject1, $message1, $headers1); //Client email

    $lisupqry = "UPDATE " . TBL . "users 
                SET user_credit = $new_credit_points 
                WHERE user_id = $user_id";

    $lisupres = mysqli_query($conn,$lisupqry);

    $_SESSION['status_msg'] = $BIZBOOK['PAYMENT_SUCCESS'];

    header('Location: dashboard');
}

