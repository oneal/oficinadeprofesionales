<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['payment_credential_submit'])) {

        $admin_cod_num_bank = $_POST['admin_cod_num_bank'];
        $admin_cod_entity_bank = $_POST['admin_cod_entity_bank'];
        $admin_cod_iban = $_POST['admin_cod_iban'];
        $admin_cod_bic_swift = $_POST['admin_cod_bic_swift'];
        $admin_cod_benify = $_POST['admin_cod_benify'];
        $admin_cod_status = $_POST['admin_cod_status'];
        $admin_paypal_id = $_POST['admin_paypal_id'];
        $admin_stripe_id = $_POST['admin_stripe_id'];
        $admin_paypal_status = $_POST['admin_paypal_status'];
        $admin_paypal_pruebas = 0;
        if(isset($_POST['paypal_test'])){
            $admin_paypal_pruebas = 1;
        }
        $admin_stripe_status = $_POST['admin_stripe_status'];
        
        $admin_tpv_version = $_POST['admin_tpv_version'];
        $admin_tpv_clave = $_POST['admin_tpv_clave'];
        $admin_tpv_name = $_POST['admin_tpv_name'];
        $admin_tpv_code = $_POST['admin_tpv_code'];
        $admin_tpv_terminal = $_POST['admin_tpv_terminal'];
        $admin_tpv_status = $_POST['admin_tpv_status'];
        $admin_tpv_pruebas = 0;
        if(isset($_POST['tpv_test'])){
            $admin_tpv_pruebas = 1;
        }
        
        $footer_id = $_POST['footer_id'];


        if($_POST['footer_path'] == "cod"){

            $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET  admin_cod_status='" . $admin_cod_status. "', admin_cod_num_bank='" . $admin_cod_num_bank. "', admin_cod_entity_bank='" . $admin_cod_entity_bank. "', admin_cod_iban='" . $admin_cod_iban. "', admin_cod_bic_swift='" . $admin_cod_bic_swift. "', admin_cod_benify='" . $admin_cod_benify. "'
        where footer_id='" . $footer_id . "'");

        }elseif($_POST['footer_path'] == "paypal"){

            $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET admin_paypal_id='" . $admin_paypal_id. "'
        , admin_paypal_status='" . $admin_paypal_status. "', admin_paypal_pruebas = '".$admin_paypal_pruebas."'
        where footer_id='" . $footer_id . "'");

        }elseif($_POST['footer_path'] == "stripe"){

            $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET admin_stripe_id='" . $admin_stripe_id . "'
        , admin_stripe_status='" . $admin_stripe_status. "' 
        where footer_id='" . $footer_id . "'");
        }elseif($_POST['footer_path'] == "tpv"){

            $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET  admin_tpv_status='" . $admin_tpv_status. "', admin_tpv_version='" . $admin_tpv_version. "', admin_tpv_clave='" . $admin_tpv_clave. "', admin_tpv_name='" . $admin_tpv_name. "', admin_tpv_code='" . $admin_tpv_code. "', admin_tpv_terminal='" . $admin_tpv_terminal. "', admin_tpv_pruebas = '".$admin_tpv_pruebas."'
        where footer_id='" . $footer_id . "'");
        }



        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-payment-credentials.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-payment-credentials.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-payment-credentials.php');
    exit;
}
?>