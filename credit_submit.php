<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

include "apiRedsys.php"; 

function add_transaction($credit_id,$amount_paid,$item_currency,$method_pay,$curDate,$conn,$TransCode){
    $user_id = $_SESSION['user_id'];

    $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_id='" . $user_id . "'");
    $user_details_row = mysqli_fetch_array($user_details);

    $user_id_pay = $user_details_row['user_id'];
    
    $user_code = $user_details_row['user_code'];

    $transaction_qry = "INSERT INTO " . TBL . "transactions 
                                            (transaction_code, user_code, plan_type_id , user_id, transaction_amount, transaction_currency, method_pay, transaction_create_cdt) 
                                            VALUES 
                                            ('$TransCode','$user_code', '$credit_id', '$user_id_pay', '$amount_paid', '$item_currency', '$method_pay', '$curDate')";

    $transaction_res = mysqli_query($conn,$transaction_qry);
    $TransactionID = mysqli_insert_id($conn);

    $status_transaction_cdt = date("Y-m-d H:i:s", time());
    $status_transaction_qry = "INSERT INTO " . TBL . "status_transactions 
                                            (id_transactions, id_status, status_transaction_cdt) 
                                            VALUES 
                                            ('$TransactionID','2','$status_transaction_cdt')";

    $status_transaction_res = mysqli_query($conn,$status_transaction_qry);
    $StatusTransactionID = mysqli_insert_id($conn);

    $update_transaction_qry = "UPDATE  " . TBL . "transactions SET id_status_transaction ='" . $StatusTransactionID . "' where transaction_id='" . $TransactionID . "'";
    $update_transaction_res = mysqli_query($conn,$update_transaction_qry);
    
    return $TransactionID;
}


if(isset($_SESSION['user_id'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['credit_submit'])) {

            $method_pay = $_POST['p-m'];
            $credit_plan = $_POST["credit_plan"];
            $footer_row = getAllFooter(); //Fetch Footer Data

            $item_currency = "EUR";

            $user_id = $_SESSION['user_id'];
            $user_row = getUser($user_id);
            
            $user_email_id = $user_row['email_id'];
            $user_code = $user_row['user_code'];            
          
            if(!empty($user_row['first_name']) and !empty($user_row['cif_nif']) and !empty($user_row['mobile_number']) and !empty($user_row['user_address']) and !empty($user_row['user_city']) and !empty($user_row['user_state']) and !empty($user_row['user_zip_code'])){
                $first_name = $user_row['first_name'];

                $curDate = date("Y-m-d H:i:s", time());
                
                $TransCode = 'TRANS' . substr(sha1(time()), 0, 5);
                
                if(!isset($_POST['p-m']) and !empty($_POST['p-m'])){
                    $_SESSION['status_msg'] = "Debes seleccionar una forma de pago";

                    header('Location: db-credits');
                    exit;
                }

                if($method_pay == 2){
                    $credit_details_row = getCreditType($credit_plan);

                    $credit_id = $credit_details_row['credit_id'];  //Plan Type Id
                    $credit_points = $credit_details_row['credit_points'];  //Points
                    $amount_paid = $credit_details_row['credit_price'];  //Points
                    
                    if($footer_row['admin_paypal_pruebas'] == 1){
                        $paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
                    }else if($footer_row['admin_paypal_pruebas'] == 0){
                        $paypal_url='https://www.paypal.com/cgi-bin/webscr';  //Live Paypal API URL
                    }       
                    
                    add_transaction($credit_id,$amount_paid,$item_currency,$method_pay,$curDate,$conn,$TransCode);

                    $admin_paypal_id = $footer_row['admin_paypal_id']; // Admin Paypal email ID

                    $link_with_payment_failure = $webpage_full_link. "credit_paypal_failure?code=".$TransCode;  //URL Payment Failure Link
                    $link_with_payment_success = $webpage_full_link. "credit_paypal_success?code=".$TransCode;  //URL Payment Failure Link

                    echo '<body onload="document.getElementById(\'frmPayPal1\').submit();">
                    Espera un segundo!!! Estamos redirigiendo a paypal....
                    <form action="'.$paypal_url.'" method="post" name="frmPayPal1" id="frmPayPal1">
                        <input type="hidden" name="business" value="'.$admin_paypal_id.'">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="item_name" value="'.$footer_row['website_address'].'">
                        <input type="hidden" name="item_number" value="'.$user_code.'">
                        <input type="hidden" name="credits" value="510">
                        <input type="hidden" name="userid" value="1">
                        <input type="hidden" name="amount" value="'.$amount_paid.'">
                        <input type="hidden" name="no_shipping" value="0">
                        <input type="hidden" name="currency_code" value="'.$item_currency.'">
                        <input type="hidden" name="handling" value="0">
                        <input type="hidden" name="cancel_return" value="'.$link_with_payment_failure.'">
                        <input type="hidden" name="return" value="'.$link_with_payment_success.'">
                    </form>
                    </body>';
                }
                
                if($method_pay == 4){

                    $credit_details_row = getCreditType($credit_plan);

                    $credit_id = $credit_details_row['credit_id'];  //Plan Type Id
                    $credit_points = $credit_details_row['credit_points'];  //Points
                    $amount_paid = $credit_details_row['credit_price'];  //Points
                    
                    add_transaction($credit_id,$amount_paid,$item_currency,$method_pay,$curDate,$conn,$TransCode);
                            
                    $miObj = new RedsysAPI();

                    $row_f = getAllFooter();

                    if($footer_row['admin_tpv_pruebas'] == 1){
                        $url_tpv = 'https://sis-t.redsys.es:25443/sis/realizarPago';
                    }else if($footer_row['admin_tpv_pruebas'] == 0){
                        $url_tpv = 'https://sis.redsys.es/sis/realizarPago';
                    }
                    
                    $version = $footer_row['admin_tpv_version']; 
                    $clave = $footer_row['admin_tpv_clave']; //poner la clave SHA-256 facilitada por el banco
                    $name = $footer_row['admin_tpv_name'];
                    $code = $footer_row['admin_tpv_code'];
                    $terminal = $footer_row['admin_tpv_terminal'];
                    $amount = doubleval($amount_paid)*100;
                    $currency = '978';
                    $consumerlng = '001';
                    $transactionType = '0';
                    $urlMerchant = $webpage_full_link;
                    $urlweb_ok = $webpage_full_link.'tpv_ok.php';
                    $urlweb_ko = $webpage_full_link.'tpv_ko.php';

                    $miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
                    $miObj->setParameter("DS_MERCHANT_CURRENCY", $currency);
                    $miObj->setParameter("DS_MERCHANT_ORDER", $TransCode);
                    $miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $code);
                    $miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
                    $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $transactionType);
                    $miObj->setParameter("DS_MERCHANT_MERCHANTURL", $urlMerchant);
                    $miObj->setParameter("DS_MERCHANT_URLOK", $urlweb_ok);      
                    $miObj->setParameter("DS_MERCHANT_URLKO", $urlweb_ko);
                    $miObj->setParameter("DS_MERCHANT_MERCHANTNAME", $name); 
                    $miObj->setParameter("DS_MERCHANT_CONSUMERLANGUAGE", $consumerlng);

                    $params = $miObj->createMerchantParameters();
                    $signature = $miObj->createMerchantSignature($clave);

                    echo '<body onload="document.getElementById(\'realizarPago\').submit();">
                    Espera un segundo!!! Estamos redirigiendo al pago con tarjeta....
                    <form id="realizarPago" action="'.$url_tpv.'" method="post">
                        <input type="hidden" name="Ds_SignatureVersion" value="'.$version.'"> 
                        <input type="hidden" name="Ds_MerchantParameters" value="'.$params.'"> 
                        <input type="hidden" name="Ds_Signature" value="'.$signature.'"> 
                    </form>
                    </body>';
                }

                if($method_pay == 1){
                    $credit_details_row = getCreditType($credit_plan);

                    $credit_id = $credit_details_row['credit_id'];  //Plan Type Id
                    $credit_points = $credit_details_row['credit_points'];  //Points
                    $amount_paid = $credit_details_row['credit_price'];  //Points

                    $TransactionID = add_transaction($credit_id,$amount_paid,$item_currency,$method_pay,$curDate,$conn,$TransCode);

                    if ($TransactionID) {

                        $transaction_row = getTransactionId($TransactionID);

                        $transaction_user_plan_type = getCreditType($transaction_row['plan_type_id']);

                        $num = $transaction_user_plan_type['credit_points']. " cr&eacute;ditos";
                        $description = $transaction_user_plan_type['credit_name'];
                        $price = number_format(($transaction_row['transaction_amount'] / $transaction_user_plan_type['credit_points']),2,',','').'&euro;';
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

                        $type_buy = "cr&eacute;ditos";

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

                        $message1 = stripslashes(str_replace(array('\' . $num . \'', '\' . $description . \'', '\' . $price . \'','\' . $transaction_amount . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \'','\' . $admin_cod_entity_bank . \'','\' . $admin_cod_num_bank . \'','\' . $admin_cod_iban . \'','\' . $admin_cod_bic_swift . \'','\' . $admin_cod_benify . \'','\' . $concept_cod . \'','\' . $type_buy . \'','\' . $type_num . \'','\' . $euro_per_day . \'','\' . $euro . \''),
                                array('' . $num . '', '' . $description . '', '' . $price . '','' . $transaction_amount . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $admin_cod_entity_bank . '','' . $admin_cod_num_bank . '','' . $admin_cod_iban . '','' . $admin_cod_bic_swift . '','' . $admin_cod_benify . '','' . $concept_cod . '','' . $type_buy . '','' . $type_num . '','' . $euro_per_day . '','' . $euro . ''), $mail_template_client));

                        $headers1 = "From: " . "$admin_email" . "\r\n";
                        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
                        $headers1 .= "MIME-Version: 1.0\r\n";
                        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

                        mail($to1, $subject1, $message1, $headers1); //Client email

                        $to2 = $admin_email;
                        $subject2 = $admin_site_name." - ".$BIZBOOK['BUY_CREDITS'];

                        $client_sql_fetch_2 = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 34"); //User mail template fetch
                        $client_sql_fetch_row_2 = mysqli_fetch_array($client_sql_fetch_2);

                        $mail_template_client2 = $client_sql_fetch_row_2['mail_template'];

                        $message2 = stripslashes(str_replace(array('\' . $num . \'', '\' . $description . \'', '\' . $price . \'','\' . $transaction_amount . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \'','\' . $TransCode . \'','\' . $type_buy . \'','\' . $type_num . \'','\' . $euro_per_day . \'','\' . $euro . \''),
                                array('' . $num . '', '' . $description . '', '' . $price . '','' . $transaction_amount . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $TransCode . '','' . $type_buy . '','' . $type_num . '','' . $euro_per_day . '','' . $euro . ''), $mail_template_client2));

                        $headers2 = "From: " . "$admin_email" . "\r\n";
                        $headers2 .= "Reply-To: " . "$admin_email" . "\r\n";
                        $headers2 .= "MIME-Version: 1.0\r\n";
                        $headers2 .= "Content-Type: text/html; charset=utf-8\r\n";

                        mail($to2, $subject2, $message2, $headers2); //Client email
                    }

                    header('Location: payment-transfer-success?row='.$TransCode);
                    exit;
                }
            }else{
            
                $_SESSION['status_msg'] = "Tienes que rellenar tus datos personales para comprar créditos.";

                header('Location: db-credits');
                exit;
            }

        }else{
            $_SESSION['status_msg'] = $BIZBOOK['OOPS_NO_LISTING'];

            header('Location: db-credits');
            exit;
        }
    } else{
        $_SESSION['status_msg'] = $BIZBOOK['OOPS_NO_LISTING'];

        header('Location: db-credits');
        exit;
    }
}else{
    header('Location: index');
    exit;
}