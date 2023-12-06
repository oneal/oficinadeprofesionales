<?php

include "config/info.php";

if(isset($_GET['transaction_code'])){
    $TransCode = $_GET['transaction_code'];
    
    $sql = "SELECT * FROM " . TBL . "transactions  WHERE transaction_code = '$TransCode' ";
    $rs = mysqli_query($conn, $sql);
    $transaction_row = mysqli_fetch_array($rs);
    if(!empty($transaction_row) and empty($transaction_row['transaction_invoice'])){
        $date = date('Y',time());
        
        $translastID = $transaction_row['transaction_id'];

        $curDate = date("Y-m-d H:i:s", time());
        $traupqry1 = "UPDATE " . TBL . "transactions 
                        SET transaction_pay_cdt = '$curDate', transaction_create_cdt = '$curDate'
                        WHERE transaction_id = $translastID";

        mysqli_query($conn,$traupqry1);

        $sql = mysqli_query($conn, "SELECT * FROM " . TBL . "transactions WHERE DATE_FORMAT(transaction_create_cdt, '%Y') = '".$date."'  AND transaction_invoice is not null");
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
                                            ('$translastID','1','$status_transaction_cdt')";

        $status_transaction_res = mysqli_query($conn,$status_transaction_qry);
        $StatusTransactionID = mysqli_insert_id($conn);
        
        $curDate = date("Y-m-d H:i:s", time());        
        $traupqry = "UPDATE " . TBL . "transactions 
                        SET id_status_transaction = '$StatusTransactionID', transaction_invoice = '$transaction_invoice'
                        WHERE transaction_id = $translastID";
        
        $lisupres = mysqli_query($conn,$traupqry);
        
        $user_code = $transaction_row['user_code'];
        
        $sql = "SELECT * FROM  " . TBL . "users where user_code='" . $user_code . "'";
        $rs = mysqli_query($conn, $sql);
        $user_row = mysqli_fetch_array($rs);
        
        $user_id = $user_row['user_id'];  //User Id        
        
        if($transaction_row['plan_type_id']>0){
            $user_credit = $user_row['user_credit'];
            
            $plan_type_id = $transaction_row['plan_type_id'];

            $credit_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "credits where credit_id='" . $plan_type_id . "'");
            $credit_details_row = mysqli_fetch_array($credit_details);

            $credit_points = $credit_details_row['credit_points'];  //Points

            $new_credit_points = $credit_points + $user_credit;

            $num = $credit_details_row['credit_points'] ." cr&eacute;ditos";
            $description = $credit_details_row['credit_name'];
            $price = number_format(($transaction_row['transaction_amount'] / $credit_details_row['credit_points']),2,',','').'&euro;';
            $transaction_amount = number_format($transaction_row['transaction_amount'],2,',','').'&euro;';

            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 35"); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
            
            $userpqry = "UPDATE " . TBL . "users 
                SET user_credit = $new_credit_points 
                WHERE user_id = $user_id";

            $userpqryres = mysqli_query($conn,$userpqry);
        }
        if($transaction_row['ad_enquiry_id']>0){
            $ad_enquiry_id = $transaction_row['ad_enquiry_id'];
            $row_ad_enquiry = getAdsEnquiry($ad_enquiry_id);
            $ads_price_id = $row_ad_enquiry['all_ads_price_id'];
            $ad_enquiry_price = getAdsPrice($ads_price_id);
            
            $num = $row_ad_enquiry['ad_total_days']." d&iacute;as";
            $price = number_format($row_ad_enquiry['ad_cost_per_day'],2,',','')." &euro;/d&iacute;a";
            $transaction_amount = number_format($row_ad_enquiry['ad_total_cost'],2,',','')." &euro;";
            $description = $ad_enquiry_price['ad_price_name'];
            
            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 36"); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
            
            $userpqryres = TRUE;
        }
        
        if($transaction_row['featured_listing_id']>0){
            $transaction_featured_listing_id = $transaction_row['featured_listing_id'];
            
            $sql = "SELECT * FROM  " . TBL . "featured_listings  where featured_listing_id = ".$transaction_featured_listing_id;
            $featured_listings_rs = mysqli_query($conn, $sql);
            $featured_listings_row = mysqli_fetch_array($featured_listings_rs);
            $featured_listing_price_id = $featured_listings_row['featured_listing_price_id'];

            $sql = "SELECT * FROM  " . TBL . "featured_listing_price where featured_listing_prices_id = ".$featured_listing_price_id;
            $featured_listing_price_rs = mysqli_query($conn, $sql);
            $featured_listing_price_row = mysqli_fetch_array($featured_listing_price_rs);
            
            $num = $featured_listings_row['featured_total_days']." d&iacute;as";
            $price = number_format($featured_listings_row['featured_cost_per_day'],2,',','')." &euro;/d&iacute;a";
            $transaction_amount = number_format($featured_listings_row['featured_total_cost'],2,',','')." &euro;";
            $description = $featured_listing_price_row['description'];
            
            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 36"); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
            
            $userpqryres = TRUE;
        }

        if($transaction_row['featured_store_id']>0){
            $transaction_featured_store_id = $transaction_row['featured_store_id'];

            $sql = "SELECT * FROM  " . TBL . "featured_stores  where featured_store_id = ".$transaction_featured_store_id;
            $featured_stores_rs = mysqli_query($conn, $sql);
            $featured_stores_row = mysqli_fetch_array($featured_stores_rs);
            $featured_store_price_id = $featured_stores_row['featured_store_price_id'];

            $sql = "SELECT * FROM  " . TBL . "featured_store_price where featured_store_prices_id = ".$featured_store_price_id;
            $featured_store_price_rs = mysqli_query($conn, $sql);
            $featured_store_price_row = mysqli_fetch_array($featured_store_price_rs);

            $num = $featured_stores_row['featured_total_days']." d&iacute;as";
            $price = number_format($featured_stores_row['featured_cost_per_day'],2,',','')." &euro;/d&iacute;a";
            $transaction_amount = number_format($featured_stores_row['featured_total_cost'],2,',','')." &euro;";
            $description = $featured_store_price_row['description'];

            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 36"); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $userpqryres = TRUE;
        }
                
        if($userpqryres){
            
            $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
            $admin_address = $admin_primary_email_fetchrow['footer_address'];

            //****************************    Admin Primary email fetch ends    *************************

            $admin_email = EMAIL_PAY; // Admin Email Id

            $to1 = $user_row['email_id'];
            $subject1 = $admin_site_name." - ".$BIZBOOK['BUY_CREDITS'];

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $logo = $webpage_full_link . "images/home/24147logo-blanco.png";

            $message1 = stripslashes(str_replace(array('\' . $num . \'', '\' . $description . \'', '\' . $price . \'','\' . $transaction_amount . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \'','\' . $TransCode . \''),
                    array('' . $num . '', '' . $description . '', '' . $price . '','' . $transaction_amount . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $TransCode . ''), $mail_template_client));

            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

            mail($to1, $subject1, $message1, $headers1); //Client email
                
            $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'] ;

            header('Location: admin-invoice-shared');
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'] ;

        header('Location: admin-invoice-shared');
    }
}else{
    $_SESSION['status_msg'] = $BIZBOOK['ERROR'] ;

    header('Location: admin-invoice-shared');
}
