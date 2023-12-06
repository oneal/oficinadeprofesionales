<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['status_featured_listing'])){
        $id_listing = $_POST['id_listing'];
        $id_featured_listing = $_POST['id_featured_listing'];
        $status = $_POST['status'];
        
        $featured_listing_rs = mysqli_query($conn,"SELECT * FROM " . TBL . "featured_listings as f_l, " . TBL . "listings as l  WHERE l.listing_id = " . $id_listing . " and l.featured_listing_id = f_l.featured_listing_id and f_l.featured_listing_id=" . $id_featured_listing);
        $featured_listing_row = mysqli_fetch_array($featured_listing_rs);
        
        if($featured_listing_row){
            $sql = mysqli_query($conn,"UPDATE " . TBL . "featured_listings SET status = '" . $status . "' where featured_listing_id = '" . $id_featured_listing . "'");

            if($sql){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }else{
        if($_POST['invoiceless'] == 0){
            if($_POST['date_end'] != "" and $_POST['date_start'] != "" and $_POST['adposi'] != ""){
                $id_listing = $_POST['id_listing'];
                $featured_listing_price_id = $_POST['adposi'];
                $hour = date("H:i:s", time());
                $date_start_old = $_POST['date_start']." ".$hour;
                $date_start = strtotime($date_start_old);
                //$date_start = date('Y-m-d', $timestamp);
                $date_end_old = $_POST['date_end']." ".$hour;
                $date_end = strtotime($date_end_old);
                //$date_end = date('Y-m-d', $timestamp1);
                $featured_total_days = $_POST["featured_total_days"];
                $featured_cost_per_day = $_POST["featured_cost_per_day"];
                $featured_total_cost = $_POST["featured_total_cost"];

                $listing_row = getIdListing($id_listing);

                $user_id = $listing_row['user_id'];

                $user_row = getUser($user_id);

                if($date_start < $date_end){

                    if(!empty($user_row['first_name']) and !empty($user_row['cif_nif']) and !empty($user_row['mobile_number']) and !empty($user_row['user_address']) and !empty($user_row['user_city']) and !empty($user_row['user_state']) and !empty($user_row['user_zip_code'])){

                        $user_code = $user_row['user_code'];

                        $item_currency = "EUR";

                        $curDate = date("Y-m-d H:i:s", time());

                        $featured_listing_price_rs = mysqli_query($conn,"SELECT * FROM " . TBL . "featured_listing_price  WHERE featured_listing_prices_id=" . $featured_listing_price_id);
                        $featured_listing_price_row = mysqli_fetch_array($featured_listing_price_rs);

                        $feature_listing_price = $featured_listing_price_row['price'];
                        $description = $featured_listing_price_row['description'];

                        $listing_qry = "INSERT INTO " . TBL . "featured_listings 
                                                        (listing_id, date_start, date_end, featured_listing_price_id, featured_total_days, featured_cost_per_day, featured_total_cost) 
                                                        VALUES 
                                                        ('$id_listing', '$date_start', '$date_end', '$featured_listing_price_id', '$featured_total_days', '$featured_cost_per_day', '$featured_total_cost')";
                        $listing_res = mysqli_query($conn,$listing_qry);
                        $featuredListlastID = mysqli_insert_id($conn);

                        if ($featuredListlastID) {
                            $sql = mysqli_query($conn,"UPDATE " . TBL . "listings SET featured_listing_id = '" . $featuredListlastID . "' where listing_id='" . $id_listing . "'");
                            $TransCode = 'TRANS' . substr(sha1(time()), 0, 5);

                            $method_pay = 1;

                            $transaction_qry = "INSERT INTO " . TBL . "transactions 
                                                (transaction_code, user_code, featured_listing_id , user_id, transaction_amount, transaction_currency, method_pay, transaction_create_cdt) 
                                                VALUES 
                                                ('$TransCode', '$user_code', '$featuredListlastID', '$user_id', '$featured_total_cost', '$item_currency', '$method_pay', '$curDate')";

                            $transaction_res = mysqli_query($conn,$transaction_qry);
                            $TransactionID = mysqli_insert_id($conn);
                            $translastID = $TransactionID;
                            
                            $status_transaction_cdt = date("Y-m-d H:i:s", time());
                            $status_transaction_qry = "INSERT INTO " . TBL . "status_transactions 
                                                                    (id_transactions, id_status, status_transaction_cdt) 
                                                                    VALUES 
                                                                    ('$TransactionID','2','$status_transaction_cdt')";

                            $status_transaction_res = mysqli_query($conn,$status_transaction_qry);
                            $StatusTransactionID = mysqli_insert_id($conn);

                            $update_transaction_qry = "UPDATE  " . TBL . "transactions SET id_status_transaction ='" . $StatusTransactionID . "' where transaction_id='" . $TransactionID . "'";
                            $update_transaction_res = mysqli_query($conn,$update_transaction_qry);

                            $sql = "SELECT * FROM  " . TBL . "featured_listings  where featured_listing_id = ".$featuredListlastID;
                            $featured_listings_rs = mysqli_query($conn, $sql);
                            $featured_listings_row = mysqli_fetch_array($featured_listings_rs);

                            $num = $featured_listings_row['featured_total_days']." d&iacute;as";
                            $price = number_format($featured_listings_row['featured_cost_per_day'],2,',','')." &euro;/d&iacute;a";
                            $transaction_amount = number_format($featured_listings_row['featured_total_cost'],2,',','')." &euro;";

                            $webpage_full_link_with_login = $webpage_full_link. "login";

                            $type_buy = "anuncio";

                            $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
                            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
                            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
                            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
                            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
                            $admin_address = $admin_primary_email_fetchrow['footer_address'];

                            //****************************    Admin Primary email fetch ends    *************************

                            $admin_email = EMAIL_PAY; // Admin Email Id

                            $to1 = $user_row['email_id'];
                            $subject1 = $admin_site_name." - ".$BIZBOOK['BUY_FEATURED_LISTING'];

                            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 33"); //User mail template fetch
                            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

                            $mail_template_client = $client_sql_fetch_row['mail_template'];

                            $logo = $webpage_full_link . "images/home/24147logo-blanco.png";

                            $admin_cod_num_bank = $admin_primary_email_fetchrow['admin_cod_num_bank'];
                            $admin_cod_entity_bank = $admin_primary_email_fetchrow['admin_cod_entity_bank'];
                            $admin_cod_iban = $admin_primary_email_fetchrow['admin_cod_iban'];
                            $admin_cod_bic_swift = $admin_primary_email_fetchrow['admin_cod_bic_swift'];
                            $admin_cod_benify = $admin_primary_email_fetchrow['admin_cod_benify'];
                            $concept_cod = "Pago ".$TransCode;

                            $message1 = stripslashes(str_replace(array('\' . $num . \'', '\' . $description . \'', '\' . $price . \'','\' . $transaction_amount . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \'','\' . $admin_cod_entity_bank . \'','\' . $admin_cod_num_bank . \'','\' . $admin_cod_iban . \'','\' . $admin_cod_bic_swift . \'','\' . $admin_cod_benify . \'','\' . $concept_cod . \'','\' . $type_buy . \''),
                                    array('' . $num . '', '' . $description . '', '' . $price . '','' . $transaction_amount . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $admin_cod_entity_bank . '','' . $admin_cod_num_bank . '','' . $admin_cod_iban . '','' . $admin_cod_bic_swift . '','' . $admin_cod_benify . '','' . $concept_cod . '','' . $type_buy . ''), $mail_template_client));

                            $headers1 = "From: " . "$admin_email" . "\r\n";
                            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
                            $headers1 .= "MIME-Version: 1.0\r\n";
                            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

                            mail($to1, $subject1, $message1, $headers1); //Client email

                            echo 1;
                        } else {
                            echo 0;
                        }
                    }else{
                        echo 3;
                    }
                }else{
                    echo 4;
                }
            }else{
                echo 2;
            }
        }else{
            if($_POST['date_end'] != "" and $_POST['date_start'] != "" and $_POST['adposi'] != ""){
                $id_listing = $_POST['id_listing'];
                $featured_listing_price_id = $_POST['adposi'];
                $hour = date("H:i:s", time());
                $date_start_old = $_POST['date_start']." ".$hour;
                $date_start = strtotime($date_start_old);
                //$date_start = date('Y-m-d', $timestamp);
                $date_end_old = $_POST['date_end']." ".$hour;
                $date_end = strtotime($date_end_old);
                //$date_end = date('Y-m-d', $timestamp1);

                $listing_row = getIdListing($id_listing);

                $user_id = $listing_row['user_id'];

                $user_row = getUser($user_id);

                if($date_start < $date_end){
                    $user_code = $user_row['user_code'];

                    $item_currency = "EUR";

                    $status = 'Active';

                    $invoice_less = 1;

                    $listing_qry = "INSERT INTO " . TBL . "featured_listings 
                                                    (listing_id, date_start, date_end, featured_listing_price_id, status, invoice_less) 
                                                    VALUES 
                                                    ('$id_listing', '$date_start', '$date_end', '$featured_listing_price_id', '$status', '$invoice_less')";

                    $listing_res = mysqli_query($conn,$listing_qry);
                    $featuredListlastID = mysqli_insert_id($conn);

                    if ($featuredListlastID) {
                        $sql = mysqli_query($conn,"UPDATE " . TBL . "listings SET featured_listing_id = '" . $featuredListlastID . "' where listing_id='" . $id_listing . "'");
                        echo 1;
                    } else {
                        echo 0;
                    }
                }else{
                    echo 4;
                }
            }else{
                echo 2;
            }
        }
    }

}
?>