<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['export_invoce_submit'])) {
        
        if(!empty($_POST["start_date"]) and !empty($_POST["end_date"])){
            $start_date_old = $_POST["start_date"];
            $timestamp1 = strtotime($start_date_old);
            $start_date = date('Y-m-d', $timestamp1);

            $end_date_old = $_POST["end_date"];
            $timestamp = strtotime($end_date_old);
            $end_date = date('Y-m-d', $timestamp);

            $sql = "SELECT * FROM " . TBL . "transactions WHERE transaction_invoice != '' AND (DATE_FORMAT(transaction_create_cdt,'%Y-%m-%d') >= '". $start_date ."' AND DATE_FORMAT(transaction_create_cdt,'%Y-%m-%d') <= '". $end_date ."') ORDER BY transaction_create_cdt ASC";
            $transactions_rs = mysqli_query($conn, $sql);
        }else if(!empty($_POST["start_date"]) and empty($_POST["end_date"])){
            $start_date_old = $_POST["start_date"];
            $timestamp1 = strtotime($start_date_old);
            $start_date = date('Y-m-d H:i:s', $timestamp1);
            
            $sql = "SELECT * FROM " . TBL . "transactions WHERE transaction_create_cdt != '' AND transaction_create_cdt >= '". $start_date ."' ORDER BY transaction_create_cdt ASC";
            $transactions_rs = mysqli_query($conn, $sql);
        }else if(empty($_POST["start_date"]) and !empty($_POST["end_date"])){
            $end_date_old = $_POST["end_date"];
            $timestamp = strtotime($end_date_old);
            $end_date = date('Y-m-d H:i:s', $timestamp);
            
            $sql = "SELECT * FROM " . TBL . "transactions WHERE transaction_invoice != '' AND transaction_create_cdt <= '". $end_date ."' ORDER BY transaction_create_cdt ASC";
            $transactions_rs = mysqli_query($conn, $sql);
        }else if(empty($_POST["start_date"]) and empty($_POST["end_date"])){
            
            $sql = "SELECT * FROM " . TBL . "transactions WHERE transaction_invoice != '' ORDER BY transaction_create_cdt ASC";
            $transactions_rs = mysqli_query($conn, $sql);
        }

        if(!empty($transactions_rs)){
            header("Content-Type: application/xls");    
            header("Content-Disposition: attachment; filename=facturas".date('Ymd',time()).".xls");  
            header("Pragma: no-cache"); 
            header("Expires: 0");

            echo '<style type="text/css">
            .xl65
             {mso-style-parent:style0;
             mso-number-format:"\@";}
            </style>';

            echo '<table border="1">';
            //make the column headers what you want in whatever order you want
            echo '<tr><th>Num de referencia</th><th>Fecha emision de factura</th><th>Fecha pago de factura</th><th>Nombre del solicitante</th><th>Subtotal</th><th>IVA</th><th>Total</th><th>DNI/NIF/CIF del solicitante</th><th>Num. factura</th></tr>';

            foreach ($transactions_rs as $row) {
                $arra_invoice['Num de referencia'] = $row['transaction_code'];
                $arra_invoice['Fecha emision de factura'] = $row['transaction_create_cdt'];
                $arra_invoice['Fecha pago de factura'] = $row['transaction_pay_cdt'];
                $user_id = $row['user_id'];
                $user_row = getUser($user_id);
                $arra_invoice['Nombre del solicitante'] = utf8_decode($user_row['first_name']);

                $total_iva = round($row['transaction_amount'] * (21 / 100), 2, PHP_ROUND_HALF_UP);

                $arra_invoice['Subtotal'] = number_format(($row['transaction_amount'] - $total_iva),"2",",","");
                $arra_invoice['IVA'] = number_format($total_iva,"2",",","");
                $arra_invoice['Total'] = number_format($row['transaction_amount'],"2",",","");

                $arra_invoice['DNI/NIF/CIF del solicitante'] = $user_row['cif_nif'];

                $transaction_invoice = $row['transaction_invoice'];
                $arra_invoice['Num. factura'] = "$transaction_invoice";

                echo "<tr><td>".$arra_invoice['Num de referencia']."</td><td>".$arra_invoice['Fecha emision de factura']."</td><td>".$arra_invoice['Fecha pago de factura']."</td><td>".$arra_invoice['Nombre del solicitante']."</td><td>".$arra_invoice['Subtotal']."</td><td>".$arra_invoice['IVA']."</td><td>".$arra_invoice['Total']."</td><td>".$arra_invoice['DNI/NIF/CIF del solicitante']."</td><td class='xl65'>".$arra_invoice['Num. factura']."</td></tr>";
            }
        }
    }
}