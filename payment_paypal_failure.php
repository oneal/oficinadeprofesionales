<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}
$_SESSION['status_msg'] = $BIZBOOK['PAYMENT_PAYPAL_FAILD'];

header('Location: db-payment');
exit;
?>