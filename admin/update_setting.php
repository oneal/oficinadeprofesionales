<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['setting_submit'])) {

        $website_address = $_POST['website_address'];
        $admin_primary_email = $_POST['admin_primary_email'];
        $currency_symbol = $_POST['currency_symbol'];
        
        $footer_id = $_POST['footer_id'];
        $header_logo_old = $_POST['header_logo_old'];
        

        
        //Super Admin Data's
        $admin_id = 1;
        $admin_email = $_POST['admin_email'];
        $admin_name = $_POST['admin_name'];
        
        $admin_sql_row = getAllSuperAdmin();
        //$admin_password_old = $_POST['admin_password_old'];
        
        if($_POST["admin_password"] != NULL){

            $admin_password = password_hash($_POST["admin_password"], HASH, ['cost' => COST]);
        }else{
            $admin_password = $admin_sql_row['admin_password'];
        }
        
        $admin_language = $_POST['admin_language'];
        $admin_photo_old = $_POST['admin_photo_old'];
        $home_page_fav_icon_old = $_POST['home_page_fav_icon_old'];
        $home_page_banner_old = $_POST['home_page_banner_old'];

        $admin_countries123 = $_POST["admin_countries"];

        $admin_seo_title = $_POST["admin_seo_title"];
        $admin_seo_description = $_POST["admin_seo_description"];
        $admin_seo_keywords = $_POST["admin_seo_keywords"];

        $admin_google_login = $_POST["admin_google_login"];
        $admin_facebook_login = $_POST["admin_facebook_login"];

        $admin_google_client_id = $_POST["admin_google_client_id"];
        $admin_google_client_secret = $_POST["admin_google_client_secret"];
        $admin_facebook_app_id = $_POST["admin_facebook_app_id"];
        
        $admin_geo_map_api = $_POST["admin_geo_map_api"];
        $admin_geo_default_latitude = $_POST["admin_geo_default_latitude"];
        $admin_geo_default_longitude = $_POST["admin_geo_default_longitude"];
        $admin_geo_default_zoom = $_POST["admin_geo_default_zoom"];

        $prefix = $fruitList = '';
        foreach ($admin_countries123 as $fruit)
        {
            $admin_countries .= $prefix .  $fruit ;
            $prefix = ',';
        }



        $_FILES['header_logo']['name'];

        if (!empty($_FILES['header_logo']['name'])) {
            $file = rand(1000, 100000) . $_FILES['header_logo']['name'];
            $file_loc = $_FILES['header_logo']['tmp_name'];
            $file_size = $_FILES['header_logo']['size'];
            $file_type = $_FILES['header_logo']['type'];
            $folder = "../images/home/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $header_logo = $event_image;
        } else {
            $header_logo = $header_logo_old;
        }

        $_FILES['home_page_fav_icon']['name'];

        if (!empty($_FILES['home_page_fav_icon']['name'])) {
            $file = rand(1000, 100000) . $_FILES['home_page_fav_icon']['name'];
            $file_loc = $_FILES['home_page_fav_icon']['tmp_name'];
            $file_size = $_FILES['home_page_fav_icon']['size'];
            $file_type = $_FILES['home_page_fav_icon']['type'];
            $folder = "../images/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $home_page_fav_icon = $event_image;
        } else {
            $home_page_fav_icon = $home_page_fav_icon_old;
        }

        $_FILES['home_page_banner']['name'];

        if (!empty($_FILES['home_page_banner']['name'])) {
            $file = rand(1000, 100000) . $_FILES['home_page_banner']['name'];
            $file_loc = $_FILES['home_page_banner']['tmp_name'];
            $file_size = $_FILES['home_page_banner']['size'];
            $file_type = $_FILES['home_page_banner']['type'];
            $folder = "../images/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $home_page_banner = $event_image;
        } else {
            $home_page_banner = $home_page_banner_old;
        }

        $_FILES['admin_photo']['name'];

        if (!empty($_FILES['admin_photo']['name'])) {
            $file = rand(1000, 100000) . $_FILES['admin_photo']['name'];
            $file_loc = $_FILES['admin_photo']['tmp_name'];
            $file_size = $_FILES['admin_photo']['size'];
            $file_type = $_FILES['admin_photo']['type'];
            $folder = "../images/user/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $admin_photo = $event_image;
        } else {
            $admin_photo = $admin_photo_old;
        }


        $sql = mysqli_query($conn,"UPDATE  " . TBL . "footer SET  website_address='" . $website_address. "'
        ,admin_primary_email='" . $admin_primary_email. "', currency_symbol='" . $currency_symbol . "'
        , header_logo='" . $header_logo. "', admin_language='" . $admin_language . "', admin_countries='" . $admin_countries . "'  
        , admin_google_client_id='" . $admin_google_client_id. "', admin_google_client_secret='" . $admin_google_client_secret . "'
        , admin_facebook_app_id='" . $admin_facebook_app_id. "', admin_seo_title='" . $admin_seo_title. "'
        , admin_seo_description='" . $admin_seo_description . "', admin_seo_keywords='" . $admin_seo_keywords. "'
        , home_page_fav_icon='" . $home_page_fav_icon . "', home_page_banner='" . $home_page_banner. "'
        , admin_google_login='" . $admin_google_login . "', admin_facebook_login='" . $admin_facebook_login. "'
        , admin_geo_map_api='" . $admin_geo_map_api. "', admin_geo_default_latitude='" . $admin_geo_default_latitude . "'
        , admin_geo_default_longitude='" . $admin_geo_default_longitude . "', admin_geo_default_zoom='" . $admin_geo_default_zoom . "'
        where footer_id='" . $footer_id . "'");

        $sql1 = mysqli_query($conn,"UPDATE  " . TBL . "admin SET admin_name='" . $admin_name. "', admin_email='" . $admin_email . "'
        , admin_password='" . $admin_password. "', admin_photo='" . $admin_photo. "' where admin_id='" . $admin_id . "'");

        if ($sql && $sql1) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];


            header('Location: admin-setting.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-setting.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-setting.php');
    exit;
}
?>