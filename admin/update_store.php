<?php/** * Created by Vignesh. * User: Vignesh */if (file_exists('config/info.php')) {    include('config/info.php');}if ($_SERVER['REQUEST_METHOD']=='POST') {    if (isset($_POST['store_submit'])) {        $store_id = $_POST["store_id"];        $store_code = $_POST["store_code"];        $profile_image_old = $_POST["profile_image_old"];        $store_name = $_POST["store_name"];        $store_mobile = $_POST["store_mobile"];        $store_email = $_POST["store_email"];        $store_website = $_POST["store_website"];        $seo_title = $_POST['seo_title'];        $seo_description = $_POST['seo_description'];        $seo_keywords = $_POST['seo_keywords'];        $store_description = addslashes($_POST["store_description"]);        $country_id = 1;         $state_id = $_POST["state_id"];        $city_id = $_POST["city_id"];        $category_id = $_POST["category_id"];                $payment_status = "Pending";        $store_slug = generar_texto_amigable($store_name);        $store_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "stores  WHERE store_slug='" . $store_slug . "' and store_id!='" . $store_id . "'");        if (mysqli_num_rows($store_name_exist_check) > 0) {            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];            header('Location: admin-edit-listings.php?code=' . $store_code);            exit;        }//************************  Profile Image Upload starts  **************************        if (!empty($_FILES['profile_image']['name'])) {            $file = rand(1000, 100000) . $_FILES['profile_image']['name'];            $file_loc = $_FILES['profile_image']['tmp_name'];            $file_size = $_FILES['profile_image']['size'];            $file_type = $_FILES['profile_image']['type'];            $folder = "../images/stores/";            $new_size = $file_size / 1024;            $new_file_name = strtolower($file);            $event_image = str_replace(' ', '-', $new_file_name);            move_uploaded_file($file_loc, $folder . $event_image);            $profile_image = $event_image;        }else {            $profile_image = $profile_image_old;        }//************************  Profile Image Upload Ends  **************************        $user = getUserCode($_POST['user_code']);        $user_id = $user['user_id'];        $store_qry =            "UPDATE  " . TBL . "stores  SET category_id='" . $category_id . "', user_id='" . $user_id . "', store_mobile='" . $store_mobile . "', store_email='" . $store_email . "'            , store_website='" . $store_website . "', store_name='" . $store_name . "', country_id='" . $country_id . "',            state_id='" . $state_id . "',city_id='" . $city_id . "',store_description='" . $store_description . "',profile_image='" . $profile_image . "', payment_status='" . $payment_status . "'    , store_slug ='" . $store_slug. "', seo_title ='" . $seo_title. "', seo_description ='" . $seo_description. "', seo_keywords ='" . $seo_keywords. "' where store_id='" . $store_id . "'";        $store_res = mysqli_query($conn,$store_qry);        //****************************    Admin Primary email fetch ends    *************************        if ($store_res) {            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];            header('Location: admin-all-stores.php');            exit;        } else {            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];            header('Location: admin-edit-store.php?code=' . $store_code);        }    }}else {    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];    header('Location: admin-all-stores.php');}