<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['store_submit'])) {



        $curDate = date("Y-m-d H:i:s", time());

        //$user_status = "Inactive";

        // Common Listing Details
       $store_name = $_POST["store_name"];
        $store_mobile = $_POST["store_mobile"];
        $store_email = $_POST["store_email"];
        $store_website = $_POST["store_website"];
        $store_description = addslashes($_POST["store_description"]);

        $state_id = $_POST["state_id"];

        $country_id = "1";

        $city_id = $_POST["city_id"];

        $category_id = $_POST["category_id"];

        $store_slug = generar_texto_amigable($store_name);
        $store_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "stores  WHERE store_slug='" . $store_slug . "' ");

        if (mysqli_num_rows($store_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-new-store.php');
            exit;
        }

//************************  Profile Image Upload starts  **************************
        
        if (!empty($_FILES['profile_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['profile_image']['name']);
            $file_loc = $_FILES['profile_image']['tmp_name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_type = $_FILES['profile_image']['type'];
            $folder = "../images/stores/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $profile_image = $event_image;
        }
//************************  Profile Image Upload Ends  **************************
//        if (isset($_POST['user_code']) && !empty($_POST['user_code'])) {
//            $user_code = $_POST['user_code'];
//            $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_code='" . $user_code . "'");
//            $user_details_row = mysqli_fetch_array($user_details);
//
//            $user_id = $user_details_row['user_id'];  //User Id
//
//            if($user_details_row['user_status'] == 'Active'){
//                // Listing Status
//                $listing_status = "Active";
//            }else{
//                // Listing Status
//                $listing_status = "Inactive";
//            }
//
//        }
        $listing_status = "Active";
        $user_id = 0;
        $store_status = 'Active';
        $payment_status = 'Pending';


        $store_qry = "INSERT INTO " . TBL . "stores 
					(user_id, category_id, store_name, store_mobile, store_email
					, store_website, country_id, state_id, city_id, store_description, profile_image, store_status
					, payment_status, store_slug, store_cdt) 
					VALUES 
					('$user_id', '$category_id', '$store_name', '$store_mobile', '$store_email', '$store_website', '$country_id'
					, '$state_id', '$city_id', '$store_description', '$profile_image', '$store_status'
					, '$payment_status', '$store_slug', '$curDate')";

        $store_res = mysqli_query($conn,$store_qry);
        $ListingID = mysqli_insert_id($conn);
        $listlastID = $ListingID;

        $ListCode = 'STORE' . substr(sha1(time()), 0, 10);

        $lisupqry = "UPDATE " . TBL . "stores 
					  SET store_code = '$ListCode' 
					  WHERE store_id = $listlastID";

        $lisupres = mysqli_query($conn,$lisupqry);

        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

        header('Location: admin-add-new-store.php');
    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-add-new-store.php');
}