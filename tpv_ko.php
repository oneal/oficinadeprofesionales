
<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}

if (file_exists('functions.php')) {
    include('functions.php');
}

/*Importar el fichero principal de la librer铆a, tal y como se muestra
a continuaci贸n. El comercio debe decidir si la importaci贸n desea hacerla con la
funci贸n 鈥渋nclude鈥? o 鈥渞equired鈥?, seg煤n los desarrollos realizados.*/
include "apiRedsys.php";  

/*Definir un objeto de la clase principal de la librer铆a, tal y como se
muestra a continuaci贸n:*/
$miObj = new RedsysAPI; 
  
/*Capturar los par谩metros de la notificaci贸n on-line:*/
$version = $_GET["Ds_SignatureVersion"]; 
$params = $_GET["Ds_MerchantParameters"]; 
$signatureRecibida = $_GET["Ds_Signature"];

/*Decodificar el par谩metro Ds_MerchantParameters. Para llevar
a cabo la decodificaci贸n de este par谩metro, se debe llamar a la
funci贸n de la librer铆a 鈥渄ecodeMerchantParameters()鈥?, tal y como
se muestra a continuaci贸n:*/
$decodec = json_decode($miObj->decodeMerchantParameters($params));

$response = $decodec->Ds_Response;               
$order = $decodec->Ds_Order;

$row_f = getAllFooter();

/*Una vez se ha realizado la llamada a la funci贸n
鈥渄ecodeMerchantParameters()鈥?, se puede obtener el valor de
cualquier par谩metro que sea susceptible de incluirse en la
notificaci贸n on-line. Para llevar a cabo la obtenci贸n del valor de un
par谩metro se debe llamar a la funci贸n 鈥済etParameter()鈥? de la
librer铆a con el nombre de par谩metro, tal y como se muestra a
continuaci贸n para obtener el c贸digo de respuesta:*/
//$codigoRespuesta = $miObj->getParameters("Ds_Response"); 

/** NOTA IMPORTANTE: Es importante llevar a cabo la
validaci贸n de todos los par谩metros que se env铆an en la
comunicaci贸n. Para actualizar el estado del pedido de
forma on-line NO debe usarse esta comunicaci贸n, sino la
notificaci贸n on-line descrita en los otros apartados, ya que
el retorno de la navegaci贸n depende de las acciones del
cliente en su navegador.*/

/*Validar el par谩metro Ds_Signature. Para llevar a cabo la
validaci贸n de este par谩metro se debe calcular la firma y
compararla con el par谩metro Ds_Signature capturado. Para ello
se debe llamar a la funci贸n de la librer铆a
鈥渃reateMerchantSignatureNotif()鈥? con la clave obtenida del
m贸dulo de administraci贸n y el par谩metro
Ds_MerchantParameters capturado, tal y como se muestra a
continuaci贸n:*/
$claveModuloAdmin = $row_f['admin_tpv_clave']; 
$signatureCalculada = $miObj->createMerchantSignatureNotif($claveModuloAdmin, $params); 

$transaction_row = getTransaction($order);
$TransactionID = $transaction_row['transaction_id'];
$TransCode = $transaction_row['transaction_code'];

/*Una vez hecho esto, ya se puede validar si el valor de la firma
enviada coincide con el valor de la firma calculada, tal y como se
muestra a continuaci贸n:*/
if ($signatureCalculada === $signatureRecibida) {
    $salida = 0;
    
    if ($response !== '0000') {
        $user_id = $transaction_row['user_id'];
        
        $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_id='" . $user_id . "'");
        $user_details_row = mysqli_fetch_array($user_details);
        
        $status_transaction_cdt = date("Y-m-d H:i:s", time());
        $status_transaction_qry = "INSERT INTO " . TBL . "status_transactions 
                                            (id_transactions, id_status, status_transaction_cdt) 
                                            VALUES 
                                            ('$TransactionID','3','$status_transaction_cdt')";

        $status_transaction_res = mysqli_query($conn,$status_transaction_qry);
        $StatusTransactionID = mysqli_insert_id($conn);

        $traupqry = "UPDATE " . TBL . "transactions 
                                        SET id_status_transaction = '$StatusTransactionID' 
                                        WHERE transaction_id = $TransactionID";

        $traupres = mysqli_query($conn,$traupqry);
        
        $transaction_user_plan_type = getCreditType($transaction_row['plan_type_id']);

        $num_credits = $transaction_user_plan_type['credit_points'];
        $credit_name = $transaction_user_plan_type['credit_name'];
        $credit_price = number_format(($transaction_row['transaction_amount'] / $transaction_user_plan_type['credit_points']),2,',','');
        $transaction_amount = number_format($transaction_row['transaction_amount'],2,',','');
        
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
        $subject1 = $admin_site_name." - Error en el pago";

        $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 44"); //User mail template fetch
        $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

        $mail_template_client = $client_sql_fetch_row['mail_template'];
        
        $admin_cod_num_bank = $admin_primary_email_fetchrow['admin_cod_num_bank'];
        $admin_cod_entity_bank = $admin_primary_email_fetchrow['admin_cod_entity_bank'];
        $admin_cod_iban = $admin_primary_email_fetchrow['admin_cod_iban'];
        $admin_cod_bic_swift = $admin_primary_email_fetchrow['admin_cod_bic_swift'];
        $admin_cod_benify = $admin_primary_email_fetchrow['admin_cod_benify'];
        $concept_cod = "Pago ".$TransCode;

        $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
        $message1 = stripslashes(str_replace(array('\' . $num_credits . \'', '\' . $credit_name . \'', '\' . $credit_price . \'','\' . $transaction_amount . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \'','\' . $admin_cod_entity_bank . \'','\' . $admin_cod_num_bank . \'','\' . $admin_cod_iban . \'','\' . $admin_cod_bic_swift . \'','\' . $admin_cod_benify . \'','\' . $concept_cod . \''),
                array('' . $num_credits . '', '' . $credit_name . '', '' . $credit_price . '','' . $transaction_amount . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $admin_cod_entity_bank . '','' . $admin_cod_num_bank . '','' . $admin_cod_iban . '','' . $admin_cod_bic_swift . '','' . $admin_cod_benify . '','' . $concept_cod . ''), $mail_template_client));

        $headers1 = "From: " . "$admin_email" . "\r\n";
        $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers1 .= "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to1, $subject1, $message1, $headers1); //Client email
    }
}
?>

<script type="text/javascript">
    window.location.replace('https://www.oficinadeprofesionales.com/error-payment?code=<?php echo $TransCode;?>');
</script>