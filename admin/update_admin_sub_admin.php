<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['sub_admin_submit'])) {

        $admin_id = $_POST['admin_id'];
        $admin_photo_old = $_POST['admin_photo_old'];

        $admin_name = $_POST["admin_name"];
        $admin_email = $_POST["admin_email"];
        
        $row = getAdmin($admin_id);
        //$admin_password_old = $_POST["admin_password_old"];
        
        if($_POST["admin_password"] != NULL){
            
            $admin_password = password_hash($_POST["admin_password"], HASH, ['cost' => COST]);
        }else{
            $admin_password = $row['admin_password'];
        }
        
        ;

        $admin_type = "Sub Admin";

        $admin_user_options_old = $_POST["admin_user_options"];
        $admin_listing_options_old = $_POST["admin_listing_options"];
        $admin_event_options_old = $_POST["admin_event_options"];
        $admin_blog_options_old = $_POST["admin_blog_options"];
        $admin_product_options_old = $_POST["admin_product_options"];
        $admin_category_options_old = $_POST["admin_category_options"];
        $admin_product_category_options_old = $_POST["admin_product_category_options"];
        $admin_enquiry_options_old = $_POST["admin_enquiry_options"];
        $admin_review_options_old = $_POST["admin_review_options"];
        $admin_feedback_options_old = $_POST["admin_feedback_options"];
        $admin_notification_options_old = $_POST["admin_notification_options"];
        $admin_ads_options_old = $_POST["admin_ads_options"];
        $admin_home_options_old = $_POST["admin_home_options"];
        $admin_country_options_old = $_POST["admin_country_options"];
        $admin_state_options_old = $_POST["admin_state_options"];
        $admin_city_options_old = $_POST["admin_city_options"];
        $admin_listing_filter_options_old = $_POST["admin_listing_filter_options"];
        $admin_invoice_options_old = $_POST["admin_invoice_options"];
        $admin_import_options_old = $_POST["admin_import_options"];
        $admin_sub_admin_options_old = $_POST["admin_sub_admin_options"];
        $admin_text_options_old = $_POST["admin_text_options"];
        $admin_listing_price_options_old = $_POST["admin_listing_price_options"];
        $admin_payment_options_old = $_POST["admin_payment_options"];
        $admin_setting_options_old = $_POST["admin_setting_options"];
        $admin_footer_options_old = $_POST["admin_footer_options"];
        $admin_dummy_image_options_old = $_POST["admin_dummy_image_options"];
        $admin_mail_template_options_old = $_POST["admin_mail_template_options"];
        $admin_work_offer_options_old = $_POST["admin_work_offer_options"];
        $admin_store_options_old = $_POST["admin_store_options"];
        $admin_state_options_old = $_POST["admin_state_options"];

        if($admin_state_options_old == "on"){
            $admin_state_options = 1;
        }else{
            $admin_state_options = 0;
        }

        if($admin_user_options_old == "on"){
            $admin_user_options = 1;
        }else{
            $admin_user_options = 0;
        }

        if($admin_listing_options_old == "on"){
            $admin_listing_options = 1;
        }else{
            $admin_listing_options = 0;
        }

        if($admin_event_options_old == "on"){
            $admin_event_options = 1;
        }else{
            $admin_event_options = 0;
        }

        if($admin_blog_options_old == "on"){
            $admin_blog_options = 1;
        }else{
            $admin_blog_options = 0;
        }

        if($admin_product_options_old == "on"){
            $admin_product_options = 1;
        }else{
            $admin_product_options = 0;
        }

        if($admin_category_options_old == "on"){
            $admin_category_options = 1;
        }else{
            $admin_category_options = 0;
        }

        if($admin_product_category_options_old == "on"){
            $admin_product_category_options = 1;
        }else{
            $admin_product_category_options = 0;
        }

        if($admin_enquiry_options_old == "on"){
            $admin_enquiry_options = 1;
        }else{
            $admin_enquiry_options = 0;
        }

        if($admin_review_options_old == "on"){
            $admin_review_options = 1;
        }else{
            $admin_review_options = 0;
        }

        if($admin_feedback_options_old == "on"){
            $admin_feedback_options = 1;
        }else{
            $admin_feedback_options = 0;
        }

        if($admin_notification_options_old == "on"){
            $admin_notification_options = 1;
        }else{
            $admin_notification_options = 0;
        }

        if($admin_ads_options_old == "on"){
            $admin_ads_options = 1;
        }else{
            $admin_ads_options = 0;
        }

        if($admin_home_options_old == "on"){
            $admin_home_options = 1;
        }else{
            $admin_home_options = 0;
        }

        if($admin_country_options_old == "on"){
            $admin_country_options = 1;
        }else{
            $admin_country_options = 0;
        }

        if($admin_state_options_old == "on"){
            $admin_state_options = 1;
        }else{
            $admin_state_options = 0;
        }

        if($admin_city_options_old == "on"){
            $admin_city_options = 1;
        }else{
            $admin_city_options = 0;
        }

        if($admin_listing_filter_options_old == "on"){
            $admin_listing_filter_options = 1;
        }else{
            $admin_listing_filter_options = 0;
        }

        if($admin_invoice_options_old == "on"){
            $admin_invoice_options = 1;
        }else{
            $admin_invoice_options = 0;
        }

        if($admin_import_options_old == "on"){
            $admin_import_options = 1;
        }else{
            $admin_import_options = 0;
        }

        if($admin_sub_admin_options_old == "on"){
            $admin_sub_admin_options = 1;
        }else{
            $admin_sub_admin_options = 0;
        }

        if($admin_text_options_old == "on"){
            $admin_text_options = 1;
        }else{
            $admin_text_options = 0;
        }

        if($admin_listing_price_options_old == "on"){
            $admin_listing_price_options = 1;
        }else{
            $admin_listing_price_options = 0;
        }

        if($admin_payment_options_old == "on"){
            $admin_payment_options = 1;
        }else{
            $admin_payment_options = 0;
        }

        if($admin_setting_options_old == "on"){
            $admin_setting_options = 1;
        }else{
            $admin_setting_options = 0;
        }

        if($admin_footer_options_old == "on"){
            $admin_footer_options = 1;
        }else{
            $admin_footer_options = 0;
        }

        if($admin_dummy_image_options_old == "on"){
            $admin_dummy_image_options = 1;
        }else{
            $admin_dummy_image_options = 0;
        }

        if($admin_mail_template_options_old == "on"){
            $admin_mail_template_options = 1;
        }else{
            $admin_mail_template_options = 0;
        }

        if($admin_work_offer_options_old == "on"){
            $admin_work_offer_options = 1;
        }else{
            $admin_work_offer_options = 0;
        }

        if($admin_store_options_old == "on"){
            $admin_store_options = 1;
        }else{
            $admin_store_options = 0;
        }

        if (!empty($_FILES['admin_photo']['name'])) {
            $file = rand(1000, 100000) . $_FILES['admin_photo']['name'];
            $file_loc = $_FILES['admin_photo']['tmp_name'];
            $file_size = $_FILES['admin_photo']['size'];
            $file_type = $_FILES['admin_photo']['type'];
            $folder = "../images/user/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $admin_photo_1 = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $admin_photo_1);
            $admin_photo = $admin_photo_1;
        }else {
            $admin_photo = $admin_photo_old;
        }


        $sql = mysqli_query($conn,"UPDATE  " . TBL . "admin SET admin_name='" . $admin_name . "', admin_email='" . $admin_email. "'
     , admin_password='" . $admin_password . "' , admin_photo='" . $admin_photo . "', admin_user_options='" . $admin_user_options . "'
    
     , admin_listing_options='" . $admin_listing_options . "' , admin_event_options='" . $admin_event_options . "', admin_blog_options='" . $admin_blog_options . "' , admin_product_options='" . $admin_product_options . "'
     , admin_category_options='" . $admin_category_options . "' , admin_product_category_options='" . $admin_product_category_options . "' , admin_enquiry_options='" . $admin_enquiry_options . "'
     , admin_review_options='" . $admin_review_options . "', admin_feedback_options='" . $admin_feedback_options . "'
     , admin_notification_options='" . $admin_notification_options . "' , admin_ads_options='" . $admin_ads_options . "', admin_home_options='" . $admin_home_options . "'
     , admin_country_options='" . $admin_country_options . "', admin_state_options='" . $admin_state_options ."', admin_city_options='" . $admin_city_options . "', admin_listing_filter_options='" . $admin_listing_filter_options . "'
     , admin_invoice_options='" . $admin_invoice_options . "' , admin_import_options='" . $admin_import_options . "', admin_sub_admin_options='" . $admin_sub_admin_options . "'
     , admin_text_options='" . $admin_text_options . "' , admin_listing_price_options='" . $admin_listing_price_options . "', admin_payment_options='" . $admin_payment_options . "'
     , admin_setting_options='" . $admin_setting_options . "' , admin_footer_options='" . $admin_footer_options . "', admin_dummy_image_options='" . $admin_dummy_image_options . "'
     , admin_mail_template_options='" . $admin_mail_template_options . "', admin_work_offer_options='" . $admin_work_offer_options . "', admin_store_options='" . $admin_store_options . "', admin_state_options='" . $admin_state_options . "'
   
     where admin_id='" . $admin_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-sub-admin-all.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-sub-admin-edit.php?row=' . $admin_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-sub-admin-all.php');
    exit;
}
?>