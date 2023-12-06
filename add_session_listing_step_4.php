<?php
if (file_exists('admin/classes/index.function.php')) {
    include('admin/classes/index.function.php');
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['listing_submit_step_4'])) {


        // Service Provided Details
        $_SESSION['google_map'] = $_POST["google_map"];
        $_SESSION['360_view'] = $_POST["360_view"];
        $_SESSION['listing_video'] = $_POST["listing_video"];
        
        if(!empty($_POST["gallery_image_old"])) {
            $gallery_image_old = $_POST["gallery_image_old"];
            $array_gallery_image_old = explode(',', $gallery_image_old);
        } else {
            $array_gallery_image_old = NULL;
        }

    // ************************  Offer Image Upload Starts  **************************

        if (count(array_filter($_FILES['gallery_image']['name'])) <= 0) {
            $prefix1 = $fruitList = $gallery_image_temp = '';
            if(isset($_POST["gallery_image_old_hidden"])) {
                $gallery_image_old123 = $_POST["gallery_image_old_hidden"];
                foreach ($gallery_image_old123 as $fruit1)
                {
                    if(!empty($fruit1)){
                        $gallery_image_temp .= $prefix1 .  $fruit1 ;
                        $prefix1 = ',';
                    }
                }
            }
            $gallery_image = $gallery_image_temp;
        } else {
            $num_files = count($_FILES['gallery_image']['name']);
            for ($k = 0; $k<=$num_files; $k++) {
                if (!empty($_FILES['gallery_image']['name'][$k])) {
                    $file = generar_texto_amigable_img($_FILES['gallery_image']['name'][$k]);
                    $file_loc = $_FILES['gallery_image']['tmp_name'][$k];
                    $file_size = $_FILES['gallery_image']['size'][$k];
                    $file_type = $_FILES['gallery_image']['type'][$k];
                    $folder = "images/listings/";
                    $new_size = $file_size / 1024;
                    $event_image = $file;
                    move_uploaded_file($file_loc, $folder . $event_image);
                    $gallery_image1[$k] = $event_image;
                }else{
                    $gallery_image1[$k] = "0";
                }
            }

            if($array_gallery_image_old){
                for($j = 0; $j<count($gallery_image1); $j++){
                    if($gallery_image1[$j] != 0){
                        $array_gallery_image_old[$j] = $gallery_image1[$j];
                    }
                }
                $array_gallery_image = $array_gallery_image_old;
            }else{
                $array_gallery_image = $gallery_image1;
            }

            $gallery_image = implode(",",$array_gallery_image);
        }

        // ************************  Gallery Image Upload ends  **************************   
    
        $_SESSION['gallery_image'] = $gallery_image;
        
        header('Location: add-listing-step-5.php');

    } else {
        header('Location: add-listing-step-1.php');
    }
} else {
    header('Location: add-listing-step-1.php');
}