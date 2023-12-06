<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['credit_submit'])) {


        $credit_name = $_POST['credit_name'];
        $credit_price = $_POST['credit_price'];
        $credit_points = $_POST['credit_points'];
        $credit_status = "Active";
        
        $curDate = date("Y-m-d H:i:s", time());

        $qry = "INSERT INTO " . TBL . "credits 
					(credit_name, credit_price,credit_points, credit_status,credit_cdt) 
					VALUES ('$credit_name' , '$credit_price','$credit_points' , '$credit_status', '$curDate')";

        $res = mysqli_query($conn,$qry);

        if ($res) {

            $_SESSION['status_msg'] = $BIZBOOK['SUCCESS'];


            header('Location: admin-credit.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-add-new-credit.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-credit.php');
    exit;
}
?>