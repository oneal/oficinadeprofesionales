<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['status_featured_store'])){
        $id_store = $_POST['id_store'];
        $id_featured_store = $_POST['id_featured_store'];
        $status = $_POST['status'];
        
        $featured_store_rs = mysqli_query($conn,"SELECT * FROM " . TBL . "featured_stores as f_l, " . TBL . "stores as l  WHERE l.store_id = " . $id_store . " and l.featured_store_id = f_l.featured_store_id and f_l.featured_store_id=" . $id_featured_store);
        $featured_store_row = mysqli_fetch_array($featured_store_rs);
        
        if($featured_store_row){
            $sql = mysqli_query($conn,"UPDATE " . TBL . "featured_stores SET status = '" . $status . "' where featured_store_id = '" . $id_featured_store . "'");
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
                $id_store = $_POST['id_store'];
                $featured_store_price_id = $_POST['adposi'];
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

                $store_row = getIdstore($id_store);

                $user_id = $store_row['user_id'];

                $user_row = getUser($user_id);

                if($date_start < $date_end){

                    if(!empty($user_row['first_name']) and !empty($user_row['cif_nif']) and !empty($user_row['mobile_number']) and !empty($user_row['user_address']) and !empty($user_row['user_city']) and !empty($user_row['user_state']) and !empty($user_row['user_zip_code'])){

                        $user_code = $user_row['user_code'];

                        $item_currency = "EUR";

                        $curDate = date("Y-m-d H:i:s", time());

                        $featured_store_price_rs = mysqli_query($conn,"SELECT * FROM " . TBL . "featured_store_price  WHERE featured_store_prices_id=" . $featured_store_price_id);
                        $featured_store_price_row = mysqli_fetch_array($featured_store_price_rs);

                        $feature_store_price = $featured_store_price_row['price'];
                        $description = $featured_store_price_row['description'];

                        $store_qry = "INSERT INTO " . TBL . "featured_stores 
                                                        (store_id, date_start, date_end, featured_store_price_id, featured_total_days, featured_cost_per_day, featured_total_cost) 
                                                        VALUES 
                                                        ('$id_store', '$date_start', '$date_end', '$featured_store_price_id', '$featured_total_days', '$featured_cost_per_day', '$featured_total_cost')";
                        $store_res = mysqli_query($conn,$store_qry);
                        $featuredListlastID = mysqli_insert_id($conn);

                        if ($featuredListlastID) {
                            $sql = mysqli_query($conn,"UPDATE " . TBL . "stores SET featured_store_id = '" . $featuredListlastID . "' where store_id='" . $id_store . "'");
                            $TransCode = 'TRANS' . substr(sha1(time()), 0, 5);

                            $method_pay = 1;

                            $transaction_qry = "INSERT INTO " . TBL . "transactions 
                                                (transaction_code, user_code, featured_store_id , user_id, transaction_amount, transaction_currency, method_pay, transaction_create_cdt) 
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

                            $sql = "SELECT * FROM  " . TBL . "featured_stores  where featured_store_id = ".$featuredListlastID;
                            $featured_stores_rs = mysqli_query($conn, $sql);
                            $featured_stores_row = mysqli_fetch_array($featured_stores_rs);

                            $num = $featured_stores_row['featured_total_days']." d&iacute;as";
                            $price = number_format($featured_stores_row['featured_cost_per_day'],2,',','')." &euro;/d&iacute;a";
                            $transaction_amount = number_format($featured_stores_row['featured_total_cost'],2,',','')." &euro;";

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
                            $subject1 = $admin_site_name." - ".$BIZBOOK['BUY_FEATURED_store'];

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
                $id_store = $_POST['id_store'];
                $featured_store_price_id = $_POST['adposi'];
                $hour = date("H:i:s", time());
                $date_start_old = $_POST['date_start']." ".$hour;
                $date_start = strtotime($date_start_old);
                //$date_start = date('Y-m-d', $timestamp);
                $date_end_old = $_POST['date_end']." ".$hour;
                $date_end = strtotime($date_end_old);
                //$date_end = date('Y-m-d', $timestamp1);

                $store_row = getIdstore($id_store);

                $user_id = $store_row['user_id'];

                $user_row = getUser($user_id);

                if($date_start < $date_end){
                    $user_code = $user_row['user_code'];

                    $item_currency = "EUR";

                    $status = 'Active';

                    $invoice_less = 1;

                    $store_qry = "INSERT INTO " . TBL . "featured_stores 
                                                    (store_id, date_start, date_end, featured_store_price_id, status, invoice_less) 
                                                    VALUES 
                                                    ('$id_store', '$date_start', '$date_end', '$featured_store_price_id', '$status', '$invoice_less')";
                    $store_res = mysqli_query($conn,$store_qry);
                    $featuredListlastID = mysqli_insert_id($conn);

                    if ($featuredListlastID) {
                        $sql = mysqli_query($conn,"UPDATE " . TBL . "stores SET featured_store_id = '" . $featuredListlastID . "' where store_id='" . $id_store . "'");
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