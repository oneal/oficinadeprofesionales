<?php
if (file_exists('admin/classes/index.function.php')) {
    include('admin/classes/index.function.php');
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['listing_submit_step_3'])) {

// Service Provided Details
    
    $service_1_name123 = $_POST["service_1_name"];
    $prefix1 = $fruitList = $service_1_name = '';
    foreach ($service_1_name123 as $fruit1)
    {
        $service_1_name .= $prefix1 .  $fruit1 ;
        $prefix1 = '|';
    }


    $_SESSION['service_1_name'] = $service_1_name;
    
    $service_1_price123 = $_POST["service_1_price"];
    $prefix1 = $fruitList = $service_1_price =  '';
    foreach ($service_1_price123 as $fruit1)
    {
        $service_1_price .= $prefix1 .  $fruit1 ;
        $prefix1 = '|';
    }
    $_SESSION['service_1_price'] = $service_1_price;
    
    $service_1_detail123 = $_POST["service_1_detail"];
    $prefix1 = $fruitList = $service_1_detail = '';
    foreach ($service_1_detail123 as $fruit1)
    {
        $service_1_detail .= $prefix1 . $fruit1;
        //$service_1_detail = addslashes($service_1_detail1);
        $prefix1 = '|';
    }
    $_SESSION['service_1_detail'] = $service_1_detail;
    
    $service_1_view_more123 = $_POST["service_1_view_more"];
    $prefix1 = $fruitList = $service_1_view_more = '';
    foreach ($service_1_view_more123 as $fruit1)
    {
        $service_1_view_more .= $prefix1 .  $fruit1 ;
        $prefix1 = '|';
    }
        
    $_SESSION['service_1_view_more'] = $service_1_view_more;

    if(!empty($_POST["service_1_image_old"])) {
        $service_1_image_old = $_POST["service_1_image_old"];
        $array_service_1_img_old = explode(',', $service_1_image_old);
    } else {
        $array_service_1_img_old = NULL;
    }

// ************************  Offer Image Upload Starts  **************************

    if (count(array_filter($_FILES['service_1_image']['name'])) <= 0) {

        $prefix1 = $fruitList = $service_1_img_temp = '';
        if(isset($_POST["service_1_img_old_hidden"])) {
            $service_1_img_old123 = $_POST["service_1_img_old_hidden"];
            foreach ($service_1_img_old123 as $fruit1)
            {
                $service_1_img_temp .= $prefix1 .  $fruit1 ;
                $prefix1 = ',';
            }
            $service_1_image = $service_1_img_temp;
        }
    } else {
        $num_files = count($_FILES['service_1_image']['name']);

        for ($k = 0; $k<=$num_files; $k++) {
            if (!empty($_FILES['service_1_image']['name'][$k])) {
                $file = generar_texto_amigable_img($_FILES['service_1_image']['name'][$k]);
                $file_loc = $_FILES['service_1_image']['tmp_name'][$k];
                $file_size = $_FILES['service_1_image']['size'][$k];
                $file_type = $_FILES['service_1_image']['type'][$k];
                $folder = "images/services/";
                $new_size = $file_size / 1024;
                $event_image = $file;
                move_uploaded_file($file_loc, $folder . $event_image);
                $service_1_image1[$k] = $event_image;
            }else{
                $service_1_image1[$k] = "0";
            }
        }

        if($array_service_1_img_old){
            for($j = 0; $j<count($service_1_image1); $j++){
                if($service_1_image1[$j] != 0){
                    $array_service_1_img_old[$j] = $service_1_image1[$j];
                }
            }
            $array_service_1_img = $array_service_1_img_old;
        }else{
            $array_service_1_img = $service_1_image1;
        }

        $service_1_image = implode(",",$array_service_1_img);
    }
    
// ************************  Offer Image Upload ends  **************************
    $_SESSION['service_1_image'] = $service_1_image;

    header('Location: add-listing-step-4');
    
    } else {
        header('Location: add-listing-step-1');
    }
}else{
    header('Location: add-listing-step-1');
}