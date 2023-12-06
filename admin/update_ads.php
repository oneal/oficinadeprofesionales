<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['edit_ad_submit'])) {

//        $path = $_POST['path'];
        $all_ads_enquiry_id = $_POST['all_ads_enquiry_id'];
        $all_ads_enquiry_row = getAdsEnquiry($all_ads_enquiry_id);
        
        if($all_ads_enquiry_row['invoice_less'] == 0){
            if($all_ads_enquiry_row['ad_enquiry_status'] == 'Active'){
                $ad_enquiry_photo_old = $_POST['ad_enquiry_photo_old'];

                $ad_link = addslashes($_POST["ad_link"]);

                $_FILES['ad_enquiry_photo']['name'];

                if (!empty($_FILES['ad_enquiry_photo']['name'])) {
                    $file = generar_texto_amigable_img($_FILES['ad_enquiry_photo']['name']);
                    $file_loc = $_FILES['ad_enquiry_photo']['tmp_name'];
                    $file_size = $_FILES['ad_enquiry_photo']['size'];
                    $file_type = $_FILES['ad_enquiry_photo']['type'];
                    $folder = "../images/ads/";
                    $new_size = $file_size / 1024;
                    $event_image = $file;
                    move_uploaded_file($file_loc, $folder . $event_image);
                    $ad_enquiry_photo = $event_image;
                } else {
                    $ad_enquiry_photo = $ad_enquiry_photo_old;
                }

                $hour = date("H:i:s", time());

                $ad_end_date_old = $_POST["ad_end_date"]." ".$hour;
                $ad_end_date = strtotime($ad_end_date_old);

                $sql = mysqli_query($conn, "UPDATE  " . TBL . "all_ads_enquiry SET ad_end_date = '". $ad_end_date ."', ad_enquiry_photo='" . $ad_enquiry_photo . "' , ad_link ='" . $ad_link . "'
                where all_ads_enquiry_id='" . $all_ads_enquiry_id . "'");
            }else{
                $ad_enquiry_photo_old = $_POST['ad_enquiry_photo_old'];

                $user_id = $_POST["user_id"];
                $all_ads_price_id = $_POST["all_ads_price_id"];

                $ad_link = addslashes($_POST["ad_link"]);

                $ad_start_date_old = $_POST["ad_start_date"];
                $timestamp1 = strtotime($ad_start_date_old);
                $ad_start_date = date('Y-m-d H:i:s', $timestamp1);

                $ad_end_date_old = $_POST["ad_end_date"];
                $timestamp = strtotime($ad_end_date_old);
                $ad_end_date = date('Y-m-d H:i:s', $timestamp);

                $ad_total_days = $_POST["ad_total_days"];
                $ad_cost_per_day = $_POST["ad_cost_per_day"];
                $ad_total_cost = $_POST["ad_total_cost"];


                $_FILES['ad_enquiry_photo']['name'];

                if (!empty($_FILES['ad_enquiry_photo']['name'])) {
                    $file = generar_texto_amigable_img($_FILES['ad_enquiry_photo']['name']);
                    $file_loc = $_FILES['ad_enquiry_photo']['tmp_name'];
                    $file_size = $_FILES['ad_enquiry_photo']['size'];
                    $file_type = $_FILES['ad_enquiry_photo']['type'];
                    $folder = "../images/ads/";
                    $new_size = $file_size / 1024;
                    $event_image = $file;
                    move_uploaded_file($file_loc, $folder . $event_image);
                    $ad_enquiry_photo = $event_image;
                } else {
                    $ad_enquiry_photo = $ad_enquiry_photo_old;
                }

                $sql = mysqli_query($conn, "UPDATE  " . TBL . "all_ads_enquiry SET user_id='" . $user_id . "'
                    , all_ads_price_id='" . $all_ads_price_id . "', ad_start_date='" . $ad_start_date . "'
                    , ad_end_date='" . $ad_end_date . "', ad_enquiry_photo='" . $ad_enquiry_photo . "' , ad_link ='" . $ad_link . "'
                    , ad_total_days='" . $ad_total_days . "', ad_cost_per_day='" . $ad_cost_per_day . "'
                    , ad_total_cost ='" . $ad_total_cost . "'
                 where all_ads_enquiry_id='" . $all_ads_enquiry_id . "'");
            }
            
            if ($sql) {

                $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

                if($path == 1){

                    header('Location: admin-current-ads.php');
                    exit;

                }else{

                    header('Location: admin-ads-request.php');
                    exit;
                }

            } else {

                $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                header('Location: admin-ads-edit.php?row=' . $all_ads_enquiry_id);
                exit;
            }
        }else{
            $ad_enquiry_photo_old = $_POST['ad_enquiry_photo_old'];

            $ad_link = addslashes($_POST["ad_link"]);

            $_FILES['ad_enquiry_photo']['name'];

            if (!empty($_FILES['ad_enquiry_photo']['name'])) {
                $file = generar_texto_amigable_img($_FILES['ad_enquiry_photo']['name']);
                $file_loc = $_FILES['ad_enquiry_photo']['tmp_name'];
                $file_size = $_FILES['ad_enquiry_photo']['size'];
                $file_type = $_FILES['ad_enquiry_photo']['type'];
                $folder = "../images/ads/";
                $new_size = $file_size / 1024;
                $event_image = $file;
                move_uploaded_file($file_loc, $folder . $event_image);
                $ad_enquiry_photo = $event_image;
            } else {
                $ad_enquiry_photo = $ad_enquiry_photo_old;
            }

            $hour = date("H:i:s", time());

            $ad_end_date_old = $_POST["ad_end_date"]." ".$hour;
            $ad_end_date = strtotime($ad_end_date_old);

            $sql = mysqli_query($conn, "UPDATE  " . TBL . "all_ads_enquiry SET ad_end_date = '". $ad_end_date ."', ad_enquiry_photo='" . $ad_enquiry_photo . "' , ad_link ='" . $ad_link . "'
            where all_ads_enquiry_id='" . $all_ads_enquiry_id . "'");
            
            if ($sql) {

                $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

                header('Location: admin-current-ads-invoice-less.php');
                exit;

            } else {

                $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

                header('Location: admin-ads-edit.php?row=' . $all_ads_enquiry_id);
                exit;
            }
        }
        
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

        header('Location: admin-ads-request.php');
        exit;
    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-ads-request.php');
    exit;
}
?>