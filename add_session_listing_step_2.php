<?php
if (file_exists('admin/classes/index.function.php')) {
    include('admin/classes/index.function.php');
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['listing_submit'])) {

        // Service Provided Details
        $_SESSION['service_id'] = $_POST["service_id"];
        
        if(!empty($_POST["service_image_old"])){
            $service_image_old = $_POST["service_image_old"];
            $array_service_img_old = explode(',', $service_image_old);
        }else{
            $array_service_img_old = NULL;
        }
        
        // ************************  Service Image Upload starts  ************************** 

        if (count(array_filter($_FILES['service_image']['name'])) <= 0) {
            $service_img_old123 = $_POST["service_img_old_hidden"];

            $prefix1 = $fruitList = '';
            foreach ($service_img_old123 as $fruit1)
            {
                $service_img_temp .= $prefix1 .  $fruit1 ;
                $prefix1 = ',';
            }
            $service_image = $service_img_temp;
        } else {
            $num_files = count($_FILES['service_image']['name']);

            for ($k = 0; $k<=$num_files; $k++) {
                if (!empty($_FILES['service_image']['name'][$k])) {
                    $file = generar_texto_amigable_img($_FILES['service_image']['name'][$k]);
                    $file_loc = $_FILES['service_image']['tmp_name'][$k];
                    $file_size = $_FILES['service_image']['size'][$k];
                    $file_type = $_FILES['service_image']['type'][$k];
                    $folder = "images/services/";
                    $new_size = $file_size / 1024;
                    $event_image = $file;
                    move_uploaded_file($file_loc, $folder . $event_image);
                    $service_image1[$k] = $event_image;
                }else{
                    $service_image1[$k] = "0";
                }
            }

            if($array_service_img_old){
                for($j = 0; $j<count($service_image1); $j++){
                    if($service_image1[$j] != 0){
                        $array_service_img_old[$j] = $service_image1[$j];
                    }
                }
                $array_service_img = $array_service_img_old;
            }else{
                $array_service_img = $service_image1;
            }

            $service_image = implode(",",$array_service_img);
        }

// ************************  Service Image Upload ends  **************************
        
        $_SESSION['service_image'] = $service_image;
        
        header('Location: add-listing-step-3');
       
    } else {
        header('Location: add-listing-step-1');
    }
}else{
    header('Location: add-listing-step-1');
}