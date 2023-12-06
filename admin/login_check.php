<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";

if ($_SERVER['REQUEST_METHOD']=='POST') {

    if (isset($_POST['admin_submit'])) {
//Retrieving data from html form
        $admin_email = mysqli_real_escape_string($conn,$_POST['admin_email']);
        $admin_password = mysqli_real_escape_string($conn,$_POST['admin_password']);

        $login = mysqli_query($conn,"SELECT * FROM " . TBL . "admin WHERE admin_email = '$admin_email'");
        
        //Check whether the query was successful or not
        $row = mysqli_fetch_array($login);

        if (mysqli_num_rows($login) > 0) {
            $password_hash = password_hash($admin_password, HASH, ['cost' => COST]);

            if (password_verify($admin_password,$row['admin_password'])) {
                $admin_id = $row['admin_id'];
                $_SESSION['admin_id'] = $admin_id;
                $update = mysqli_query($conn,"UPDATE " . TBL . "admin SET admin_login=now() where admin_id=" . $_SESSION['admin_id'] . "");

                if (password_needs_rehash($row['admin_password'], HASH , ['cost' => COST])) {
                    $newHash = password_hash($admin_password, HASH, ['cost' => COST]);
                    $upqry = "UPDATE " . TBL . "admin 
                                      SET admin_password = '$newHash' 
                                      WHERE admin_id = $admin_id";

                    $upres = mysqli_query($conn,$upqry);
                }

                header("location: profile.php");
            } else {
                $_SESSION['status_msg'] = $BIZBOOK['TEXT_LOGIN_CHECK'];

                header("location: index.php");
            }
        } else {
            $_SESSION['status_msg'] = $BIZBOOK['TEXT_LOGIN_CHECK'];

            header("location: index.php");
        }
    }
}else {
    $_SESSION['status_msg'] = $BIZBOOK['TEXT_LOGIN_CHECK'];

    header("location: index.php");
}
?>