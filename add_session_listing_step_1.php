<?php
if (file_exists('admin/classes/index.function.php')) {
    include('admin/classes/index.function.php');
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['listing_submit_step_1'])) {


    // Basic Personal Details
    //    $_SESSION['first_name'] = $_POST["first_name"];
    //    $_SESSION['last_name'] = $_POST["last_name"];
    //    $_SESSION['mobile_number'] = $_POST["mobile_number"];
    //    $_SESSION['email_id'] = $_POST["email_id"];
    //
    //    $_SESSION['register_mode'] = "Direct";
    //    $_SESSION['user_status'] = "Inactive";

    // Common Listing Details
        $_SESSION['listing_name'] = trim(strip_tags(htmlspecialchars($_POST["listing_name"])));
        $_SESSION['listing_mobile'] = trim(strip_tags(htmlspecialchars($_POST["listing_mobile"])));
        $_SESSION['listing_email'] = trim(strip_tags(htmlspecialchars($_POST["listing_email"])));
        $_SESSION['listing_website'] = trim(strip_tags(htmlspecialchars($_POST["listing_website"])));
        $_SESSION['listing_address'] = trim(strip_tags(htmlspecialchars($_POST["listing_address"])));
        $_SESSION['listing_lat'] = trim(strip_tags(htmlspecialchars($_POST["listing_lat"])));
        $_SESSION['listing_lng'] = trim(strip_tags(htmlspecialchars($_POST["listing_lng"])));
        $_SESSION['listing_description'] = $_POST["listing_description"];
        $_SESSION['category_id'] = $_POST["category_id"];
        //$_SESSION['sub_category_id'] = $_POST["sub_category_id"];
        $_SESSION['state_id'] = $_POST["state_id"];
        $_SESSION['country_id'] = 1;
        $_SESSION['city_id'] = $_POST["city_id"];
        $_SESSION['service_locations'] = trim(strip_tags(htmlspecialchars($_POST["service_locations"])));



        //************************  Profile Image Upload starts  **************************
        if (!empty($_FILES['profile_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['profile_image']['name']);
            $file_loc = $_FILES['profile_image']['tmp_name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_type = $_FILES['profile_image']['type'];
            $folder = "images/listings/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $profile_image = $event_image;
        }else{
            $profile_image = $_POST['profile_image_old_hidden'];
        }

        $_SESSION['profile_image'] = $profile_image;

    //************************  Profile Image Upload Ends  **************************
    //************************  Cover Image Upload starts  **************************

        if (!empty($_FILES['cover_image']['name'])) {
            $file = generar_texto_amigable_img($_FILES['cover_image']['name']);
            $file_loc = $_FILES['cover_image']['tmp_name'];
            $file_size = $_FILES['cover_image']['size'];
            $file_type = $_FILES['cover_image']['type'];
            $folder = "images/listing-ban/";
            $new_size = $file_size / 1024;
            $event_image = $file;
            move_uploaded_file($file_loc, $folder . $event_image);
            $cover_image = $event_image;
        }else{
            $cover_image = $_POST['cover_image_old_hidden'];
        }

        $_SESSION['cover_image'] = $cover_image;


    //************************  Cover Image Upload ends  **************************


        if ($_SESSION['listing_name'] == NULL || empty($_SESSION['listing_name'])) {
            header('Location: add-listing-step-1');
        }else{
            header('Location: add-listing-step-2');
        }
    }
}else{
    header('Location: add-listing-step-1');
}