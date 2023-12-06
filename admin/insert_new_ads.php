<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_ad_submit'])) {
        if(empty($_POST['ads_invoiceless'])){

            $user_id = $_POST["user_id"];

            $user_row = getUser($user_id);

            $user_code = $user_row['user_code'];

            $all_ads_price_id = $_POST["all_ads_price_id"];

            $hour = date("H:i:s", time());

            $ad_start_date_old = $_POST["ad_start_date"]." ".$hour;
            $ad_start_date = strtotime($ad_start_date_old);
            //$ad_start_date = date('Y-m-d H:i:s', $timestamp1);

            $ad_end_date_old = $_POST["ad_end_date"]." ".$hour;
            $ad_end_date = strtotime($ad_end_date_old);
            //$ad_end_date = date('Y-m-d H:i:s', $timestamp);

            $ad_total_days = $_POST["ad_total_days"];
            $ad_cost_per_day = $_POST["ad_cost_per_day"];
            $ad_total_cost = $_POST["ad_total_cost"];
            $ad_link = addslashes($_POST["ad_link"]);


            $ad_type = $_POST["all_type"];

            $category_id = 0;
            if($ad_type != 4) {
                $category_id = $_POST["all_category"];
            }

            if($ad_start_date < $ad_end_date){

                if(!empty($user_row['first_name']) and !empty($user_row['cif_nif']) and !empty($user_row['mobile_number']) and !empty($user_row['user_address']) and !empty($user_row['user_city']) and !empty($user_row['user_state']) and !empty($user_row['user_zip_code'])){

                    $item_currency = "EUR";

                    if (!empty($_FILES['ad_enquiry_photo']['name'])) {
                        $file = generar_texto_amigable_img($_FILES['ad_enquiry_photo']['name']);
                        $file_loc = $_FILES['ad_enquiry_photo']['tmp_name'];
                        $file_size = $_FILES['ad_enquiry_photo']['size'];
                        $file_type = $_FILES['ad_enquiry_photo']['type'];
                        $folder = "../images/ads/";
                        $new_size = $file_size / 1024;
                        $event_image = $file;
                        move_uploaded_file($file_loc, $folder . $event_image);
                        $ad_enquiry_photo = $event_image;
                    }

                    $ad_enquiry_status = "InActive";

                    $curDate = date("Y-m-d H:i:s", time());

                    $qry = "INSERT INTO " . TBL . "all_ads_enquiry 
                                                    (user_id,all_ads_price_id, ad_start_date, ad_end_date, ad_enquiry_photo, ad_link
                                                    ,ad_total_days, ad_cost_per_day, ad_total_cost, ad_enquiry_status, type, category_id) 
                                                    VALUES ('$user_id', '$all_ads_price_id', '$ad_start_date', '$ad_end_date', '$ad_enquiry_photo', '$ad_link'
                                                    , '$ad_total_days', '$ad_cost_per_day', '$ad_total_cost', '$ad_enquiry_status', '$ad_type', '$category_id')";

                    $res = mysqli_query($conn,$qry);
                    $ad_enquiry_id = mysqli_insert_id($conn);

                    if ($res) {

                        $TransCode = 'TRANS' . substr(sha1(time()), 0, 5);

                        $method_pay = 1;

                        $transaction_qry = "INSERT INTO " . TBL . "transactions 
                                            (transaction_code, user_code, ad_enquiry_id , user_id, transaction_amount, transaction_currency, method_pay, transaction_create_cdt) 
                                            VALUES 
                                            ('$TransCode', '$user_code', '$ad_enquiry_id', '$user_id', '$ad_total_cost', '$item_currency', '$method_pay', '$curDate')";

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

                        $row_ad_enquiry = getAdsEnquiry($ad_enquiry_id);
                        $ads_price_id = $row_ad_enquiry['all_ads_price_id'];
                        $ad_enquiry_price = getAdsPrice($ads_price_id);

                        $num = $row_ad_enquiry['ad_total_days']." d&iacute;as";
                        $price = number_format($row_ad_enquiry['ad_cost_per_day'],2,',','')." &euro;/d&iacute;a";
                        $transaction_amount = number_format($row_ad_enquiry['ad_total_cost'],2,',','')." &euro;";
                        $description = $ad_enquiry_price['ad_price_name'];

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
                        $subject1 = $admin_site_name." - ".$BIZBOOK['BUY_ADS'];

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

                        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

                        header('Location: admin-ads-request.php');
                        exit;

                    } else {

                        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                        header('Location: admin-create-ads.php');
                        exit;
                    }
                }else{
                    $_SESSION['status_msg'] = "Tienes que rellenar tus datos personales para comprar créditos.";

                    header('Location: admin-create-ads.php');
                    exit;
                }
            }else{
                $_SESSION['status_msg'] = "La fecha de fin debe ser superior a la fecha de inicio.";

                header('Location: admin-create-ads.php');
                exit;
            }
        }else{

            $invoice_less = 1;
            $all_ads_price_id = $_POST["all_ads_price_id"];
            
            $hour = date("H:i:s", time());

            $ad_start_date_old = $_POST["ad_start_date"]." ".$hour;
            $ad_start_date = strtotime($ad_start_date_old);
            //$ad_start_date = date('Y-m-d H:i:s', $timestamp1);

            $ad_end_date_old = $_POST["ad_end_date"]." ".$hour;
            $ad_end_date = strtotime($ad_end_date_old);
            //$ad_end_date = date('Y-m-d H:i:s', $timestamp);
            
            $ad_link = addslashes($_POST["ad_link"]);

            $ad_type = $_POST["all_type"];

            $category_id = 0;
            if($ad_type != 4) {
                $category_id = $_POST["all_category"];
            }
            
            if($ad_start_date < $ad_end_date){
                
                $_FILES['ad_enquiry_photo']['name'];

                if (!empty($_FILES['ad_enquiry_photo']['name'])) {
                    $file = generar_texto_amigable_img($_FILES['ad_enquiry_photo']['name']);
                    $file_loc = $_FILES['ad_enquiry_photo']['tmp_name'];
                    $file_size = $_FILES['ad_enquiry_photo']['size'];
                    $file_type = $_FILES['ad_enquiry_photo']['type'];
                    $folder = "../images/ads/";
                    $new_size = $file_size / 1024;
                    $event_image = $file;
                    move_uploaded_file($file_loc, $folder . $event_image);
                    $ad_enquiry_photo = $event_image;
                }

                $ad_enquiry_status = "Active";

                $curDate = date("Y-m-d H:i:s", time());

                $qry = "INSERT INTO " . TBL . "all_ads_enquiry 
                                                (all_ads_price_id, ad_start_date, ad_end_date, ad_enquiry_photo, ad_link, ad_enquiry_status, invoice_less, type, category_id, ad_enquiry_cdt) 
                                                VALUES ('$all_ads_price_id', '$ad_start_date', '$ad_end_date', '$ad_enquiry_photo', '$ad_link', '$ad_enquiry_status', '$invoice_less', '$ad_type', '$category_id','$curDate')";

                $res = mysqli_query($conn,$qry);
                $ad_enquiry_id = mysqli_insert_id($conn);

                if ($res) {
                    $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

                    header('Location: admin-current-ads-invoice-less.php');
                    exit;
                }
            }else{
                $_SESSION['status_msg'] = "La fecha de fin debe ser superior a la fecha de inicio.";

                header('Location: admin-current-ads-invoice-less.php');
                exit;
            }
        }

    } else {

        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-ads-request.php');
        exit;
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-ads-request.php');
    exit;
}
?>