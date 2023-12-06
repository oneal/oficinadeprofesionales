<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if(isset($_GET['row']) and $_GET['row'] != ""){
    $user_id = $_GET['row'];
    
    $user_row = getUserCode($user_id); 
    
    if(!empty($user_row) and $user_row['user_status'] != 'Active'){
        $upqry = "UPDATE " . TBL . "users 
                            SET user_status = 'Active'
                            WHERE user_id = ".$user_row['user_id'];
        
        //echo $upqry; die();
        $upres = mysqli_query($conn,$upqry);
        
        if($upres){
            $_SESSION['status_msg'] = "Cuenta verificada correctamente";
            $_SESSION['login_status_msg'] = 1;

            header('Location: login?login');
            exit();
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
            $_SESSION['register_status_msg'] = 1;

            header('Location: login?login=register');
            exit();
        }
    } else {
        header('Location: '.$slash);
        exit();
    }
}else{
    header('Location: '.$slash);
    exit();
}

