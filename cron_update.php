<?php

//***************** Important Part Do Not Delete **************************

# Auto Update Of Listing Status when it has expiry dates starts

if (file_exists('config/info.php')) {
    include('config/info.php');
}

$exp_listsql = "SELECT * FROM " . TBL . "listings  WHERE listing_status = 'Active' AND listing_is_delete != '2' ORDER BY listing_id ASC";

$exp_listrs = mysqli_query($conn,$exp_listsql);

while ($exp_listrow = mysqli_fetch_array($exp_listrs)) {

    $exp_listing_type_id = $exp_listrow['listing_type_id'];
    $exp_listing_id = $exp_listrow['listing_id'];

    $exp_user_id = $exp_listrow['user_id'];

    $exp_user_type = "SELECT * FROM " . TBL . "users  WHERE user_id= '$exp_user_id'";
    $exp_user_type_rs = mysqli_query($conn, $exp_user_type);

    $exp_user_type_row = mysqli_fetch_array($exp_user_type_rs);

    if($exp_user_type_row['setting_user_status'] == 0){
        
        $user_credit = $exp_user_type_row['user_credit'];

        $continue = TRUE;
        if($exp_listrow['frequency_type'] == 1){
            $continue = TRUE;
        }else if($exp_listrow['frequency_type'] == 2){
            $time_actual = strtotime(date("H:i", time()));
            $time_inicio = strtotime('00:00');
            $time_fin = strtotime('08:00');
            if($time_actual > $time_inicio and $time_actual < $time_fin){
                $continue = FALSE;
            }
        }else{
            $continue = FALSE;
        }

        if($continue){
            if ($exp_listrow['credit_frequency'] != 0) {

                if ($user_credit != 0) {

                    if ($exp_listrow['credit_frequency'] == 1) {

                        $new_user_credit = $user_credit - 1;

                        //Update query to check interval of 3 hours starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 2 HOUR)";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 3 hours ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];      //To fetch the credit flag


                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {

                            //Query to update the new credit. starts
                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";


                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }

                    } elseif ($exp_listrow['credit_frequency'] == 2) {

                        $new_user_credit = $user_credit - 1;  //New Credit point Existing minus 1.

                        //Update query to check interval of 12 hours starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 5 HOUR)";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 12 hours ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];   //Credit Flag

                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {    //Logic to check flag is 1.
                            //Query to update the new credit. starts

                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";

                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }
                        
                    } elseif ($exp_listrow['credit_frequency'] == 3) {

                        $new_user_credit = $user_credit - 1;

                        //Update query to check interval of 1 DAY starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 8 HOUR) ";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 1 Day ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];      //To fetch the credit flag

                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {

                            //Query to update the new credit. starts

                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";

                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }
                        
                    } elseif ($exp_listrow['credit_frequency'] == 4) {

                        $new_user_credit = $user_credit - 1;

                        //Update query to check interval of 1 DAY starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 11 HOUR) ";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 1 Day ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];      //To fetch the credit flag

                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {

                            //Query to update the new credit. starts

                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";

                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }

                    } elseif ($exp_listrow['credit_frequency'] == 5) {

                        $new_user_credit = $user_credit - 1;

                        //Update query to check interval of 1 DAY starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 23 HOUR) ";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 1 Day ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];      //To fetch the credit flag

                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {

                            //Query to update the new credit. starts

                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";

                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }

                    } elseif ($exp_listrow['credit_frequency'] == 6) {

                        $new_user_credit = $user_credit - 1;

                        //Update query to check interval of 7 Day starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 167 HOUR) ";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 7 Day ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];      //To fetch the credit flag

                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {

                            //Query to update the new credit. starts

                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";

                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }

                    } elseif ($exp_listrow['credit_frequency'] == 7) {

                        $new_user_credit = $user_credit - 1;

                        //Update query to check interval of 30 Day starts

                        $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_cdt='".date("Y-m-d H:i:s", time())."',credit_flag = 1
                        where listing_id = $exp_listing_id AND listing_cdt < date_sub(now(),interval 729 HOUR) ";

                        $exp_update_rs = mysqli_query($conn, $exp_update_sql);

                        //Update query to check interval of 30 Day ends

                        //To fetch the credit flag from listing table starts

                        $exp_listsql1 = "SELECT * FROM " . TBL . "listings  WHERE listing_id = $exp_listing_id";

                        $exp_listrs1 = mysqli_query($conn,$exp_listsql1);
                        $exp_listrow1 = mysqli_fetch_array($exp_listrs1);

                        $credit_flag = $exp_listrow1['credit_flag'];      //To fetch the credit flag

                        //To fetch the credit flag from listing table ends

                        if ($exp_update_rs && ($credit_flag == 1)) {

                            //Query to update the new credit. starts

                            $exp_users_sql = "UPDATE  " . TBL . "users SET user_credit= $new_user_credit
                            where user_id='$exp_user_id'";

                            $exp_users_sql_rs = mysqli_query($conn, $exp_users_sql);

                            //Query to update the new credit. ends

                            //Query to reset the flag to 0. starts

                            $exp_update1_sql = "UPDATE  " . TBL . "listings SET credit_flag = 0
                            where listing_id='$exp_listing_id'";

                            $exp_update_rs1 = mysqli_query($conn, $exp_update1_sql);

                            //Query to reset the flag to 0. ends
                        }

                    }
                }
            }

        }

        //    $exp_list_type = "SELECT * FROM " . TBL . "listing_type  WHERE listing_type_id= '$exp_listing_type_id'";
        //    $exp_list_type_rs = mysqli_query($conn,$exp_list_type);
        //
        //    $exp_list_type_row = mysqli_fetch_array($exp_list_type_rs);
        //    $listing_type_duration = $exp_list_type_row['listing_type_duration'];
        //
        //
        //    $listing_inactive_status = "Inactive";
        //
        //    $exp_update_sql = "UPDATE  " . TBL . "listings SET listing_status='$listing_inactive_status'
        //     where listing_id='$exp_listing_id'
        //AND listing_cdt < DATE_SUB(NOW(), INTERVAL $listing_type_duration DAY)";
        //
        //
        //    $exp_update_rs = mysqli_query($conn,$exp_update_sql);
        //
        //    $exp_update_row = mysqli_fetch_array($exp_update_rs);
    }
}


# Auto Update Of Listing Status when it has expiry dates ends

//***************** Important Part Do Not Delete **************************