<?php
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf; 
use Dompdf\Options;

if (file_exists('config/info.php')) {
    include('config/info.php');
}

$transaction_code = $_GET['transaction_code'];

$transaction_row = getTransaction($transaction_code);

$user_details_row = getUser($transaction_row['user_id']);

if($transaction_row['plan_type_id']>0){
    $transaction_user_plan_type = getCreditType($transaction_row['plan_type_id']);
    $num = $transaction_user_plan_type['credit_points'] ." cr&eacute;ditos";
    $description = $transaction_user_plan_type['credit_name'];
    $price = number_format(($transaction_row['transaction_amount'] / $transaction_user_plan_type['credit_points']),2,',','').'&euro;';
}

if($transaction_row['ad_enquiry_id']>0){
    $ad_enquiry_id = $transaction_row['ad_enquiry_id'];
    $row_ad_enquiry = getAdsEnquiry($ad_enquiry_id);
    $ads_price_id = $row_ad_enquiry['all_ads_price_id'];
    $ad_enquiry_price = getAdsPrice($ads_price_id);
            
    $num = $row_ad_enquiry['ad_total_days']." d&iacute;as";
    $description = $ad_enquiry_price['ad_price_name'];
    $price = number_format($row_ad_enquiry['ad_cost_per_day'],2,',','').'&euro;/d&iacute;a';
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

$path = '../images/home/24147logo-blanco.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$base_amount = $transaction_row['transaction_amount'] / 1.21;
$total_iva = round(($transaction_row['transaction_amount'] - $base_amount), 2, PHP_ROUND_HALF_UP);

$html = '
<table class="table">
    <tbody>
        <tr style="width: 700px;">
            <td style=" background: #0b253a; width: 350px"><img src="'.$base64.'" style="max-width: 200px; padding-left: 20px"></td>
            <td style="width: 350px; text-align: right;">
                <h2 style="font-size:1em"> N&deg; Factura: ' . $transaction_row['transaction_invoice'] . '</h2>
                <p style="font-size:1em"><strong>Fecha factura:</strong>' . date("d-m-Y", strtotime($transaction_row['transaction_create_cdt'])).'</p>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 20px; width:50%">
                <h2 style="font-size:1.2em;color:#333;">La Oficina de los profesionales</h2>
                <p>
                    Apartado de correos 2097<br/>
                    Jaén<br/>
                    23080 - Jaén <br/>
                    CIF/NIF - B-23449309
                </p>
            </td>
            <td style="width:50%;">
                <h2 style="font-size:1.2em;color:#333;">'.$user_details_row['first_name'].'</h2>
                <p>'.
                    $user_details_row['user_address'] . '<br/>' . $user_details_row['user_city']. '<br/>' . $user_details_row['user_zip_code'] ." - ". $user_details_row['user_state'] . '<br/>' ."CIF/NIF - ". $user_details_row['cif_nif'].'
                </p>
            </td>
        </tr>
    </tbody>
</table>
<table align="center" border="0" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <td>
            <table border="0" cellpadding="5" cellspacing="0" width="100%">
                <tr align="center">
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Valor</th>
                </tr>
                <tr>
                    <td colspan="7"><hr></td>
                </tr>
                <tr align="center">
                    <td>'.
                        $num.'
                    </td>
                    <td>'. $description.'</td>
                    <td>'. $price .'</td>
                    <td>'. number_format($transaction_row['transaction_amount'],2,',','').'&euro;</td>
                </tr>
                <tr>
                <td colspan="7"><hr></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">BASE</td>
                    <td style="text-align: center;">'. number_format($base_amount,2,',','').'&euro;</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">IVA 21%</td>
                    <td style="text-align: center;">'. number_format($total_iva,2,',','') . '&euro;</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">TOTAL</td>
                    <td style="text-align: center;">'. number_format($transaction_row['transaction_amount'],2,',','').'&euro;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>';

$options = new Options();
$options->set('defaultFont', 'Helvetica');

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($transaction_row['transaction_invoice'].'.pdf');