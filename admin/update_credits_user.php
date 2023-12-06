<?php

include('config/info.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['credit_submit'])) {
        if(!empty($_POST['credit_plan'])){
            $credit_id = $_POST['credit_plan'];
            $user_id = $_POST['u_i'];

            $credit_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "credits where credit_id=" . $credit_id);
            $credit_details_row = mysqli_fetch_array($credit_details);
            
            $credit_points = $credit_details_row['credit_points'];  //Points

            $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_code='" . $user_id . "'");
            $user_details_row = mysqli_fetch_array($user_details);
            
            $user_i = $user_details_row['user_id'];

            $user_credit = $user_details_row['user_credit'];

            $new_credit_points = $credit_points + $user_credit;

            $lisupqry = "UPDATE " . TBL . "users 
                    SET user_credit = $new_credit_points 
                    WHERE user_id = $user_i";

            $lisupres = mysqli_query($conn,$lisupqry);

            $_SESSION['status_msg'] = $BIZBOOK['PAYMENT_SUCCESS'];

            header('Location: admin-my-profile-edit.php?row='.$user_i.'&path=2');
            exit();
        }else{
            $_SESSION['status_msg'] = "Debes seleccionar un plan de créditos";

            header('Location: admin-all-users');
            exit();
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-all-users');
        exit();
    }
}else{
    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-users');
    exit();
}


